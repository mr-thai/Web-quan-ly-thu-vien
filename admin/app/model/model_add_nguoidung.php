<?php
function nd_add($conn, $data)
{
    $ma_nguoi_dung = nd_next_id($conn);
    $mat_khau_hash = password_hash($data['mat_khau'], PASSWORD_BCRYPT);

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO nguoi_dung (ma_nguoi_dung, ten_dang_nhap, mat_khau, ho_ten, email, so_dien_thoai, trang_thai)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        'issssss',
        $ma_nguoi_dung,
        $data['ten_dang_nhap'],
        $mat_khau_hash,
        $data['ho_ten'],
        $data['email'],
        $data['so_dien_thoai'],
        $data['trang_thai']
    );

    return mysqli_stmt_execute($stmt);
}
?>