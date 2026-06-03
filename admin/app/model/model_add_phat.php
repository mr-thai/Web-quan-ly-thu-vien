<?php
function pm_add_phat($conn, $ma_chi_tiet_phieu, $loai_vi_pham, $gia_goc_sach, $so_tien_phat)
{
    $ma_chi_tiet_phieu = (int)$ma_chi_tiet_phieu;
    $loai_vi_pham = mysqli_real_escape_string($conn, $loai_vi_pham);
    $gia_goc_sach = (float)$gia_goc_sach;
    $so_tien_phat = (float)$so_tien_phat;
    
    $sql = "INSERT INTO vi_pham_phat (ma_chi_tiet_phieu, loai_vi_pham, gia_goc_sach, so_tien_phat, trang_thai_thanh_toan, ngay_tao)
            VALUES (" . $ma_chi_tiet_phieu . ", '" . $loai_vi_pham . "', " . $gia_goc_sach . ", " . $so_tien_phat . ", 'chua_dong', NOW())";
    
    return mysqli_query($conn, $sql);
}
?>
