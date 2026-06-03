<?php
function getDanhSachSach($conn) {
    $sql = "SELECT s.ma_sach, s.ten_sach, s.gia_sach, s.ten_the_loai, tg.ho_ten as ten_tac_gia, a.url_anh 
            FROM sach s 
            JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia 
            LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
            LIMIT 10";
    return $conn->query($sql);
}

function getSachById($conn, $id) {
    $sql = "SELECT s.ma_sach, s.ten_sach, s.gia_sach, s.ten_the_loai, tg.ho_ten as ten_tac_gia, a.url_anh 
            FROM sach s 
            LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
            LEFT JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia     
            WHERE s.ma_sach = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}
function getSachNoiBat($conn) {
    $sql = "SELECT s.ma_sach, s.ten_sach, s.gia_sach, s.ten_the_loai, tg.ho_ten as ten_tac_gia, a.url_anh 
            FROM sach s 
            JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia 
            LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
            ORDER BY s.ten_sach DESC
            LIMIT 1";
    return $conn->query($sql);
}
function getSachMoiPhatHanh($conn) {
    $sql = "SELECT s.ma_sach, s.ten_sach, s.gia_sach, s.ten_the_loai, tg.ho_ten as ten_tac_gia, a.url_anh 
            FROM sach s 
            JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia 
            LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
            ORDER BY s.nam_xuat_ban DESC, s.ma_sach DESC 
            LIMIT 1";
    return $conn->query($sql);      
}
function getSachChonBoiTacGia($conn) {
    $sql = "SELECT DISTINCT s.ma_sach, s.ten_sach, s.gia_sach, s.ten_the_loai, tg.ho_ten as ten_tac_gia, a.url_anh 
            FROM sach s 
            JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia 
            LEFT JOIN (
                SELECT ma_sach, MIN(url_anh) AS url_anh
                FROM anh_sach
                WHERE anh_chinh = 1
                GROUP BY ma_sach
            ) a ON s.ma_sach = a.ma_sach
            ORDER BY RAND() 
            LIMIT 6";
    return $conn->query($sql);      
}
?>