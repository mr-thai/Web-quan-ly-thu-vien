<?php
/* ===== PRODUCT GRID START ===== */
$products = $products ?? false;
?>
<div class="tg-productgrid">
    <?php if ($products && mysqli_num_rows($products) > 0): ?>
        <?php while ($row = $products->fetch_assoc()):
            $bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
        ?>
        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
            <div class="tg-postbook">
                <figure class="tg-featureimg">
                    <div class="tg-bookimg">
                        <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>" class="tg-frontcover">
                            <img src="<?= htmlspecialchars($bookImage) ?>" alt="<?= htmlspecialchars($row['ten_sach']) ?>">
                        </a>
                    </div>
                </figure>
             
                <div class="tg-postbookcontent">
                    <ul class="tg-bookscategories">
                        <li><a href="javascript:void(0);"><?= htmlspecialchars($row['ten_the_loai']) ?></a></li>
                    </ul>
                    <div class="tg-booktitle">
                        <h3><a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_sach']) ?></a></h3>
                    </div>
                    <span class="tg-bookwriter">Tác giả: <a href="javascript:void(0);"><?= htmlspecialchars($row['ten_tac_gia']) ?></a></span>
                    <span class="tg-stars"><span>&#9733;&#9733;&#9733;&#9733;&#9733;</span></span>
                    <a class="tg-btn tg-btnstyletwo" href="app/controller/control_muon_sach.php?action=add&id=<?= intval($row['ma_sach']) ?>"
                       <?= (int)$row['so_luong_con'] <= 0 ? 'style="opacity:0.5;pointer-events:none;"' : '' ?>>
                        <i class="fa fa-book"></i><em>Mượn sách</em>
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-xs-12" style="text-align:center;padding:60px 20px;">
            <i class="fa fa-search" style="font-size:52px;color:var(--text-light);display:block;margin-bottom:16px;"></i>
            <h3 style="color:var(--text-muted);">Không tìm thấy sách nào</h3>
            <p style="color:var(--text-light);">Thử tìm kiếm với từ khóa khác hoặc <a href="products.php">xem tất cả sách</a>.</p>
        </div>
    <?php endif; ?>
</div>
<?php /* ===== PRODUCT GRID END ===== */ ?>