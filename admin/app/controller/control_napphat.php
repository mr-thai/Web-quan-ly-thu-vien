<?php
require_once __DIR__ . '/../model/model_getnguoidung_by_phone.php';
require_once __DIR__ . '/../model/model_getphat_by_user.php';
require_once __DIR__ . '/../model/model_update_phat.php';

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
        $ma_phat_list = $_POST['ma_phat'] ?? array();
            $so_tien_phat_list = $_POST['so_tien_phat'] ?? array();
        
            if (!empty($ma_phat_list)) {
                $updated_count = 0;
                foreach ($ma_phat_list as $index => $ma_phat) {
                    $so_tien_phat = isset($so_tien_phat_list[$index]) ? (int)$so_tien_phat_list[$index] : 0;
                    if ((int)$ma_phat > 0 && $so_tien_phat > 0) {
                        pm_update_phat($conn, (int)$ma_phat, $so_tien_phat);
                        $updated_count++;
                    }
                }
            
                $message = $updated_count > 0 ? 'thanh toán phạt thành công (' . $updated_count . ' dòng)' : 'Không có dữ liệu thanh toán';
            // Refresh data
            $danh_sach_phat = pm_get_phat_by_user($conn, $nguoi_dung['ma_nguoi_dung']);
        }
    }
}
?>
