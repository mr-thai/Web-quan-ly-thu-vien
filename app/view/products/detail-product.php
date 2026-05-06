<?php
require_once 'app/config.php'; ini_set('display_errors', 1); error_reporting(E_ALL);
require_once 'app/model/model_product.php';
$book = $book ?? [];
$relatedBooks = false;
if (!empty($book['ma_tacgia'])) {
	$relatedBooks = getSachLienQuan($conn, $book['ma_tacgia']);
}
?>

<div class="tg-productdetail">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="tg-postbook">
				<figure class="tg-featureimg"><img src="images/books/img-07.jpg" alt="image description"></figure>
				<div class="tg-postbookcontent">
					<form method="GET" action="app/controller/control_muon_sach.php" style="display:inline;">
						<input type="hidden" name="action" value="add">
						<input type="hidden" name="id" value="<?php echo $book['ma_sach']; ?>">
						<button type="submit" class="tg-btn tg-active tg-btn-lg" onclick="return confirm('Thêm vào giỏ mượn?')">
							<i class="fa fa-book"></i> Mượn sách
						</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<div class="tg-productcontent">
				<ul class="tg-bookscategories">
					<li><a href="javascript:void(0);"><?php echo htmlspecialchars($book['ten_the_loai'], ENT_QUOTES, 'UTF-8'); ?></a></li>
				</ul>
				<div class="tg-booktitle">
					<h3><?php echo htmlspecialchars($book['ten_sach'], ENT_QUOTES, 'UTF-8'); ?></h3>
				</div>
				<span class="tg-bookwriter">By: <a href="javascript:void(0);"><?php echo htmlspecialchars($book['ten_tac_gia'], ENT_QUOTES, 'UTF-8'); ?></a></span>
				<span class="tg-stars"><span></span></span>
				<span class="tg-addreviews"><a href="javascript:void(0);">Add Your Review</a></span>
				<div class="tg-share">
					<span>Share:</span>
					<ul class="tg-socialicons">
						<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
						<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
						<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
						<li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
						<li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
					</ul>
				</div>
				<div class="tg-description">
					<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etdoloreat magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisi nisi ut aliquip ex ea commodo consequat aute.</p>
					<p>Arure dolor in reprehenderit in voluptate velit esse cillum dolore fugiat nulla aetur excepteur sint occaecat cupidatat non proident, sunt in culpa quistan officia serunt mollit anim id est laborum sed ut perspiciatis unde omnis iste natus... <a href="javascript:void(0);">More</a></p>
				</div>
				<div class="tg-sectionhead">
					<h2>Thông số sách</h2>
				</div>
				<ul class="tg-productinfo">
					<li><span>Format:</span><span>Hardback</span></li>
					<li><span>Pages:</span><span>528 pages</span></li>
					<li><span>Dimensions:</span><span>153 x 234 x 43mm | 758g</span></li>
					<li><span>Language:</span><span>English</span></li>
					<li><span>ISBN10:</span><span>1234567890</span></li>
					<li><span>ISBN13:</span><span>1234567890000</span></li>
				</ul>
			</div>
		</div>
		<div class="tg-aboutauthor">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="tg-sectionhead">
					<h2>Tác giả</h2>
				</div>
				<div class="tg-authorbox">
					<figure class="tg-authorimg">
						<img src="images/author/imag-24.jpg" alt="image description">
					</figure>
					<div class="tg-authorinfo">
						<div class="tg-authorhead">
							<div class="tg-leftarea">
								<div class="tg-authorname">
									<h2><?php echo htmlspecialchars($book['ten_tac_gia'], ENT_QUOTES, 'UTF-8'); ?></h2>
								</div>
							</div>
							<div class="tg-rightarea">
								<ul class="tg-socialicons">
									<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
									<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
									<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
									<li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
									<li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="tg-description">
							<!-- <p><?php echo htmlspecialchars($book['mo_ta_tac_gia'], ENT_QUOTES, 'UTF-8'); ?></p> -->
						</div>
						<a class="tg-btn tg-active" href="javascript:void(0);">View All Books</a>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>