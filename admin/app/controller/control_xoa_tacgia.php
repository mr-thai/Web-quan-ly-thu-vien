<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_delete_tacgia.php';

$delete_id = (int)$_GET['delete_id'];

try {
    $ok = tg_delete($conn, $delete_id);
    $message = $ok ? 'Xóa tác giả thành công.' : 'Lỗi xóa tác giả.';
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1451) {
        $message = 'Không thể xóa tác giả này vì vẫn còn sách của tác giả trong hệ thống!';
    } else {
        $message = 'Lỗi cơ sở dữ liệu: ' . $e->getMessage();
    }
}
?>