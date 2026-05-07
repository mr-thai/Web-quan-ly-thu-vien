<?php
require_once __DIR__ . '/app/config.php';

$_SESSION = [];
setcookie(session_name(), '', time() - 42000);
session_destroy();
header('Location: index.php');
exit();
?>