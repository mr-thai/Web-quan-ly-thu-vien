<?php
function sach_get_tac_gia_list($conn)
{
    $list = array();
    $rs = mysqli_query($conn, "SELECT ma_tac_gia, ho_ten FROM tac_gia ORDER BY ho_ten ASC");
    if ($rs) {
        while ($row = mysqli_fetch_assoc($rs)) {
            $list[] = $row;
        }
        mysqli_free_result($rs);
    }
    return $list;
}
?>