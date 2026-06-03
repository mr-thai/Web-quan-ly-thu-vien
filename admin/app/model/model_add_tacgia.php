<?php
function tg_add($conn, $data)
{
    $ma_tac_gia = tg_next_id($conn);

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO tac_gia (ma_tac_gia, ho_ten, but_danh, ngay_sinh, ngay_mat, quoc_tich, avatar_url, tieu_su, ghi_chu)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        'issssssss',
        $ma_tac_gia,
        $data['ho_ten'],
        $data['but_danh'],
        $data['ngay_sinh'],
        $data['ngay_mat'],
        $data['quoc_tich'],
        $data['avatar_url'],
        $data['tieu_su'],
        $data['ghi_chu']
    );

    return mysqli_stmt_execute($stmt);
}
?>