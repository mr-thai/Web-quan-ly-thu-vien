-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2026 at 02:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quan_ly_ban_my_pham`
--

-- --------------------------------------------------------

--
-- Table structure for table `anhsanpham`
--

CREATE TABLE `anhsanpham` (
  `ma_anh` int(11) NOT NULL,
  `ma_san_pham` int(11) NOT NULL,
  `duong_dan_anh` varchar(255) NOT NULL,
  `thu_tu_hien_thi` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anhsanpham`
--

INSERT INTO `anhsanpham` (`ma_anh`, `ma_san_pham`, `duong_dan_anh`, `thu_tu_hien_thi`) VALUES
(1, 1, 'products/lrp_effaclar_1.png', 1),
(2, 1, 'products/lrp_effaclar_2.png', 2),
(3, 2, 'products/lrp_anthelios_1.png', 1),
(4, 3, 'products/lrp_serum_1.png', 1),
(5, 4, 'products/vichy_normaderm_1.png', 1),
(6, 5, 'products/estee_anr_1.png', 1),
(7, 5, 'products/estee_anr_box.png', 2),
(8, 6, 'products/laneige_lip_1.png', 1),
(9, 7, 'products/innisfree_greentea_1.png', 1),
(10, 8, 'products/anessa_milk_1.png', 1),
(11, 9, 'products/loreal_ha_1.png', 1),
(12, 10, 'products/maybelline_matte_1.png', 1),
(13, 11, 'products/cerave_foaming_1.png', 1),
(14, 12, 'products/paula_bha_1.png', 1),
(15, 12, 'products/paula_bha_texture.png', 2),
(16, 13, 'products/ordinary_nia_1.png', 1),
(17, 14, 'products/mac_ruby_1.png', 1),
(18, 15, 'products/innisfree_hair_1.png', 1),
(19, 16, 'products/sulwhasoo_first_1.png', 1),
(20, 17, 'products/bioderma_sensibio_1.png', 1),
(21, 18, 'products/klairs_vit_1.png', 1),
(22, 19, 'products/skin1004_centella_1.png', 1),
(23, 20, 'products/cocoon_shampoo_1.png', 1),
(24, 21, 'products/hadalabo_lotion_1.png', 1),
(25, 22, 'products/kiehls_darkspot_1.png', 1),
(26, 23, 'products/cerave_sunscreen_1.png', 1),
(27, 24, 'products/cerave_healing_1.png', 1),
(28, 25, 'products/cocoon_coffee_1.png', 1),
(29, 26, 'products/loreal_fall_1.png', 1),
(30, 27, 'products/paula_lip_1.png', 1),
(31, 28, 'products/shiseido_cleanser_1.png', 1),
(32, 29, 'products/laneige_waterbank_1.png', 1),
(33, 30, 'products/ordinary_uv_1.png', 1),
(34, 31, 'products/skin1004_oil_1.png', 1),
(35, 32, 'products/vichy_vitc_1.png', 1),
(36, 33, 'products/innisfree_cotton_1.png', 1),
(37, 34, 'products/kiehls_amino_1.png', 1),
(38, 35, 'products/paula_clear_1.png', 1),
(39, 36, 'products/bioderma_pore_1.png', 1),
(40, 37, 'products/bioderma_aqua_1.png', 1),
(41, 38, 'products/mac_powder_1.png', 1),
(42, 39, 'products/cocoon_mask_1.png', 1),
(43, 40, 'products/hadalabo_oil_1.png', 1),
(44, 41, 'products/lrp_duo_1.png', 1),
(45, 42, 'products/laneige_radianc_1.png', 1),
(46, 43, 'products/maybelline_lifter_1.png', 1),
(47, 44, 'products/shiseido_ultimune_1.png', 1),
(48, 45, 'products/kiehls_calendula_1.png', 1),
(49, 46, 'products/cocoon_turmeric_1.png', 1),
(50, 47, 'products/kiehls_uv_1.png', 1),
(51, 48, 'products/sulwhasoo_lip_1.png', 1),
(52, 49, 'products/loreal_color_1.png', 1),
(53, 50, 'products/mac_fix_1.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bienthesanpham`
--

CREATE TABLE `bienthesanpham` (
  `ma_bien_the` int(11) NOT NULL,
  `ma_san_pham` int(11) NOT NULL,
  `ma_sku` varchar(50) NOT NULL,
  `gia_ban` decimal(15,2) NOT NULL,
  `so_luong_ton` int(11) DEFAULT 0,
  `ten_thuoc_tinh` varchar(50) DEFAULT NULL,
  `gia_tri_thuoc_tinh` varchar(50) DEFAULT NULL,
  `anh_bien_the` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bienthesanpham`
--

INSERT INTO `bienthesanpham` (`ma_bien_the`, `ma_san_pham`, `ma_sku`, `gia_ban`, `so_luong_ton`, `ten_thuoc_tinh`, `gia_tri_thuoc_tinh`, `anh_bien_the`) VALUES
(1, 1, 'LRP-EF-50', 175000.00, 100, 'Dung tích', '50ml', NULL),
(2, 1, 'LRP-EF-200', 385000.00, 50, 'Dung tích', '200ml', NULL),
(3, 1, 'LRP-EF-400', 525000.00, 30, 'Dung tích', '400ml', NULL),
(4, 2, 'LRP-AN-50', 495000.00, 120, 'Dung tích', '50ml', NULL),
(5, 3, 'LRP-EF-SER-30', 950000.00, 40, 'Dung tích', '30ml', NULL),
(6, 4, 'VIC-NOR-200', 360000.00, 60, 'Dung tích', '200ml', NULL),
(7, 4, 'VIC-NOR-400', 510000.00, 25, 'Dung tích', '400ml', NULL),
(8, 5, 'EST-ANR-30', 2100000.00, 15, 'Dung tích', '30ml', NULL),
(9, 5, 'EST-ANR-50', 3500000.00, 10, 'Dung tích', '50ml', NULL),
(10, 6, 'LAN-LIP-B', 240000.00, 80, 'Màu sắc', 'Berry', NULL),
(11, 6, 'LAN-LIP-G', 240000.00, 45, 'Màu sắc', 'Grapefruit', NULL),
(12, 7, 'INN-GT-150', 220000.00, 150, 'Dung tích', '150ml', NULL),
(13, 8, 'ANE-MILK-60', 620000.00, 200, 'Dung tích', '60ml', NULL),
(14, 8, 'ANE-MILK-20', 250000.00, 100, 'Dung tích', '20ml', NULL),
(15, 9, 'LOR-HA-30', 420000.00, 90, 'Dung tích', '30ml', NULL),
(16, 10, 'MAY-MAT-117', 205000.00, 70, 'Màu sắc', '117 Groundbreaker', NULL),
(17, 10, 'MAY-MAT-118', 205000.00, 65, 'Màu sắc', '118 Dancer', NULL),
(18, 10, 'MAY-MAT-205', 205000.00, 50, 'Màu sắc', '205 Assertive', NULL),
(19, 11, 'CER-FO-236', 320000.00, 110, 'Dung tích', '236ml', NULL),
(20, 11, 'CER-FO-473', 450000.00, 85, 'Dung tích', '473ml', NULL),
(21, 12, 'PAU-BHA-30', 399000.00, 40, 'Dung tích', '30ml', NULL),
(22, 12, 'PAU-BHA-118', 949000.00, 20, 'Dung tích', '118ml', NULL),
(23, 13, 'ORD-NIA-30', 210000.00, 130, 'Dung tích', '30ml', NULL),
(24, 13, 'ORD-NIA-60', 380000.00, 55, 'Dung tích', '60ml', NULL),
(25, 14, 'MAC-RUBY', 550000.00, 40, 'Màu sắc', 'Ruby Woo', NULL),
(26, 15, 'INN-MYH-250', 280000.00, 45, 'Dung tích', '250ml', NULL),
(27, 16, 'SUL-FCA-60', 1850000.00, 15, 'Dung tích', '60ml', NULL),
(28, 17, 'BIO-SEN-100', 195000.00, 200, 'Dung tích', '100ml', NULL),
(29, 17, 'BIO-SEN-500', 495000.00, 150, 'Dung tích', '500ml', NULL),
(30, 18, 'KLA-VIT-35', 350000.00, 60, 'Dung tích', '35ml', NULL),
(31, 19, 'SKI-AMP-100', 450000.00, 110, 'Dung tích', '100ml', NULL),
(32, 19, 'SKI-AMP-55', 320000.00, 70, 'Dung tích', '55ml', NULL),
(33, 20, 'COC-SHAM-310', 245000.00, 90, 'Dung tích', '310ml', NULL),
(34, 21, 'HAD-LOK-170', 285000.00, 120, 'Dung tích', '170ml', NULL),
(35, 22, 'KIE-DAR-30', 1650000.00, 20, 'Dung tích', '30ml', NULL),
(36, 22, 'KIE-DAR-50', 2400000.00, 12, 'Dung tích', '50ml', NULL),
(37, 23, 'CER-SUN-75', 410000.00, 40, 'Dung tích', '75ml', NULL),
(38, 24, 'CER-HEA-85', 380000.00, 50, 'Khối lượng', '85g', NULL),
(39, 25, 'COC-COF-200', 165000.00, 140, 'Khối lượng', '200g', NULL),
(40, 26, 'LOR-FAL-650', 189000.00, 60, 'Dung tích', '650ml', NULL),
(41, 27, 'PAU-LIP-10', 550000.00, 30, 'Dung tích', '10ml', NULL),
(42, 28, 'SHI-CLA-125', 1100000.00, 25, 'Dung tích', '125ml', NULL),
(43, 29, 'LAN-WBS-50', 1150000.00, 35, 'Dung tích', '50ml', NULL),
(44, 30, 'ORD-UV-50', 295000.00, 45, 'Dung tích', '50ml', NULL),
(45, 31, 'SKI-OIL-200', 395000.00, 65, 'Dung tích', '200ml', NULL),
(46, 32, 'VIC-VIT-20', 950000.00, 20, 'Dung tích', '20ml', NULL),
(47, 33, 'INN-COT-01', 220000.00, 50, 'Màu sắc', '01 Red', NULL),
(48, 33, 'INN-COT-05', 220000.00, 45, 'Màu sắc', '05 Burgundy', NULL),
(49, 34, 'KIE-AMI-250', 650000.00, 30, 'Dung tích', '250ml', NULL),
(50, 34, 'KIE-AMI-500', 1100000.00, 15, 'Dung tích', '500ml', NULL),
(51, 35, 'PAU-CLE-177', 599000.00, 40, 'Dung tích', '177ml', NULL),
(52, 36, 'BIO-PORE-30', 450000.00, 55, 'Dung tích', '30ml', NULL),
(53, 37, 'BIO-AQUA-40', 420000.00, 70, 'Dung tích', '40ml', NULL),
(54, 38, 'MAC-POW-923', 580000.00, 35, 'Màu sắc', '923 Stay Curious', NULL),
(55, 38, 'MAC-POW-316', 580000.00, 30, 'Màu sắc', '316 Devoted To Chili', NULL),
(56, 39, 'COC-MASK-200', 215000.00, 80, 'Khối lượng', '200g', NULL),
(57, 40, 'HAD-OIL-200', 320000.00, 60, 'Dung tích', '200ml', NULL),
(58, 41, 'LRP-DUO-40', 425000.00, 100, 'Dung tích', '40ml', NULL),
(59, 42, 'LAN-RAD-50', 850000.00, 40, 'Dung tích', '50ml', NULL),
(60, 43, 'MAY-LIF-001', 215000.00, 50, 'Màu sắc', '001 Pearl', NULL),
(61, 43, 'MAY-LIF-004', 215000.00, 40, 'Màu sắc', '004 Silk', NULL),
(62, 44, 'SHI-ULT-50', 2850000.00, 10, 'Dung tích', '50ml', NULL),
(63, 45, 'KIE-CAL-230', 950000.00, 50, 'Dung tích', '230ml', NULL),
(64, 45, 'KIE-CAL-500', 1750000.00, 20, 'Dung tích', '500ml', NULL),
(65, 46, 'COC-TUR-30', 265000.00, 85, 'Dung tích', '30ml', NULL),
(66, 47, 'KIE-UV-30', 1150000.00, 45, 'Dung tích', '30ml', NULL),
(67, 48, 'SUL-LIP-1', 950000.00, 20, 'Màu sắc', '01 Apricot', NULL),
(68, 49, 'LOR-COL-650', 205000.00, 40, 'Dung tích', '650ml', NULL),
(69, 50, 'MAC-FIX-100', 650000.00, 55, 'Dung tích', '100ml', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `ma_chi_tiet` int(11) NOT NULL,
  `ma_don_hang` int(11) NOT NULL,
  `ma_bien_the` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `gia_don_vi` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`ma_chi_tiet`, `ma_don_hang`, `ma_bien_the`, `so_luong`, `gia_don_vi`) VALUES
(1, 1, 1, 1, 175000.00),
(2, 1, 12, 1, 399000.00),
(3, 2, 5, 1, 950000.00),
(4, 2, 17, 1, 250000.00),
(5, 3, 8, 1, 620000.00),
(6, 3, 23, 1, 230000.00),
(7, 4, 30, 1, 300000.00),
(8, 5, 11, 1, 450000.00),
(9, 5, 21, 1, 100000.00),
(10, 6, 13, 1, 210000.00),
(11, 7, 3, 1, 525000.00),
(12, 7, 35, 1, 425000.00),
(13, 8, 15, 1, 420000.00),
(14, 8, 30, 1, 300000.00),
(15, 9, 20, 1, 480000.00),
(16, 10, 16, 1, 1500000.00),
(17, 11, 26, 1, 600000.00),
(18, 12, 43, 1, 215000.00),
(19, 12, 40, 1, 205000.00),
(20, 13, 22, 1, 890000.00),
(21, 14, 1, 2, 175000.00),
(22, 15, 12, 1, 949000.00),
(23, 15, 10, 1, 151000.00),
(24, 16, 33, 1, 265000.00),
(25, 17, 20, 1, 750000.00),
(26, 18, 24, 1, 380000.00),
(27, 19, 32, 1, 1350000.00),
(28, 20, 11, 1, 520000.00),
(29, 21, 5, 1, 980000.00),
(30, 22, 11, 1, 450000.00),
(31, 23, 14, 1, 600000.00),
(32, 24, 27, 1, 150000.00),
(33, 25, 32, 2, 1400000.00),
(34, 26, 16, 1, 1850000.00),
(35, 26, 34, 1, 650000.00),
(36, 27, 21, 1, 340000.00),
(37, 28, 41, 1, 500000.00),
(38, 29, 31, 1, 400000.00),
(39, 30, 5, 1, 1250000.00),
(40, 31, 1, 1, 750000.00),
(41, 32, 30, 1, 300000.00),
(42, 33, 43, 1, 180000.00),
(43, 34, 8, 1, 620000.00),
(44, 35, 5, 1, 3500000.00),
(45, 35, 16, 1, 1000000.00),
(46, 36, 33, 1, 220000.00),
(47, 37, 8, 1, 850000.00),
(48, 38, 31, 1, 400000.00),
(49, 39, 19, 1, 3500000.00),
(50, 40, 27, 1, 150000.00),
(51, 41, 1, 1, 1200000.00),
(52, 42, 21, 1, 780000.00),
(53, 43, 30, 1, 300000.00),
(54, 44, 11, 1, 550000.00),
(55, 45, 15, 2, 400000.00),
(56, 46, 26, 1, 900000.00),
(57, 47, 32, 1, 1600000.00),
(58, 48, 12, 1, 420000.00),
(59, 49, 8, 1, 250000.00),
(60, 50, 11, 1, 680000.00),
(61, 51, 12, 1, 350000.00),
(62, 52, 16, 1, 1150000.00),
(63, 53, 1, 1, 550000.00),
(64, 54, 30, 1, 300000.00),
(65, 55, 13, 1, 210000.00),
(66, 56, 37, 2, 425000.00),
(67, 57, 1, 1, 400000.00),
(68, 58, 1, 1, 1250000.00),
(69, 59, 14, 2, 550000.00),
(70, 60, 18, 1, 350000.00),
(71, 61, 26, 1, 600000.00),
(72, 62, 33, 1, 220000.00),
(73, 63, 27, 1, 50000.00),
(74, 64, 21, 1, 780000.00),
(75, 65, 34, 1, 650000.00),
(76, 66, 30, 1, 300000.00),
(77, 67, 24, 1, 150000.00),
(78, 68, 34, 1, 1100000.00),
(79, 69, 41, 1, 550000.00),
(80, 70, 31, 1, 400000.00);

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `ma_danh_gia` int(11) NOT NULL,
  `ma_nguoi_dung` int(11) NOT NULL,
  `ma_san_pham` int(11) NOT NULL,
  `so_sao` tinyint(4) DEFAULT NULL CHECK (`so_sao` between 1 and 5),
  `noi_dung` text DEFAULT NULL,
  `anh_danh_gia` varchar(255) DEFAULT NULL,
  `ngay_danh_gia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danhgia`
--

INSERT INTO `danhgia` (`ma_danh_gia`, `ma_nguoi_dung`, `ma_san_pham`, `so_sao`, `noi_dung`, `anh_danh_gia`, `ngay_danh_gia`) VALUES
(1, 4, 1, 5, 'Sản phẩm dùng rất tốt, da sạch mà không bị khô.', NULL, '2026-04-14 12:22:26'),
(2, 5, 5, 5, 'Serum ANR đúng là chân ái, da phục hồi rất nhanh.', NULL, '2026-04-14 12:22:26'),
(3, 6, 8, 4, 'Chống nắng tốt nhưng hơi bóng mặt tí.', NULL, '2026-04-14 12:22:26'),
(4, 8, 4, 5, 'Sữa rửa mặt Vichy dùng cực thích cho da dầu.', NULL, '2026-04-14 12:22:26'),
(5, 9, 10, 3, 'Màu son hơi đậm so với hình nhưng vẫn đẹp.', NULL, '2026-04-14 12:22:26'),
(6, 10, 1, 5, 'Giao hàng nhanh, đóng gói cẩn thận.', NULL, '2026-04-14 12:22:26'),
(7, 11, 7, 4, 'Innisfree trà xanh lúc nào cũng ổn.', NULL, '2026-04-14 12:22:26'),
(8, 13, 12, 5, 'BHA Paula Choice giúp đẩy mụn ẩn rất tốt.', NULL, '2026-04-14 12:22:26'),
(9, 14, 14, 5, 'Son MAC Ruby Woo màu đỏ quá sang.', NULL, '2026-04-14 12:22:26'),
(10, 15, 13, 2, 'Dùng bị châm chích nhẹ, chắc do da mình nhạy cảm.', NULL, '2026-04-14 12:22:26'),
(11, 16, 17, 5, 'Nước tẩy trang quốc dân, không có gì để chê.', NULL, '2026-04-14 12:22:26'),
(12, 17, 19, 5, 'Tinh chất rau má làm dịu da mụn cực ổn.', NULL, '2026-04-14 12:22:26'),
(13, 18, 20, 4, 'Dầu gội bưởi mùi thơm tự nhiên, đỡ rụng tóc.', NULL, '2026-04-14 12:22:26'),
(14, 19, 25, 5, 'Tẩy da chết cà phê thơm xỉu luôn.', NULL, '2026-04-14 12:22:26'),
(15, 20, 1, 5, 'Sản phẩm chính hãng, check code ok.', NULL, '2026-04-14 12:22:26'),
(16, 21, 3, 5, 'Serum giảm mụn hiệu quả.', NULL, '2026-04-14 12:22:26'),
(17, 22, 6, 4, 'Son dưỡng thơm.', NULL, '2026-04-14 12:22:26'),
(18, 23, 9, 5, 'Cấp ẩm tốt.', NULL, '2026-04-14 12:22:26'),
(19, 24, 11, 4, 'Rửa mặt sạch.', NULL, '2026-04-14 12:22:26'),
(20, 25, 2, 5, 'Chống nắng đỉnh.', NULL, '2026-04-14 12:22:26'),
(21, 26, 15, 5, 'Tẩy trang sạch.', NULL, '2026-04-14 12:22:26'),
(22, 27, 18, 4, 'Vitamin C sáng da.', NULL, '2026-04-14 12:22:26'),
(23, 4, 22, 5, 'Mờ thâm nhanh.', NULL, '2026-04-14 12:22:26'),
(24, 5, 24, 5, 'Dưỡng ẩm tốt.', NULL, '2026-04-14 12:22:26'),
(25, 6, 26, 3, 'Hơi rít tóc.', NULL, '2026-04-14 12:22:26'),
(26, 7, 28, 5, 'Shiseido đẳng cấp.', NULL, '2026-04-14 12:22:26'),
(27, 8, 30, 4, 'Giá rẻ mà tốt.', NULL, '2026-04-14 12:22:26'),
(28, 9, 32, 5, 'Vitamin C Vichy tươi mới.', NULL, '2026-04-14 12:22:26'),
(29, 10, 34, 5, 'Dầu gội dịu nhẹ.', NULL, '2026-04-14 12:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `ma_danh_muc` int(11) NOT NULL,
  `ten_danh_muc` varchar(100) NOT NULL,
  `duong_dan_anh` varchar(255) DEFAULT 'assets/img/default_cat.png',
  `ma_danh_muc_cha` int(11) DEFAULT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`ma_danh_muc`, `ten_danh_muc`, `duong_dan_anh`, `ma_danh_muc_cha`, `ngay_tao`) VALUES
(1, 'Chăm sóc da mặt', 'assets/img/skincare.png', NULL, '2026-04-14 12:20:07'),
(2, 'Trang điểm', 'assets/img/makeup.png', NULL, '2026-04-14 12:20:07'),
(3, 'Chăm sóc cơ thể', 'assets/img/bodycare.png', NULL, '2026-04-14 12:20:07'),
(4, 'Nước hoa', 'assets/img/perfume.png', NULL, '2026-04-14 12:20:07'),
(5, 'Chăm sóc tóc', 'assets/img/haircare.png', NULL, '2026-04-14 12:20:07'),
(6, 'Sữa rửa mặt', 'assets/img/cleanser.png', 1, '2026-04-14 12:20:07'),
(7, 'Serum & Tinh chất', 'assets/img/serum.png', 1, '2026-04-14 12:20:07'),
(8, 'Kem chống nắng', 'assets/img/sunscreen.png', 1, '2026-04-14 12:20:07'),
(9, 'Son môi', 'assets/img/lipstick.png', 2, '2026-04-14 12:20:07'),
(10, 'Dầu gội', 'assets/img/shampoo.png', 5, '2026-04-14 12:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `diachi`
--

CREATE TABLE `diachi` (
  `ma_dia_chi` int(11) NOT NULL,
  `ma_nguoi_dung` int(11) NOT NULL,
  `la_mac_dinh` tinyint(1) DEFAULT 0,
  `ten_duong` varchar(255) NOT NULL,
  `phuong_xa` varchar(100) DEFAULT NULL,
  `quan_huyen` varchar(100) DEFAULT NULL,
  `thanh_pho` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diachi`
--

INSERT INTO `diachi` (`ma_dia_chi`, `ma_nguoi_dung`, `la_mac_dinh`, `ten_duong`, `phuong_xa`, `quan_huyen`, `thanh_pho`) VALUES
(1, 1, 1, '123 Le Loi', 'Ben Nghe', 'Quan 1', 'Ho Chi Minh'),
(2, 2, 1, '456 Nguyen Trai', 'Thanh Xuan Trung', 'Thanh Xuan', 'Ha Noi'),
(3, 3, 1, '789 Tran Hung Dao', 'Hai Chau I', 'Hai Chau', 'Da Nang'),
(4, 4, 1, '12 Ly Tu Trong', 'An Cu', 'Ninh Kieu', 'Can Tho'),
(5, 5, 1, '34 Hoang Hoa Tham', 'Loc Tho', 'Nha Trang', 'Khanh Hoa'),
(6, 6, 1, '56 Hung Vuong', 'Tu An', 'Buon Ma Thuot', 'Dak Lak'),
(7, 7, 1, '78 Phan Chu Trinh', 'Van Thanh', 'Phan Thiet', 'Binh Thuan'),
(8, 8, 1, '90 Nguyen Hue', 'Phu Hoi', 'Hue', 'Thua Thien Hue'),
(9, 9, 1, '11 Quang Trung', 'Ngoc Trao', 'Thanh Pho Thanh Hoa', 'Thanh Hoa'),
(10, 10, 1, '22 Le Thanh Tong', 'Bach Dang', 'Ha Long', 'Quang Ninh'),
(11, 11, 1, '33 Tran Phu', 'Lien Bao', 'Vinh Yen', 'Vinh Phuc'),
(12, 12, 1, '44 Vo Thi Sau', 'Thong Nhat', 'Bien Hoa', 'Dong Nai'),
(13, 13, 1, '55 Nguyen Van Linh', 'Vinh Trung', 'Thanh Khe', 'Da Nang'),
(14, 14, 1, '66 CMT8', 'Phuong 5', 'Quan 3', 'Ho Chi Minh'),
(15, 15, 1, '77 Dien Bien Phu', 'Da Kao', 'Quan 1', 'Ho Chi Minh'),
(16, 16, 1, '88 Ba Huyen Thanh Quan', 'Phuong 6', 'Quan 3', 'Ho Chi Minh'),
(17, 17, 1, '99 Hai Ba Trung', 'Ben Nghe', 'Quan 1', 'Ho Chi Minh'),
(18, 18, 1, '101 Nam Ky Khoi Nghia', 'Vo Thi Sau', 'Quan 3', 'Ho Chi Minh'),
(19, 19, 1, '202 Nguyen Van Cu', 'An Khanh', 'Ninh Kieu', 'Can Tho'),
(20, 20, 1, '303 Tran Phu', 'Phuong 4', 'Vung Tau', 'Ba Ria - Vung Tau'),
(21, 21, 1, '404 Le Duan', 'Thach Thang', 'Hai Chau', 'Da Nang'),
(22, 22, 1, '505 Kim Ma', 'Ngoc Khanh', 'Ba Dinh', 'Ha Noi'),
(23, 23, 1, '606 Giai Phong', 'Giap Bat', 'Hoang Mai', 'Ha Noi'),
(24, 24, 1, '707 Cau Giay', 'Quan Hoa', 'Cau Giay', 'Ha Noi'),
(25, 25, 1, '808 Nguyen Tat Thanh', 'Xuan Ha', 'Thanh Khe', 'Da Nang'),
(26, 26, 1, '909 Hung Vuong', 'Thoi Hoa', 'Ben Cat', 'Binh Duong'),
(27, 27, 1, '100 Nguyen Van Linh', 'Tan Thuan Tay', 'Quan 7', 'Ho Chi Minh'),
(28, 4, 0, '15 Nguyen Viet Xuan', 'Hung Dung', 'Vinh', 'Nghe An'),
(29, 5, 0, '25 Nguyen Sy Sach', 'Ha Huy Tap', 'Vinh', 'Nghe An'),
(30, 10, 0, '88 To Huu', 'Trung Van', 'Nam Tu Liem', 'Ha Noi');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `ma_don_hang` int(11) NOT NULL,
  `ma_nguoi_dung` int(11) NOT NULL,
  `ma_dia_chi` int(11) DEFAULT NULL,
  `ma_giam_gia_id` int(11) DEFAULT NULL,
  `tong_tien` decimal(15,2) NOT NULL,
  `trang_thai` enum('cho_xu_ly','dang_chuan_bi','dang_giao','da_giao','da_huy') DEFAULT 'cho_xu_ly',
  `ngay_dat_hang` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`ma_don_hang`, `ma_nguoi_dung`, `ma_dia_chi`, `ma_giam_gia_id`, `tong_tien`, `trang_thai`, `ngay_dat_hang`) VALUES
(1, 4, 4, 1, 450000.00, 'da_giao', '2026-03-01 03:00:00'),
(2, 5, 5, NULL, 1200000.00, 'da_giao', '2026-03-02 04:30:00'),
(3, 6, 6, 2, 850000.00, 'da_giao', '2026-03-03 02:15:00'),
(4, 7, 7, NULL, 300000.00, 'da_huy', '2026-03-04 07:20:00'),
(5, 8, 8, 4, 550000.00, 'da_giao', '2026-03-05 09:45:00'),
(6, 9, 9, 9, 210000.00, 'da_giao', '2026-03-06 01:10:00'),
(7, 10, 10, NULL, 950000.00, 'da_giao', '2026-03-07 03:30:00'),
(8, 11, 11, 5, 720000.00, 'da_giao', '2026-03-08 05:00:00'),
(9, 12, 12, NULL, 480000.00, 'da_giao', '2026-03-09 08:50:00'),
(10, 13, 13, 3, 1500000.00, 'da_giao', '2026-03-10 04:20:00'),
(11, 14, 14, NULL, 600000.00, 'da_giao', '2026-03-11 02:00:00'),
(12, 15, 15, 14, 420000.00, 'da_giao', '2026-03-12 06:15:00'),
(13, 16, 16, NULL, 890000.00, 'da_giao', '2026-03-13 07:40:00'),
(14, 17, 17, 1, 350000.00, 'da_giao', '2026-03-14 10:00:00'),
(15, 18, 18, NULL, 1100000.00, 'da_giao', '2026-03-15 03:25:00'),
(16, 19, 19, 21, 265000.00, 'da_giao', '2026-03-16 01:50:00'),
(17, 20, 20, NULL, 750000.00, 'da_giao', '2026-03-17 04:10:00'),
(18, 21, 21, 24, 380000.00, 'da_giao', '2026-03-18 08:30:00'),
(19, 22, 22, 22, 1350000.00, 'da_giao', '2026-03-19 09:00:00'),
(20, 23, 23, NULL, 520000.00, 'da_giao', '2026-03-20 02:45:00'),
(21, 24, 24, 1, 980000.00, 'da_giao', '2026-03-21 07:10:00'),
(22, 25, 25, NULL, 450000.00, 'da_giao', '2026-03-22 06:20:00'),
(23, 26, 26, 2, 600000.00, 'da_giao', '2026-03-23 03:00:00'),
(24, 27, 27, 49, 150000.00, 'da_giao', '2026-03-24 04:30:00'),
(25, 4, 28, NULL, 2800000.00, 'da_giao', '2026-03-25 02:15:00'),
(26, 5, 29, 3, 2500000.00, 'da_giao', '2026-03-26 07:20:00'),
(27, 10, 30, NULL, 340000.00, 'da_giao', '2026-03-27 09:45:00'),
(28, 11, 11, NULL, 500000.00, 'da_giao', '2026-03-28 01:10:00'),
(29, 12, 12, 34, 400000.00, 'da_giao', '2026-03-29 03:30:00'),
(30, 13, 13, NULL, 1250000.00, 'da_giao', '2026-03-30 05:00:00'),
(31, 14, 14, 1, 750000.00, 'da_giao', '2026-03-31 08:50:00'),
(32, 15, 15, NULL, 300000.00, 'da_giao', '2026-04-01 04:20:00'),
(33, 16, 16, 43, 180000.00, 'da_giao', '2026-04-01 02:00:00'),
(34, 17, 17, NULL, 620000.00, 'da_giao', '2026-04-02 06:15:00'),
(35, 18, 18, 23, 4500000.00, 'da_giao', '2026-04-02 07:40:00'),
(36, 19, 19, NULL, 220000.00, 'da_giao', '2026-04-03 10:00:00'),
(37, 20, 20, 1, 850000.00, 'da_giao', '2026-04-03 03:25:00'),
(38, 21, 21, NULL, 400000.00, 'da_giao', '2026-04-04 01:50:00'),
(39, 22, 22, 17, 3500000.00, 'da_giao', '2026-04-04 04:10:00'),
(40, 23, 23, NULL, 150000.00, 'da_giao', '2026-04-05 08:30:00'),
(41, 24, 24, 1, 1200000.00, 'da_giao', '2026-04-05 09:00:00'),
(42, 25, 25, NULL, 780000.00, 'da_giao', '2026-04-06 02:45:00'),
(43, 26, 26, 4, 300000.00, 'da_giao', '2026-04-06 07:10:00'),
(44, 27, 27, NULL, 550000.00, 'da_giao', '2026-04-07 06:20:00'),
(45, 4, 4, 5, 800000.00, 'da_giao', '2026-04-07 03:00:00'),
(46, 5, 5, NULL, 900000.00, 'da_giao', '2026-04-08 04:30:00'),
(47, 6, 6, 22, 1600000.00, 'da_giao', '2026-04-08 02:15:00'),
(48, 7, 7, NULL, 420000.00, 'da_giao', '2026-04-09 07:20:00'),
(49, 8, 8, 1, 250000.00, 'da_giao', '2026-04-09 09:45:00'),
(50, 9, 9, NULL, 680000.00, 'da_giao', '2026-04-10 01:10:00'),
(51, 10, 10, 4, 350000.00, 'dang_giao', '2026-04-10 03:30:00'),
(52, 11, 11, NULL, 1150000.00, 'dang_giao', '2026-04-11 05:00:00'),
(53, 12, 12, 1, 550000.00, 'dang_giao', '2026-04-11 08:50:00'),
(54, 13, 13, NULL, 300000.00, 'dang_giao', '2026-04-12 04:20:00'),
(55, 14, 14, 9, 210000.00, 'dang_chuan_bi', '2026-04-12 02:00:00'),
(56, 15, 15, NULL, 850000.00, 'dang_chuan_bi', '2026-04-13 06:15:00'),
(57, 16, 16, 1, 400000.00, 'dang_chuan_bi', '2026-04-13 07:40:00'),
(58, 17, 17, NULL, 1250000.00, 'cho_xu_ly', '2026-04-14 10:00:00'),
(59, 18, 18, 10, 1100000.00, 'cho_xu_ly', '2026-04-14 03:25:00'),
(60, 19, 19, NULL, 350000.00, 'cho_xu_ly', '2026-04-14 01:50:00'),
(61, 20, 20, 1, 600000.00, 'cho_xu_ly', '2026-04-15 04:10:00'),
(62, 21, 21, NULL, 220000.00, 'cho_xu_ly', '2026-04-15 08:30:00'),
(63, 22, 22, 49, 50000.00, 'cho_xu_ly', '2026-04-15 09:00:00'),
(64, 23, 23, NULL, 780000.00, 'cho_xu_ly', '2026-04-15 02:45:00'),
(65, 24, 24, 5, 650000.00, 'cho_xu_ly', '2026-04-15 07:10:00'),
(66, 25, 25, NULL, 300000.00, 'cho_xu_ly', '2026-04-15 06:20:00'),
(67, 26, 26, 1, 150000.00, 'cho_xu_ly', '2026-04-15 03:00:00'),
(68, 27, 27, NULL, 1100000.00, 'cho_xu_ly', '2026-04-15 04:30:00'),
(69, 4, 28, 2, 550000.00, 'cho_xu_ly', '2026-04-15 02:15:00'),
(70, 5, 29, NULL, 400000.00, 'cho_xu_ly', '2026-04-15 07:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `ma_muc_gio_hang` int(11) NOT NULL,
  `ma_nguoi_dung` int(11) NOT NULL,
  `ma_bien_the` int(11) NOT NULL,
  `so_luong` int(11) DEFAULT 1,
  `ngay_them` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giohang`
--

INSERT INTO `giohang` (`ma_muc_gio_hang`, `ma_nguoi_dung`, `ma_bien_the`, `so_luong`, `ngay_them`) VALUES
(1, 4, 5, 1, '2026-04-14 12:22:17'),
(2, 4, 10, 2, '2026-04-14 12:22:17'),
(3, 5, 1, 1, '2026-04-14 12:22:17'),
(4, 5, 15, 1, '2026-04-14 12:22:17'),
(5, 6, 20, 1, '2026-04-14 12:22:17'),
(6, 7, 3, 1, '2026-04-14 12:22:17'),
(7, 8, 40, 2, '2026-04-14 12:22:17'),
(8, 9, 12, 1, '2026-04-14 12:22:17'),
(9, 10, 8, 1, '2026-04-14 12:22:17'),
(10, 11, 22, 1, '2026-04-14 12:22:17'),
(11, 12, 14, 1, '2026-04-14 12:22:17'),
(12, 13, 31, 1, '2026-04-14 12:22:17'),
(13, 14, 2, 2, '2026-04-14 12:22:17'),
(14, 15, 19, 1, '2026-04-14 12:22:17'),
(15, 16, 25, 1, '2026-04-14 12:22:17'),
(16, 17, 34, 1, '2026-04-14 12:22:17'),
(17, 18, 41, 1, '2026-04-14 12:22:17'),
(18, 19, 1, 1, '2026-04-14 12:22:17'),
(19, 20, 11, 2, '2026-04-14 12:22:17'),
(20, 21, 13, 1, '2026-04-14 12:22:17'),
(21, 22, 45, 1, '2026-04-14 12:22:17'),
(22, 23, 7, 1, '2026-04-14 12:22:17'),
(23, 24, 16, 1, '2026-04-14 12:22:17'),
(24, 25, 23, 1, '2026-04-14 12:22:17'),
(25, 26, 30, 2, '2026-04-14 12:22:17'),
(26, 27, 38, 1, '2026-04-14 12:22:17'),
(27, 4, 42, 1, '2026-04-14 12:22:17'),
(28, 5, 48, 1, '2026-04-14 12:22:17'),
(29, 6, 50, 1, '2026-04-14 12:22:17'),
(30, 7, 17, 1, '2026-04-14 12:22:17'),
(31, 8, 32, 1, '2026-04-14 12:22:17'),
(32, 9, 21, 1, '2026-04-14 12:22:17'),
(33, 10, 37, 1, '2026-04-14 12:22:17'),
(34, 11, 12, 1, '2026-04-14 12:22:17'),
(35, 12, 1, 2, '2026-04-14 12:22:17'),
(36, 13, 9, 1, '2026-04-14 12:22:17'),
(37, 14, 26, 1, '2026-04-14 12:22:17'),
(38, 15, 33, 1, '2026-04-14 12:22:17'),
(39, 16, 40, 1, '2026-04-14 12:22:17'),
(40, 17, 44, 1, '2026-04-14 12:22:17'),
(41, 18, 15, 1, '2026-04-14 12:22:17'),
(42, 19, 27, 2, '2026-04-14 12:22:17'),
(43, 20, 20, 1, '2026-04-14 12:22:17'),
(44, 21, 4, 1, '2026-04-14 12:22:17'),
(45, 22, 11, 1, '2026-04-14 12:22:17'),
(46, 23, 35, 1, '2026-04-14 12:22:17'),
(47, 24, 2, 1, '2026-04-14 12:22:17'),
(48, 25, 18, 1, '2026-04-14 12:22:17'),
(49, 26, 22, 1, '2026-04-14 12:22:17'),
(50, 27, 49, 3, '2026-04-14 12:22:17'),
(51, 4, 11, 1, '2026-04-14 12:22:17'),
(52, 5, 16, 1, '2026-04-14 12:22:17'),
(53, 6, 31, 1, '2026-04-14 12:22:17'),
(54, 7, 43, 1, '2026-04-14 12:22:17'),
(55, 8, 5, 1, '2026-04-14 12:22:17'),
(56, 9, 10, 1, '2026-04-14 12:22:17'),
(57, 10, 34, 1, '2026-04-14 12:22:17'),
(58, 11, 3, 1, '2026-04-14 12:22:17'),
(59, 12, 24, 1, '2026-04-14 12:22:17'),
(60, 13, 17, 1, '2026-04-14 12:22:17'),
(61, 14, 45, 1, '2026-04-14 12:22:17'),
(62, 15, 30, 1, '2026-04-14 12:22:17'),
(63, 16, 2, 1, '2026-04-14 12:22:17'),
(64, 17, 8, 1, '2026-04-14 12:22:17'),
(65, 18, 12, 1, '2026-04-14 12:22:17'),
(66, 19, 21, 1, '2026-04-14 12:22:17'),
(67, 20, 41, 1, '2026-04-14 12:22:17'),
(68, 21, 26, 1, '2026-04-14 12:22:17'),
(69, 22, 33, 1, '2026-04-14 12:22:17'),
(70, 23, 50, 1, '2026-04-14 12:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `magiamgia`
--

CREATE TABLE `magiamgia` (
  `ma_giam_gia_id` int(11) NOT NULL,
  `ma_code` varchar(20) NOT NULL,
  `loai_giam_gia` enum('co_dinh','phan_tram') NOT NULL,
  `gia_tri_giam` decimal(15,2) NOT NULL,
  `gia_tri_don_hang_toi_thieu` decimal(15,2) DEFAULT 0.00,
  `ngay_het_han` date NOT NULL,
  `gioi_han_su_dung` int(11) DEFAULT 1,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `magiamgia`
--

INSERT INTO `magiamgia` (`ma_giam_gia_id`, `ma_code`, `loai_giam_gia`, `gia_tri_giam`, `gia_tri_don_hang_toi_thieu`, `ngay_het_han`, `gioi_han_su_dung`, `ngay_tao`) VALUES
(1, 'WELCOME10', 'phan_tram', 10.00, 0.00, '2026-12-31', 1000, '2026-04-14 12:21:40'),
(2, 'GIAM50K', 'co_dinh', 50000.00, 500000.00, '2026-06-30', 500, '2026-04-14 12:21:40'),
(3, 'BEAUTY20', 'phan_tram', 20.00, 1000000.00, '2026-05-01', 200, '2026-04-14 12:21:40'),
(4, 'FREE50', 'co_dinh', 50000.00, 300000.00, '2026-08-15', 300, '2026-04-14 12:21:40'),
(5, 'SKINCARE15', 'phan_tram', 15.00, 600000.00, '2026-09-20', 150, '2026-04-14 12:21:40'),
(6, 'SUMMERVIBE', 'phan_tram', 25.00, 1500000.00, '2026-07-31', 100, '2026-04-14 12:21:40'),
(7, 'COCOON50', 'co_dinh', 50000.00, 400000.00, '2026-10-10', 500, '2026-04-14 12:21:40'),
(8, 'LOREAL20', 'phan_tram', 20.00, 800000.00, '2026-11-11', 250, '2026-04-14 12:21:40'),
(9, 'MAYBELLINE10', 'phan_tram', 10.00, 200000.00, '2026-12-25', 400, '2026-04-14 12:21:40'),
(10, 'LRPVOUCHER', 'co_dinh', 100000.00, 1200000.00, '2026-04-30', 100, '2026-04-14 12:21:40'),
(11, 'HALLOWEEN', 'phan_tram', 13.00, 0.00, '2026-10-31', 666, '2026-04-14 12:21:40'),
(12, 'BLACKFRIDAY', 'phan_tram', 50.00, 2000000.00, '2026-11-28', 50, '2026-04-14 12:21:40'),
(13, 'NEWYEAR2026', 'co_dinh', 200000.00, 2000000.00, '2026-01-05', 100, '2026-04-14 12:21:40'),
(14, '8MARCH', 'phan_tram', 20.00, 500000.00, '2026-03-08', 300, '2026-04-14 12:21:40'),
(15, '20OCT', 'phan_tram', 20.00, 500000.00, '2026-10-20', 300, '2026-04-14 12:21:40'),
(16, 'FLASHSALE5', 'phan_tram', 5.00, 100000.00, '2026-02-28', 1000, '2026-04-14 12:21:40'),
(17, 'MEMBERVIP', 'phan_tram', 30.00, 3000000.00, '2026-12-31', 50, '2026-04-14 12:21:40'),
(18, 'CHOICE50K', 'co_dinh', 50000.00, 450000.00, '2026-06-15', 200, '2026-04-14 12:21:40'),
(19, 'LANEIGE15', 'phan_tram', 15.00, 700000.00, '2026-05-20', 150, '2026-04-14 12:21:40'),
(20, 'ANESSA10', 'phan_tram', 10.00, 500000.00, '2026-08-30', 200, '2026-04-14 12:21:40'),
(21, 'ORD20K', 'co_dinh', 20000.00, 200000.00, '2026-07-15', 500, '2026-04-14 12:21:40'),
(22, 'VICHYGIFT', 'co_dinh', 150000.00, 1500000.00, '2026-09-01', 80, '2026-04-14 12:21:40'),
(23, 'ESTEE500K', 'co_dinh', 500000.00, 5000000.00, '2026-12-31', 20, '2026-04-14 12:21:40'),
(24, 'CERAVE12', 'phan_tram', 12.00, 400000.00, '2026-04-15', 300, '2026-04-14 12:21:40'),
(25, 'KIEHLS100', 'co_dinh', 100000.00, 1000000.00, '2026-05-05', 100, '2026-04-14 12:21:40'),
(26, 'SUNSCREEN5', 'phan_tram', 5.00, 0.00, '2026-08-31', 1000, '2026-04-14 12:21:40'),
(27, 'LIPSTICK20', 'phan_tram', 20.00, 300000.00, '2026-02-14', 500, '2026-04-14 12:21:40'),
(28, 'HAIRCARE15', 'phan_tram', 15.00, 500000.00, '2026-03-20', 200, '2026-04-14 12:21:40'),
(29, 'BODYLOVE', 'co_dinh', 40000.00, 400000.00, '2026-06-01', 400, '2026-04-14 12:21:40'),
(30, 'PERFUME10', 'phan_tram', 10.00, 2000000.00, '2026-12-31', 50, '2026-04-14 12:21:40'),
(31, 'SALE01', 'phan_tram', 10.00, 100000.00, '2026-01-31', 100, '2026-04-14 12:21:40'),
(32, 'SALE02', 'phan_tram', 10.00, 100000.00, '2026-02-28', 100, '2026-04-14 12:21:40'),
(33, 'SALE03', 'phan_tram', 10.00, 100000.00, '2026-03-31', 100, '2026-04-14 12:21:40'),
(34, 'SALE04', 'phan_tram', 10.00, 100000.00, '2026-04-30', 100, '2026-04-14 12:21:40'),
(35, 'SALE05', 'phan_tram', 10.00, 100000.00, '2026-05-31', 100, '2026-04-14 12:21:40'),
(36, 'SALE06', 'phan_tram', 10.00, 100000.00, '2026-06-30', 100, '2026-04-14 12:21:40'),
(37, 'SALE07', 'phan_tram', 10.00, 100000.00, '2026-07-31', 100, '2026-04-14 12:21:40'),
(38, 'SALE08', 'phan_tram', 10.00, 100000.00, '2026-08-31', 100, '2026-04-14 12:21:40'),
(39, 'SALE09', 'phan_tram', 10.00, 100000.00, '2026-09-30', 100, '2026-04-14 12:21:40'),
(40, 'SALE10', 'phan_tram', 10.00, 100000.00, '2026-10-31', 100, '2026-04-14 12:21:40'),
(41, 'SALE11', 'phan_tram', 10.00, 100000.00, '2026-11-30', 100, '2026-04-14 12:21:40'),
(42, 'SALE12', 'phan_tram', 10.00, 100000.00, '2026-12-31', 100, '2026-04-14 12:21:40'),
(43, 'MYPHAMVIET', 'phan_tram', 20.00, 200000.00, '2026-12-31', 500, '2026-04-14 12:21:40'),
(44, 'KBEAUTY', 'phan_tram', 15.00, 500000.00, '2026-06-30', 300, '2026-04-14 12:21:40'),
(45, 'JBEAUTY', 'phan_tram', 15.00, 500000.00, '2026-06-30', 300, '2026-04-14 12:21:40'),
(46, 'USBEAUTY', 'phan_tram', 15.00, 500000.00, '2026-06-30', 300, '2026-04-14 12:21:40'),
(47, 'FRENCHSTLYE', 'phan_tram', 15.00, 500000.00, '2026-06-30', 300, '2026-04-14 12:21:40'),
(48, 'GIFTFORYOU', 'co_dinh', 30000.00, 300000.00, '2026-12-31', 1000, '2026-04-14 12:21:40'),
(49, 'FREESHIP0', 'co_dinh', 30000.00, 0.00, '2026-12-31', 5000, '2026-04-14 12:21:40'),
(50, 'LASTCHANCE', 'phan_tram', 40.00, 1000000.00, '2026-12-31', 50, '2026-04-14 12:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `ma_nguoi_dung` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `ho_ten` varchar(100) DEFAULT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `anh_dai_dien` varchar(255) DEFAULT 'assets/img/default_avatar.png',
  `vai_tro` enum('khach_hang','quan_tri','nhan_vien') DEFAULT 'khach_hang',
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`ma_nguoi_dung`, `email`, `mat_khau`, `ho_ten`, `so_dien_thoai`, `anh_dai_dien`, `vai_tro`, `ngay_tao`) VALUES
(1, 'admin@beauty.com', '$2y$10$xyz...', 'Quản Trị Viên', '0901234567', 'assets/img/default_avatar.png', 'quan_tri', '2026-04-14 12:21:14'),
(2, 'nv_lan@beauty.com', '$2y$10$abc...', 'Nguyễn Thị Lan', '0912345678', 'assets/img/default_avatar.png', 'nhan_vien', '2026-04-14 12:21:14'),
(3, 'nv_hung@beauty.com', '$2y$10$def...', 'Trần Văn Hùng', '0923456789', 'assets/img/default_avatar.png', 'nhan_vien', '2026-04-14 12:21:14'),
(4, 'kh_01@gmail.com', '$2y$10$ghi...', 'Lê Văn An', '0934567890', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(5, 'kh_02@gmail.com', '$2y$10$jkl...', 'Phạm Thu Hà', '0945678901', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(6, 'kh_03@gmail.com', '$2y$10$mno...', 'Hoàng Gia Bảo', '0956789012', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(7, 'kh_04@gmail.com', '$2y$10$pqr...', 'Đỗ Minh Khôi', '0967890123', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(8, 'kh_05@gmail.com', '$2y$10$stu...', 'Vũ Thùy Linh', '0978901234', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(9, 'kh_06@gmail.com', '$2y$10$vwx...', 'Ngô Thanh Tùng', '0989012345', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(10, 'kh_07@gmail.com', '$2y$10$yza...', 'Bùi Phương Nam', '0990123456', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(11, 'kh_08@gmail.com', '$2y$10$bcd...', 'Đặng Mai Chi', '0812345678', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(12, 'kh_09@gmail.com', '$2y$10$efg...', 'Trương Quốc Anh', '0823456789', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(13, 'kh_10@gmail.com', '$2y$10$hij...', 'Lý Kim Ngân', '0834567890', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(14, 'kh_11@gmail.com', '$2y$10$klm...', 'Võ Hoàng Yến', '0845678901', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(15, 'kh_12@gmail.com', '$2y$10$nop...', 'Nguyễn Đình Trọng', '0856789012', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(16, 'kh_13@gmail.com', '$2y$10$qrs...', 'Trần Ngọc Bích', '0867890123', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(17, 'kh_14@gmail.com', '$2y$10$tuv...', 'Phan Anh Đức', '0878901234', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(18, 'kh_15@gmail.com', '$2y$10$wxy...', 'Lương Thế Thành', '0889012345', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(19, 'kh_16@gmail.com', '$2y$10$zab...', 'Tạ Minh Tâm', '0890123456', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(20, 'kh_17@gmail.com', '$2y$10$cde...', 'Dương Thúy Hạnh', '0701234567', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(21, 'kh_18@gmail.com', '$2y$10$fgh...', 'Cao Tiến Dũng', '0712345678', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(22, 'kh_19@gmail.com', '$2y$10$ijk...', 'Hồ Xuân Hương', '0723456789', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(23, 'kh_20@gmail.com', '$2y$10$lmn...', 'Mai Văn Quyết', '0734567890', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(24, 'kh_21@gmail.com', '$2y$10$opq...', 'Lê Thị Diệu', '0745678901', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(25, 'kh_22@gmail.com', '$2y$10$rst...', 'Đinh Công Tráng', '0756789012', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(26, 'kh_23@gmail.com', '$2y$10$uvw...', 'Phùng Hưng', '0767890123', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(27, 'kh_24@gmail.com', '$2y$10$xyz...', 'Quách Thị Trang', '0778901234', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(28, 'kh_25@gmail.com', '$2y$10$abc...', 'Vi Văn Định', '0789012345', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(29, 'kh_26@gmail.com', '$2y$10$def...', 'Tôn Nữ Hỷ Khương', '0790123456', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14'),
(30, 'kh_27@gmail.com', '$2y$10$ghi...', 'Âu Dương Chấn Hoa', '0321234567', 'assets/img/default_avatar.png', 'khach_hang', '2026-04-14 12:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `ma_san_pham` int(11) NOT NULL,
  `ma_danh_muc` int(11) DEFAULT NULL,
  `ma_thuong_hieu` int(11) DEFAULT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `anh_dai_dien` varchar(255) DEFAULT 'assets/img/default_product.png',
  `mo_ta_chi_tiet` text DEFAULT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngay_cap_nhat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`ma_san_pham`, `ma_danh_muc`, `ma_thuong_hieu`, `ten_san_pham`, `anh_dai_dien`, `mo_ta_chi_tiet`, `ngay_tao`, `ngay_cap_nhat`) VALUES
(1, 6, 1, 'Sữa rửa mặt Effaclar Gel', 'assets/img/default_product.png', 'Gel rửa mặt tạo bọt dành cho da dầu nhạy cảm', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(2, 8, 1, 'Kem chống nắng Anthelios UVMune 400', 'assets/img/default_product.png', 'Bảo vệ da khỏi tia UVA dài nhất', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(3, 7, 1, 'Serum Effaclar', 'assets/img/default_product.png', 'Hỗ trợ giảm mụn và thâm sau mụn', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(4, 6, 2, 'Sữa rửa mặt Vichy Normaderm', 'assets/img/default_product.png', 'Làm sạch sâu và se khít lỗ chân lông', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(5, 7, 3, 'Advanced Night Repair', 'assets/img/default_product.png', 'Serum phục hồi da ban đêm huyền thoại', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(6, 9, 4, 'Son dưỡng Laneige Lip Glowy Balm', 'assets/img/default_product.png', 'Dưỡng ẩm cho môi căng mọng', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(7, 6, 5, 'Sữa rửa mặt Innisfree Green Tea', 'assets/img/default_product.png', 'Chiết xuất trà xanh dưỡng ẩm', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(8, 8, 6, 'Anessa Perfect UV Sunscreen Skincare Milk', 'assets/img/default_product.png', 'Sữa chống nắng vật lý lai hóa học', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(9, 7, 7, 'Serum Hyaluronic Acid 1.5%', 'assets/img/default_product.png', 'Cấp ẩm đa tầng cho da căng bóng', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(10, 9, 8, 'Son kem Maybelline SuperStay Matte Ink', 'assets/img/default_product.png', 'Son lì lâu trôi suốt 16h', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(11, 6, 9, 'CeraVe Foaming Facial Cleanser', 'assets/img/default_product.png', 'Rửa mặt cho da dầu và da thường', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(12, 7, 10, 'Skin Perfecting 2% BHA Liquid Exfoliant', 'assets/img/default_product.png', 'Tẩy tế bào chết hóa học bán chạy nhất', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(13, 7, 11, 'Niacinamide 10% + Zinc 1%', 'assets/img/default_product.png', 'Kiểm soát dầu thừa và hỗ trợ thu nhỏ lỗ chân lông', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(14, 9, 13, 'Son M.A.C Ruby Woo', 'assets/img/default_product.png', 'Màu đỏ cổ điển sang trọng', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(15, 10, 5, 'Dầu gội Innisfree My Hair Recipe', 'assets/img/default_product.png', 'Chăm sóc da đầu khỏe mạnh', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(16, 7, 14, 'Sulwhasoo First Care Activating Serum', 'assets/img/default_product.png', 'Tinh chất khởi đầu cho làn da rạng rỡ', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(17, 6, 15, 'Bioderma Sensibio H2O', 'assets/img/default_product.png', 'Nước tẩy trang dịu nhẹ cho da nhạy cảm', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(18, 7, 16, 'Freshly Juiced Vitamin Drop', 'assets/img/default_product.png', 'Vitamin C tươi phục hồi và làm sáng da', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(19, 7, 17, 'Madagascar Centella Ampoule', 'assets/img/default_product.png', 'Tinh chất rau má làm dịu da tức thì', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(20, 10, 18, 'Dầu gội bưởi Cocoon', 'assets/img/default_product.png', 'Giảm rụng tóc và kích thích mọc tóc', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(21, 7, 19, 'Hada Labo Gokujyun Lotion', 'assets/img/default_product.png', 'Nước hoa hồng cấp ẩm sâu', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(22, 7, 20, 'Kiehl\'s Clearly Corrective Dark Spot Solution', 'assets/img/default_product.png', 'Làm mờ vết thâm và đều màu da', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(23, 8, 9, 'CeraVe Hydrating Mineral Sunscreen', 'assets/img/default_product.png', 'Chống nắng thuần vật lý cho da nhạy cảm', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(24, 9, 9, 'CeraVe Healing Ointment', 'assets/img/default_product.png', 'Sáp dưỡng phục hồi da khô nứt nẻ', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(25, 6, 18, 'Tẩy da chết cà phê Đắk Lắk', 'assets/img/default_product.png', 'Làm sạch tế bào chết cơ thể', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(26, 10, 7, 'Dầu gội L\'Oréal Elseve Fall Resist', 'assets/img/default_product.png', 'Ngăn rụng tóc hiệu quả', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(27, 9, 10, 'Paula\'s Choice Lip Booster', 'assets/img/default_product.png', 'Dưỡng môi chuyên sâu với Peptide', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(28, 6, 12, 'Shiseido Clarifying Cleansing Foam', 'assets/img/default_product.png', 'Làm sạch và dưỡng sáng da', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(29, 7, 4, 'Laneige Water Bank Blue HA Serum', 'assets/img/default_product.png', 'Cấp ẩm tức thì bằng Blue Hyaluronic Acid', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(30, 8, 11, 'The Ordinary Mineral UV Filters', 'assets/img/default_product.png', 'Chống nắng khoáng chất nhẹ nhàng', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(31, 6, 17, 'Centella Cleansing Oil', 'assets/img/default_product.png', 'Dầu tẩy trang rau má sạch sâu', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(32, 7, 2, 'Vichy Liftactiv Vitamin C 15%', 'assets/img/default_product.png', 'Chống oxy hóa và làm sáng da', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(33, 9, 5, 'Innisfree Vivid Cotton Ink', 'assets/img/default_product.png', 'Son kem mịn mượt như bông', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(34, 10, 20, 'Kiehl\'s Amino Acid Shampoo', 'assets/img/default_product.png', 'Dầu gội dịu nhẹ hằng ngày', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(35, 6, 10, 'Clear Pore Normalizing Cleanser', 'assets/img/default_product.png', 'Sữa rửa mặt giảm mụn chứa Salicylic Acid', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(36, 7, 15, 'Sébium Pore Refiner', 'assets/img/default_product.png', 'Kem dưỡng thu nhỏ lỗ chân lông cho da dầu', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(37, 8, 15, 'Photoderm Max Aquafluide', 'assets/img/default_product.png', 'Chống nắng bảo vệ tế bào da', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(38, 9, 13, 'M.A.C Powder Kiss Lipstick', 'assets/img/default_product.png', 'Son lì hiệu ứng mờ ảo', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(39, 10, 18, 'Kem ủ tóc bưởi Cocoon', 'assets/img/default_product.png', 'Nuôi dưỡng tóc từ gốc đến ngọn', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(40, 6, 19, 'Hada Labo Oil Cleansing', 'assets/img/default_product.png', 'Dầu tẩy trang dưỡng ẩm', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(41, 7, 1, 'Effaclar Duo(+)', 'assets/img/default_product.png', 'Kem dưỡng giảm mụn, ngừa thâm', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(42, 8, 4, 'Laneige Radian-C Sunscreen', 'assets/img/default_product.png', 'Chống nắng và dưỡng sáng da', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(43, 9, 8, 'Maybelline Lifter Gloss', 'assets/img/default_product.png', 'Son bóng chứa Hyaluronic Acid', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(44, 7, 12, 'Ultimune Power Infusing Concentrate', 'assets/img/default_product.png', 'Tinh chất đánh thức sức mạnh làn da', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(45, 6, 20, 'Calendula Deep Cleansing Foaming Face Wash', 'assets/img/default_product.png', 'Sữa rửa mặt hoa cúc làm dịu da', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(46, 7, 18, 'Tinh chất nghệ Hưng Yên', 'assets/img/default_product.png', 'Làm sáng da và chống oxy hóa', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(47, 8, 20, 'Ultra Light Daily UV Defense', 'assets/img/default_product.png', 'Kem chống nắng hằng ngày thoáng nhẹ', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(48, 9, 14, 'Essential Lip Serum Stick', 'assets/img/default_product.png', 'Son dưỡng thảo dược cao cấp', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(49, 10, 7, 'Dầu gội L\'Oréal Color Protect', 'assets/img/default_product.png', 'Giữ màu cho tóc nhuộm', '2026-04-14 12:20:36', '2026-04-14 12:20:36'),
(50, 7, 13, 'M.A.C Prep + Prime Fix+', 'assets/img/default_product.png', 'Xịt khoáng giữ lớp trang điểm', '2026-04-14 12:20:36', '2026-04-14 12:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `ma_thanh_toan` int(11) NOT NULL,
  `ma_don_hang` int(11) NOT NULL,
  `phuong_thuc` enum('cod','the_tin_dung','vi_dien_tu','chuyen_khoan') NOT NULL,
  `trang_thai` enum('cho_thanh_toan','hoan_tat','that_bai','da_hoan_tien') DEFAULT 'cho_thanh_toan',
  `ma_giao_dich_cong` varchar(100) DEFAULT NULL,
  `ngay_thanh_toan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thanhtoan`
--

INSERT INTO `thanhtoan` (`ma_thanh_toan`, `ma_don_hang`, `phuong_thuc`, `trang_thai`, `ma_giao_dich_cong`, `ngay_thanh_toan`) VALUES
(1, 1, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(2, 2, 'the_tin_dung', 'hoan_tat', 'PAY-998811', '2026-04-14 12:22:09'),
(3, 3, 'vi_dien_tu', 'hoan_tat', 'MOMO-554422', '2026-04-14 12:22:09'),
(4, 4, 'cod', 'that_bai', NULL, '2026-04-14 12:22:09'),
(5, 5, 'chuyen_khoan', 'hoan_tat', 'BANK-778899', '2026-04-14 12:22:09'),
(6, 6, 'vi_dien_tu', 'hoan_tat', 'ZALO-112233', '2026-04-14 12:22:09'),
(7, 7, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(8, 8, 'the_tin_dung', 'hoan_tat', 'VISA-445566', '2026-04-14 12:22:09'),
(9, 9, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(10, 10, 'chuyen_khoan', 'hoan_tat', 'BANK-009911', '2026-04-14 12:22:09'),
(11, 11, 'vi_dien_tu', 'hoan_tat', 'MOMO-887766', '2026-04-14 12:22:09'),
(12, 12, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(13, 13, 'the_tin_dung', 'hoan_tat', 'PAY-332211', '2026-04-14 12:22:09'),
(14, 14, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(15, 15, 'chuyen_khoan', 'hoan_tat', 'BANK-554433', '2026-04-14 12:22:09'),
(16, 16, 'vi_dien_tu', 'hoan_tat', 'MOMO-221100', '2026-04-14 12:22:09'),
(17, 17, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(18, 18, 'the_tin_dung', 'hoan_tat', 'VISA-667788', '2026-04-14 12:22:09'),
(19, 19, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(20, 20, 'vi_dien_tu', 'hoan_tat', 'ZALO-990011', '2026-04-14 12:22:09'),
(21, 21, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(22, 22, 'chuyen_khoan', 'hoan_tat', 'BANK-223344', '2026-04-14 12:22:09'),
(23, 23, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(24, 24, 'vi_dien_tu', 'hoan_tat', 'MOMO-445566', '2026-04-14 12:22:09'),
(25, 25, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(26, 26, 'the_tin_dung', 'hoan_tat', 'PAY-112233', '2026-04-14 12:22:09'),
(27, 27, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(28, 28, 'chuyen_khoan', 'hoan_tat', 'BANK-445566', '2026-04-14 12:22:09'),
(29, 29, 'vi_dien_tu', 'hoan_tat', 'ZALO-778899', '2026-04-14 12:22:09'),
(30, 30, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(31, 31, 'the_tin_dung', 'hoan_tat', 'VISA-112233', '2026-04-14 12:22:09'),
(32, 32, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(33, 33, 'vi_dien_tu', 'hoan_tat', 'MOMO-334455', '2026-04-14 12:22:09'),
(34, 34, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(35, 35, 'chuyen_khoan', 'hoan_tat', 'BANK-667788', '2026-04-14 12:22:09'),
(36, 36, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(37, 37, 'the_tin_dung', 'hoan_tat', 'PAY-445566', '2026-04-14 12:22:09'),
(38, 38, 'vi_dien_tu', 'hoan_tat', 'ZALO-112233', '2026-04-14 12:22:09'),
(39, 39, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(40, 40, 'chuyen_khoan', 'hoan_tat', 'BANK-889900', '2026-04-14 12:22:09'),
(41, 41, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(42, 42, 'vi_dien_tu', 'hoan_tat', 'MOMO-990011', '2026-04-14 12:22:09'),
(43, 43, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(44, 44, 'the_tin_dung', 'hoan_tat', 'VISA-334455', '2026-04-14 12:22:09'),
(45, 45, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(46, 46, 'chuyen_khoan', 'hoan_tat', 'BANK-112233', '2026-04-14 12:22:09'),
(47, 47, 'vi_dien_tu', 'hoan_tat', 'ZALO-445566', '2026-04-14 12:22:09'),
(48, 48, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(49, 49, 'the_tin_dung', 'hoan_tat', 'PAY-667788', '2026-04-14 12:22:09'),
(50, 50, 'cod', 'hoan_tat', NULL, '2026-04-14 12:22:09'),
(51, 51, 'cod', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(52, 52, 'vi_dien_tu', 'hoan_tat', 'MOMO-123456', '2026-04-14 12:22:09'),
(53, 53, 'cod', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(54, 54, 'chuyen_khoan', 'hoan_tat', 'BANK-987654', '2026-04-14 12:22:09'),
(55, 55, 'cod', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(56, 56, 'vi_dien_tu', 'hoan_tat', 'MOMO-111222', '2026-04-14 12:22:09'),
(57, 57, 'cod', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(58, 58, 'chuyen_khoan', 'hoan_tat', 'BANK-333444', '2026-04-14 12:22:09'),
(59, 59, 'cod', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(60, 60, 'vi_dien_tu', 'hoan_tat', 'ZALO-555666', '2026-04-14 12:22:09'),
(61, 61, 'cod', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(62, 62, 'the_tin_dung', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(63, 63, 'cod', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(64, 64, 'vi_dien_tu', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(65, 65, 'cod', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(66, 66, 'chuyen_khoan', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(67, 67, 'cod', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(68, 68, 'vi_dien_tu', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(69, 69, 'cod', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09'),
(70, 70, 'chuyen_khoan', 'cho_thanh_toan', NULL, '2026-04-14 12:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `thuonghieu`
--

CREATE TABLE `thuonghieu` (
  `ma_thuong_hieu` int(11) NOT NULL,
  `ten_thuong_hieu` varchar(100) NOT NULL,
  `duong_dan_logo` varchar(255) DEFAULT 'assets/img/default_brand.png',
  `quoc_gia` varchar(50) DEFAULT NULL,
  `mo_ta` text DEFAULT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thuonghieu`
--

INSERT INTO `thuonghieu` (`ma_thuong_hieu`, `ten_thuong_hieu`, `duong_dan_logo`, `quoc_gia`, `mo_ta`, `ngay_tao`) VALUES
(1, 'La Roche-Posay', 'logos/lrp.png', 'Pháp', 'Chuyên dược mỹ phẩm cho da nhạy cảm', '2026-04-14 12:20:21'),
(2, 'Vichy', 'logos/vichy.png', 'Pháp', 'Sử dụng nguồn nước khoáng triệu năm', '2026-04-14 12:20:21'),
(3, 'Estee Lauder', 'logos/estee.png', 'Mỹ', 'Thương hiệu mỹ phẩm cao cấp', '2026-04-14 12:20:21'),
(4, 'Laneige', 'logos/laneige.png', 'Hàn Quốc', 'Chuyên các sản phẩm cấp ẩm chuyên sâu', '2026-04-14 12:20:21'),
(5, 'Innisfree', 'logos/innisfree.png', 'Hàn Quốc', 'Mỹ phẩm thiên nhiên từ đảo Jeju', '2026-04-14 12:20:21'),
(6, 'Anessa', 'logos/anessa.png', 'Nhật Bản', 'Chuyên gia chống nắng số 1 Nhật Bản', '2026-04-14 12:20:21'),
(7, 'L\'Oréal Paris', 'logos/loreal.png', 'Pháp', 'Tập đoàn mỹ phẩm lớn nhất thế giới', '2026-04-14 12:20:21'),
(8, 'Maybelline', 'logos/maybelline.png', 'Mỹ', 'Thương hiệu trang điểm hàng đầu', '2026-04-14 12:20:21'),
(9, 'CeraVe', 'logos/cerave.png', 'Mỹ', 'Phát triển bởi các bác sĩ da liễu', '2026-04-14 12:20:21'),
(10, 'Paula\'s Choice', 'logos/paula.choice.png', 'Mỹ', 'Tập trung vào thành phần khoa học', '2026-04-14 12:20:21'),
(11, 'The Ordinary', 'logos/ordinary.png', 'Canada', 'Thiết kế đơn giản, hiệu quả tối ưu', '2026-04-14 12:20:21'),
(12, 'Shiseido', 'logos/shiseido.png', 'Nhật Bản', 'Tinh hoa mỹ phẩm Nhật Bản', '2026-04-14 12:20:21'),
(13, 'M.A.C', 'logos/mac.png', 'Mỹ', 'Đẳng cấp trang điểm chuyên nghiệp', '2026-04-14 12:20:21'),
(14, 'Sulwhasoo', 'logos/sulwhasoo.png', 'Hàn Quốc', 'Mỹ phẩm thảo dược cao cấp', '2026-04-14 12:20:21'),
(15, 'Bioderma', 'logos/bioderma.png', 'Pháp', 'Tiên phong trong giải pháp Micellar Water', '2026-04-14 12:20:21'),
(16, 'Klairs', 'logos/klairs.png', 'Hàn Quốc', 'Dành riêng cho da nhạy cảm', '2026-04-14 12:20:21'),
(17, 'Skin1004', 'logos/skin1004.png', 'Hàn Quốc', 'Chiết xuất từ rau má Madagascar', '2026-04-14 12:20:21'),
(18, 'Cocoon', 'logos/cocoon.png', 'Việt Nam', 'Mỹ phẩm thuần chay 100% Việt Nam', '2026-04-14 12:20:21'),
(19, 'Hada Labo', 'logos/hadalabo.png', 'Nhật Bản', 'Dưỡng ẩm sâu với Hyaluronic Acid', '2026-04-14 12:20:21'),
(20, 'Kiehl\'s', 'logos/kiehls.png', 'Mỹ', 'Thảo dược thiên nhiên từ năm 1851', '2026-04-14 12:20:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anhsanpham`
--
ALTER TABLE `anhsanpham`
  ADD PRIMARY KEY (`ma_anh`),
  ADD KEY `fk_anh_sanpham` (`ma_san_pham`);

--
-- Indexes for table `bienthesanpham`
--
ALTER TABLE `bienthesanpham`
  ADD PRIMARY KEY (`ma_bien_the`),
  ADD UNIQUE KEY `ma_sku` (`ma_sku`),
  ADD KEY `fk_bienthe_sanpham` (`ma_san_pham`),
  ADD KEY `idx_sku_bien_the` (`ma_sku`);

--
-- Indexes for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`ma_chi_tiet`),
  ADD KEY `fk_chitiet_donhang` (`ma_don_hang`),
  ADD KEY `fk_chitiet_bienthe` (`ma_bien_the`);

--
-- Indexes for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`ma_danh_gia`),
  ADD KEY `fk_danhgia_nguoidung` (`ma_nguoi_dung`),
  ADD KEY `fk_danhgia_sanpham` (`ma_san_pham`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`ma_danh_muc`),
  ADD KEY `fk_danhmuc_cha` (`ma_danh_muc_cha`);

--
-- Indexes for table `diachi`
--
ALTER TABLE `diachi`
  ADD PRIMARY KEY (`ma_dia_chi`),
  ADD KEY `fk_diachi_nguoidung` (`ma_nguoi_dung`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`ma_don_hang`),
  ADD KEY `fk_donhang_nguoidung` (`ma_nguoi_dung`),
  ADD KEY `fk_donhang_diachi` (`ma_dia_chi`),
  ADD KEY `fk_donhang_magiamgia` (`ma_giam_gia_id`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`ma_muc_gio_hang`),
  ADD KEY `fk_giohang_nguoidung` (`ma_nguoi_dung`),
  ADD KEY `fk_giohang_bienthe` (`ma_bien_the`);

--
-- Indexes for table `magiamgia`
--
ALTER TABLE `magiamgia`
  ADD PRIMARY KEY (`ma_giam_gia_id`),
  ADD UNIQUE KEY `ma_code` (`ma_code`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`ma_nguoi_dung`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ma_san_pham`),
  ADD KEY `fk_sanpham_danhmuc` (`ma_danh_muc`),
  ADD KEY `fk_sanpham_thuonghieu` (`ma_thuong_hieu`),
  ADD KEY `idx_ten_san_pham` (`ten_san_pham`);

--
-- Indexes for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`ma_thanh_toan`),
  ADD KEY `fk_thanhtoan_donhang` (`ma_don_hang`);

--
-- Indexes for table `thuonghieu`
--
ALTER TABLE `thuonghieu`
  ADD PRIMARY KEY (`ma_thuong_hieu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anhsanpham`
--
ALTER TABLE `anhsanpham`
  MODIFY `ma_anh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `bienthesanpham`
--
ALTER TABLE `bienthesanpham`
  MODIFY `ma_bien_the` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `ma_chi_tiet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `ma_danh_gia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `ma_danh_muc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `diachi`
--
ALTER TABLE `diachi`
  MODIFY `ma_dia_chi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `ma_don_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `ma_muc_gio_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `magiamgia`
--
ALTER TABLE `magiamgia`
  MODIFY `ma_giam_gia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `ma_nguoi_dung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ma_san_pham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `ma_thanh_toan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `thuonghieu`
--
ALTER TABLE `thuonghieu`
  MODIFY `ma_thuong_hieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anhsanpham`
--
ALTER TABLE `anhsanpham`
  ADD CONSTRAINT `fk_anh_sanpham` FOREIGN KEY (`ma_san_pham`) REFERENCES `sanpham` (`ma_san_pham`) ON DELETE CASCADE;

--
-- Constraints for table `bienthesanpham`
--
ALTER TABLE `bienthesanpham`
  ADD CONSTRAINT `fk_bienthe_sanpham` FOREIGN KEY (`ma_san_pham`) REFERENCES `sanpham` (`ma_san_pham`) ON DELETE CASCADE;

--
-- Constraints for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `fk_chitiet_bienthe` FOREIGN KEY (`ma_bien_the`) REFERENCES `bienthesanpham` (`ma_bien_the`),
  ADD CONSTRAINT `fk_chitiet_donhang` FOREIGN KEY (`ma_don_hang`) REFERENCES `donhang` (`ma_don_hang`) ON DELETE CASCADE;

--
-- Constraints for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `fk_danhgia_nguoidung` FOREIGN KEY (`ma_nguoi_dung`) REFERENCES `nguoidung` (`ma_nguoi_dung`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_danhgia_sanpham` FOREIGN KEY (`ma_san_pham`) REFERENCES `sanpham` (`ma_san_pham`) ON DELETE CASCADE;

--
-- Constraints for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD CONSTRAINT `fk_danhmuc_cha` FOREIGN KEY (`ma_danh_muc_cha`) REFERENCES `danhmuc` (`ma_danh_muc`) ON DELETE SET NULL;

--
-- Constraints for table `diachi`
--
ALTER TABLE `diachi`
  ADD CONSTRAINT `fk_diachi_nguoidung` FOREIGN KEY (`ma_nguoi_dung`) REFERENCES `nguoidung` (`ma_nguoi_dung`) ON DELETE CASCADE;

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `fk_donhang_diachi` FOREIGN KEY (`ma_dia_chi`) REFERENCES `diachi` (`ma_dia_chi`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_donhang_magiamgia` FOREIGN KEY (`ma_giam_gia_id`) REFERENCES `magiamgia` (`ma_giam_gia_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_donhang_nguoidung` FOREIGN KEY (`ma_nguoi_dung`) REFERENCES `nguoidung` (`ma_nguoi_dung`) ON DELETE CASCADE;

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `fk_giohang_bienthe` FOREIGN KEY (`ma_bien_the`) REFERENCES `bienthesanpham` (`ma_bien_the`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_giohang_nguoidung` FOREIGN KEY (`ma_nguoi_dung`) REFERENCES `nguoidung` (`ma_nguoi_dung`) ON DELETE CASCADE;

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`ma_danh_muc`) REFERENCES `danhmuc` (`ma_danh_muc`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_sanpham_thuonghieu` FOREIGN KEY (`ma_thuong_hieu`) REFERENCES `thuonghieu` (`ma_thuong_hieu`) ON DELETE SET NULL;

--
-- Constraints for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD CONSTRAINT `fk_thanhtoan_donhang` FOREIGN KEY (`ma_don_hang`) REFERENCES `donhang` (`ma_don_hang`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
