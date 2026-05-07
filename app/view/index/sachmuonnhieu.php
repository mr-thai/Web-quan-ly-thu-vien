<?php
$danh_sach = $danh_sach ?? false;
?>
<section class="tg-sectionspace tg-haslayout">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-sectionhead">
                    <h2><span>Lựa Chọn Của Mọi Người</span>Sách Được Mượn Nhiều</h2>
                    <a class="tg-btn" href="products.php">Xem Tất Cả</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="tg-bestsellingbooksslider" class="tg-bestsellingbooksslider tg-bestsellingbooks owl-carousel">
                    
                    <?php while($danh_sach && $row = $danh_sach->fetch_assoc()): ?>
                    <?php
                        $bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
                    ?>
                    <div class="item">
                        <div class="tg-postbook">
                            <figure class="tg-featureimg">
                                <div class="tg-bookimg">
                                    <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>" class="tg-frontcover"><img src="<?= htmlspecialchars($bookImage) ?>" alt="bia sach" style="width:200px;height:300px;object-fit:cover;display:block;"></a>
                                    <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>" class="tg-backcover"><img src="<?= htmlspecialchars($bookImage) ?>" alt="bia sach" style="width:200px;height:300px;object-fit:cover;display:block; "></a>
                                </div>
                            </figure>
                            <div class="tg-postbookcontent">
                                <ul class="tg-bookscategories"><li><a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_the_loai']) ?></a></li></ul>
                                <div class="tg-themetagbox"><span class="tg-themetag">mới</span></div>
                                <div class="tg-booktitle"><h3><a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_sach']) ?></a></h3></div>
                                <span class="tg-bookwriter">Bởi: <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_tac_gia']) ?></a></span>
                                <span class="tg-stars"><span></span></span>
                                <a class="tg-btn tg-btnstyletwo" href="app/controller/control_muon_sach.php?action=add&id=<?= $row['ma_sach'] ?>">
                                    <i class="fa fa-book"></i><em>Mượn sách</em>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>

                </div>
            </div>
        </div>
    </div>
</section>