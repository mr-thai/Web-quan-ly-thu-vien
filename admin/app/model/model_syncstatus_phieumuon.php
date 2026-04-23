<?php
function pm_sync_status($conn)
{
    mysqli_query($conn, "UPDATE phieu_muon SET trang_thai = 'tre_han' WHERE ngay_tra IS NULL AND ngay_hen_tra < NOW()");
    mysqli_query($conn, "UPDATE phieu_muon SET trang_thai = 'dang_muon' WHERE ngay_tra IS NULL AND ngay_hen_tra >= NOW()");
}
?>