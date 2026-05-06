-- =============================================
-- QLTV - Production Ready Schema
-- =============================================

SET SQL_MODE = "STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `qltv`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE `qltv`;

START TRANSACTION;

-- =============================================
-- 1. Bảng người dùng
-- =============================================
CREATE TABLE `nguoi_dung` (
  `ma_nguoi_dung` INT NOT NULL AUTO_INCREMENT,
  `ten_dang_nhap` VARCHAR(50) NOT NULL,
  `mat_khau` VARCHAR(255) NOT NULL,
  `ho_ten` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `so_dien_thoai` VARCHAR(15) NOT NULL,
  `trang_thai` TINYINT(1) NOT NULL DEFAULT 1,
  `ngay_tao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`ma_nguoi_dung`),
  UNIQUE KEY `uk_username` (`ten_dang_nhap`),
  UNIQUE KEY `uk_email` (`email`)
) ENGINE=InnoDB;

-- =============================================
-- 2. Bảng tác giả
-- =============================================
CREATE TABLE `tac_gia` (
  `ma_tac_gia` INT NOT NULL AUTO_INCREMENT,
  `ho_ten` VARCHAR(255) NOT NULL,
  `but_danh` VARCHAR(255) DEFAULT NULL,
  `ngay_sinh` DATE DEFAULT NULL,
  `ngay_mat` DATE DEFAULT NULL,
  `quoc_tich` VARCHAR(100) DEFAULT NULL,
  `avatar_url` VARCHAR(255) DEFAULT NULL,
  `tieu_su` TEXT,
  `ghi_chu` TEXT,
  `ngay_tao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (`ma_tac_gia`)
) ENGINE=InnoDB;

