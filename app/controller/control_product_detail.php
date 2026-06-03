<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_product.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header('Location: ../products.php');
    exit();
}

$book = getSachChiTiet($conn, $id);
if (!$book) {
    header('Location: ../products.php');
    exit();
}

$relatedBooks = false;
if (!empty($book['ma_tacgia'])) {
    $relatedBooks = getSachLienQuan($conn, $book['ma_tacgia']);
}
$bookImage = !empty($book['url_anh']) ? ltrim($book['url_anh'], '/') : 'images/products/img-01.jpg';
$authorImage = !empty($book['tac_gia_avatar']) ? ltrim($book['tac_gia_avatar'], '/') : 'images/author/imag-24.jpg';

$infoItems = [];
if (!empty($book['nha_xuat_ban'])) $infoItems[] = ['Nhà xuất bản', $book['nha_xuat_ban']];
if (!empty($book['nam_xuat_ban'])) $infoItems[] = ['Năm xuất bản', $book['nam_xuat_ban']];
if (!empty($book['so_trang'])) $infoItems[] = ['Số trang', $book['so_trang'] . ' trang'];
if (!empty($book['isbn'])) $infoItems[] = ['ISBN', $book['isbn']];
if (!empty($book['vi_tri_ke'])) $infoItems[] = ['Vị trí kệ', $book['vi_tri_ke']];
if (!empty($book['gia_sach'])) $infoItems[] = ['Giá sách', number_format((float)$book['gia_sach'], 0, ',', '.') . ' đ'];
if (!empty($book['so_luong_con']) || isset($book['so_luong_con'])) $infoItems[] = ['Còn lại', (int)$book['so_luong_con'] . ' cuốn'];
