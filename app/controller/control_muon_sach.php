<?php

require_once '../config.php';
require_once '../model/model_index.php';
require_once '../model/model_muon_sach.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    switch ($action) {
        case 'add':
            actionThemSachVaoGio($conn);
            break;
        case 'remove':
            actionXoaSachKhoiGio();
            break;
        case 'clear':
            actionXoaToanboBGio();
            break;
        case 'print':
            actionInPhieu($conn);
            break;
        case 'checkout':
            actionCheckout($conn);
            break;
        default:
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
    }
}

/**
 * Thêm sách vào giỏ mượn
 */
function actionThemSachVaoGio($conn)
{
    if (!isset($_GET['id'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    $id = (int)$_GET['id'];
    $sach = getSachById($conn, $id);

    if (!$sach) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Lấy số lượng còn từ DB
    $stmtCheck = $conn->prepare('SELECT so_luong_con FROM sach WHERE ma_sach = ?');
    $stmtCheck->bind_param('i', $id);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    $sachData = $resultCheck->fetch_assoc();
    $stmtCheck->close();
    
    $soLuongCon = $sachData ? (int)$sachData['so_luong_con'] : 0;
    
    if ($soLuongCon <= 0) {
        $_SESSION['error'] = 'Sách này hiện không có sẵn để mượn.';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        // Kiểm tra không vượt quá số lượng có sẵn
        if ($_SESSION['cart'][$id]['qty'] < $soLuongCon) {
            $_SESSION['cart'][$id]['qty']++;
        }
    } else {
        $_SESSION['cart'][$id] = [
            'ma_sach' => $id,
            'ten_sach' => $sach['ten_sach'],
            'url_anh'  => $sach['url_anh'] ?? '',
            'qty'      => 1
        ];
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

/**
 * Xóa sách khỏi giỏ mượn
 */
function actionXoaSachKhoiGio()
{
    if (!isset($_GET['id'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    $id = (int)$_GET['id'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
        $_SESSION['success'] = 'Đã xóa sách khỏi giỏ mượn.';
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

/**
 * Xóa toàn bộ giỏ mượn
 */
function actionXoaToanboBGio()
{
    $_SESSION['cart'] = [];
    $_SESSION['success'] = 'Đã xóa toàn bộ giỏ mượn.';
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

/**
 * In phiếu mượn
 */
function actionInPhieu($conn)
{
    if (!isset($_SESSION['nguoi_dung'])) {
        header('Location: ../../login.php');
        exit();
    }
    
    if (!isset($_GET['id'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    $ma_phieu_muon = (int)$_GET['id'];
    
    $checkPhieu = $conn->prepare("SELECT ma_phieu_muon FROM phieu_muon WHERE ma_phieu_muon = ? AND ma_nguoi_dung = ?");
    $checkPhieu->bind_param('ii', $ma_phieu_muon, $_SESSION['nguoi_dung']['ma_nguoi_dung']);
    $checkPhieu->execute();
    $resultCheck = $checkPhieu->get_result();
    
    if ($resultCheck->num_rows == 0) {
        $checkPhieu->close();
        die('Bạn không có quyền in phiếu này.');
    }
    $checkPhieu->close();
    
    hienThiPhieuMuon($conn, $ma_phieu_muon);
    exit();
}

/**
 * Checkout (tạo phiếu mượn)
 */
function actionCheckout($conn)
{
    if (!isset($_SESSION['nguoi_dung'])) {
        header('Location: ../../login.php?next=cart-muon.php');
        exit();
    }

    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        $_SESSION['error'] = 'Giỏ mượn trống.';
        header('Location: ../../cart-muon.php');
        exit();
    }

    // Lấy thời gian mượn từ POST (3 ngày, 1 tuần, 3 tuần), mặc định 14 ngày
    $thoigian_muon = isset($_POST['thoigian_muon']) ? (int)$_POST['thoigian_muon'] : 14;
    if (!in_array($thoigian_muon, [3, 7, 21, 14])) {
        $thoigian_muon = 14;
    }

    $ma_nguoi_dung = (int)$_SESSION['nguoi_dung']['ma_nguoi_dung'];
    $ngay_hen_tra = date('Y-m-d H:i:s', strtotime('+' . $thoigian_muon . ' days'));

    $ma_phieu_muon = taoPhieuMuon($conn, $ma_nguoi_dung, $ngay_hen_tra);

    if (!$ma_phieu_muon) {
        $_SESSION['error'] = 'Không thể tạo phiếu mượn. Vui lòng thử lại.';
        header('Location: ../../cart-muon.php');
        exit();
    }

    $successAll = true;
    foreach ($_SESSION['cart'] as $ma_sach => $item) {
        $so_luong = (int)$item['qty'];
        
        // Kiểm tra và giảm số lượng sách
        if (!giamSoLuongSach($conn, $ma_sach, $so_luong)) {
            $successAll = false;
            break;
        }

        // Thêm chi tiết phiếu mượn
        if (!themChiTietPhieuMuon($conn, $ma_phieu_muon, $ma_sach, $so_luong)) {
            $successAll = false;
            break;
        }
    }

    if ($successAll) {
        $_SESSION['cart'] = [];
        $_SESSION['success'] = 'Mượn sách thành công. Vui lòng trả sách trước ngày ' . date('d/m/Y', strtotime($ngay_hen_tra));
        
        // Hiển thị phiếu in
        hienThiPhieuMuon($conn, $ma_phieu_muon);
        exit();
    } else {
        capNhatTrangThaiPhieuMuon($conn, $ma_phieu_muon, 'huy');
        $_SESSION['error'] = 'Lỗi khi xử lý mượn sách. Vui lòng thử lại.';
        header('Location: ../../cart-muon.php');
        exit();
    }
}

/**
 * Hiển thị phiếu mượn để in
 */
function hienThiPhieuMuon($conn, $ma_phieu_muon)
{
    $phieu = $conn->query("SELECT pm.*, nd.ho_ten, nd.email, nd.so_dien_thoai FROM phieu_muon pm JOIN nguoi_dung nd ON pm.ma_nguoi_dung = nd.ma_nguoi_dung WHERE pm.ma_phieu_muon = $ma_phieu_muon")->fetch_assoc();
    
    if (!$phieu) {
        die('Phiếu mượn không tồn tại.');
    }

    $chiTiet = layChiTietPhieuMuon($conn, $ma_phieu_muon);

    echo '<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phiếu mượn sách - ' . $phieu['ma_phieu_muon'] . '</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="apple-touch-icon" href="../../apple-touch-icon.png">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" href="../../css/normalize.css">
	<link rel="stylesheet" href="../../css/font-awesome.min.css">
	<link rel="stylesheet" href="../../css/icomoon.css">
	<link rel="stylesheet" href="../../css/jquery-ui.css">
	<link rel="stylesheet" href="../../css/owl.carousel.css">
	<link rel="stylesheet" href="../../css/transitions.css">
	<link rel="stylesheet" href="../../css/main.css">
	<link rel="stylesheet" href="../../css/color.css">
	<link rel="stylesheet" href="../../css/responsive.css">
    <style>
        body { background: #f7f7f7; color: #333; font-family: Arial, sans-serif; }
        .receipt-wrapper { max-width: 800px; margin: 40px auto; }
        .receipt-card { background: #fff; border: 1px solid #ddd; padding: 30px; border-radius: 4px; }
        .receipt-header { text-align: center; margin-bottom: 30px; }
        .receipt-header h2 { margin: 0 0 10px; font-size: 24px; }
        .receipt-header p { margin: 5px 0; font-size: 14px; color: #666; }
        .receipt-info { margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px; }
        .receipt-info-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; }
        .receipt-info-row strong { min-width: 150px; }
        .receipt-table { width: 100%; margin-bottom: 20px; }
        .receipt-table thead { background: #f5f5f5; }
        .receipt-table th, .receipt-table td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; font-size: 14px; }
        .receipt-table th { font-weight: bold; }
        .receipt-total { text-align: right; margin-bottom: 20px; font-size: 16px; font-weight: bold; }
        .receipt-footer { text-align: center; margin-top: 30px; font-size: 12px; color: #999; }
        .btn-group { text-align: center; margin-top: 20px; }
        .btn { display: inline-block; padding: 10px 20px; margin: 5px; background: #007bff; color: white; text-decoration: none; border: none; cursor: pointer; border-radius: 4px; }
        .btn:hover { background: #0056b3; }
        @media print {
            body { background: white; }
            .btn-group { display: none; }
            .receipt-wrapper { margin: 0; }
            .receipt-card { border: none; padding: 0; }
        }
    </style>
</head>
<body>
    <div class="receipt-wrapper">
        <div class="receipt-card">
            <div class="receipt-header">
                <h2>🎓 PHIẾU ĐĂNG KÝ MƯỢN SÁCH</h2>
                <p>Số phiếu: #' . str_pad($phieu['ma_phieu_muon'], 6, '0', STR_PAD_LEFT) . '</p>
            </div>

            <div class="receipt-info">
                <div class="receipt-info-row">
                    <strong>Người mượn:</strong>
                    <span>' . htmlspecialchars($phieu['ho_ten']) . '</span>
                </div>
                <div class="receipt-info-row">
                    <strong>Email:</strong>
                    <span>' . htmlspecialchars($phieu['email']) . '</span>
                </div>
                <div class="receipt-info-row">
                    <strong>Số điện thoại:</strong>
                    <span>' . htmlspecialchars($phieu['so_dien_thoai']) . '</span>
                </div>
                <div class="receipt-info-row">
                    <strong>Ngày mượn:</strong>
                    <span>' . date('d/m/Y H:i', strtotime($phieu['ngay_muon'])) . '</span>
                </div>
                <div class="receipt-info-row">
                    <strong>Hạn trả:</strong>
                    <span>' . date('d/m/Y', strtotime($phieu['ngay_hen_tra'])) . '</span>
                </div>
            </div>

            <table class="receipt-table">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sách</th>
                        <th>Thể loại</th>
                        <th>Tác giả</th>
                        <th style="text-align: center;">Số lượng</th>
                        <th style="text-align: center;">Hạn trả</th>
                    </tr>
                </thead>
                <tbody>';

    $tongSoLuong = 0;
    while ($row = $chiTiet->fetch_assoc()) {
        $tongSoLuong += (int)$row['so_luong'];
        // Xử lý đường dẫn ảnh sử dụng hàm getImageUrl()
        $anhUrl = getImageUrl($row['url_anh'] ?? '');
        echo '<tr>
                        <td style="text-align: center;">
                            <img src="' . htmlspecialchars($anhUrl) . '" alt="' . htmlspecialchars($row['ten_sach']) . '" style="width: 50px; height: 70px; object-fit: cover; border-radius: 3px;">
                        </td>
                        <td>' . htmlspecialchars($row['ten_sach']) . '</td>
                        <td>' . htmlspecialchars($row['ten_the_loai'] ?? 'N/A') . '</td>
                        <td>' . htmlspecialchars($row['ten_tac_gia'] ?? 'N/A') . '</td>
                        <td style="text-align: center;">' . (int)$row['so_luong'] . '</td>
                        <td style="text-align: center;">' . date('d/m/Y', strtotime($phieu['ngay_hen_tra'])) . '</td>
                    </tr>';
    }

    echo '</tbody>
            </table>

            <div class="receipt-total">
                Tổng cộng: <span>' . $tongSoLuong . ' cuốn</span>
            </div>

            <div class="btn-group">
                <button class="btn" onclick="window.print()">In phiếu</button>
                <a href="../../index.php" class="btn" style="background: #6c757d;">Quay lại trang chủ</a>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
    <script src="../../js/vendor/jquery-library.js"></script>
    <script src="../../js/vendor/bootstrap.min.js"></script>
    <script src="../../js/owl.carousel.min.js"></script>
    <script src="../../js/jquery.vide.min.js"></script>
    <script src="../../js/countdown.js"></script>
    <script src="../../js/jquery-ui.js"></script>
    <script src="../../js/parallax.js"></script>
    <script src="../../js/countTo.js"></script>
    <script src="../../js/appear.js"></script>
    <script src="../../js/gmap3.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>';
}
