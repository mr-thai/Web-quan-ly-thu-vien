<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_index.php';

$sach_moi_phat_hanh = getSachChonBoiTacGia($conn);

include __DIR__ . '/../view/index/duocchonboitacgia.php';
