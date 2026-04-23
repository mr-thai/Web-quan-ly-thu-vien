<?php
function sach_delete($conn, $ma_sach)
{
    $stmt = mysqli_prepare($conn, "DELETE FROM sach WHERE ma_sach = ?");
    mysqli_stmt_bind_param($stmt, 'i', $ma_sach);
    return mysqli_stmt_execute($stmt);
}
?>