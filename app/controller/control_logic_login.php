<?php

if (isset($_SESSION['nguoi_dung'])) {
    header('Location: index.php');
    exit();
}

$error = '';
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
    $identifier = trim($_POST['identifier'] ?? '');
    $password = $_POST['password'] ?? '';
    $next = $_POST['next'] ?? '';

    if ($identifier === '' || $password === '') {
        $error = 'Vui lòng nhập đầy đủ tên đăng nhập/email và mật khẩu.';
    } else {
        $stmt = $conn->prepare('SELECT ma_nguoi_dung, ten_dang_nhap, mat_khau, ho_ten, email, so_dien_thoai, trang_thai FROM nguoi_dung WHERE ten_dang_nhap = ? OR email = ? LIMIT 1');
        $stmt->bind_param('ss', $identifier, $identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            $storedPassword = $user['mat_khau'];
            $passwordMatches = password_verify($password, $storedPassword) || hash_equals($storedPassword, md5($password));

            if ((int)$user['trang_thai'] !== 1) {
                $error = 'Tài khoản của bạn đang bị khóa hoặc chưa kích hoạt.';
            } elseif ($passwordMatches) {
                $_SESSION['nguoi_dung'] = [
                    'ma_nguoi_dung' => (int)$user['ma_nguoi_dung'],
                    'ten_dang_nhap' => $user['ten_dang_nhap'],
                    'ho_ten' => $user['ho_ten'],
                    'email' => $user['email'],
                    'so_dien_thoai' => $user['so_dien_thoai']
                ];

                $redirect = 'index.php';
                if (isSafeLocalPath($next)) {
                    $redirect = $next;
                }

                header('Location: ' . $redirect);
                exit();
            } else {
                $error = 'Mật khẩu không đúng.';
            }
        } else {
            $error = 'Không tìm thấy tài khoản phù hợp.';
        }

        $stmt->close();
    }
}
?>