<?php
function pm_get_dang_muon_by_user($conn, $ma_nguoi_dung)
{
    if (empty($ma_nguoi_dung)) {
        return array();
    }
    
    $ma_nguoi_dung = (int)$ma_nguoi_dung;
    $sql = "SELECT ct.*, s.ten_sach, s.gia_sach, pm.ngay_hen_tra, pm.ngay_muon
            FROM chi_tiet_phieu_muon ct
            JOIN phieu_muon pm ON ct.ma_phieu_muon = pm.ma_phieu_muon
            JOIN sach s ON ct.ma_sach = s.ma_sach
            WHERE pm.ma_nguoi_dung = " . $ma_nguoi_dung . "
            AND ct.trang_thai = 'dang_muon'
            AND pm.trang_thai != 'da_tra'
            ORDER BY pm.ngay_muon DESC";
    
    $list = array();
    $rs = mysqli_query($conn, $sql);
    if ($rs) {
        while ($row = mysqli_fetch_assoc($rs)) {
            $list[] = $row;
        }
        mysqli_free_result($rs);
    }
    
    return $list;
}
?>
