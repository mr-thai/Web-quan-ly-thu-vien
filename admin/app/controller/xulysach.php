<?php
require_once __DIR__ . '/../model/SachModel.php';

$message = '';
$keyword = trim($_GET['keyword'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        require __DIR__ . '/control_them_sach.php';
    }

    if ($action === 'edit') {
        require __DIR__ . '/control_sua_sach.php';
    }
}

if (isset($_GET['delete_id'])) {
    require __DIR__ . '/control_xoa_sach.php';
}

require __DIR__ . '/control_danhsach_sach.php';
?>