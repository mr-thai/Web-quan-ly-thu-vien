<?php
function pm_get_nguoi_dung_list($conn)
{
    $list = array();
    $rs = mysqli_query($conn, "SELECT ma_nguoi_dung, ten_dang_nhap, ho_ten FROM nguoi_dung ORDER BY ho_ten ASC");
    if ($rs) {
        while ($row = mysqli_fetch_assoc($rs)) {
            $list[] = $row;
        }
        mysqli_free_result($rs);
    }
    return $list;
}
?>