<?php
require_once __DIR__ . '/../model/NguoiDungModel.php';

$message = '';
$keyword = trim($_GET['keyword'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        require __DIR__ . '/control_them_nguoidung.php';
    }

    if ($action === 'edit') {
        require __DIR__ . '/control_sua_nguoidung.php';
    }
}

if (isset($_GET['delete_id'])) {
    require __DIR__ . '/control_xoa_nguoidung.php';
}

require __DIR__ . '/control_danhsach_nguoidung.php';
?>