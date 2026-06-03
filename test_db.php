<?php
require 'admin/app/config.php';
require 'admin/app/model/model_delete_sach.php';
try {
    var_dump(sach_delete($conn, 23));
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
