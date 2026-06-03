<?php
$ma_sach_list = $_POST['ma_sach'];
$so_luong_list = $_POST['so_luong'];
$books = array();

foreach ($ma_sach_list as $index => $ma_sach) {
    $books[] = array(
        'ma_sach' => (int)$ma_sach,
        'so_luong' => (int)$so_luong_list[$index]
    );
}

$ok = pm_add($conn, array(
    'ma_nguoi_dung' => (int)$_POST['ma_nguoi_dung'],
    'ngay_muon' => date('Y-m-d H:i:s', strtotime($_POST['ngay_muon'])),
    'ngay_hen_tra' => date('Y-m-d H:i:s', strtotime($_POST['ngay_hen_tra'])),
    'ghi_chu' => trim($_POST['ghi_chu']),
    'books' => $books
));

$message = $ok ? 'Tạo phiếu mượn thành công.' : 'Lỗi tạo phiếu mượn.';
?>