<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_index.php';

$danh_sach = getDanhSachSach($conn);

include __DIR__ . '/../view/index/sachmuonnhieu.php';
