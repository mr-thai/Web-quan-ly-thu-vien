<?php
function pm_get_phat_by_user($conn, $ma_nguoi_dung)
{
    if (empty($ma_nguoi_dung)) {
        return array();
    }
    
    $ma_nguoi_dung = (int)$ma_nguoi_dung;
    $sql = "SELECT vp.*, s.ten_sach
            FROM vi_pham_phat vp
            JOIN chi_tiet_phieu_muon ct ON vp.ma_chi_tiet_phieu = ct.ma_chi_tiet_phieu
            JOIN phieu_muon pm ON ct.ma_phieu_muon = pm.ma_phieu_muon
            JOIN sach s ON ct.ma_sach = s.ma_sach
            WHERE pm.ma_nguoi_dung = " . $ma_nguoi_dung . "
            AND vp.trang_thai_thanh_toan = 'chua_dong'
            ORDER BY vp.ngay_tao DESC";
    
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
