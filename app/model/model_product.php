<?php   
    function getDanhSachSachProduct_aside($conn) {
        $sql = "SELECT s.ma_sach, s.ten_sach, tg.ho_ten as ten_tac_gia, a.url_anh 
                FROM sach s 
                JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia 
                LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
                LIMIT 5";
        return $conn->query($sql);
    }
    function getDanhSachSachAuthor_aside($conn) {
        $sql = "SELECT tg.ma_tac_gia, tg.ho_ten as ten_tac_gia, COUNT(s.ma_sach) as so_sach 
                FROM tac_gia tg 
                JOIN sach s ON tg.ma_tac_gia = s.ma_tacgia 
                GROUP BY tg.ma_tac_gia 
                ORDER BY so_sach DESC 
                LIMIT 5";
        return $conn->query($sql);
    }
    function getDanhSachSach($conn) {
        $sql = "SELECT s.ma_sach, s.ten_sach, tg.ho_ten as ten_tac_gia, a.url_anh 
                FROM sach s 
                JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia 
                LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
                LIMIT 20";
        return $conn->query($sql);
    }   
    function getSachBanChay($conn) {
        $sql = "SELECT s.ma_sach, s.ten_sach, tg.ho_ten as ten_tac_gia, a.url_anh 
                FROM sach s 
                JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia 
                LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
                LIMIT 1";
        return $conn->query($sql);
    }
    function getSachChiTiet($conn, $ma_sach) {
        $ma_sach = intval($ma_sach);
        if ($ma_sach <= 0) return false;
        $sql = "SELECT s.*, tg.ho_ten as ten_tac_gia, a.url_anh 
                FROM sach s 
                JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia 
                LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
                WHERE s.ma_sach = ? LIMIT 1";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('i', $ma_sach);
            $stmt->execute();
            $res = $stmt->get_result();
            $row = $res->fetch_assoc();
            $stmt->close();
            return $row ? $row : false;
        }
        return false;
    }
    function getSachLienQuan($conn, $ma_tacgia) {
        $ma_tacgia = intval($ma_tacgia);
        $sql = "SELECT s.ma_sach, s.ten_sach, s.ten_the_loai, tg.ho_ten AS ten_tac_gia, a.url_anh 
                FROM sach s 
                JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia 
                LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
                WHERE s.ma_tacgia = ?
                LIMIT 5";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('i', $ma_tacgia);
            $stmt->execute();
            $res = $stmt->get_result();
            $stmt->close();
            return $res;
        }
        return false;
    }
?>