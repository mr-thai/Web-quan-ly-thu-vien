<?php
$book = $book ?? [];
$relatedBooks = $relatedBooks ?? false;
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
						$otherBooks = ltrim($row['url_anh'], '/');
					?>
					<div class="item">
						<div class="tg-postbook">
							<figure class="tg-featureimg">
								<div class="tg-bookimg">
									<a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>" class="tg-frontcover"><img src="<?php echo $otherBooks; ?>" alt="image description"></a>
									<a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>" class="tg-backcover"><img src="<?php echo $otherBooks; ?>" alt="image description"></a>
								</div>
							</figure>
							<div class="tg-postbookcontent">
								<ul class="tg-bookscategories">
									<li><a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>"><?php echo htmlspecialchars($row['ten_the_loai']); ?></a></li>
								</ul>
								<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
								<div class="tg-booktitle">
									<h3><a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>"><?php echo htmlspecialchars($row['ten_sach']); ?></a></h3>
								</div>
								<span class="tg-bookwriter">By: <a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>"><?php echo htmlspecialchars($row['ten_tac_gia']); ?></a></span>
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