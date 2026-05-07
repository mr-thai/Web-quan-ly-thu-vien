<?php
$pickedBooks = $pickedBooks ?? false;
?>
<section class="tg-sectionspace tg-haslayout">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="tg-sectionhead">
					<h2><span>Some Great Books</span>Picked By Authors</h2>
					<a class="tg-btn" href="products.php">View All</a>
				</div>
			</div>
			<div id="tg-pickedbyauthorslider" class="tg-pickedbyauthor tg-pickedbyauthorslider owl-carousel">
				<?php if ($pickedBooks && $pickedBooks->num_rows > 0): ?>
					<?php while ($book = $pickedBooks->fetch_assoc()):
						$bookImage = !empty($book['url_anh']) ? ltrim($book['url_anh'], '/') : 'images/products/img-01.jpg';
					?>
					<div class="item">
						<div class="tg-postbook">
							<figure class="tg-featureimg">
								<div class="tg-bookimg">
									<div class="tg-frontcover"><img src="<?php echo $bookImage; ?>" alt="image description"></div>
								</div>
								<div class="tg-hovercontent">
									<div class="tg-description">
										<p><?php echo htmlspecialchars(!empty($book['mo_ta']) ? $book['mo_ta'] : 'Sách được chọn từ dữ liệu tác giả.'); ?></p>
									</div>
									<strong class="tg-bookpage">Book Pages: <?php echo htmlspecialchars($book['so_trang']); ?></strong>
									<strong class="tg-bookcategory">Năm XB: <?php echo htmlspecialchars($book['nam_xuat_ban']); ?></strong>
									<strong class="tg-bookprice">Price: <?php echo number_format((float)$book['gia_sach'], 0, ',', '.'); ?> đ</strong>
								</div>
							</figure>
							<div class="tg-postbookcontent">
								<div class="tg-booktitle">
									<h3><a href="productdetail.php?id=<?php echo intval($book['ma_sach']); ?>"><?php echo htmlspecialchars($book['ten_sach']); ?></a></h3>
								</div>
								<span class="tg-bookwriter">By: <a href="authordetail.php?id=<?php echo intval($book['ma_tac_gia']); ?>"><?php echo htmlspecialchars($book['ten_tac_gia']); ?></a></span>
								<a class="tg-btn tg-btnstyletwo" href="productdetail.php?id=<?php echo intval($book['ma_sach']); ?>">
									<i class="fa fa-book"></i>
									<em>Mượn sách</em>
								</a>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				<?php else: ?>
					<div class="item">
						<div class="tg-postbook">
							<div class="tg-postbookcontent">
								<div class="tg-booktitle">
									<h3>chưa có dữ liệu</h3>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>