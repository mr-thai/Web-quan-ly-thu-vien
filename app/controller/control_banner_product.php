<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_product.php';

$featuredBook = getSachBanChay($conn);

include __DIR__ . '/../view/products/banner-product.php';
