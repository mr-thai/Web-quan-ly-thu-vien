<?php
function pm_get_details_map($conn, $phieuMuonList)
{
    $map = array();
    if (empty($phieuMuonList)) {
        return $map;
    }

    $ids = array();
    foreach ($phieuMuonList as $item) {
        $ids[] = (int)$item['ma_phieu_muon'];
    }

    $idSql = implode(',', $ids);

    $sql = "SELECT ct.*, s.ten_sach
            FROM chi_tiet_phieu_muon ct
            LEFT JOIN sach s ON ct.ma_sach = s.ma_sach
            WHERE ct.ma_phieu_muon IN (" . $idSql . ")
            ORDER BY ct.ma_phieu_muon DESC, ct.ma_chi_tiet_phieu ASC";

    $rs = mysqli_query($conn, $sql);
    if ($rs) {
        while ($row = mysqli_fetch_assoc($rs)) {
            $ma_phieu_muon = (int)$row['ma_phieu_muon'];
            if (!isset($map[$ma_phieu_muon])) {
                $map[$ma_phieu_muon] = array();
            }
            $map[$ma_phieu_muon][] = $row;
        }
        mysqli_free_result($rs);
    }

    return $map;
}
?>