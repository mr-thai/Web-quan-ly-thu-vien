<?php
/* Controller xử lý đăng nhập */

// Nếu đã đăng nhập thì về trang chủ
if (isset($_SESSION['nguoi_dung'])) {
    header('Location: index.php'); exit;
}

$error = ''; // Khởi tạo biến lỗi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['email']    ?? '');
    $pw = trim($_POST['password'] ?? '');

    if (empty($id) || empty($pw)) {
        $error = 'Vui lòng nhập tên đăng nhập và mật khẩu.';
    } else {
        $stmt = $conn->prepare("SELECT * FROM nguoi_dung WHERE (ten_dang_nhap = ? OR email = ?) AND trang_thai = 1 LIMIT 1");
        $stmt->bind_param("ss", $id, $id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($user && ($pw === $user['mat_khau'])) {
            $_SESSION['nguoi_dung'] = $user;

            // Chuyển về trang đích nếu có, hoặc trang chủ
            $next = trim($_POST['next'] ?? $_GET['next'] ?? '');
            $next = ($next !== '' && strpos($next, '/') === false) ? $next : 'index.php';
            header('Location: ' . $next); exit;
        } else {
            $error = 'Sai tên đăng nhập hoặc mật khẩu. Vui lòng thử lại.';
        }
    }
}
?>