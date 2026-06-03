<?php require_once 'app/config.php'; ?>
<!doctype html>
<html class="no-js" lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Manlib - Thư Viện Sách Trực Tuyến</title>
    <meta name="description" content="Manlib - Hệ thống quản lý thư viện trực tuyến. Tìm kiếm, mượn và quản lý sách dễ dàng.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<body class="tg-home tg-homeone">
<div id="tg-wrapper" class="tg-wrapper tg-haslayout">

    <?php include 'app/view/header.php'; ?>

    <!-- MAIN CONTENT START -->
    <main id="tg-main" class="tg-main tg-haslayout">

        <?php include 'app/view/index/hero-banner.php'; ?>

        <?php include 'app/view/index/howitworks.php'; ?>

        <?php include 'app/controller/control_index_bestselling.php'; ?>

        <?php include 'app/controller/control_index_featured.php'; ?>

        <?php include 'app/controller/control_index_newrelease.php'; ?>

        <?php include 'app/controller/control_index_picked.php'; ?>

        <?php include 'app/view/index/loichungnhan.php'; ?>

    </main>
    <!-- MAIN CONTENT END -->

    <?php include 'app/view/footer.php'; ?>

</div>
<script src="js/vendor/jquery-library.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.vide.min.js"></script>
<script src="js/countdown.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/countTo.js"></script>
<script src="js/appear.js"></script>
<script src="js/main.js"></script>
</body>
</html>