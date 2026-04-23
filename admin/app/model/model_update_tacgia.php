<?php
function tg_update($conn, $ma_tac_gia, $data)
{
    $stmt = mysqli_prepare(
        $conn,
        "UPDATE tac_gia
         SET ho_ten = ?, but_danh = ?, ngay_sinh = ?, ngay_mat = ?, quoc_tich = ?, tieu_su = ?, ghi_chu = ?
         WHERE ma_tac_gia = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        'sssssssi',
        $data['ho_ten'],
        $data['but_danh'],
        $data['ngay_sinh'],
        $data['ngay_mat'],
        $data['quoc_tich'],
        $data['tieu_su'],
        $data['ghi_chu'],
        $ma_tac_gia
    );

    return mysqli_stmt_execute($stmt);
}
?>