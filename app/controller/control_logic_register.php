<?php
if (isset($_SESSION['nguoi_dung'])) {
    header('Location: index.php'); exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, ho_ten, email, so_dien_thoai, trang_thai) VALUES (?, ?, ?, ?, ?, 1)");
    $stmt->bind_param(
        "sssss",
        $_POST['ten_dang_nhap'],
        $_POST['mat_khau'],
        $_POST['ho_ten'],
        $_POST['email'],
        $_POST['so_dien_thoai']
    );
    $stmt->execute();

    header('Location: login.php'); exit;
}
?>