<?php
$delete_id = (int)$_GET['delete_id'];
$ok = nd_delete($conn, $delete_id);

$message = $ok ? 'Xóa người dùng thành công.' : 'Lỗi xóa người dùng.';
?>