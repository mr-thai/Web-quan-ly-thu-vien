<?php
$message = '';
$keyword = trim($_GET['keyword'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $ho_ten = trim($_POST['ho_ten'] ?? '');
        $but_danh = trim($_POST['but_danh'] ?? '');
        $ngay_sinh = trim($_POST['ngay_sinh'] ?? '');
        $ngay_mat = trim($_POST['ngay_mat'] ?? '');
        $quoc_tich = trim($_POST['quoc_tich'] ?? '');
        $tieu_su = trim($_POST['tieu_su'] ?? '');
        $ghi_chu = trim($_POST['ghi_chu'] ?? '');

        if ($ho_ten === '') {
            $message = 'Họ tên tác giả không được để trống.';
        } else {
            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO tac_gia (ho_ten, but_danh, ngay_sinh, ngay_mat, quoc_tich, tieu_su, ghi_chu)
                 VALUES (?, ?, NULLIF(?, ''), NULLIF(?, ''), ?, ?, ?)"
            );

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'sssssss', $ho_ten, $but_danh, $ngay_sinh, $ngay_mat, $quoc_tich, $tieu_su, $ghi_chu);
                if (mysqli_stmt_execute($stmt)) {
                    $message = 'Thêm tác giả thành công.';
                } else {
                    $message = 'Lỗi thêm tác giả: ' . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = 'Không thể khởi tạo truy vấn thêm tác giả.';
            }
        }
    }

    if ($action === 'edit') {
        $ma_tac_gia = (int)($_POST['ma_tac_gia'] ?? 0);
        $ho_ten = trim($_POST['ho_ten'] ?? '');
        $but_danh = trim($_POST['but_danh'] ?? '');
        $ngay_sinh = trim($_POST['ngay_sinh'] ?? '');
        $ngay_mat = trim($_POST['ngay_mat'] ?? '');
        $quoc_tich = trim($_POST['quoc_tich'] ?? '');
        $tieu_su = trim($_POST['tieu_su'] ?? '');
        $ghi_chu = trim($_POST['ghi_chu'] ?? '');

        if ($ma_tac_gia <= 0 || $ho_ten === '') {
            $message = 'Dữ liệu cập nhật tác giả không hợp lệ.';
        } else {
            $stmt = mysqli_prepare(
                $conn,
                "UPDATE tac_gia
                 SET ho_ten = ?,
                     but_danh = ?,
                     ngay_sinh = NULLIF(?, ''),
                     ngay_mat = NULLIF(?, ''),
                     quoc_tich = ?,
                     tieu_su = ?,
                     ghi_chu = ?
                 WHERE ma_tac_gia = ?"
            );

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'sssssssi', $ho_ten, $but_danh, $ngay_sinh, $ngay_mat, $quoc_tich, $tieu_su, $ghi_chu, $ma_tac_gia);
                if (mysqli_stmt_execute($stmt)) {
                    $message = 'Cập nhật tác giả thành công.';
                } else {
                    $message = 'Lỗi cập nhật tác giả: ' . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = 'Không thể khởi tạo truy vấn cập nhật tác giả.';
            }
        }
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    if ($delete_id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM tac_gia WHERE ma_tac_gia = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $delete_id);
            if (mysqli_stmt_execute($stmt)) {
                $message = 'Xóa tác giả thành công.';
            } else {
                $message = 'Lỗi xóa tác giả: ' . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = 'Không thể khởi tạo truy vấn xóa tác giả.';
        }
    }
}

if ($keyword !== '') {
    $search = '%' . $keyword . '%';
    $stmt = mysqli_prepare(
        $conn,
        "SELECT *
         FROM tac_gia
         WHERE CAST(ma_tac_gia AS CHAR) LIKE ? OR ho_ten LIKE ? OR but_danh LIKE ? OR quoc_tich LIKE ?
         ORDER BY ma_tac_gia DESC"
    );

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssss', $search, $search, $search, $search);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        $result = false;
        $message = 'Không thể khởi tạo truy vấn tìm kiếm tác giả.';
    }
} else {
    $result = mysqli_query($conn, "SELECT * FROM tac_gia ORDER BY ma_tac_gia DESC");
}
?>