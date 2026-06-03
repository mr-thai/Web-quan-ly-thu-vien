<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_product.php';

$danh_sach = getDanhSachSachProduct_aside($conn);
$danh_sach_tac_gia = getDanhSachSachAuthor_aside($conn);

include __DIR__ . '/../view/products/aside-products.php';
