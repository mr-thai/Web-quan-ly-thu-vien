<?php
/* ===== SECTION: SÁCH ĐƯỢC MƯỢN NHIỀU START ===== */
$danh_sach = $danh_sach ?? false;
$rank = 0;
?>
<section class="tg-sectionspace tg-haslayout" style="background:var(--background);">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-sectionhead">
                    <h2><span>Top lựa chọn</span>Sách Được Mượn Nhiều Nhất</h2>
                    <a class="tg-btn" href="products.php">
                        <i class="fa fa-arrow-right"></i><em>Xem tất cả</em>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="tg-bestsellingbooksslider" class="tg-bestsellingbooksslider tg-bestsellingbooks owl-carousel">
                    <?php if ($danh_sach): while ($row = $danh_sach->fetch_assoc()):
                        $rank++;
                        $bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
                        $soLuongCon = (int)($row['so_luong_con'] ?? 1);
                        $soCuonMuon = (int)($row['so_cuon_muon'] ?? 0);
                    ?>
                    <div class="item">
                        <div class="tg-postbook" style="position:relative;">
                            <!-- Huy hiệu thứ hạng -->
                            <?php if ($rank <= 3): ?>
                            <div style="position:absolute;top:10px;left:10px;z-index:10;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:white;
                                background:<?= $rank === 1 ? '#D4AF37' : ($rank === 2 ? '#9E9E9E' : '#CD7F32') ?>;">
                                <?= $rank ?>
                            </div>
                            <?php endif; ?>

                            <!-- Badge hết sách -->
                            <?php if ($soLuongCon <= 0): ?>
                           
                            <?php endif; ?>

                            <figure class="tg-featureimg">
                                <div class="tg-bookimg">
                                    <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>" class="tg-frontcover">
                                        <img src="<?= htmlspecialchars($bookImage) ?>" alt="<?= htmlspecialchars($row['ten_sach']) ?>">
                                    </a>
                                </div>
                            </figure>

                            <div class="tg-postbookcontent">
                                <ul class="tg-bookscategories">
                                    <li><a href="products.php"><?= htmlspecialchars($row['ten_the_loai'] ?? '') ?></a></li>
                                </ul>
                                <div class="tg-booktitle">
                                    <h3><a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_sach']) ?></a></h3>
                                </div>
                                <span class="tg-bookwriter">Tác giả: <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_tac_gia'] ?? '') ?></a></span>
                                <span class="tg-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>

                                <?php if ($soCuonMuon > 0): ?>
                                <div style="font-size:11px;color:var(--text-muted);margin-bottom:10px;">
                                    <i class="fa fa-users" style="margin-right:4px;color:var(--secondary);"></i>
                                    Đã mượn <strong style="color:var(--primary);"><?= $soCuonMuon ?></strong> lần
                                </div>
                                <?php endif; ?>

                                
                            </div>
                        </div>
                    </div>
                    <?php endwhile; else: ?>
                    <div class="col-xs-12" style="text-align:center;padding:60px;color:var(--text-muted);">
                        <i class="fa fa-book" style="font-size:52px;opacity:0.2;display:block;margin-bottom:12px;"></i>
                        <p>Chưa có dữ liệu sách.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /* ===== SECTION: SÁCH ĐƯỢC MƯỢN NHIỀU END ===== */ ?>