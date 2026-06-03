<?php
function nd_delete($conn, $id)
{
    $stmt = mysqli_prepare($conn, "DELETE FROM nguoi_dung WHERE ma_nguoi_dung = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    return mysqli_stmt_execute($stmt);
}
?>