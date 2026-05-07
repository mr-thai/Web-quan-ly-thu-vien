<?php
if (isset($_SESSION['nguoi_dung'])) {
    header('Location: index.php'); exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['email'] ?? '';
    $pw = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM nguoi_dung WHERE ten_dang_nhap=? OR email=? LIMIT 1");
    $stmt->bind_param("ss", $id, $id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && ($pw == $user['mat_khau'])) {
        $_SESSION['nguoi_dung'] = $user;
        header('Location: index.php'); exit;
    }

    $error = "Sai thông tin";
}
?>