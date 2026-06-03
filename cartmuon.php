<?php require_once 'app/controller/control_cartmuon.php'; ?>
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
    <link rel="stylesheet" href="css/color.css?v=2">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/cart.css">
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
                    <div class="total-item">Tổng cộng: <strong><?php echo $totalBooks; ?> cuốn sách</strong><br>Hạn trả: <strong>2 tuần từ ngày mượn</strong></div>
                </div>

                <!-- Form mượn sách -->
                <form method="POST" action="app/controller/control_muon_sach.php?action=checkout">
                    <input type="hidden" name="thoigian_muon" value="14">
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

    <script src="js/cart.js"></script>
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
