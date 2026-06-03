<?php
function nd_update($conn, $id, $data)
{
    if ($data['mat_khau'] !== '') {
        $mat_khau_hash = password_hash($data['mat_khau'], PASSWORD_BCRYPT);
        $stmt = mysqli_prepare(
            $conn,
            "UPDATE nguoi_dung
             SET ten_dang_nhap = ?, ho_ten = ?, email = ?, mat_khau = ?, so_dien_thoai = ?, trang_thai = ?
             WHERE ma_nguoi_dung = ?"
        );
        mysqli_stmt_bind_param(
            $stmt,
            'ssssssi',
            $data['ten_dang_nhap'],
            $data['ho_ten'],
            $data['email'],
            $mat_khau_hash,
            $data['so_dien_thoai'],
            $data['trang_thai'],
            $id
        );
        return mysqli_stmt_execute($stmt);
    }

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE nguoi_dung
         SET ten_dang_nhap = ?, ho_ten = ?, email = ?, so_dien_thoai = ?, trang_thai = ?
         WHERE ma_nguoi_dung = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        'sssssi',
        $data['ten_dang_nhap'],
        $data['ho_ten'],
        $data['email'],
        $data['so_dien_thoai'],
        $data['trang_thai'],
        $id
    );

    return mysqli_stmt_execute($stmt);
}
?>