-- =============================================
-- 3. Bảng sách
-- =============================================
CREATE TABLE `sach` (
  `ma_sach` INT NOT NULL AUTO_INCREMENT,
  `ma_tacgia` INT NOT NULL,
  `isbn` VARCHAR(20) NOT NULL,
  `ten_sach` VARCHAR(255) NOT NULL,
  `nha_xuat_ban` VARCHAR(255) NOT NULL,
  `ten_the_loai` VARCHAR(100) NOT NULL,
  `nam_xuat_ban` INT NOT NULL,
  `so_trang` INT NOT NULL,
  `gia_sach` DECIMAL(10,2) NOT NULL,
  `so_luong` INT NOT NULL,
  `so_luong_con` INT NOT NULL,
  `vi_tri_ke` VARCHAR(50) NOT NULL,
  `mo_ta` TEXT,
  `trang_thai` ENUM('con','het') NOT NULL DEFAULT 'con',

  PRIMARY KEY (`ma_sach`),
  UNIQUE KEY `uk_isbn` (`isbn`),
  KEY `idx_sach_tacgia` (`ma_tacgia`),

  CONSTRAINT `fk_sach_tacgia`
    FOREIGN KEY (`ma_tacgia`)
    REFERENCES `tac_gia`(`ma_tac_gia`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB;

-- =============================================
-- 4. Bảng phiếu mượn
-- =============================================
CREATE TABLE `phieu_muon` (
  `ma_phieu_muon` INT NOT NULL AUTO_INCREMENT,
  `ma_nguoi_dung` INT NOT NULL,
  `ngay_muon` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_hen_tra` DATETIME NOT NULL,
  `ngay_tra` DATETIME DEFAULT NULL,
  `trang_thai` ENUM('dang_muon','da_tra','tre_han') NOT NULL DEFAULT 'dang_muon',
  `ghi_chu` TEXT,

  PRIMARY KEY (`ma_phieu_muon`),
  KEY `idx_pm_user` (`ma_nguoi_dung`),

  CONSTRAINT `fk_pm_user`
    FOREIGN KEY (`ma_nguoi_dung`)
    REFERENCES `nguoi_dung`(`ma_nguoi_dung`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- 5. Chi tiết phiếu mượn
-- =============================================
CREATE TABLE `chi_tiet_phieu_muon` (
  `ma_chi_tiet_phieu` INT NOT NULL AUTO_INCREMENT,
  `ma_phieu_muon` INT NOT NULL,
  `ma_sach` INT NOT NULL,
  `so_luong` INT NOT NULL,
  `ngay_tra_thuc_te` DATETIME DEFAULT NULL,
  `trang_thai` ENUM('dang_muon', 'da_tra', 'tra_tre_han', 'hu_hong', 'mat_sach') NOT NULL DEFAULT 'dang_muon',
  `ghi_chu_tinh_trang` TEXT NULL,

  PRIMARY KEY (`ma_chi_tiet_phieu`),
  KEY `idx_ctpm_pm` (`ma_phieu_muon`),
  KEY `idx_ctpm_sach` (`ma_sach`),

  CONSTRAINT `fk_ctpm_pm`
    FOREIGN KEY (`ma_phieu_muon`)
    REFERENCES `phieu_muon`(`ma_phieu_muon`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,

  CONSTRAINT `fk_ctpm_sach`
    FOREIGN KEY (`ma_sach`)
    REFERENCES `sach`(`ma_sach`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB;

-- =============================================
-- 6. Ảnh sách
-- =============================================
CREATE TABLE `anh_sach` (
  `ma_anh` INT NOT NULL AUTO_INCREMENT,
  `ma_sach` INT NOT NULL,
  `url_anh` VARCHAR(255) NOT NULL,
  `anh_chinh` TINYINT(1) NOT NULL DEFAULT 0,
  `ghi_chu` TEXT,

  PRIMARY KEY (`ma_anh`),
  KEY `idx_anh_sach` (`ma_sach`),

  CONSTRAINT `fk_anh_sach`
    FOREIGN KEY (`ma_sach`)
    REFERENCES `sach`(`ma_sach`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- 7. Vi phạm và phạt tiền
-- =============================================
CREATE TABLE `vi_pham_phat` (
  `ma_phat` INT NOT NULL AUTO_INCREMENT,
  `ma_chi_tiet_phieu` INT NOT NULL,
  `loai_vi_pham` ENUM('tre_han', 'hu_hong', 'mat_sach') NOT NULL,
  `gia_goc_sach` DECIMAL(10,2) NOT NULL,
  `so_tien_phat` DECIMAL(10,2) NOT NULL,
  `trang_thai_thanh_toan` ENUM('chua_dong', 'da_dong') NOT NULL DEFAULT 'chua_dong',
  `ngay_thu_tien` DATETIME DEFAULT NULL,
  `ngay_tao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`ma_phat`),
  KEY `idx_vp_ctpm` (`ma_chi_tiet_phieu`),
  KEY `idx_vp_ngay_thu` (`ngay_thu_tien`),

  CONSTRAINT `fk_vp_ctpm`
    FOREIGN KEY (`ma_chi_tiet_phieu`)
    REFERENCES `chi_tiet_phieu_muon`(`ma_chi_tiet_phieu`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- SCRIPT CHÈN DỮ LIỆU MẪU CHO QLTV
-- =============================================
USE `qltv`;

-- 1. Dữ liệu bảng `nguoi_dung`
INSERT INTO `nguoi_dung` (`ma_nguoi_dung`, `ten_dang_nhap`, `mat_khau`, `ho_ten`, `email`, `so_dien_thoai`, `trang_thai`) VALUES
(1, 'nguyenvana', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn An', 'an.nguyen@email.com', '0901111222', 1),
(2, 'tranthib', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Thị Bình', 'binh.tran@email.com', '0912222333', 1),
(3, 'lethic', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Thị Cẩm', 'cam.le@email.com', '0923333444', 1),
(4, 'phamvand', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Văn Dũng', 'dung.pham@email.com', '0934444555', 1),
(5, 'hoangthie', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Thị Én', 'en.hoang@email.com', '0945555666', 1),
(6, 'vuvang', 'e10adc3949ba59abbe56e057f20f883e', 'Vũ Văn Giang', 'giang.vu@email.com', '0956666777', 1),
(7, 'dangthih', 'e10adc3949ba59abbe56e057f20f883e', 'Đặng Thị Hoa', 'hoa.dang@email.com', '0967777888', 0),
(8, 'buivani', 'e10adc3949ba59abbe56e057f20f883e', 'Bùi Văn Inh', 'inh.bui@email.com', '0978888999', 1),
(9, 'ngokimk', 'e10adc3949ba59abbe56e057f20f883e', 'Ngô Kim Kiều', 'kieu.ngo@email.com', '0989999000', 1),
(10, 'doanvanl', 'e10adc3949ba59abbe56e057f20f883e', 'Đoàn Văn Long', 'long.doan@email.com', '0990000111', 1);

-- 2. Dữ liệu bảng `tac_gia`
INSERT INTO `tac_gia` (`ma_tac_gia`, `ho_ten`, `but_danh`, `ngay_sinh`, `ngay_mat`, `quoc_tich`, `avatar_url`, `tieu_su`, `ghi_chu`) VALUES
(1, 'Nguyễn Nhật Ánh', 'Nguyễn Nhật Ánh', '1955-05-07', NULL, 'Việt Nam', '/uploads/author/nguyen-nhat-anh.jpg', 'Nhà văn chuyên viết cho tuổi thơ, tuổi trẻ.', 'Nổi tiếng thập niên 90 đến nay'),
(2, 'Trần Hữu Tri', 'Nam Cao', '1915-10-29', '1951-11-28', 'Việt Nam', '/uploads/author/nam-cao.jpg', 'Nhà văn hiện thực xuất sắc trước Cách mạng tháng Tám.', 'Đại diện tiêu biểu văn học hiện thực'),
(3, 'Vũ Trọng Phụng', 'Vũ Trọng Phụng', '1912-10-20', '1939-10-13', 'Việt Nam', '/uploads/author/vu-trong-phung.jpg', 'Ông vua phóng sự đất Bắc.', 'Tác phẩm mang tính trào phúng cao'),
(4, 'Nguyễn Sen', 'Tô Hoài', '1920-09-27', '2014-07-06', 'Việt Nam', '/uploads/author/to-hoai.jpg', 'Nhà văn lớn của nền văn học hiện đại Việt Nam.', 'Viết nhiều cho thiếu nhi'),
(5, 'Joanne Rowling', 'J.K. Rowling', '1965-07-31', NULL, 'Anh', '/uploads/author/jk-rowling.jpg', 'Tiểu thuyết gia người Anh, tác giả fantasy.', 'Tác giả tỷ phú đầu tiên'),
(6, 'Haruki Murakami', 'Haruki Murakami', '1949-01-12', NULL, 'Nhật Bản', '/uploads/author/haruki-murakami.jpg', 'Tiểu thuyết gia đương đại nổi tiếng.', 'Thường viết về sự cô đơn'),
(7, 'Arthur Conan Doyle', 'Conan Doyle', '1859-05-22', '1930-07-07', 'Anh', '/uploads/author/arthur-conan-doyles.jpg', 'Nhà văn người Scotland nổi tiếng với tiểu thuyết trinh thám.', 'Cha đẻ tiểu thuyết trinh thám hiện đại'),
(8, 'Nguyễn Tường Lân', 'Thạch Lam', '1910-07-07', '1942-06-27', 'Việt Nam', '/uploads/author/thach-lam.jpg', 'Nhà văn thuộc nhóm Tự Lực văn đoàn.', 'Văn phong nhẹ nhàng, tinh tế'),
(9, 'Nguyễn Du', 'Tố Như', '1765-01-01', '1820-09-16', 'Việt Nam', '/uploads/author/nguyen-du.jpg', 'Đại thi hào dân tộc, danh nhân văn hóa thế giới.', 'Sử dụng chữ Nôm điêu luyện'),
(10, 'Dale Carnegie', 'Dale Carnegie', '1888-11-24', '1955-11-01', 'Mỹ', '/uploads/author/dale-carnegie.jpg', 'Nhà văn và nhà phát triển nghệ thuật diễn thuyết.', 'Tiên phong mảng self-help');
-- 3. Dữ liệu bảng `sach`
INSERT INTO `sach` (`ma_sach`, `ma_tacgia`, `isbn`, `ten_sach`, `nha_xuat_ban`, `ten_the_loai`, `nam_xuat_ban`, `so_trang`, `gia_sach`, `so_luong`, `so_luong_con`, `vi_tri_ke`, `mo_ta`, `trang_thai`) VALUES
(1, 1, '9786041093150', 'Mắt Biếc', 'NXB Trẻ', 'Văn học', 1990, 300, 110000.00, 20, 15, 'Kệ A1-Tầng 1', 'Truyện dài về tình yêu tuổi học trò.', 'con'),
(2, 2, '9786042084614', 'Chí Phèo', 'NXB Văn Học', 'Văn học', 1941, 120, 45000.00, 30, 30, 'Kệ A2-Tầng 1', 'Tuyển tập truyện ngắn hiện thực phê phán.', 'con'),
(3, 3, '9786046985444', 'Số Đỏ', 'NXB Hội Nhà Văn', 'Văn học', 1936, 250, 75000.00, 15, 10, 'Kệ A3-Tầng 1', 'Tiểu thuyết trào phúng xuất sắc.', 'con'),
(4, 4, '9786042129032', 'Dế Mèn Phiêu Lưu Ký', 'NXB Kim Đồng', 'Truyện thiếu nhi', 1941, 196, 60000.00, 50, 45, 'Kệ B1-Tầng 2', 'Truyện đồng thoại kinh điển của Việt Nam.', 'con'),
(5, 5, '9786041159931', 'Harry Potter và Hòn Đá Phù Thủy', 'NXB Trẻ', 'Fantasy', 1997, 350, 180000.00, 10, 0, 'Kệ C1-Tầng 3', 'Tập 1 của series Harry Potter.', 'het'),
(6, 6, '9786046985451', 'Rừng Na Uy', 'NXB Hội Nhà Văn', 'Văn học', 1987, 540, 150000.00, 25, 20, 'Kệ C2-Tầng 3', 'Tiểu thuyết lãng mạn đương đại Nhật Bản.', 'con'),
(7, 7, '9786042084621', 'Sherlock Holmes - Toàn tập', 'NXB Văn Học', 'Tiểu thuyết trinh thám', 1892, 1200, 350000.00, 5, 2, 'Kệ D1-Tầng 4', 'Tuyển tập các vụ án của thám tử Sherlock Holmes.', 'con'),
(8, 8, '9786041093167', 'Gió Lạnh Đầu Mùa', 'NXB Trẻ', 'Văn học', 1937, 210, 65000.00, 15, 12, 'Kệ A4-Tầng 1', 'Tập truyện ngắn nhẹ nhàng, sâu lắng.', 'con'),
(9, 9, '9786042129049', 'Truyện Kiều', 'NXB Giáo Dục', 'Thơ', 1820, 320, 85000.00, 40, 35, 'Kệ E1-Tầng 2', 'Tuyệt tác thơ Nôm của văn học Việt Nam.', 'con'),
(10, 10, '9786046860001', 'Đắc Nhân Tâm', 'NXB Tổng Hợp TP.HCM', 'Self-help', 1936, 320, 95000.00, 100, 80, 'Kệ F1-Tầng 1', 'Nghệ thuật thu phục lòng người.', 'con');

-- 4. Dữ liệu bảng `anh_sach`
INSERT INTO `anh_sach` (`ma_anh`, `ma_sach`, `url_anh`, `anh_chinh`, `ghi_chu`) VALUES
(1, 1, '/uploads/sach/mat_biec_bia.jpg', 1, 'Ảnh bìa chính sách Mắt Biếc'),
(2, 2, '/uploads/sach/chi_pheo_bia.jpg', 1, 'Ảnh bìa chính sách Chí Phèo'),
(3, 3, '/uploads/sach/so_do_bia.jpg', 1, 'Ảnh bìa chính sách Số Đỏ'),
(4, 4, '/uploads/sach/de_men_bia.jpg', 1, 'Ảnh bìa chính sách Dế Mèn Phiêu Lưu Ký'),
(5, 5, '/uploads/sach/hp_hon_da_phu_thuy.jpg', 1, 'Ảnh bìa chính Harry Potter tập 1'),
(6, 6, '/uploads/sach/rung_na_uy_bia.jpg', 1, 'Ảnh bìa chính sách Rừng Na Uy'),
(7, 7, '/uploads/sach/sherlock_toan_tap.jpg', 1, 'Ảnh bìa chính Sherlock Holmes toàn tập'),
(8, 8, '/uploads/sach/gio_lanh_bia.jpg', 1, 'Ảnh bìa chính Gió Lạnh Đầu Mùa'),
(9, 9, '/uploads/sach/truyen_kieu_bia.jpg', 1, 'Ảnh bìa chính Truyện Kiều'),
(10, 10, '/uploads/sach/dac_nhan_tam_bia.jpg', 1, 'Ảnh bìa chính Đắc Nhân Tâm');

-- 5. Dữ liệu bảng `phieu_muon`
INSERT INTO `phieu_muon` (`ma_phieu_muon`, `ma_nguoi_dung`, `ngay_muon`, `ngay_hen_tra`, `ngay_tra`, `trang_thai`, `ghi_chu`) VALUES
(1, 1, '2023-10-01 08:30:00', '2023-10-15 17:00:00', '2023-10-14 09:15:00', 'da_tra', 'Trả đúng hạn, sách nguyên vẹn'),
(2, 2, '2023-10-05 09:00:00', '2023-10-20 17:00:00', '2023-10-25 10:00:00', 'da_tra', 'Trả trễ 5 ngày, đã thu phí phạt'),
(3, 3, '2023-11-01 14:20:00', '2023-11-15 17:00:00', NULL, 'tre_han', 'Đã gọi điện nhắc nhở lần 1'),
(4, 4, '2024-03-01 10:10:00', '2024-03-15 17:00:00', NULL, 'dang_muon', 'Đang mượn hợp lệ'),
(5, 5, '2024-03-05 13:45:00', '2024-03-20 17:00:00', NULL, 'dang_muon', NULL),
(6, 6, '2023-12-10 08:00:00', '2023-12-25 17:00:00', '2023-12-20 14:30:00', 'da_tra', 'Sách bị rách mép, đã bồi thường 10%'),
(7, 8, '2024-01-15 15:30:00', '2024-01-30 17:00:00', '2024-01-29 09:00:00', 'da_tra', 'Trả trước hạn'),
(8, 9, '2024-02-01 09:45:00', '2024-02-16 17:00:00', '2024-02-16 16:50:00', 'da_tra', 'Trả đúng ngày hẹn'),
(9, 10, '2024-02-20 11:20:00', '2024-03-06 17:00:00', NULL, 'tre_han', 'Không liên lạc được qua số điện thoại'),
(10, 1, '2024-03-08 14:00:00', '2024-03-23 17:00:00', NULL, 'dang_muon', 'Mượn thêm sách mới');

-- 6. Dữ liệu bảng `chi_tiet_phieu_muon`
INSERT INTO `chi_tiet_phieu_muon` (`ma_chi_tiet_phieu`, `ma_phieu_muon`, `ma_sach`, `so_luong`, `ngay_tra_thuc_te`, `trang_thai`, `ghi_chu_tinh_trang`) VALUES
(1, 1, 1, 1, '2023-10-14 09:15:00', 'da_tra', 'Sách nguyên vẹn, trả đúng hạn'),
(2, 1, 4, 1, '2023-10-14 09:15:00', 'da_tra', 'Sách nguyên vẹn, trả đúng hạn'),
(3, 2, 3, 1, '2023-10-25 10:00:00', 'tra_tre_han', 'Trả trễ 5 ngày, phạt 5,000 VNĐ'),
(4, 3, 5, 1, NULL, 'dang_muon', 'Đang mượn, quá hạn 5 ngày'),
(5, 3, 6, 1, NULL, 'dang_muon', 'Đang mượn, quá hạn 5 ngày'),
(6, 4, 10, 1, NULL, 'dang_muon', 'Đang mượn, còn 7 ngày'),
(7, 5, 1, 1, NULL, 'dang_muon', 'Đang mượn, còn 12 ngày'),
(8, 6, 2, 1, '2023-12-20 14:30:00', 'hu_hong', 'Sách bị rách mép, đã bồi thường 10% = 4,500 VNĐ'),
(9, 7, 9, 1, '2024-01-29 09:00:00', 'da_tra', 'Sách nguyên vẹn, trả trước hạn 1 ngày'),
(10, 8, 4, 1, '2024-02-16 16:50:00', 'da_tra', 'Sách nguyên vẹn, trả đúng hạn');

-- 7. Dữ liệu bảng `vi_pham_phat`
INSERT INTO `vi_pham_phat` (`ma_phat`, `ma_chi_tiet_phieu`, `loai_vi_pham`, `gia_goc_sach`, `so_tien_phat`, `trang_thai_thanh_toan`, `ngay_thu_tien`, `ngay_tao`) VALUES
(1, 3, 'tre_han', 75000.00, 5000.00, 'da_dong', '2023-10-26 10:30:00', '2023-10-25 10:00:00'),
(2, 8, 'hu_hong', 45000.00, 4500.00, 'da_dong', '2023-12-21 09:15:00', '2023-12-20 14:30:00'),
(3, 4, 'tre_han', 180000.00, 15000.00, 'chua_dong', NULL, '2023-11-20 10:00:00'),
(4, 5, 'tre_han', 150000.00, 15000.00, 'chua_dong', NULL, '2023-11-20 10:00:00');

COMMIT;
