<?php
function nd_get_all($conn, $keyword = '')
{
    if ($keyword !== '') {
        $search = '%' . $keyword . '%';
        $stmt = mysqli_prepare(
            $conn,
            "SELECT *
             FROM nguoi_dung
             WHERE ten_dang_nhap LIKE ? OR ho_ten LIKE ? OR email LIKE ? OR so_dien_thoai LIKE ?
             ORDER BY ma_nguoi_dung DESC"
        );
        mysqli_stmt_bind_param($stmt, 'ssss', $search, $search, $search, $search);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    return mysqli_query($conn, "SELECT * FROM nguoi_dung ORDER BY ma_nguoi_dung DESC");
}
?>