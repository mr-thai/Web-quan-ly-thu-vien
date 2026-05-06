<?php
function pm_update_phat($conn, $ma_phat, $so_tien_phat)
{
    $ma_phat = (int)$ma_phat;
    $so_tien_phat = (float)$so_tien_phat;
    
    $sql = "UPDATE vi_pham_phat 
            SET so_tien_phat = " . $so_tien_phat . ",
                trang_thai_thanh_toan = 'da_dong',
                ngay_thu_tien = NOW()
            WHERE ma_phat = " . $ma_phat;
    
    return mysqli_query($conn, $sql);
}
?>
