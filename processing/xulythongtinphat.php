<?php
$message = '';
$keyword = trim($_GET['keyword'] ?? '');

$phieu_muon_options = array();
$pm_rs = mysqli_query(
    $conn,
    "SELECT pm.id_phieu_muon, nd.ho_ten, nd.ten_dang_nhap
     FROM phieu_muon pm
     LEFT JOIN nguoi_dung nd ON pm.id_nguoi_dung = nd.id_nguoi_dung
     ORDER BY pm.id_phieu_muon DESC"
);
if ($pm_rs) {
    while ($row = mysqli_fetch_assoc($pm_rs)) {
        $phieu_muon_options[] = $row;
    }
    mysqli_free_result($pm_rs);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $id_phieu_muon = (int)($_POST['id_phieu_muon'] ?? 0);
        $so_tien = (float)($_POST['so_tien'] ?? 0);
        $ly_do = trim($_POST['ly_do'] ?? '');
        $ngay_phat = trim($_POST['ngay_phat'] ?? '');
        $trang_thai = trim($_POST['trang_thai'] ?? 'chua_thanh_toan');

        if ($id_phieu_muon <= 0 || $ly_do === '') {
            $message = 'Vui lòng chọn phiếu mượn và nhập lý do phạt.';
        } else {
            $stmt = null;
            if ($ngay_phat === '') {
                $stmt = mysqli_prepare(
                    $conn,
                    "INSERT INTO phat (id_phieu_muon, so_tien, ly_do, trang_thai) VALUES (?, ?, ?, ?)"
                );

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'idss', $id_phieu_muon, $so_tien, $ly_do, $trang_thai);
                }
            } else {
                $ngay_phat_sql = date('Y-m-d H:i:s', strtotime($ngay_phat));
                $stmt = mysqli_prepare(
                    $conn,
                    "INSERT INTO phat (id_phieu_muon, so_tien, ly_do, ngay_phat, trang_thai) VALUES (?, ?, ?, ?, ?)"
                );

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'idsss', $id_phieu_muon, $so_tien, $ly_do, $ngay_phat_sql, $trang_thai);
                }
            }

            if (!empty($stmt)) {
                if (mysqli_stmt_execute($stmt)) {
                    $message = 'Thêm thông tin phạt thành công.';
                } else {
                    $message = 'Lỗi thêm thông tin phạt: ' . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = 'Không thể khởi tạo truy vấn thêm thông tin phạt.';
            }
        }
    }

    if ($action === 'edit') {
        $id_phat = (int)($_POST['id_phat'] ?? 0);
        $id_phieu_muon = (int)($_POST['id_phieu_muon'] ?? 0);
        $so_tien = (float)($_POST['so_tien'] ?? 0);
        $ly_do = trim($_POST['ly_do'] ?? '');
        $ngay_phat = trim($_POST['ngay_phat'] ?? '');
        $trang_thai = trim($_POST['trang_thai'] ?? 'chua_thanh_toan');

        if ($id_phat <= 0 || $id_phieu_muon <= 0 || $ly_do === '') {
            $message = 'Dữ liệu cập nhật thông tin phạt không hợp lệ.';
        } else {
            $ngay_phat_sql = $ngay_phat === '' ? date('Y-m-d H:i:s') : date('Y-m-d H:i:s', strtotime($ngay_phat));
            $stmt = mysqli_prepare(
                $conn,
                "UPDATE phat
                 SET id_phieu_muon = ?, so_tien = ?, ly_do = ?, ngay_phat = ?, trang_thai = ?
                 WHERE id_phat = ?"
            );

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'idsssi', $id_phieu_muon, $so_tien, $ly_do, $ngay_phat_sql, $trang_thai, $id_phat);
                if (mysqli_stmt_execute($stmt)) {
                    $message = 'Cập nhật thông tin phạt thành công.';
                } else {
                    $message = 'Lỗi cập nhật thông tin phạt: ' . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = 'Không thể khởi tạo truy vấn cập nhật thông tin phạt.';
            }
        }
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    if ($delete_id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM phat WHERE id_phat = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $delete_id);
            if (mysqli_stmt_execute($stmt)) {
                $message = 'Xóa thông tin phạt thành công.';
            } else {
                $message = 'Lỗi xóa thông tin phạt: ' . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = 'Không thể khởi tạo truy vấn xóa thông tin phạt.';
        }
    }
}

if ($keyword !== '') {
    $search = '%' . $keyword . '%';
    $stmt = mysqli_prepare(
        $conn,
        "SELECT p.*, nd.ho_ten, nd.ten_dang_nhap
         FROM phat p
         LEFT JOIN phieu_muon pm ON p.id_phieu_muon = pm.id_phieu_muon
         LEFT JOIN nguoi_dung nd ON pm.id_nguoi_dung = nd.id_nguoi_dung
         WHERE CAST(p.id_phat AS CHAR) LIKE ?
            OR CAST(p.id_phieu_muon AS CHAR) LIKE ?
            OR p.ly_do LIKE ?
            OR nd.ho_ten LIKE ?
         ORDER BY p.id_phat DESC"
    );

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssss', $search, $search, $search, $search);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        $result = false;
        $message = 'Không thể khởi tạo truy vấn tìm kiếm thông tin phạt.';
    }
} else {
    $result = mysqli_query(
        $conn,
        "SELECT p.*, nd.ho_ten, nd.ten_dang_nhap
         FROM phat p
         LEFT JOIN phieu_muon pm ON p.id_phieu_muon = pm.id_phieu_muon
         LEFT JOIN nguoi_dung nd ON pm.id_nguoi_dung = nd.id_nguoi_dung
         ORDER BY p.id_phat DESC"
    );
}
?>