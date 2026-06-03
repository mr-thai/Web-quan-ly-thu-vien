<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_author.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header('Location: ../authors.php');
    exit();
}

$author = getTacGiaChiTiet($conn, $id);
if (!$author) {
    header('Location: ../authors.php');
    exit();
}

$authorBooks = getSachTheoTacGia($conn, $id, 12);
