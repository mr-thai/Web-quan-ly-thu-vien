<?php
require_once __DIR__ . '/../model/TacGiaModel.php';

$message = '';
$keyword = trim($_GET['keyword'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        require __DIR__ . '/control_them_tacgia.php';
    }

    if ($action === 'edit') {
        require __DIR__ . '/control_sua_tacgia.php';
    }
}

if (isset($_GET['delete_id'])) {
    require __DIR__ . '/control_xoa_tacgia.php';
}

require __DIR__ . '/control_danhsach_tacgia.php';
?>