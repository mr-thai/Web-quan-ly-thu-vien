<?php
function pm_delete($conn, $ma_phieu_muon)
{
    mysqli_begin_transaction($conn);
    $ok = true;

    $stmtInfo = mysqli_prepare($conn, "SELECT trang_thai FROM phieu_muon WHERE ma_phieu_muon = ?");
    mysqli_stmt_bind_param($stmtInfo, 'i', $ma_phieu_muon);
    mysqli_stmt_execute($stmtInfo);
    $rsInfo = mysqli_stmt_get_result($stmtInfo);
    $pm = mysqli_fetch_assoc($rsInfo);
    mysqli_stmt_close($stmtInfo);

    if ($pm['trang_thai'] !== 'da_tra') {
        $stmtCt = mysqli_prepare($conn, "SELECT ma_sach, So_Luong FROM chi_tiet_phieu_muon WHERE ma_phieu_muon = ? FOR UPDATE");
        mysqli_stmt_bind_param($stmtCt, 'i', $ma_phieu_muon);
        mysqli_stmt_execute($stmtCt);
        $rsCt = mysqli_stmt_get_result($stmtCt);

        while ($row = mysqli_fetch_assoc($rsCt)) {
            $ma_sach = (int)$row['ma_sach'];
            $so_luong = (int)$row['So_Luong'];

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

        mysqli_stmt_close($stmtCt);
    }

    if ($ok) {
        $stmtDelCt = mysqli_prepare($conn, "DELETE FROM chi_tiet_phieu_muon WHERE ma_phieu_muon = ?");
        mysqli_stmt_bind_param($stmtDelCt, 'i', $ma_phieu_muon);
        $ok = mysqli_stmt_execute($stmtDelCt);
        mysqli_stmt_close($stmtDelCt);
    }

    if ($ok) {
        $stmtDelPm = mysqli_prepare($conn, "DELETE FROM phieu_muon WHERE ma_phieu_muon = ?");
        mysqli_stmt_bind_param($stmtDelPm, 'i', $ma_phieu_muon);
        $ok = mysqli_stmt_execute($stmtDelPm);
        mysqli_stmt_close($stmtDelPm);
    }

    if ($ok) {
        mysqli_commit($conn);
    } else {
        mysqli_rollback($conn);
    }

    return $ok;
}
?>