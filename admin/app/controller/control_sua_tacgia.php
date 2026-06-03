<?php
require_once __DIR__ . '/helper_image.php';

$ma_tac_gia = (int)($_POST['ma_tac_gia'] ?? 0);

$avatar_url = trim($_POST['avatar_url'] ?? '');
if (!empty($avatar_url)) {
    $processed_url = process_base64_image($avatar_url, '/uploads/author');
} else {
    $processed_url = trim($_POST['old_avatar_url'] ?? '');
}

$ok = tg_update($conn, $ma_tac_gia, array(
    'ho_ten' => trim($_POST['ho_ten']),
    'but_danh' => trim($_POST['but_danh']),
    'ngay_sinh' => trim($_POST['ngay_sinh']),
    'ngay_mat' => trim($_POST['ngay_mat']),
    'quoc_tich' => trim($_POST['quoc_tich']),
    'avatar_url' => $processed_url,
    'tieu_su' => trim($_POST['tieu_su']),
    'ghi_chu' => trim($_POST['ghi_chu'])
));

$message = $ok ? 'Cập nhật tác giả thành công.' : 'Lỗi cập nhật tác giả.';
?>