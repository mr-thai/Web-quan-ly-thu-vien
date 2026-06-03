<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_delete_sach.php';

$delete_id = (int)$_GET['delete_id'];

try {
    $ok = sach_delete($conn, $delete_id);
    $message = $ok ? 'Xóa sách thành công.' : 'Lỗi xóa sách.';
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1451) {
        $message = 'Không thể xóa cuốn sách này vì nó đã được mượn (nằm trong phiếu mượn)!';
    } else {
        $message = 'Lỗi cơ sở dữ liệu: ' . $e->getMessage();
    }
}
?>