<?php
function tg_delete($conn, $ma_tac_gia)
{
    $stmt = mysqli_prepare($conn, "DELETE FROM tac_gia WHERE ma_tac_gia = ?");
    mysqli_stmt_bind_param($stmt, 'i', $ma_tac_gia);
    return mysqli_stmt_execute($stmt);
}
?>