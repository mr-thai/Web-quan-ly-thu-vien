<?php
$message = '';
$keyword = trim($_GET['keyword'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $ten_the_loai = trim($_POST['ten_the_loai'] ?? '');
        $mo_ta = trim($_POST['mo_ta'] ?? '');

        if ($ten_the_loai === '') {
            $message = 'Tên thể loại không được để trống.';
        } else {
            $stmt = mysqli_prepare($conn, "INSERT INTO the_loai (ten_the_loai, mo_ta) VALUES (?, ?)");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ss', $ten_the_loai, $mo_ta);
                if (mysqli_stmt_execute($stmt)) {
                    $message = 'Thêm thể loại thành công.';
                } else {
                    $message = 'Lỗi thêm thể loại: ' . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = 'Không thể khởi tạo truy vấn thêm thể loại.';
            }
        }
    }

    if ($action === 'edit') {
        $id_the_loai = (int)($_POST['id_the_loai'] ?? 0);
        $ten_the_loai = trim($_POST['ten_the_loai'] ?? '');
        $mo_ta = trim($_POST['mo_ta'] ?? '');

        if ($id_the_loai <= 0 || $ten_the_loai === '') {
            $message = 'Dữ liệu cập nhật thể loại không hợp lệ.';
        } else {
            $stmt = mysqli_prepare($conn, "UPDATE the_loai SET ten_the_loai = ?, mo_ta = ? WHERE id_the_loai = ?");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ssi', $ten_the_loai, $mo_ta, $id_the_loai);
                if (mysqli_stmt_execute($stmt)) {
                    $message = 'Cập nhật thể loại thành công.';
                } else {
                    $message = 'Lỗi cập nhật thể loại: ' . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = 'Không thể khởi tạo truy vấn cập nhật thể loại.';
            }
        }
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    if ($delete_id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM the_loai WHERE id_the_loai = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $delete_id);
            if (mysqli_stmt_execute($stmt)) {
                $message = 'Xóa thể loại thành công.';
            } else {
                $message = 'Lỗi xóa thể loại: ' . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = 'Không thể khởi tạo truy vấn xóa thể loại.';
        }
    }
}

if ($keyword !== '') {
    $search = '%' . $keyword . '%';
    $stmt = mysqli_prepare(
        $conn,
        "SELECT *
         FROM the_loai
         WHERE CAST(id_the_loai AS CHAR) LIKE ? OR ten_the_loai LIKE ? OR mo_ta LIKE ?
         ORDER BY id_the_loai DESC"
    );
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sss', $search, $search, $search);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        $result = false;
        $message = 'Không thể khởi tạo truy vấn tìm kiếm thể loại.';
    }
} else {
    $result = mysqli_query($conn, "SELECT * FROM the_loai ORDER BY id_the_loai DESC");
}
?>