<?php
/* ===== HEADER START ===== */
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += (int)$item['qty'];
    }
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header id="tg-header" class="tg-header tg-haslayout">

    <!-- TOPBAR START -->
    <div class="tg-topbar">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="tg-addnav">
                        <li><a href="contactus.php"><i class="icon-envelope"></i><em>Liên hệ</em></a></li>
                        <li><a href="aboutus.php"><i class="icon-question-circle"></i><em>Giới thiệu</em></a></li>
                    </ul>
                    <div class="tg-userlogin">
                        <?php if (isset($_SESSION['nguoi_dung'])): ?>
                            <div class="dropdown tg-themedropdown tg-currencydropdown">
                                <a href="javascript:void(0);" id="tg-userlogin" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user-circle" style="margin-right:6px;"></i>
                                    <span>Xin chào, <?php echo htmlspecialchars($_SESSION['nguoi_dung']['ho_ten'] ?? $_SESSION['nguoi_dung']['ten_dang_nhap']); ?></span>
                                </a>
                                <ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-userlogin">
                                    <li><a href="sachcuatoi.php"><i class="fa fa-book" style="width:18px;color:var(--primary);"></i> Sách đã mượn</a></li>
                                    <li><a href="cartmuon.php"><i class="fa fa-shopping-basket" style="width:18px;color:var(--primary);"></i> Giỏ mượn</a></li>
                                    <li><hr style="margin:6px 0;border-color:var(--border-light);"></li>
                                    <li><a href="logout.php"><i class="fa fa-sign-out" style="width:18px;color:var(--accent);"></i> Đăng xuất</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <div class="dropdown tg-themedropdown tg-currencydropdown">
                                <a href="javascript:void(0);" id="tg-userlogin" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user-o" style="margin-right:6px;"></i>
                                    <span>Tài khoản</span>
                                </a>
                                <ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-userlogin">
                                    <li><a href="login.php"><i class="fa fa-sign-in" style="width:18px;color:var(--primary);"></i> Đăng nhập</a></li>
                                    <li><a href="register.php"><i class="fa fa-user-plus" style="width:18px;color:var(--secondary);"></i> Đăng ký</a></li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- TOPBAR END -->

    <!-- MIDDLE CONTAINER START -->
    <div class="tg-middlecontainer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <strong class="tg-logo">
                        <a href="index.php" class="ml-logo">
                            <div class="ml-icon-wrapper">
                                <div class="ml-book-page"></div>
                                <div class="ml-book-page"></div>
                                <div class="ml-book-page"></div>
                                <div class="ml-book-cover"></div>
                            </div>
                            <div class="ml-text-wrapper">
                                <h1 class="ml-text-main">Man<span>lib</span></h1>
                            </div>
                        </a>
                    </strong>

                    <!-- CART DROPDOWN START -->
                    <div class="tg-wishlistandcart">
                        <div class="dropdown tg-themedropdown tg-minicartdropdown">
                            <a href="javascript:void(0);" id="tg-minicart" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="tg-themebadge"><?= $cart_count ?></span>
                                <i class="icon-cart"></i>
                                <span style="font-size:13px;font-weight:500;">Giỏ mượn</span>
                            </a>
                            <div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-minicart" style="min-width:280px;padding:16px;">
                                <div class="tg-minicartbody" style="max-height:200px;overflow-y:auto;margin-bottom:12px;">
                                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                                        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                                            <?php $cartImage = !empty($item['url_anh']) ? ltrim($item['url_anh'], '/') : 'images/products/img-01.jpg'; ?>
                                            <div class="tg-minicarproduct" style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid var(--border-light);">
                                                <figure style="margin:0;flex-shrink:0;">
                                                    <img src="<?= htmlspecialchars($cartImage) ?>" alt="bia sach" width="44" height="60" style="object-fit:cover;border-radius:6px;box-shadow:var(--shadow-sm);">
                                                </figure>
                                                <div>
                                                    <p style="margin:0;font-size:13px;font-weight:600;color:var(--text-main);line-height:1.3;"><?= htmlspecialchars($item['ten_sach']) ?></p>
                                                    <span style="font-size:12px;color:var(--text-muted);">Số lượng: <?= (int)$item['qty'] ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div style="text-align:center;padding:20px 0;color:var(--text-muted);">
                                            <i class="fa fa-book" style="font-size:28px;margin-bottom:8px;opacity:0.3;display:block;"></i>
                                            <span style="font-size:13px;">Giỏ mượn trống</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="tg-minicartfoot" style="border-top:1px solid var(--border-light);padding-top:12px;">
                                    <div style="display:flex;gap:8px;justify-content:space-between;align-items:center;">
                                        <a class="tg-btnemptycart" href="app/controller/control_muon_sach.php?action=clear" onclick="return confirm('Xác nhận xóa toàn bộ giỏ mượn?');" style="font-size:12px;color:var(--accent);display:flex;align-items:center;gap:4px;">
                                            <i class="fa fa-trash-o"></i> Xóa giỏ
                                        </a>
                                        <div style="display:flex;gap:8px;">
                                            <a class="tg-btn" href="cartmuon.php" style="padding:7px 14px;font-size:12px;">Xem giỏ</a>
                                            <?php if (isset($_SESSION['nguoi_dung'])): ?>
                                                <a class="tg-btn tg-active" href="cartmuon.php" style="padding:7px 14px;font-size:12px;">Mượn ngay</a>
                                            <?php else: ?>
                                                <a class="tg-btn tg-active" href="login.php?next=cartmuon.php" style="padding:7px 14px;font-size:12px;">Đăng nhập</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CART DROPDOWN END -->

                    <!-- SEARCH START -->
                    <div class="tg-searchbox">
                        <form class="tg-formtheme tg-formsearch" method="get" action="<?php echo htmlspecialchars($search_form_action ?? 'app/controller/control_search.php'); ?>">
                            <fieldset>
                                <input type="text" name="search" class="typeahead form-control" placeholder="Tìm sách, tác giả, ISBN..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                <button type="submit"><i class="icon-magnifier"></i></button>
                            </fieldset>
                        </form>
                    </div>
                    <!-- SEARCH END -->

                </div>
            </div>
        </div>
    </div>
    <!-- MIDDLE CONTAINER END -->

    <!-- NAVIGATION START -->
    <div class="tg-navigationarea">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <nav id="tg-nav" class="tg-nav">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
                                <span class="sr-only">Điều hướng</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                            <ul>
                                <li <?= $current_page === 'index.php' ? 'class="tg-active"' : '' ?>><a href="index.php">Trang chủ</a></li>
                                <li <?= $current_page === 'products.php' ? 'class="tg-active"' : '' ?>><a href="products.php">Danh mục sách</a></li>
                                <li <?= $current_page === 'authors.php' ? 'class="tg-active"' : '' ?>><a href="authors.php">Tác giả</a></li>
                                <li <?= $current_page === 'aboutus.php' ? 'class="tg-active"' : '' ?>><a href="aboutus.php">Giới thiệu</a></li>
                                <li <?= $current_page === 'contactus.php' ? 'class="tg-active"' : '' ?>><a href="contactus.php">Liên hệ</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- NAVIGATION END -->

</header>
<?php /* ===== HEADER END ===== */ ?>