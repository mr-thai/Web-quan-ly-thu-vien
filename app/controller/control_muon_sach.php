<?php
session_start();
require_once '../config.php';
require_once '../model/model_index_noibat.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'add' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sach = getSachById($conn, $id);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty']++;
        } else {
            $_SESSION['cart'][$id] = [
                'ten_sach' => $sach['ten_sach'],
                'gia_sach' => $sach['gia_sach'],
                'url_anh'  => $sach['url_anh'],
                'qty'      => 1
            ];
        }
        header("Location: " . $_SERVER['HTTP_REFERER']); 
        exit();
    }

    if ($action == 'checkout') {
        echo "<!doctype html>";
        echo "<html lang='vi'><head><meta charset='utf-8'><title>Phiếu mượn sách</title>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
        echo "<link rel='stylesheet' href='../../css/bootstrap.min.css'>";
        echo "<link rel='stylesheet' href='../../css/normalize.css'>";
        echo "<link rel='stylesheet' href='../../css/font-awesome.min.css'>";
        echo "<link rel='stylesheet' href='../../css/main.css'>";
        echo "<link rel='stylesheet' href='../../css/color.css'>";
        echo "<link rel='stylesheet' href='../../css/responsive.css'>";
        echo "<style>
                body { background: #f7f7f7; color: #333; }
                .borrow-wrap { max-width: 980px; margin: 40px auto; }
                .borrow-card { background: #fff; border: 1px solid #e7e7e7; padding: 30px; }
                .borrow-title { margin: 0 0 10px; font-size: 30px; font-weight: 500; color: #484848; }
                .borrow-meta { margin-bottom: 20px; color: #767676; font-size: 14px; }
                .borrow-table th { background: #f5f5f5; font-weight: 600; }
                .borrow-table th, .borrow-table td { vertical-align: middle !important; }
                .book-cover { width: 60px; height: auto; border: 1px solid #ddd; }
                .borrow-actions { margin-top: 20px; display: flex; gap: 10px; flex-wrap: wrap; }
                .borrow-empty { margin: 0; font-size: 16px; color: #767676; }
                @media print {
                    body { background: #fff; }
                    .borrow-wrap { margin: 0; max-width: 100%; }
                    .borrow-card { border: 0; padding: 0; }
                    .borrow-actions { display: none; }
                }
              </style></head><body>";
        echo "<div class='borrow-wrap'>";
        echo "<div class='borrow-card'>";
        echo "<h2 class='borrow-title'>Phiếu đăng ký mượn sách</h2>";
        echo "<div class='borrow-meta'>Ngày in: " . date('d/m/Y H:i') . "</div>";

        if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            $tongSoLuong = 0;
            echo "<table class='table table-bordered borrow-table'>";
            echo "<tr><th>Ảnh</th><th>Tên sách</th><th>Số lượng</th></tr>";
            foreach ($_SESSION['cart'] as $item) {
                $tongSoLuong += (int)$item['qty'];
                $imagePath;
                if (!preg_match('/^https?:\\/\\//i', $imagePath)) {
                    $imagePath = '../../' . ltrim($imagePath, '/');
                }
                echo "<tr>";
                echo "<td><img src='" . htmlspecialchars($imagePath) . "' alt='bia sach' class='book-cover'></td>";
                echo "<td>" . htmlspecialchars($item['ten_sach']) . "</td>";
                echo "<td>" . (int)$item['qty'] . "</td>";
                echo "</tr>";
            }
            echo "<tr><td colspan='2'><strong>Tổng số lượng</strong></td><td><strong>" . $tongSoLuong . "</strong></td></tr>";
            echo "</table>";
            unset($_SESSION['cart']);
        } else {
            echo "<p class='borrow-empty'>Giỏ hàng trống!</p>";
        }

        echo "<div class='borrow-actions'>";
        echo "<button class='tg-btn' onclick='window.print()'>In lại</button>";
        echo "<a class='tg-btn tg-active' href='../../index.php'>Quay lại trang chủ</a>";
        echo "</div>";
        echo "</div></div>";
        echo "<script>window.onload = function(){ window.print(); };</script>";
        echo "</body></html>";
        exit();
    }
}
?>