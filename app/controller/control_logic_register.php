<?php
/* Controller xử lý đăng ký */

// Nếu đã đăng nhập thì về trang chủ
if (isset($_SESSION['nguoi_dung'])) {
    header('Location: index.php'); exit;
}

$error = ''; // Khởi tạo biến lỗi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Lấy dữ liệu từ form
    $ten_dang_nhap   = trim($_POST['ten_dang_nhap']   ?? '');
    $mat_khau        = trim($_POST['mat_khau']        ?? '');
    $xac_nhan_mat_khau = trim($_POST['xac_nhan_mat_khau'] ?? '');
    $ho_ten          = trim($_POST['ho_ten']          ?? '');
    $email           = trim($_POST['email']           ?? '');
    $so_dien_thoai   = trim($_POST['so_dien_thoai']   ?? '');

    // Kiểm tra dữ liệu
    if (empty($ten_dang_nhap) || empty($mat_khau) || empty($ho_ten)) {
        $error = 'Vui lòng điền đầy đủ thông tin bắt buộc.';
    } elseif ($mat_khau !== $xac_nhan_mat_khau) {
        $error = 'Mật khẩu xác nhận không khớp.';
    } else {
        // Kiểm tra tên đăng nhập hoặc email đã tồn tại chưa
        $check = $conn->prepare("SELECT ma_nguoi_dung FROM nguoi_dung WHERE ten_dang_nhap = ? OR email = ? LIMIT 1");
        $check->bind_param("ss", $ten_dang_nhap, $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = 'Tên đăng nhập hoặc email đã được sử dụng.';
        } else {
            // Thêm người dùng mới
            $stmt = $conn->prepare("INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, ho_ten, email, so_dien_thoai, trang_thai) VALUES (?, ?, ?, ?, ?, 1)");
            $stmt->bind_param("sssss", $ten_dang_nhap, $mat_khau, $ho_ten, $email, $so_dien_thoai);

            if ($stmt->execute()) {
                // Đăng ký thành công, chuyển về login
                header('Location: login.php?registered=1'); exit;
            } else {
                $error = 'Đăng ký thất bại. Vui lòng thử lại.';
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>