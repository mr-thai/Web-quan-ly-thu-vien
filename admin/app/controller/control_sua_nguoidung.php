<?php
$id = (int)($_POST['ma_nguoi_dung'] ?? 0);

$ok = nd_update($conn, $id, array(
    'ten_dang_nhap' => trim($_POST['ten_dang_nhap']),
    'ho_ten' => trim($_POST['ho_ten']),
    'email' => trim($_POST['email']),
    'mat_khau' => trim($_POST['mat_khau']),
    'so_dien_thoai' => trim($_POST['so_dien_thoai']),
    'trang_thai' => trim($_POST['trang_thai'])
));

$message = $ok ? 'Cập nhật người dùng thành công.' : 'Lỗi cập nhật người dùng.';
?>