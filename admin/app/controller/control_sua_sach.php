<?php
require_once __DIR__ . '/helper_image.php';

$ma_sach = (int)($_POST['ma_sach'] ?? 0);

// Xử lý ảnh base64 nếu có
$url_anh = trim($_POST['url_anh'] ?? '');
if (!empty($url_anh)) {
    $processed_url = process_base64_image($url_anh, '/uploads/sach');
} else {
    $processed_url = trim($_POST['old_url_anh'] ?? '');
}

$data = array(
    'ma_tacgia' => (int)$_POST['ma_tacgia'],
    'isbn' => trim($_POST['isbn']),
    'ten_sach' => trim($_POST['ten_sach']),
    'nha_xuat_ban' => trim($_POST['nha_xuat_ban']),
    'ten_the_loai' => (int)$_POST['ten_the_loai'],
    'nam_xuat_ban' => (int)$_POST['nam_xuat_ban'],
    'so_trang' => (int)$_POST['so_trang'],
    'gia_sach' => (float)$_POST['gia_sach'],
    'so_luong' => (int)$_POST['so_luong'],
    'so_luong_con' => (int)$_POST['so_luong_con'],
    'vi_tri_ke' => trim($_POST['vi_tri_ke']),
    'mo_ta' => trim($_POST['mo_ta']),
    'url_anh' => $processed_url,
    'trang_thai' => ((int)$_POST['so_luong_con'] > 0) ? 'con' : 'het'
);

$ok = sach_update($conn, $ma_sach, $data);
$message = $ok ? 'Cập nhật sách thành công.' : 'Lỗi cập nhật sách.';
?>