<?php
$delete_id = (int)$_GET['delete_id'];
$ok = pm_delete($conn, $delete_id);

$message = $ok ? 'Xóa phiếu mượn thành công.' : 'Lỗi xóa phiếu mượn.';
?>