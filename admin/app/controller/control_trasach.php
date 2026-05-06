<?php
require_once __DIR__ . '/../model/model_getnguoidung_by_phone.php';
require_once __DIR__ . '/../model/model_getdangmuon_by_user.php';
require_once __DIR__ . '/../model/model_update_return_book.php';
require_once __DIR__ . '/../model/model_add_phat.php';

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
        $ma_chi_tiet_list = is_array($_POST['ma_chi_tiet_phieu'] ?? null) 
            ? $_POST['ma_chi_tiet_phieu'] 
            : (isset($_POST['ma_chi_tiet_phieu']) ? array($_POST['ma_chi_tiet_phieu']) : array());
        
        $ngay_tra_thuc_te = $_POST['ngay_tra_thuc_te'] ?? date('Y-m-d H:i:s');
        $trang_thai = $_POST['trang_thai'] ?? 'da_tra';
        $ghi_chu_tinh_trang = $_POST['ghi_chu_tinh_trang'] ?? '';
        
        $updated_count = 0;
        foreach ($ma_chi_tiet_list as $ma_chi_tiet_phieu) {
            $ma_chi_tiet_phieu = (int)$ma_chi_tiet_phieu;
            if ($ma_chi_tiet_phieu > 0) {
                pm_update_return_book($conn, $ma_chi_tiet_phieu, $ngay_tra_thuc_te, $trang_thai, $ghi_chu_tinh_trang);
                $updated_count++;
                
                // Auto-create fine if needed
                if ($trang_thai === 'hu_hong' || $trang_thai === 'mat_sach') {
                    $gia_goc = $_POST['gia_goc'] ?? 0;
                    $so_tien_phat = $_POST['so_tien_phat'] ?? $gia_goc;
                    pm_add_phat($conn, $ma_chi_tiet_phieu, $trang_thai, $gia_goc, $so_tien_phat);
                } elseif ($trang_thai === 'tra_tre_han') {
                    $gia_goc = $_POST['gia_goc'] ?? 0;
                    $so_tien_phat = $_POST['so_tien_phat'] ?? 5000;
                    pm_add_phat($conn, $ma_chi_tiet_phieu, 'tre_han', $gia_goc, $so_tien_phat);
                }
            }
        }
        
        if ($updated_count > 0) {
            $message = 'Cập nhật trả sách thành công (' . $updated_count . ' cuốn)';
            // Refresh data
            $sach_dang_muon = pm_get_dang_muon_by_user($conn, $nguoi_dung['ma_nguoi_dung']);
        }
    }
}
?>

