<?php
function sach_next_id($conn)
{
    $nextId = 1;
    $rs = mysqli_query($conn, "SELECT COALESCE(MAX(ma_sach), 0) + 1 AS next_id FROM sach");
    if ($rs) {
        $row = mysqli_fetch_assoc($rs);
        $nextId = (int)$row['next_id'];
        mysqli_free_result($rs);
    }
    return $nextId;
}
?>