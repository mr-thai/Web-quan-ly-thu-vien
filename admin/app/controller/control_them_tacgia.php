<?php
require_once __DIR__ . '/helper_image.php';

$avatar_url = trim($_POST['avatar_url'] ?? '');
$processed_url = process_base64_image($avatar_url, '/uploads/author');

$ok = tg_add($conn, array(
    'ho_ten' => trim($_POST['ho_ten']),
    'but_danh' => trim($_POST['but_danh']),
    'ngay_sinh' => trim($_POST['ngay_sinh']),
    'ngay_mat' => trim($_POST['ngay_mat']),
    'quoc_tich' => trim($_POST['quoc_tich']),
    'avatar_url' => $processed_url,
    'tieu_su' => trim($_POST['tieu_su']),
    'ghi_chu' => trim($_POST['ghi_chu'])
));

$message = $ok ? 'Thêm tác giả thành công.' : 'Lỗi thêm tác giả.';
?>