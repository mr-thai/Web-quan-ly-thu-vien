<?php
/* ===== SECTION: ĐƯỢC CHỌN BỞI TÁC GIẢ START ===== */
$sach_moi_phat_hanh = $sach_moi_phat_hanh ?? false;
?>
<section class="tg-sectionspace tg-haslayout" style="background:var(--background);">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-sectionhead">
                    <h2><span>Tuyển chọn đặc biệt</span>Sách Được Yêu Thích</h2>
                    <a class="tg-btn" href="products.php"><i class="fa fa-arrow-right"></i><em>Xem tất cả</em></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="tg-pickedbyauthorslider" class="tg-pickedbyauthor tg-pickedbyauthorslider owl-carousel">
                <?php if ($sach_moi_phat_hanh && is_object($sach_moi_phat_hanh)): ?>
                <?php while ($row = $sach_moi_phat_hanh->fetch_assoc()):
                    $bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
                    $soTrang   = !empty($row['so_trang']) ? (int)$row['so_trang'] : 0;
                    $moTa      = !empty($row['mo_ta']) ? mb_strimwidth($row['mo_ta'], 0, 100, '...') : 'Một cuốn sách đáng đọc trong bộ sưu tập thư viện.';
                ?>
                <div class="item">
                    <div class="tg-postbook">
                        <figure class="tg-featureimg">
                            <div class="tg-bookimg">
                                <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>" class="tg-frontcover">
                                    <img src="<?= htmlspecialchars($bookImage) ?>" alt="<?= htmlspecialchars($row['ten_sach']) ?>">
                                </a>
                            </div>
                            <div class="tg-hovercontent" style="padding:14px;">
                                <div class="tg-description">
                                    <p style="font-size:13px;line-height:1.6;margin:0 0 10px;"><?= htmlspecialchars($moTa) ?></p>
                                </div>
                                <?php if ($soTrang > 0): ?>
                                <strong class="tg-bookpage" style="display:block;font-size:12px;color:var(--text-muted);margin-bottom:4px;">
                                    <i class="fa fa-file-text-o" style="margin-right:4px;"></i><?= $soTrang ?> trang
                                </strong>
                                <?php endif; ?>
                                <strong class="tg-bookcategory" style="display:block;font-size:12px;color:var(--primary);margin-bottom:8px;">
                                    <i class="fa fa-tag" style="margin-right:4px;"></i><?= htmlspecialchars($row['ten_the_loai']) ?>
                                </strong>
                                <span class="tg-stars" style="font-size:13px;">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                            </div>
                        </figure>
                        <div class="tg-postbookcontent">
                            <ul class="tg-bookscategories">
                                <li><a href="products.php"><?= htmlspecialchars($row['ten_the_loai']) ?></a></li>
                            </ul>
                            <div class="tg-booktitle">
                                <h3><a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_sach']) ?></a></h3>
                            </div>
                            <span class="tg-bookwriter">Tác giả: <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_tac_gia']) ?></a></span>
                            <a class="tg-btn tg-btnstyletwo" href="app/controller/control_muon_sach.php?action=add&id=<?= intval($row['ma_sach']) ?>">
                                <i class="fa fa-book"></i><em>Mượn sách</em>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php else: ?>
                <div style="padding:40px;text-align:center;color:var(--text-muted);">
                    <i class="fa fa-book" style="font-size:40px;opacity:0.2;display:block;margin-bottom:12px;"></i>
                    <p>Chưa có dữ liệu.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php /* ===== SECTION: ĐƯỢC CHỌN BỞI TÁC GIẢ END ===== */ ?>