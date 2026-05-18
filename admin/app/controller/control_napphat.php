<?php
require_once __DIR__ . '/../model/model_getnguoidung_by_phone.php';
require_once __DIR__ . '/../model/model_getphat_by_user.php';
require_once __DIR__ . '/control_tra_nap_helpers.php';

$phone = trim($_GET['phone'] ?? '');
$nguoi_dung = null;
$danh_sach_phat = array();
$message = '';

if (!empty($phone)) {
    $nguoi_dung = pm_get_nguoi_dung_by_phone($conn, $phone);
    
    if ($nguoi_dung) {
        $ma_nguoi_dung = $nguoi_dung['ma_nguoi_dung'];
        $danh_sach_phat = pm_get_phat_by_user($conn, $ma_nguoi_dung);
    } else {
        $message = 'Không tìm thấy ';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'confirm_phat' && $nguoi_dung) {
        $ma_phat_list = pm_filter_positive_int_list($_POST['ma_phat'] ?? null);
        $so_tien_phat_list = pm_normalize_post_list($_POST['so_tien_phat'] ?? null);
        
        if (!empty($ma_phat_list)) {
            $updated_count = process_confirm_phat($conn, $ma_phat_list, $so_tien_phat_list);
            
            $message = $updated_count > 0 ? 'thanh toán phạt thành công (' . $updated_count . ' dòng)' : 'Không có dữ liệu thanh toán';
            // Refresh data
            $danh_sach_phat = pm_get_phat_by_user($conn, $nguoi_dung['ma_nguoi_dung']);
        } else {
            $message = 'Vui lòng chọn ít nhất một phiếu phạt hợp lệ';
        }
    }
}
?>
