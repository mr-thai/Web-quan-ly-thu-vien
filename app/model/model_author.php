<?php
    function getDanhSachTacGia ($conn) {
        $sql = "SELECT tg.ma_tac_gia, tg.ho_ten, tg.but_danh, tg.ngay_sinh, tg.ngay_mat, tg.quoc_tich, tg.avatar_url, tg.tieu_su, tg.ghi_chu, COUNT(s.ma_sach) as so_sach 
                FROM tac_gia tg 
                LEFT JOIN sach s ON tg.ma_tac_gia = s.ma_tacgia 
                GROUP BY tg.ma_tac_gia 
                ORDER BY so_sach DESC, tg.ho_ten ASC";
        return $conn->query($sql);
    }

    function getTacGiaChiTiet($conn, $ma_tac_gia) {
        $ma_tac_gia = intval($ma_tac_gia);
        if ($ma_tac_gia <= 0) return false;

        $sql = "SELECT tg.ma_tac_gia, tg.ho_ten, tg.but_danh, tg.ngay_sinh, tg.ngay_mat, tg.quoc_tich, tg.avatar_url, tg.tieu_su, tg.ghi_chu, COUNT(s.ma_sach) as so_sach 
                FROM tac_gia tg 
                LEFT JOIN sach s ON tg.ma_tac_gia = s.ma_tacgia 
                WHERE tg.ma_tac_gia = ?
                GROUP BY tg.ma_tac_gia 
                LIMIT 1";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('i', $ma_tac_gia);
            $stmt->execute();
            $res = $stmt->get_result();
            $row = $res->fetch_assoc();
            $stmt->close();
            return $row ? $row : false;
        }

        return false;
    }

    function getSachTheoTacGia($conn, $ma_tac_gia, $limit = 6) {
        $ma_tac_gia = intval($ma_tac_gia);
        $limit = intval($limit);
        if ($ma_tac_gia <= 0) return false;
        if ($limit <= 0) $limit = 6;

        $sql = "SELECT s.ma_sach, s.ten_sach, s.gia_sach, s.nam_xuat_ban, s.so_trang, s.mo_ta, s.trang_thai, a.url_anh 
                FROM sach s 
                LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
                WHERE s.ma_tacgia = ? 
                ORDER BY s.ma_sach DESC 
                LIMIT ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('ii', $ma_tac_gia, $limit);
            $stmt->execute();
            $res = $stmt->get_result();
            $stmt->close();
            return $res;
        }

        return false;
    }

    function getSachDuocChonBoiTacGia($conn, $limit = 5) {
        $limit = intval($limit);
        if ($limit <= 0) $limit = 5;

        $sql = "SELECT s.ma_sach, s.ten_sach, s.so_trang, s.gia_sach, s.mo_ta, s.nam_xuat_ban, tg.ho_ten as ten_tac_gia, a.url_anh 
                FROM sach s 
                JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia 
                LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1 
                ORDER BY s.nam_xuat_ban DESC, s.ma_sach DESC 
                LIMIT ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('i', $limit);
            $stmt->execute();
            $res = $stmt->get_result();
            $stmt->close();
            return $res;
        }

        return false;
    }
?>