<?php
require_once __DIR__ . '/../model/PhieuMuonModel.php';

$message = '';
$keyword = trim($_GET['keyword'] ?? '');
$status_filter = trim($_GET['status'] ?? '');

pm_sync_status($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        require __DIR__ . '/control_them_phieumuon.php';
    }

    if ($action === 'edit') {
        require __DIR__ . '/control_sua_phieumuon.php';
    }

    if ($action === 'return') {
        require __DIR__ . '/control_trasach_phieumuon.php';
    }
}

if (isset($_GET['delete_id'])) {
    require __DIR__ . '/control_xoa_phieumuon.php';
}

require __DIR__ . '/control_danhsach_phieumuon.php';
return;
?>