<?php
require_once __DIR__ . '/admin/app/controller/helper_image.php';
$json = '{"id":"test","name":"test.png","type":"image/png","size":123,"metadata":{},"data":"iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg=="}';
var_dump(process_base64_image($json, 'images/products'));
?>
