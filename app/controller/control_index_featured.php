<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_index.php';

$sach_noi_bat = getSachNoiBat($conn);
$row = $sach_noi_bat ? $sach_noi_bat->fetch_assoc() : [];

if (!$row) {
	$row = [];
}

include __DIR__ . '/../view/index/sachnoibat.php';
