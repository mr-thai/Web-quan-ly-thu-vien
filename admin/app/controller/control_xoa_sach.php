<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_delete_sach.php';

$delete_id = (int)$_GET['delete_id'];
$ok = sach_delete($conn, $delete_id);

$message = $ok ? 'Xóa sách thành công.' : 'Lỗi xóa sách.';
?>