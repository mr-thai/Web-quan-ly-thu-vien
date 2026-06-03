<?php
require_once __DIR__ . '/../model/model_getnguoidung_by_phone.php';
require_once __DIR__ . '/../model/model_getdangmuon_by_user.php';
require_once __DIR__ . '/../model/model_getphat_by_user.php';
require_once __DIR__ . '/control_tra_nap_helpers.php';

$phone = trim($_GET['phone'] ?? '');
$nguoi_dung = null;
$sach_dang_muon = array();
$danh_sach_phat = array();
$message = '';

if (!empty($phone)) {
    $nguoi_dung = pm_get_nguoi_dung_by_phone($conn, $phone);

    if ($nguoi_dung) {
        $ma_nguoi_dung = (int) $nguoi_dung['ma_nguoi_dung'];
        $sach_dang_muon = pm_get_dang_muon_by_user($conn, $ma_nguoi_dung);
        $danh_sach_phat = pm_get_phat_by_user($conn, $ma_nguoi_dung);
    } else {
        $message = 'Không tìm thấy người dùng với số điện thoại này';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'return_book' && $nguoi_dung) {
        $ma_chi_tiet_list = pm_filter_positive_int_list($_POST['ma_chi_tiet_phieu'] ?? null);
        $ngay_tra_thuc_te = $_POST['ngay_tra_thuc_te'] ?? date('Y-m-d H:i:s');
        $trang_thai = $_POST['trang_thai'] ?? 'da_tra';
        $ghi_chu_tinh_trang = $_POST['ghi_chu_tinh_trang'] ?? '';

        if (empty($ma_chi_tiet_list)) {
            $message = 'Vui lòng chọn ít nhất một cuốn sách hợp lệ';
        } else {
            $result = process_return_items($conn, $ma_chi_tiet_list, $ngay_tra_thuc_te, $trang_thai, $ghi_chu_tinh_trang, $_POST);

            if (!empty($result['error'])) {
                $message = $result['error'];
            } elseif (($result['updated_count'] ?? 0) > 0) {
                // Prepare receipt data from returned items before refreshing lists
                $receipt = array();
                $receipt['items'] = array();
                $receipt['total_fine'] = 0;
                if (!empty($result['items']) && is_array($result['items'])) {
                    // map item titles from current $sach_dang_muon (pre-refresh)
                    $map = array();
                    foreach ($sach_dang_muon as $row) {
                        $map[(int)$row['ma_chi_tiet_phieu']] = $row;
                    }

                    foreach ($result['items'] as $it) {
                        $mid = (int)$it['ma_chi_tiet_phieu'];
                        $title = isset($map[$mid]) ? $map[$mid]['ten_sach'] : ('#' . $mid);
                        $gia = (float)($it['gia_goc'] ?? 0);
                        $phat = (float)($it['so_tien_phat'] ?? 0);
                        $receipt['items'][] = array(
                            'ma_chi_tiet_phieu' => $mid,
                            'ten_sach' => $title,
                            'trang_thai' => $it['trang_thai'] ?? '',
                            'gia_goc' => $gia,
                            'so_tien_phat' => $phat,
                        );
                        $receipt['total_fine'] += $phat;
                    }
                }

                $sach_dang_muon = pm_get_dang_muon_by_user($conn, (int) $nguoi_dung['ma_nguoi_dung']);
                $danh_sach_phat = pm_get_phat_by_user($conn, (int) $nguoi_dung['ma_nguoi_dung']);
            } else {
                $message = 'Không có sách hợp lệ để xử lý';
            }
        }
    }

    if ($action === 'confirm_phat' && $nguoi_dung) {
        $ma_phat_list = pm_filter_positive_int_list($_POST['ma_phat'] ?? null);
        $so_tien_phat_list = pm_normalize_post_list($_POST['so_tien_phat'] ?? null);

        if (!empty($ma_phat_list)) {
            $updated_count = process_confirm_phat($conn, $ma_phat_list, $so_tien_phat_list);

            $message = $updated_count > 0
                ? 'Thanh toán phạt thành công (' . $updated_count . ' dòng)'
                : 'Không có dữ liệu thanh toán';

            $danh_sach_phat = pm_get_phat_by_user($conn, (int) $nguoi_dung['ma_nguoi_dung']);
        } else {
            $message = 'Vui lòng chọn ít nhất một phiếu phạt hợp lệ';
        }
    }
}
