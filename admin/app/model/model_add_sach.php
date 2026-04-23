<?php
function sach_add($conn, $data)
{
    $ma_sach = sach_next_id($conn);
    mysqli_begin_transaction($conn);

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO sach (ma_sach, ma_tacgia, isbn, ten_sach, nha_xuat_ban, ten_the_loai, nam_xuat_ban, so_trang, gia_sach, so_luong, so_luong_con, vi_tri_ke, mo_ta, trang_thai)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        'iisssiiidiisss',
        $ma_sach,
        $data['ma_tacgia'],
        $data['isbn'],
        $data['ten_sach'],
        $data['nha_xuat_ban'],
        $data['ten_the_loai'],
        $data['nam_xuat_ban'],
        $data['so_trang'],
        $data['gia_sach'],
        $data['so_luong'],
        $data['so_luong_con'],
        $data['vi_tri_ke'],
        $data['mo_ta'],
        $data['trang_thai']
    );

    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($ok && $data['url_anh'] !== '') {
        $stmtAnh = mysqli_prepare(
            $conn,
            "INSERT INTO anh_sach (ma_sach, url_anh, anh_chinh, ghi_chu) VALUES (?, ?, 1, '')"
        );
        mysqli_stmt_bind_param($stmtAnh, 'is', $ma_sach, $data['url_anh']);
        $ok = mysqli_stmt_execute($stmtAnh);
        mysqli_stmt_close($stmtAnh);
    }

    if ($ok) {
        mysqli_commit($conn);
    } else {
        mysqli_rollback($conn);
    }

    return $ok;
}
?>