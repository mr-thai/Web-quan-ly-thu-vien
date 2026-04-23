<?php
function pm_get_all($conn, $keyword = '', $status = '')
{
    $where = array();

    if ($keyword !== '') {
        $keyword = mysqli_real_escape_string($conn, $keyword);
        $where[] = "(CAST(pm.ma_phieu_muon AS CHAR) LIKE '%" . $keyword . "%' OR nd.ho_ten LIKE '%" . $keyword . "%' OR nd.ten_dang_nhap LIKE '%" . $keyword . "%')";
    }

    if ($status !== '') {
        $status = mysqli_real_escape_string($conn, $status);
        $where[] = "pm.trang_thai = '" . $status . "'";
    }

    $sql = "SELECT pm.*, nd.ho_ten, nd.ten_dang_nhap
            FROM phieu_muon pm
            LEFT JOIN nguoi_dung nd ON pm.ma_nguoi_dung = nd.ma_nguoi_dung";

    if (!empty($where)) {
        $sql .= " WHERE " . implode(' AND ', $where);
    }

    $sql .= " ORDER BY pm.ma_phieu_muon DESC";

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