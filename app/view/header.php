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
                        <div class="dropdown tg-themedropdown tg-currencydropdown">
                        <a href="javascript:void(0);" id="tg-userlogin" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <figure><img src="images/users/img-01.jpg" alt="hình ảnh" width="30" height="30"></figure>
                            <span>Xin chào, John</span>
                        </a>
                        <ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-userlogin">
                            <li><a href="javascript:void(0);">Trang cá nhân</a></li>
                            <li><a href="javascript:void(0);">Đơn hàng</a></li>
                            <li><a href="javascript:void(0);">Đăng xuất</a></li>
                        </ul>
                    </div>
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
                                <a class="tg-btnemptycart" href="javascript:void(0);"><i class="fa fa-trash-o"></i><span>Xóa Giỏ Hàng</span></a>
                                <div class="tg-btns">
                                    <a class="tg-btn tg-active" href="javascript:void(0);">Xem Giỏ Hàng</a>
                                    <a class="tg-btn" href="app/controller/control_muon_sach.php?action=checkout">Mượn Sách</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="tg-searchbox">
                        <form class="tg-formtheme tg-formsearch">
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
                                <li>
                                    <a href="authors.php">Tác Giả</a>
                                </li>
                                <li><a href="products.php">Bán Chạy</a></li>
                                <li><a href="products.php">Giảm Giá Tuần</a></li>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">Tin Tức</a>
                                    <ul class="sub-menu">
                                        <li><a href="newslist.php">Tin Tức Mới Nhất</a></li>
                                    </ul>
                                </li>
                                <li><a href="contactus.php">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>