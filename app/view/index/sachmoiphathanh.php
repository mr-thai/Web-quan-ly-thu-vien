<?php
require_once 'app/model/model_index.php';
$sach_moi_phat_hanh = getSachMoiPhatHanh($conn);
$row = $sach_moi_phat_hanh->fetch_assoc();
$bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
?>  
    <section class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="tg-newrelease">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="tg-sectionhead"><h2><span>Nếm Gia Vị Mới</span>Sách Phát Hành Mới</h2></div>
                        <div class="tg-description"><p>Mô tả về sách mới.</p></div>
                        <div class="tg-btns">
                            <a class="tg-btn tg-active" href="javascript:void(0);">Xem Tất Cả</a>
                            <a class="tg-btn" href="javascript:void(0);">Đọc Thêm</a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="row">
                            <div class="tg-newreleasebooks">
                                <div class="col-xs-4 col-sm-4 col-md-6 col-lg-4">
                                    <div class="tg-postbook">
                                        <figure class="tg-featureimg">
                                            <div class="tg-bookimg">
                                                <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>" class="tg-frontcover"><img src="<?= htmlspecialchars($bookImage) ?>" alt="hình ảnh"></a>
                                            </div>
                                        </figure>
                                        <div class="tg-postbookcontent">
                                            <ul class="tg-bookscategories"><li><a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_the_loai'], ENT_QUOTES, 'UTF-8') ?></a></li></ul>
                                            <div class="tg-booktitle"><h3><a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_sach'], ENT_QUOTES, 'UTF-8') ?></a></h3></div>
                                            <span class="tg-bookwriter">Bởi: <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_tac_gia'], ENT_QUOTES, 'UTF-8') ?></a></span>
                                            <span class="tg-stars"><span></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>