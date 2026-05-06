<?php
session_start();
require_once 'app/config.php';

// Kiểm tra đăng nhập
$isLoggedIn = isset($_SESSION['nguoi_dung']);
$userName = $isLoggedIn ? $_SESSION['nguoi_dung']['ho_ten'] : '';

// Lấy giỏ mượn từ session
$cart = $_SESSION['cart'] ?? [];
$totalBooks = count($cart);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giỏ mượn sách - Xác nhận</title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/transitions.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Removed duplicate stylesheet includes to avoid conflicts -->
    <style>
        .cart-container { max-width: 900px; margin: 20px auto; }
        .cart-section { background: transparent; padding: 30px; margin-bottom: 20px; border-radius: 0; box-shadow: none; }
        .cart-header { border-bottom: 2px solid #f0f0f0; padding-bottom: 20px; margin-bottom: 20px; }
        .cart-header h2 { margin: 0; color: #333; }
        .cart-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .cart-table thead { background: #f5f5f5; }
        .cart-table th { padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #ddd; }
        .cart-table td { padding: 15px; border-bottom: 1px solid #eee; }
        .cart-table img { width: 50px; height: 70px; object-fit: cover; border-radius: 4px; }
        .book-info { display: flex; gap: 15px; align-items: flex-start; }
        .book-details h4 { margin: 0 0 5px 0; color: #333; }
        .book-details p { margin: 3px 0; color: #666; font-size: 13px; }
        .qty { text-align: center; width: 50px; }
        .btn-remove { background: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
        .btn-remove:hover { background: #c82333; }
        .cart-empty { text-align: center; padding: 40px; color: #999; }
        .cart-empty p { font-size: 16px; }
        .time-selector { margin-bottom: 20px; }
        .time-selector label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
        .time-options { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px; }
        .time-option { position: relative; }
        .time-option input[type="radio"] { display: none; }
        .time-option label { 
            display: block; 
            padding: 15px; 
            border: 2px solid #ddd; 
            border-radius: 6px; 
            cursor: pointer; 
            text-align: center; 
            transition: all 0.3s;
            background: #f9f9f9;
            margin: 0;
        }
        .time-option input[type="radio"]:checked + label { 
            background: #007bff; 
            color: white; 
            border-color: #0056b3; 
        }
        .time-option label:hover { border-color: #007bff; }
        .time-option .time-value { font-size: 20px; font-weight: 600; display: block; margin-bottom: 5px; }
        .time-option .time-desc { font-size: 12px; color: #666; }
        .time-option input[type="radio"]:checked + label .time-desc { color: rgba(255,255,255,0.9); }
        .cart-total { display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f9f9f9; border-radius: 6px; margin: 20px 0; }
        .cart-total .total-item { font-size: 14px; color: #666; }
        .cart-total .total-item strong { color: #333; }
        .cart-actions { display: flex; gap: 12px; margin-top: 20px; }
        .btn { padding: 12px 24px; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 600; transition: all 0.3s; }
        .btn-primary { background: #007bff; color: white; }
        .btn-primary:hover { background: #0056b3; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-secondary:hover { background: #5a6268; }
        .user-info { color: #28a745; font-size: 14px; font-weight: 600; margin-bottom: 15px; }
    </style>
</head>
<body>
    <?php include 'app/view/header.php'; ?>

    <div class="cart-container">
        <div class="cart-section">
            <div class="cart-header">
                <h2>Giỏ mượn sách của bạn</h2>
            </div>

            <?php if (empty($cart)): ?>
                <div class="cart-empty">
                    <p>Giỏ mượn của bạn trống. <a href="index.php">Quay lại trang chủ để chọn sách</a></p>
                </div>
            <?php else: ?>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sách</th>
                            <th style="text-align: center;">Số lượng</th>
                            <th style="text-align: center;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $bookId => $book): ?>
                            <tr>
                                <td>
                                    <img src="<?php echo getImageUrl($book['url_anh'] ?? ''); ?>" 
                                         alt="<?php echo htmlspecialchars($book['ten_sach']); ?>">
                                </td>
                                <td>
                                    <div class="book-info">
                                        <div class="book-details">
                                            <h4><?php echo htmlspecialchars($book['ten_sach']); ?></h4>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <span class="qty"><?php echo (int)$book['qty']; ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <a href="app/controller/control_muon_sach.php?action=remove&id=<?php echo (int)$bookId; ?>" 
                                       class="btn-remove" onclick="return confirm('Xóa sách này khỏi giỏ mượn?')">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="cart-total">
                    <div class="total-item">Tổng cộng: <strong><?php echo $totalBooks; ?> cuốn sách</strong></div>
                </div>

                <!-- Form chọn thời gian mượn -->
                <form method="POST" action="app/controller/control_muon_sach.php?action=checkout">
                    <div class="time-selector">
                        <label>Chọn thời gian mượn:</label>
                        <div class="time-options">
                            <div class="time-option">
                                <input type="radio" name="thoigian_muon" value="3" id="time-3days">
                                <label for="time-3days">
                                    <span class="time-value">3</span>
                                    <span class="time-desc">Ngày</span>
                                </label>
                            </div>
                            <div class="time-option">
                                <input type="radio" name="thoigian_muon" value="7" id="time-1week">
                                <label for="time-1week">
                                    <span class="time-value">1</span>
                                    <span class="time-desc">Tuần</span>
                                </label>
                            </div>
                            <div class="time-option">
                                <input type="radio" name="thoigian_muon" value="21" id="time-3weeks">
                                <label for="time-3weeks">
                                    <span class="time-value">3</span>
                                    <span class="time-desc">Tuần</span>
                                </label>
                            </div>
                            <div class="time-option">
                                <input type="radio" name="thoigian_muon" value="14" id="time-2weeks" checked>
                                <label for="time-2weeks">
                                    <span class="time-value">2</span>
                                    <span class="time-desc">Tuần (Mặc định)</span>
                                </label>
                            </div>
                        </div>
                        <div style="margin-top: 12px; padding: 12px; background: #f0f0f0; border-radius: 6px; font-size: 13px; color: #666;">
                            <strong>Hạn trả:</strong> <span id="return-date">-</span>
                        </div>
                    </div>

                    <div class="cart-actions">
                        <button type="submit" class="btn btn-primary" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>
                            Xác nhận mượn sách
                        </button>
                        <a href="app/controller/control_muon_sach.php?action=clear" class="btn btn-secondary" onclick="return confirm('Xóa toàn bộ giỏ mượn?')">
                            Xóa giỏ mượn
                        </a>
                        <a href="index.php" class="btn btn-secondary">← Quay lại trang chủ</a>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'app/view/footer.php'; ?>

    <script>
        // Tính toán ngày trả dựa trên thời gian mượn
        function updateReturnDate() {
            const selectedTime = document.querySelector('input[name="thoigian_muon"]:checked').value;
            const days = parseInt(selectedTime);
            const today = new Date();
            const returnDate = new Date(today.getTime() + days * 24 * 60 * 60 * 1000);
            
            const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            const formattedDate = returnDate.toLocaleDateString('vi-VN', options);
            
            document.getElementById('return-date').textContent = formattedDate;
        }

        // Cập nhật ngày trả khi thay đổi lựa chọn
        document.querySelectorAll('input[name="thoigian_muon"]').forEach(radio => {
            radio.addEventListener('change', updateReturnDate);
        });

        // Tính toán ngày trả ban đầu
        updateReturnDate();
    </script>
    <script src="js/vendor/jquery-library.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.vide.min.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/parallax.js"></script>
    <script src="js/countTo.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/gmap3.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
