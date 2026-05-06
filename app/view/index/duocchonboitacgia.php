<?php
require_once 'app/model/model_index.php';
$sach_moi_phat_hanh = getSachChonBoiTacGia($conn);
?>  
    <section class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-sectionhead"><h2><span>Một Số Sách Tuyệt Vời</span>Được Chọn Bởi Tác Giả</h2><a class="tg-btn" href="products.php">Xem Tất Cả</a></div>
                </div>
                <div id="tg-pickedbyauthorslider" class="tg-pickedbyauthor tg-pickedbyauthorslider owl-carousel">
                <?php while($row = $sach_moi_phat_hanh->fetch_assoc()): ?>
                    <?php
                        $bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
                    ?>    
                <div class="item">
                        <div class="tg-postbook">
                            <figure class="tg-featureimg">
                                <div class="tg-bookimg"><div class="tg-frontcover"><img src="<?= htmlspecialchars($bookImage) ?>" alt="hình ảnh" style="width:200px;height:300px;object-fit:cover;display:block;"></div></div>
                                <div class="tg-hovercontent">
                                    <div class="tg-description"><p>Mô tả sách.</p></div>
                                    <strong class="tg-bookpage">Trang Sách: 206</strong>
                                    <strong class="tg-bookcategory">Thể Loại: <?= $row['ten_the_loai'] ?></strong>
                                    <div class="tg-ratingbox"><span class="tg-stars"><span></span></span></div>
                                </div>
                            </figure>
                            <div class="tg-postbookcontent">
                                <div class="tg-booktitle"><h3><a href="javascript:void(0);"><?= $row['ten_sach'] ?></a></h3></div>
                                <span class="tg-bookwriter">Bởi: <a href="javascript:void(0);"><?= $row['ten_tac_gia'] ?></a></span>
                                <a class="tg-btn tg-btnstyletwo" href="app/controller/control_muon_sach.php?action=add&id=<?php echo $row['ma_sach']; ?>"><i class="fa fa-book"></i><em>Mượn sách</em></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>