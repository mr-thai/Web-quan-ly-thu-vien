<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_product.php';

$relatedBooks = false;
$ma_tacgia = isset($_GET['ma_tacgia']) ? intval($_GET['ma_tacgia']) : 0;
if ($ma_tacgia > 0) {
    $relatedBooks = getSachLienQuan($conn, $ma_tacgia);
}

include __DIR__ . '/../view/products/sachtuongtu.php';
