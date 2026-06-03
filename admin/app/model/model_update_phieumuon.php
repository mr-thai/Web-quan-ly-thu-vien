<?php
function pm_update($conn, $ma_phieu_muon, $data)
{
    $stmt = mysqli_prepare(
        $conn,
        "UPDATE phieu_muon
         SET ma_nguoi_dung = ?, ngay_muon = ?, ngay_hen_tra = ?, ghi_chu = ?
         WHERE ma_phieu_muon = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        'isssi',
        $data['ma_nguoi_dung'],
        $data['ngay_muon'],
        $data['ngay_hen_tra'],
        $data['ghi_chu'],
        $ma_phieu_muon
    );

    return mysqli_stmt_execute($stmt);
}
?>