<?php
$sql = "SELECT pm.ma_phieu_muon,
               nd.ho_ten,
               nd.ten_dang_nhap,
               pm.ngay_hen_tra,
               pm.ngay_tra,
               CASE
                   WHEN pm.ngay_tra IS NULL AND pm.ngay_hen_tra < NOW() THEN 'tre_han_chua_tra'
                   WHEN pm.ngay_tra IS NOT NULL AND pm.ngay_tra > pm.ngay_hen_tra THEN 'tre_han_da_tra'
                   ELSE 'dung_han'
               END AS trang_thai_phat
        FROM phieu_muon pm
        LEFT JOIN nguoi_dung nd ON pm.ma_nguoi_dung = nd.ma_nguoi_dung";

if ($keyword !== '') {
    $search = '%' . $keyword . '%';
    $stmt = mysqli_prepare(
        $conn,
        $sql . " WHERE CAST(pm.ma_phieu_muon AS CHAR) LIKE ?
                  OR nd.ho_ten LIKE ?
                  OR nd.ten_dang_nhap LIKE ?
                  ORDER BY pm.ma_phieu_muon DESC"
    );
    mysqli_stmt_bind_param($stmt, 'sss', $search, $search, $search);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($conn, $sql . " ORDER BY pm.ma_phieu_muon DESC");
}
?>