<?php require_once 'app/controller/control_sachcuatoi.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sách của tôi</title>
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/color.css?v=2">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
    <?php include 'app/view/header.php'; ?>

    <div class="container" style="margin-top: 30px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-12">
                <h2>Lịch sử mượn sách</h2>

                <?php if ($phieuMuon->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Số phiếu</th>
                                    <th>Ngày mượn</th>
                                    <th>Hạn trả</th>
                                    <th>Số sách</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($phieu = $phieuMuon->fetch_assoc()): 
                                    $soNgayConLai = (strtotime($phieu['ngay_hen_tra']) - time()) / 86400;
                                    $statusClass = $phieu['trang_thai'] == 'da_tra' ? 'success' : ($phieu['trang_thai'] == 'tre_han' ? 'danger' : ($soNgayConLai < 3 ? 'warning' : 'info'));
                                    $statusText = $phieu['trang_thai'] == 'dang_muon' ? 'Đang mượn' : ($phieu['trang_thai'] == 'da_tra' ? 'Đã trả' : 'Trễ hạn');
                                ?>
                                <tr>
                                    <td><strong>#<?php echo str_pad($phieu['ma_phieu_muon'], 6, '0', STR_PAD_LEFT); ?></strong></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($phieu['ngay_muon'])); ?></td>
                                    <td>
                                        <?php echo date('d/m/Y', strtotime($phieu['ngay_hen_tra'])); ?>
                                        <br>
                                        <small class="text-muted">
                                            <?php 
                                            if ($soNgayConLai < 0) {
                                                echo 'Trễ ' . abs(ceil($soNgayConLai)) . ' ngày';
                                            } elseif ($soNgayConLai < 1) {
                                                echo 'Hôm nay trả';
                                            } elseif ($soNgayConLai < 3) {
                                                echo 'Còn ' . ceil($soNgayConLai) . ' ngày';
                                            } else {
                                                echo 'Còn ' . ceil($soNgayConLai) . ' ngày';
                                            }
                                            ?>
                                        </small>
                                    </td>
                                    <td><?php echo $phieu['so_sach']; ?> cuốn</td>
                                    <td>
                                        <span class="badge badge-<?php echo $statusClass; ?>">
                                            <?php echo $statusText; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="chitietmuon.php?id=<?php echo $phieu['ma_phieu_muon']; ?>" class="btn btn-sm btn-primary">Xem chi tiết</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading"> Bạn chưa có lịch sử mượn sách!</h4>
                        <p>Hãy <a href="products.php" class="alert-link">duyệt danh sách sách</a> và thêm vào giỏ mượn.</p>
                    </div>
                <?php endif; ?>

                <div style="margin-top: 20px;">
                    <a href="index.php" class="btn btn-secondary">← Quay lại trang chủ</a>
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
