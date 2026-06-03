<?php
function pm_return($conn, $ma_phieu_muon, $ngay_tra)
{
    mysqli_begin_transaction($conn);
    $ok = true;

    $details = array();
    $stmtCt = mysqli_prepare(
        $conn,
        "SELECT ma_sach, So_Luong FROM chi_tiet_phieu_muon WHERE ma_phieu_muon = ? FOR UPDATE"
    );
    mysqli_stmt_bind_param($stmtCt, 'i', $ma_phieu_muon);
    mysqli_stmt_execute($stmtCt);
    $rsCt = mysqli_stmt_get_result($stmtCt);
    while ($row = mysqli_fetch_assoc($rsCt)) {
        $details[] = $row;
    }
    mysqli_stmt_close($stmtCt);

    foreach ($details as $ct) {
        $ma_sach = (int)$ct['ma_sach'];
        $so_luong = (int)$ct['So_Luong'];

        $stmtStock = mysqli_prepare($conn, "SELECT so_luong_con FROM sach WHERE ma_sach = ? FOR UPDATE");
        mysqli_stmt_bind_param($stmtStock, 'i', $ma_sach);
        mysqli_stmt_execute($stmtStock);
        $rsStock = mysqli_stmt_get_result($stmtStock);
        $stockRow = mysqli_fetch_assoc($rsStock);
        mysqli_stmt_close($stmtStock);

        $so_luong_con_moi = (int)$stockRow['so_luong_con'] + $so_luong;

        $stmtUpdate = mysqli_prepare($conn, "UPDATE sach SET so_luong_con = ?, trang_thai = 'con' WHERE ma_sach = ?");
        mysqli_stmt_bind_param($stmtUpdate, 'ii', $so_luong_con_moi, $ma_sach);
        $ok = mysqli_stmt_execute($stmtUpdate);
        mysqli_stmt_close($stmtUpdate);

        if (!$ok) {
            break;
        }
    }

    if ($ok) {
        $stmtCtStatus = mysqli_prepare(
            $conn,
            "UPDATE chi_tiet_phieu_muon SET trang_thai = 'da_tra' WHERE ma_phieu_muon = ?"
        );
        mysqli_stmt_bind_param($stmtCtStatus, 'i', $ma_phieu_muon);
        $ok = mysqli_stmt_execute($stmtCtStatus);
        mysqli_stmt_close($stmtCtStatus);
    }

    if ($ok) {
        $stmtPm = mysqli_prepare(
            $conn,
            "UPDATE phieu_muon SET ngay_tra = ?, trang_thai = 'da_tra' WHERE ma_phieu_muon = ?"
        );
        mysqli_stmt_bind_param($stmtPm, 'si', $ngay_tra, $ma_phieu_muon);
        $ok = mysqli_stmt_execute($stmtPm);
        mysqli_stmt_close($stmtPm);
    }

    if ($ok) {
        mysqli_commit($conn);
    } else {
        mysqli_rollback($conn);
    }

    return $ok;
}
?>