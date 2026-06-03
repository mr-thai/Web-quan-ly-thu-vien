<?php
require_once __DIR__ . '/../config.php';

$isLoggedIn = isset($_SESSION['nguoi_dung']);
$userName = $isLoggedIn ? $_SESSION['nguoi_dung']['ho_ten'] : '';
$cart = $_SESSION['cart'] ?? [];
$totalBooks = count($cart);
