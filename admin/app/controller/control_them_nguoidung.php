<?php
$ok = nd_add($conn, array(
    'ten_dang_nhap' => trim($_POST['ten_dang_nhap']),
    'ho_ten' => trim($_POST['ho_ten']),
    'email' => trim($_POST['email']),
    'mat_khau' => trim($_POST['mat_khau']),
    'so_dien_thoai' => trim($_POST['so_dien_thoai']),
    'trang_thai' => trim($_POST['trang_thai'])
));

$message = $ok ? 'Thêm người dùng thành công.' : 'Lỗi thêm người dùng.';
?>