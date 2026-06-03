<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_product.php';

$products = getDanhSachSach($conn);

include __DIR__ . '/../view/products/productgrid.php';
