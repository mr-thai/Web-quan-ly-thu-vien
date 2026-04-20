<?php
$message = '';
$keyword = trim($_GET['keyword'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $ten_dang_nhap = trim($_POST['ten_dang_nhap'] ?? '');
        $ho_ten = trim($_POST['ho_ten'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $mat_khau = trim($_POST['mat_khau'] ?? '');
        $so_dien_thoai = trim($_POST['so_dien_thoai'] ?? '');
        $dia_chi = trim($_POST['dia_chi'] ?? '');
        $trang_thai = trim($_POST['trang_thai'] ?? '1');

        if ($ten_dang_nhap === '' || $ho_ten === '' || $email === '' || $mat_khau === '' || $so_dien_thoai === '' || $dia_chi === '') {
            $message = 'Vui lòng điền đầy đủ thông tin khi thêm người dùng.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = 'Email không hợp lệ.';
        } else {
            $next_id = 1;
            $id_rs = mysqli_query($conn, "SELECT COALESCE(MAX(id_nguoi_dung), 0) + 1 AS next_id FROM nguoi_dung");
            if ($id_rs) {
                $id_row = mysqli_fetch_assoc($id_rs);
                $next_id = (int)($id_row['next_id'] ?? 1);
                mysqli_free_result($id_rs);
            }

            $mat_khau_hash = password_hash($mat_khau, PASSWORD_BCRYPT);
            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO nguoi_dung (id_nguoi_dung, ten_dang_nhap, mat_khau, ho_ten, email, so_dien_thoai, dia_chi, trang_thai) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'isssssss', $next_id, $ten_dang_nhap, $mat_khau_hash, $ho_ten, $email, $so_dien_thoai, $dia_chi, $trang_thai);
                if (mysqli_stmt_execute($stmt)) {
                    $message = 'Thêm người dùng thành công.';
                } else {
                    $message = 'Lỗi thêm người dùng: ' . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = 'Không thể khởi tạo truy vấn thêm người dùng.';
            }
        }
    }

    if ($action === 'edit') {
        $id = (int)($_POST['id_nguoi_dung'] ?? 0);
        $ten_dang_nhap = trim($_POST['ten_dang_nhap'] ?? '');
        $ho_ten = trim($_POST['ho_ten'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $mat_khau = trim($_POST['mat_khau'] ?? '');
        $so_dien_thoai = trim($_POST['so_dien_thoai'] ?? '');
        $dia_chi = trim($_POST['dia_chi'] ?? '');
        $trang_thai = trim($_POST['trang_thai'] ?? '1');

        if ($id <= 0 || $ten_dang_nhap === '' || $ho_ten === '' || $email === '' || $so_dien_thoai === '' || $dia_chi === '') {
            $message = 'Dữ liệu chỉnh sửa không hợp lệ.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = 'Email không hợp lệ.';
        } else {
            $stmt = null;
            if ($mat_khau !== '') {
                $mat_khau_hash = password_hash($mat_khau, PASSWORD_BCRYPT);
                $stmt = mysqli_prepare(
                    $conn,
                    "UPDATE nguoi_dung
                     SET ten_dang_nhap = ?, ho_ten = ?, email = ?, mat_khau = ?, so_dien_thoai = ?, dia_chi = ?, trang_thai = ?
                     WHERE id_nguoi_dung = ?"
                );
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'sssssssi', $ten_dang_nhap, $ho_ten, $email, $mat_khau_hash, $so_dien_thoai, $dia_chi, $trang_thai, $id);
                }
            } else {
                $stmt = mysqli_prepare(
                    $conn,
                    "UPDATE nguoi_dung
                     SET ten_dang_nhap = ?, ho_ten = ?, email = ?, so_dien_thoai = ?, dia_chi = ?, trang_thai = ?
                     WHERE id_nguoi_dung = ?"
                );
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'ssssssi', $ten_dang_nhap, $ho_ten, $email, $so_dien_thoai, $dia_chi, $trang_thai, $id);
                }
            }

            if (!empty($stmt)) {
                if (mysqli_stmt_execute($stmt)) {
                    $message = 'Cập nhật người dùng thành công.';
                } else {
                    $message = 'Lỗi cập nhật người dùng: ' . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = 'Không thể khởi tạo truy vấn cập nhật người dùng.';
            }
        }
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    if ($delete_id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM nguoi_dung WHERE id_nguoi_dung = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $delete_id);
            if (mysqli_stmt_execute($stmt)) {
                $message = 'Xóa người dùng thành công.';
            } else {
                $message = 'Lỗi xóa người dùng: ' . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = 'Không thể khởi tạo truy vấn xóa người dùng.';
        }
    }
}

if ($keyword !== '') {
    $search = '%' . $keyword . '%';
    $stmt = mysqli_prepare(
        $conn,
        "SELECT *
         FROM nguoi_dung
         WHERE ten_dang_nhap LIKE ? OR ho_ten LIKE ? OR email LIKE ? OR so_dien_thoai LIKE ?
         ORDER BY id_nguoi_dung DESC"
    );
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssss', $search, $search, $search, $search);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        $result = false;
        $message = 'Không thể khởi tạo truy vấn tìm kiếm người dùng.';
    }
} else {
    $result = mysqli_query($conn, "SELECT * FROM nguoi_dung ORDER BY id_nguoi_dung DESC");
}
?>