<?php
/* ===== SECTION: SÁCH NỔI BẬT (FEATURED) START ===== */
$sach_noi_bat = $sach_noi_bat ?? false;
$row = $row ?? [];
$bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
?>
<?php if (!empty($row)): ?>
<section class="tg-haslayout" style="background:var(--surface);border-top:1px solid var(--border-light);border-bottom:1px solid var(--border-light);">
    <div class="container">
        <div class="row">
            <div class="tg-featureditm">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="tg-featureditmcontent" style="padding:56px 40px 56px 0;">
                        <span style="display:inline-block;font-size:11px;font-weight:700;color:var(--secondary);text-transform:uppercase;letter-spacing:2px;margin-bottom:14px;">
                            <i class="fa fa-star" style="color:var(--gold);margin-right:4px;"></i> Nổi bật hôm nay
                        </span>
                        <div class="tg-themetagbox" style="margin-bottom:12px;">
                            <span class="tg-themetag"><?= htmlspecialchars($row['ten_the_loai'] ?? '') ?></span>
                        </div>
                        <div class="tg-booktitle" style="margin-bottom:16px;">
                            <h2 style="font-size:28px;line-height:1.3;margin:0;">
                                <a href="productdetail.php?id=<?= intval($row['ma_sach'] ?? 0) ?>" style="color:var(--text-main);">
                                    <?= htmlspecialchars($row['ten_sach'] ?? '') ?>
                                </a>
                            </h2>
                        </div>
                        <span class="tg-bookwriter" style="font-size:15px;height:auto;margin-bottom:14px;">
                            Tác giả: <a href="productdetail.php?id=<?= intval($row['ma_sach'] ?? 0) ?>" style="color:var(--primary);font-weight:600;">
                                <?= htmlspecialchars($row['ten_tac_gia'] ?? '') ?>
                            </a>
                        </span>
                        <p style="font-size:14px;color:var(--text-muted);margin-bottom:24px;line-height:1.7;max-width:440px;">
                            <?= htmlspecialchars(mb_strimwidth($row['mo_ta'] ?? 'Một trong những cuốn sách nổi bật trong tuần tại thư viện Manlib.', 0, 150, '...')) ?>
                        </p>
                        <span class="tg-stars" style="font-size:18px;margin-bottom:20px;display:block;">
                            &#9733;&#9733;&#9733;&#9733;&#9733;
                        </span>
                        <div class="tg-priceandbtn">
                            <a class="tg-btn" href="app/controller/control_muon_sach.php?action=add&id=<?= intval($row['ma_sach'] ?? 0) ?>">
                                <i class="fa fa-book"></i><em>Mượn ngay</em>
                            </a>
                            <a class="tg-btn tg-active" href="productdetail.php?id=<?= intval($row['ma_sach'] ?? 0) ?>" style="margin-left:10px;">
                                <i class="fa fa-info-circle"></i><em>Chi tiết</em>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="display:flex;align-items:center;justify-content:center;padding:40px 20px;">
                    <div style="position:relative;max-width:220px;">
                        <div style="position:absolute;top:-10px;right:-10px;width:200px;height:280px;background:rgba(139,94,60,0.08);border-radius:16px;z-index:0;"></div>
                        <img src="<?= htmlspecialchars($bookImage) ?>" alt="<?= htmlspecialchars($row['ten_sach'] ?? '') ?>"
                             style="position:relative;z-index:1;width:100%;border-radius:12px;box-shadow:0 20px 50px rgba(139,94,60,0.25);transform:rotate(-2deg);transition:transform 0.3s ease;"
                             onmouseover="this.style.transform='rotate(0deg) scale(1.04)'" onmouseout="this.style.transform='rotate(-2deg)'">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /* ===== SECTION: SÁCH NỔI BẬT (FEATURED) END ===== */ ?>