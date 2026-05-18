<?php require_once 'app/controller/control_chitietmuon.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết phiếu mượn</title>
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
    <?php include 'app/view/header.php'; ?>

    <div class="container" style="margin-top: 30px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Chi tiết phiếu mượn #<?php echo str_pad($phieu['ma_phieu_muon'], 6, '0', STR_PAD_LEFT); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Người mượn:</strong> <?php echo htmlspecialchars($phieu['ho_ten']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($phieu['email']); ?></p>
                                <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($phieu['so_dien_thoai']); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Ngày mượn:</strong> <?php echo date('d/m/Y H:i', strtotime($phieu['ngay_muon'])); ?></p>
                                <p><strong>Hạn trả:</strong> <?php echo date('d/m/Y', strtotime($phieu['ngay_hen_tra'])); ?></p>
                                <p>
                                    <strong>Trạng thái:</strong> 
                                    <span class="badge badge-<?php echo $phieu['trang_thai'] == 'dang_muon' ? 'primary' : 'success'; ?>">
                                        <?php 
                                        $statuses = [
                                            'dang_muon' => 'Đang mượn',
                                            'da_tra' => 'Đã trả',
                                            'tre_han' => 'Trễ hạn'
                                        ];
                                        echo $statuses[$phieu['trang_thai']] ?? 'Không xác định';
                                        ?>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <hr>

                        <h4>Danh sách sách mượn</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Tên sách</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $tongSoLuong = 0; ?>
                                    <?php while ($item = $chiTiet->fetch_assoc()): 
                                        $tongSoLuong += $item['so_luong'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($item['url_anh'])): ?>
                                                <img src="<?php echo getImageUrl($item['url_anh']); ?>" alt="Ảnh sách" style="max-width: 50px; height: auto;">
                                            <?php else: ?>
                                                <img src="<?php echo getImageUrl(''); ?>" alt="Ảnh sách" style="max-width: 50px; height: auto;">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($item['ten_sach']); ?></strong>
                                        </td>
                                        <td><?php echo number_format($item['gia_sach'], 0, ',', '.') . ' ₫'; ?></td>
                                        <td><?php echo $item['so_luong']; ?></td>
                                        <td>
                                            <span class="badge badge-<?php echo $item['trang_thai'] == 'dang_muon' ? 'warning' : 'success'; ?>">
                                                <?php echo $item['trang_thai'] == 'dang_muon' ? 'Đang mượn' : 'Đã trả'; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                        <div style="text-align: right; margin-top: 15px; padding-top: 15px; border-top: 1px solid #ddd;">
                            <strong>Tổng số lượng: <?php echo $tongSoLuong; ?> cuốn</strong>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    <a href="sachcuatoi.php" class="btn btn-secondary">← Quay lại danh sách</a>
                    <a href="app/controller/control_muon_sach.php?action=print&id=<?php echo $ma_phieu_muon; ?>" class="btn btn-primary" target="_blank">🖨️ In phiếu</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'app/view/footer.php'; ?>
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
