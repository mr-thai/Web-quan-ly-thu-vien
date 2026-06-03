<?php
function tg_get_all($conn, $keyword = '')
{
    if ($keyword !== '') {
        $search = '%' . $keyword . '%';
        $stmt = mysqli_prepare(
            $conn,
            "SELECT *
             FROM tac_gia
             WHERE CAST(ma_tac_gia AS CHAR) LIKE ? OR ho_ten LIKE ? OR but_danh LIKE ? OR quoc_tich LIKE ?
             ORDER BY ma_tac_gia DESC"
        );
        mysqli_stmt_bind_param($stmt, 'ssss', $search, $search, $search, $search);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    return mysqli_query($conn, "SELECT * FROM tac_gia ORDER BY ma_tac_gia DESC");
}
?>