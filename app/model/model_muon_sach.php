<?php

/**
 * Tạo phiếu mượn mới
 * @param $conn mysqli connection
 * @param $ma_nguoi_dung int ID người dùng
 * @param $ngay_hen_tra datetime Ngày hẹn trả
 * @return int ma_phieu_muon hoặc false nếu lỗi
 */
function taoPhieuMuon($conn, $ma_nguoi_dung, $ngay_hen_tra)
{
    $stmt = $conn->prepare('INSERT INTO phieu_muon (ma_nguoi_dung, ngay_muon, ngay_hen_tra, trang_thai) VALUES (?, NOW(), ?, "dang_muon")');
    $stmt->bind_param('is', $ma_nguoi_dung, $ngay_hen_tra);
    
    if ($stmt->execute()) {
        $ma_phieu = $conn->insert_id;
        $stmt->close();
        return $ma_phieu;
    }
    
    $stmt->close();
    return false;
}

/**
 * Thêm chi tiết phiếu mượn
 * @param $conn mysqli connection
 * @param $ma_phieu_muon int ID phiếu mượn
 * @param $ma_sach int ID sách
 * @param $so_luong int Số lượng mượn
 * @return bool
 */
function themChiTietPhieuMuon($conn, $ma_phieu_muon, $ma_sach, $so_luong)
{
    $stmt = $conn->prepare('INSERT INTO chi_tiet_phieu_muon (ma_phieu_muon, ma_sach, so_luong, trang_thai) VALUES (?, ?, ?, "dang_muon")');
    $stmt->bind_param('iii', $ma_phieu_muon, $ma_sach, $so_luong);
    
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

/**
 * Lấy danh sách phiếu mượn đang mượn của người dùng
 * @param $conn mysqli connection
 * @param $ma_nguoi_dung int ID người dùng
 * @return mysqli_result
 */
function layPhieuMuonDangMuon($conn, $ma_nguoi_dung)
{
    $sql = "SELECT pm.ma_phieu_muon, pm.ngay_muon, pm.ngay_hen_tra, pm.trang_thai, COUNT(ctpm.ma_chi_tiet_phieu) as so_sach
            FROM phieu_muon pm
            LEFT JOIN chi_tiet_phieu_muon ctpm ON pm.ma_phieu_muon = ctpm.ma_phieu_muon AND ctpm.trang_thai = 'dang_muon'
            WHERE pm.ma_nguoi_dung = ? AND pm.trang_thai = 'dang_muon'
            GROUP BY pm.ma_phieu_muon
            ORDER BY pm.ngay_muon DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $ma_nguoi_dung);
    $stmt->execute();
    
    return $stmt->get_result();
}

/**
 * Lấy TẤT CẢ phiếu mượn của người dùng (tất cả trạng thái)
 * @param $conn mysqli connection
 * @param $ma_nguoi_dung int ID người dùng
 * @return mysqli_result
 */
function layPhieuMuonTatCa($conn, $ma_nguoi_dung)
{
    $sql = "SELECT pm.ma_phieu_muon, pm.ngay_muon, pm.ngay_hen_tra, pm.trang_thai, COUNT(ctpm.ma_chi_tiet_phieu) as so_sach
            FROM phieu_muon pm
            LEFT JOIN chi_tiet_phieu_muon ctpm ON pm.ma_phieu_muon = ctpm.ma_phieu_muon
            WHERE pm.ma_nguoi_dung = ?
            GROUP BY pm.ma_phieu_muon
            ORDER BY pm.ngay_muon DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $ma_nguoi_dung);
    $stmt->execute();
    
    return $stmt->get_result();
}

/**
 * Lấy chi tiết sách trong phiếu mượn
 * @param $conn mysqli connection
 * @param $ma_phieu_muon int ID phiếu mượn
 * @return mysqli_result
 */
function layChiTietPhieuMuon($conn, $ma_phieu_muon)
{
    $sql = "SELECT ctpm.ma_chi_tiet_phieu, ctpm.ma_sach, ctpm.so_luong, ctpm.trang_thai,
                   s.ten_sach, s.gia_sach, s.ten_the_loai, a.url_anh, tg.ho_ten as ten_tac_gia
            FROM chi_tiet_phieu_muon ctpm
            JOIN sach s ON ctpm.ma_sach = s.ma_sach
            LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1
            LEFT JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia
            WHERE ctpm.ma_phieu_muon = ?
            ORDER BY ctpm.ma_chi_tiet_phieu";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $ma_phieu_muon);
    $stmt->execute();
    
    return $stmt->get_result();
}

/**
 * Cập nhật trạng thái phiếu mươn
 * @param $conn mysqli connection
 * @param $ma_phieu_muon int ID phiếu mượn
 * @param $trang_thai string Trạng thái mới (dang_muon, da_tra, tre_han)
 * @return bool
 */
function capNhatTrangThaiPhieuMuon($conn, $ma_phieu_muon, $trang_thai)
{
    $stmt = $conn->prepare('UPDATE phieu_muon SET trang_thai = ? WHERE ma_phieu_muon = ?');
    $stmt->bind_param('si', $trang_thai, $ma_phieu_muon);
    
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

/**
 * Trả sách từ phiếu mượn
 * @param $conn mysqli connection
 * @param $ma_chi_tiet_phieu int ID chi tiết phiếu
 * @return bool
 */
function traChiTiet($conn, $ma_chi_tiet_phieu)
{
    $stmt = $conn->prepare('UPDATE chi_tiet_phieu_muon SET trang_thai = "da_tra" WHERE ma_chi_tiet_phieu = ?');
    $stmt->bind_param('i', $ma_chi_tiet_phieu);
    
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

/**
 * Kiểm tra số lượng còn của sách
 * @param $conn mysqli connection
 * @param $ma_sach int ID sách
 * @return int Số lượng còn
 */
function laySoLuongCon($conn, $ma_sach)
{
    $stmt = $conn->prepare('SELECT so_luong_con FROM sach WHERE ma_sach = ?');
    $stmt->bind_param('i', $ma_sach);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    
    return $row ? (int)$row['so_luong_con'] : 0;
}

/**
 * Cập nhật số lượng sách khi mượn
 * @param $conn mysqli connection
 * @param $ma_sach int ID sách
 * @param $so_luong int Số lượng mượn (trừ đi)
 * @return bool
 */
function giamSoLuongSach($conn, $ma_sach, $so_luong)
{
    $stmt = $conn->prepare('UPDATE sach SET so_luong_con = so_luong_con - ? WHERE ma_sach = ? AND so_luong_con >= ?');
    $stmt->bind_param('iii', $so_luong, $ma_sach, $so_luong);
    
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

/**
 * Cập nhật số lượng sách khi trả
 * @param $conn mysqli connection
 * @param $ma_sach int ID sách
 * @param $so_luong int Số lượng trả (cộng lại)
 * @return bool
 */
function tangSoLuongSach($conn, $ma_sach, $so_luong)
{
    $stmt = $conn->prepare('UPDATE sach SET so_luong_con = so_luong_con + ? WHERE ma_sach = ?');
    $stmt->bind_param('ii', $so_luong, $ma_sach);
    
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

?>
