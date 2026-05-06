<?php require_once 'app/config.php';
require_once 'app/model/model_author.php';
$pickedBooks = getSachDuocChonBoiTacGia($conn, 5);
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
										<p><?php echo htmlspecialchars(!empty($book['mo_ta']) ? $book['mo_ta'] : 'Sách được chọn từ dữ liệu tác giả.', ENT_QUOTES, 'UTF-8'); ?></p>
									</div>
									<strong class="tg-bookpage">Book Pages: <?php echo htmlspecialchars($book['so_trang'], ENT_QUOTES, 'UTF-8'); ?></strong>
									<strong class="tg-bookcategory">Năm XB: <?php echo htmlspecialchars($book['nam_xuat_ban'], ENT_QUOTES, 'UTF-8'); ?></strong>
									<strong class="tg-bookprice">Price: <?php echo number_format((float)$book['gia_sach'], 0, ',', '.'); ?> đ</strong>
									<div class="tg-ratingbox"><span class="tg-stars"><span></span></span></div>
								</div>
							</figure>
							<div class="tg-postbookcontent">
								<div class="tg-booktitle">
									<h3><a href="productdetail.php?id=<?php echo intval($book['ma_sach']); ?>"><?php echo htmlspecialchars($book['ten_sach'], ENT_QUOTES, 'UTF-8'); ?></a></h3>
								</div>
								<span class="tg-bookwriter">By: <a href="authordetail.php?id=<?php echo intval($book['ma_tac_gia']); ?>"><?php echo htmlspecialchars($book['ten_tac_gia'], ENT_QUOTES, 'UTF-8'); ?></a></span>
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
									<h3>Hiện chưa có dữ liệu sách để hiển thị.</h3>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>