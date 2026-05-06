<header id="tg-header" class="tg-header tg-haslayout">
    <div class="tg-topbar">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="tg-addnav">
                        <li><a href="javascript:void(0);"><i class="icon-envelope"></i><em>Liên Hệ</em></a></li>
                        <li><a href="javascript:void(0);"><i class="icon-question-circle"></i><em>Trợ Giúp</em></a></li>
                    </ul>
                    <div class="tg-userlogin">
                        <?php if (isset($_SESSION['nguoi_dung'])): ?>
                            <div class="dropdown tg-themedropdown tg-currencydropdown">
                                <a href="javascript:void(0);" id="tg-userlogin" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   
                                    <span>Xin chào, <?php echo htmlspecialchars($_SESSION['nguoi_dung']['ho_ten'] ?? $_SESSION['nguoi_dung']['ten_dang_nhap']); ?></span>
                                </a>
                                <ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-userlogin">
                                    <li><a href="sach-cua-toi.php">Sách đã mượn</a></li>
                                    <li><a href="cart-muon.php">Giỏ mượn</a></li>
                                    <li><a href="logout.php">Đăng xuất</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <div class="dropdown tg-themedropdown tg-currencydropdown">
                                <a href="javascript:void(0);" id="tg-userlogin" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  
                                    <span>Tài khoản</span>
                                </a>
                                <ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-userlogin">
                                    <li><a href="login.php">Đăng nhập</a></li>
                                    <li><a href="register.php">Đăng ký</a></li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tg-middlecontainer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <strong class="tg-logo"><a href="index.php"><img src="images/logo.png" alt="logo công ty"></a></strong>
                    <div class="tg-wishlistandcart">
                    <?php
                    $cart_count = 0;
                    $cart_total = 0;
                    if (isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item) {
                            $cart_count += $item['qty'];
                        }
                    }
                    ?>
                    <div class="dropdown tg-themedropdown tg-minicartdropdown">
                        <a href="javascript:void(0);" id="tg-minicart" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="tg-themebadge"><?= $cart_count ?></span>
                            <i class="icon-cart"></i>
                        </a>
                        <div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-minicart">
                            <div class="tg-minicartbody">
                                <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                                    <?php foreach($_SESSION['cart'] as $id => $item): ?>
                                    <?php $cartImage = !empty($item['url_anh']) ? ltrim($item['url_anh'], '/') : 'images/products/img-01.jpg'; ?>
                                    <div class="tg-minicarproduct">
                                        <figure><img src="<?= htmlspecialchars($cartImage) ?>" alt="hình ảnh" width="60"></figure>
                                        <div class="tg-minicarproductdata">
                                            <h5><a href="javascript:void(0);"><?= htmlspecialchars($item['ten_sach']) ?></a> * <?= (int)$item['qty'] ?></h5>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p style="padding: 10px;">Giỏ hàng trống</p>
                                <?php endif; ?>
                            </div>
                    <div class="tg-minicartfoot">
                                <a class="tg-btnemptycart" href="app/controller/control_muon_sach.php?action=clear" onclick="return confirm('Xác nhận xóa toàn bộ giỏ mượn?');"><i class="fa fa-trash-o"></i><span>Xóa Giỏ</span></a>
                                <div class="tg-btns">
                                    <a class="tg-btn tg-active" href="cart-muon.php">Xem Giỏ</a>
                                    <?php if (isset($_SESSION['nguoi_dung'])): ?>
                                        <a class="tg-btn" href="cart-muon.php">Mượn</a>
                                    <?php else: ?>
                                        <a class="tg-btn" href="login.php?next=cart-muon.php">Đăng nhập</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="tg-searchbox">
                        <form class="tg-formtheme tg-formsearch" method="get" action="<?php echo htmlspecialchars($search_form_action ?? 'app/controller/control_search.php', ENT_QUOTES, 'UTF-8'); ?>">
                            <fieldset>
                                <input type="text" name="search" class="typeahead form-control" placeholder="Tìm theo tiêu đề, tác giả, từ khóa, ISBN...">
                                <button type="submit"><i class="icon-magnifier"></i></button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tg-navigationarea">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <nav id="tg-nav" class="tg-nav ">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
                                <span class="sr-only">Chuyển đổi điều hướng</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                            <ul>
                                <li class="menu-item-has-children menu-item-has-mega-menu">
                                    <a href="javascript:void(0);">Tất Cả Thể Loại</a>
                                    <div class="mega-menu">
                                        <ul class="tg-themetabnav" role="tablist">
                                            <li role="presentation" class="active"><a href="#artandphotography" aria-controls="artandphotography" role="tab" data-toggle="tab">Nghệ Thuật &amp; Nhiếp Ảnh</a></li>
                                            <li role="presentation"><a href="#fiction" aria-controls="fiction" role="tab" data-toggle="tab">Tiểu Thuyết</a></li>
                                        </ul>
                                        <div class="tab-content tg-themetabcontent">
                                            <div role="tabpanel" class="tab-pane active" id="artandphotography">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle"><h2>Kiến Trúc</h2></div>
                                                        <ul><li><a href="products.php">Tough As Nails</a></li></ul>
                                                        <a class="tg-btnviewall" href="products.php">Xem Tất Cả</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="fiction">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle"><h2>Tiểu Thuyết</h2></div>
                                                        <ul><li><a href="products.php">Consectetur adipisicing</a></li></ul>
                                                        <a class="tg-btnviewall" href="products.php">Xem Tất Cả</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="products.php">sản phẩm</a></li>
                                <li><a href="productdetail.php">chi tiết sản phẩm</a></li>
                                <li><a href="contactus.php">góp ý</a></li>
                                <li><a href="authors.php">tác giả</a></li>
                                <li><a href="authordetail.php">chi tiết tác giả</a></li>
                                <li><a href="aboutus.php">giới thiệu</a></li>
                                <li><a href="404error.php">lỗi 404</a></li>
                               
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>