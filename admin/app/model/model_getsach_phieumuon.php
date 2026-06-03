<?php
function pm_get_sach_list($conn)
{
    $list = array();
    $rs = mysqli_query($conn, "SELECT ma_sach, ten_sach, so_luong_con FROM sach ORDER BY ten_sach ASC");
    if ($rs) {
        while ($row = mysqli_fetch_assoc($rs)) {
            $list[] = $row;
        }
        mysqli_free_result($rs);
    }
    return $list;
}
?>