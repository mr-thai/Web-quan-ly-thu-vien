<?php
$ma_phieu_muon = (int)$_POST['ma_phieu_muon'];
$ngay_tra = date('Y-m-d H:i:s', strtotime($_POST['ngay_tra']));

$ok = pm_return($conn, $ma_phieu_muon, $ngay_tra);
$message = $ok ? 'Trả sách thành công.' : 'Lỗi trả sách.';
?>