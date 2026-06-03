<?php
function pm_add($conn, $data)
{
    mysqli_begin_transaction($conn);

    $ma_phieu_muon = pm_next_id($conn);
    $ma_chi_tiet = ct_next_id($conn);

    $tong_so_sach = 0;
    foreach ($data['books'] as $book) {
        $tong_so_sach += (int)$book['so_luong'];
    }

    $stmtPm = mysqli_prepare(
        $conn,
        "INSERT INTO phieu_muon (ma_phieu_muon, ma_nguoi_dung, ngay_muon, ngay_hen_tra, ngay_tra, tong_so_sach, trang_thai, ghi_chu)
         VALUES (?, ?, ?, ?, NULL, ?, 'dang_muon', ?)"
    );

    mysqli_stmt_bind_param(
        $stmtPm,
        'iissis',
        $ma_phieu_muon,
        $data['ma_nguoi_dung'],
        $data['ngay_muon'],
        $data['ngay_hen_tra'],
        $tong_so_sach,
        $data['ghi_chu']
    );

    $ok = mysqli_stmt_execute($stmtPm);

    if ($ok) {
        foreach ($data['books'] as $book) {
            $stmtStock = mysqli_prepare($conn, "SELECT so_luong_con FROM sach WHERE ma_sach = ? FOR UPDATE");
            mysqli_stmt_bind_param($stmtStock, 'i', $book['ma_sach']);
            mysqli_stmt_execute($stmtStock);
            $rsStock = mysqli_stmt_get_result($stmtStock);
            $stockRow = mysqli_fetch_assoc($rsStock);
            mysqli_stmt_close($stmtStock);

            $so_luong_con_moi = (int)$stockRow['so_luong_con'] - (int)$book['so_luong'];

            $stmtUpdateStock = mysqli_prepare($conn, "UPDATE sach SET so_luong_con = ?, trang_thai = ? WHERE ma_sach = ?");
            $trang_thai = $so_luong_con_moi > 0 ? 'con' : 'het';
            mysqli_stmt_bind_param($stmtUpdateStock, 'isi', $so_luong_con_moi, $trang_thai, $book['ma_sach']);
            $ok = mysqli_stmt_execute($stmtUpdateStock);
            mysqli_stmt_close($stmtUpdateStock);

            if (!$ok) {
                break;
            }

            $stmtCt = mysqli_prepare(
                $conn,
                "INSERT INTO chi_tiet_phieu_muon (ma_chi_tiet_phieu, ma_phieu_muon, ma_sach, So_Luong, trang_thai)
                 VALUES (?, ?, ?, ?, 'dang_muon')"
            );

            $ma_sach_text = (string)$book['ma_sach'];
            mysqli_stmt_bind_param($stmtCt, 'iisi', $ma_chi_tiet, $ma_phieu_muon, $ma_sach_text, $book['so_luong']);
            $ok = mysqli_stmt_execute($stmtCt);
            mysqli_stmt_close($stmtCt);

            if (!$ok) {
                break;
            }

            $ma_chi_tiet++;
        }
    }

    if ($ok) {
        mysqli_commit($conn);
    } else {
        mysqli_rollback($conn);
    }

    return $ok;
}
?>