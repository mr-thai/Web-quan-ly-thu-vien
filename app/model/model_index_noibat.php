<?php
function getDanhSachSach($conn) {
    $sql = "SELECT s.ma_sach, s.ten_sach, s.gia_sach, tg.ho_ten as ten_tac_gia, a.url_anh 
            FROM sach s 
            JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia 
            LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
            LIMIT 10";
    return $conn->query($sql);
}

function getSachById($conn, $id) {
    $sql = "SELECT s.ma_sach, s.ten_sach, s.gia_sach, a.url_anh 
            FROM sach s 
            LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
            WHERE s.ma_sach = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}
?>