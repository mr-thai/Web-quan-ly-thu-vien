<?php
function pm_get_nguoi_dung_by_phone($conn, $phone)
{
    if (empty($phone)) {
        return null;
    }
    
    $phone = mysqli_real_escape_string($conn, $phone);
    $sql = "SELECT * FROM nguoi_dung WHERE so_dien_thoai = '" . $phone . "' LIMIT 1";
    
    $rs = mysqli_query($conn, $sql);
    if ($rs && mysqli_num_rows($rs) > 0) {
        $row = mysqli_fetch_assoc($rs);
        mysqli_free_result($rs);
        return $row;
    }
    
    return null;
}
?>
