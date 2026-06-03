<?php
require 'admin/app/config.php';
require 'admin/app/model/model_delete_tacgia.php';

try {
    var_dump(tg_delete($conn, 99999));
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
?>
