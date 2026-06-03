<?php require_once 'app/config.php'; ?>
<!doctype html>
<html class="no-js" lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manlib - Danh mục sách</title>
    <meta name="description" content="Xem và mượn sách từ kho thư viện Manlib với hàng nghìn đầu sách phong phú.">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/transitions.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/color.css?v=3">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>
<div id="tg-wrapper" class="tg-wrapper tg-haslayout">

    <?php include 'app/view/header.php'; ?>

    <!-- BANNER NỘI TRANG START -->
    <div class="tg-innerbanner tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-innerbannercontent">
                        <h1>Danh mục sách</h1>
                        <ol class="tg-breadcrumb">
                            <li><a href="index.php">Trang chủ</a></li>
                            <li class="tg-active">Danh mục sách</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BANNER NỘI TRANG END -->

    <!-- NỘI DUNG CHÍNH START -->
    <main id="tg-main" class="tg-main tg-haslayout">
        <div class="tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div id="tg-twocolumns" class="tg-twocolumns">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 pull-right">
                            <div id="tg-content" class="tg-content">
                                <div class="tg-products">
                                    <?php require_once 'app/controller/control_product_grid.php'; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 pull-left">
                            <?php require_once 'app/controller/control_aside_products.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- NỘI DUNG CHÍNH END -->

    <?php include 'app/view/footer.php'; ?>

</div>
<script src="js/vendor/jquery-library.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/main.js"></script>
</body>
</html>