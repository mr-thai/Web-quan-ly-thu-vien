<?php
$phieu_muon_list = pm_get_all($conn, $keyword, $status_filter);
$chi_tiet_by_phieu = pm_get_details_map($conn, $phieu_muon_list);
$nguoi_dung_list = pm_get_nguoi_dung_list($conn);
$sach_list = pm_get_sach_list($conn);
?>