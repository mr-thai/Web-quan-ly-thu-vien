<?php
function pm_update_return_book($conn, $ma_chi_tiet_phieu, $ngay_tra_thuc_te, $trang_thai, $ghi_chu_tinh_trang)
{
    $ma_chi_tiet_phieu = (int)$ma_chi_tiet_phieu;
    $ngay_tra_thuc_te = mysqli_real_escape_string($conn, $ngay_tra_thuc_te);
    $trang_thai = mysqli_real_escape_string($conn, $trang_thai);
    $ghi_chu_tinh_trang = mysqli_real_escape_string($conn, $ghi_chu_tinh_trang);
    
    $sql = "UPDATE chi_tiet_phieu_muon 
            SET ngay_tra_thuc_te = '" . $ngay_tra_thuc_te . "',
                trang_thai = '" . $trang_thai . "',
                ghi_chu_tinh_trang = '" . $ghi_chu_tinh_trang . "'
            WHERE ma_chi_tiet_phieu = " . $ma_chi_tiet_phieu;
    
    return mysqli_query($conn, $sql);
}
?>
