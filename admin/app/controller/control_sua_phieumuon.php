<?php
$ma_phieu_muon = (int)$_POST['ma_phieu_muon'];

$ok = pm_update($conn, $ma_phieu_muon, array(
    'ma_nguoi_dung' => (int)$_POST['ma_nguoi_dung'],
    'ngay_muon' => date('Y-m-d H:i:s', strtotime($_POST['ngay_muon'])),
    'ngay_hen_tra' => date('Y-m-d H:i:s', strtotime($_POST['ngay_hen_tra'])),
    'ghi_chu' => trim($_POST['ghi_chu'])
));

$message = $ok ? 'Cập nhật phiếu mượn thành công.' : 'Lỗi cập nhật phiếu mượn.';
?>