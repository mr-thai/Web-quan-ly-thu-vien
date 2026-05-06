<?php
if (isset($_SESSION['nguoi_dung'])) {
    header('Location: index.php');
    exit();
}

$error = '';
$success = '';
$next = $_GET['next'] ?? '';

function isSafeLocalPath($path)
{
    return is_string($path)
        && $path !== ''
        && strpos($path, '://') === false
        && strpos($path, '//') !== 0
        && $path[0] !== '/'
        && preg_match('/^[a-zA-Z0-9_\-./?=&]+$/', $path);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hoTen = trim($_POST['ho_ten'] ?? '');
    $tenDangNhap = trim($_POST['ten_dang_nhap'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $soDienThoai = trim($_POST['so_dien_thoai'] ?? '');
    $password = $_POST['mat_khau'] ?? '';
    $confirmPassword = $_POST['xac_nhan_mat_khau'] ?? '';
    $next = $_POST['next'] ?? '';

    if ($hoTen === '' || $tenDangNhap === '' || $email === '' || $soDienThoai === '' || $password === '' || $confirmPassword === '') {
        $error = 'Vui lòng điền đầy đủ thông tin.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email không hợp lệ.';
    } elseif (!preg_match('/^[0-9]{9,15}$/', $soDienThoai)) {
        $error = 'Số điện thoại phải từ 9 đến 15 chữ số.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Mật khẩu xác nhận không khớp.';
    } elseif (strlen($password) < 6) {
        $error = 'Mật khẩu phải có ít nhất 6 ký tự.';
    } else {
        $stmt = $conn->prepare('SELECT ma_nguoi_dung FROM nguoi_dung WHERE ten_dang_nhap = ? OR email = ? LIMIT 1');
        $stmt->bind_param('ss', $tenDangNhap, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = 'Tên đăng nhập hoặc email đã tồn tại.';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare('INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, ho_ten, email, so_dien_thoai, trang_thai) VALUES (?, ?, ?, ?, ?, 1)');
            $insert->bind_param('sssss', $tenDangNhap, $hashedPassword, $hoTen, $email, $soDienThoai);

            if ($insert->execute()) {
                $redirect = 'login.php?registered=1';
                if (isSafeLocalPath($next)) {
                    $redirect .= '&next=' . urlencode($next);
                }
                header('Location: ' . $redirect);
                exit();
            }

            $error = 'Không thể tạo tài khoản. Vui lòng thử lại.';
            $insert->close();
        }

        $stmt->close();
    }
}
?>