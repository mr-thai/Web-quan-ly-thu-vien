<?php
require_once 'app/config.php'; ini_set('display_errors', 1); error_reporting(E_ALL);
require_once 'app/model/model_product.php';
$book = $book ?? [];
$relatedBooks = false;
if (!empty($book['ma_tacgia'])) {
    $relatedBooks = getSachLienQuan($conn, $book['ma_tacgia']);
}
?>
<div class="tg-relatedproducts">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="tg-sectionhead">
					<h2><span>Những cuốn sách tương tự</span>Bạn có thể thích</h2>
					<a class="tg-btn" href="products.php">Xem tất cả</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div id="tg-relatedproductslider" class="tg-relatedproductslider tg-relatedbooks owl-carousel">
					
					<?php if ($relatedBooks && $relatedBooks instanceof mysqli_result): while($row = $relatedBooks->fetch_assoc()): 
						$otherBooks = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
					?>
					<div class="item">
						<div class="tg-postbook">
							<figure class="tg-featureimg">
								<div class="tg-bookimg">
									<div class="tg-frontcover"><img src="<?php echo $otherBooks; ?>" alt="image description"></div>
									<div class="tg-backcover"><img src="<?php echo $otherBooks; ?>" alt="image description"></div>
								</div>
							</figure>
							<div class="tg-postbookcontent">
								<ul class="tg-bookscategories">
									<li><a href="javascript:void(0);"><?php echo htmlspecialchars($row['ten_the_loai'], ENT_QUOTES, 'UTF-8'); ?></a></li>
								</ul>
								<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
								<div class="tg-booktitle">
									<h3><a href="javascript:void(0);"><?php echo htmlspecialchars($row['ten_sach'], ENT_QUOTES, 'UTF-8'); ?></a></h3>
								</div>
								<span class="tg-bookwriter">By: <a href="javascript:void(0);"><?php echo htmlspecialchars($row['ten_tac_gia'], ENT_QUOTES, 'UTF-8'); ?></a></span>
								<span class="tg-stars"><span></span></span>
								<a class="tg-btn tg-btnstyletwo" href="app/controller/control_muon_sach.php?action=add&id=<?php echo intval($row['ma_sach']); ?>">
									<i class="fa fa-book"></i>
									<em>Mượn sách</em>
								</a>
							</div>
						</div>
					</div>
					<?php endwhile; endif; ?>
				</div>
			</div>
		</div>