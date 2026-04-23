<?php
$delete_id = (int)$_GET['delete_id'];
$ok = tg_delete($conn, $delete_id);

$message = $ok ? 'Xóa tác giả thành công.' : 'Lỗi xóa tác giả.';
?>