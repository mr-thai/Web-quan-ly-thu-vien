<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_index.php';

$sach_moi_phat_hanh = getSachMoiPhatHanh($conn);
$row = $sach_moi_phat_hanh ? $sach_moi_phat_hanh->fetch_assoc() : [];

if (!$row) {
	$row = [];
}

include __DIR__ . '/../view/index/sachmoiphathanh.php';
