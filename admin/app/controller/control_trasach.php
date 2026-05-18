<?php
require_once __DIR__ . '/../model/model_getnguoidung_by_phone.php';
require_once __DIR__ . '/../model/model_getdangmuon_by_user.php';
require_once __DIR__ . '/control_tra_nap_helpers.php';

$phone = trim($_GET['phone'] ?? '');
$nguoi_dung = null;
$sach_dang_muon = array();
$message = '';

if (!empty($phone)) {
    $nguoi_dung = pm_get_nguoi_dung_by_phone($conn, $phone);
    
    if ($nguoi_dung) {
        $ma_nguoi_dung = $nguoi_dung['ma_nguoi_dung'];
        $sach_dang_muon = pm_get_dang_muon_by_user($conn, $ma_nguoi_dung);
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
                $message = 'Cập nhật trả sách thành công (' . ($result['updated_count'] ?? 0) . ' cuốn)';
                // Refresh data
                $sach_dang_muon = pm_get_dang_muon_by_user($conn, $nguoi_dung['ma_nguoi_dung']);
            } else {
                $message = 'Không có sách hợp lệ để xử lý';
            }
        }
    }
}
?>

