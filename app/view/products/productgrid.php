<?php require_once 'app/config.php'; 
require_once 'app/model/model_product.php';
$products = getDanhSachSach($conn);
?>
<div class="tg-productgrid">
	<?php while($row = $products->fetch_assoc()): 
		$bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
	?>
	<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
		<div class="tg-postbook">
			<figure class="tg-featureimg">
				<div class="tg-bookimg">
					<a href="productdetail.php?id=<?php echo $row['ma_sach']; ?>" class="tg-frontcover"><img src="<?php echo $bookImage; ?>" alt="image description" style="width:200px;height:300px;object-fit:cover;display:block;"></a>
					<div class="tg-backcover"><img src="<?php echo $bookImage; ?>" alt="image description" style="width:200px;height:300px;object-fit:cover;display:block;"></div>
				</div>
			</figure>
			<div class="tg-postbookcontent">
				<ul class="tg-bookscategories">
					<li><a href="javascript:void(0);"><?php echo htmlspecialchars($row['ten_the_loai'], ENT_QUOTES, 'UTF-8'); ?></a></li>
				</ul>
				<div class="tg-booktitle">
			<h3><a href="productdetail.php?id=<?php echo $row['ma_sach']; ?>"><?php echo htmlspecialchars($row['ten_sach'], ENT_QUOTES, 'UTF-8'); ?></a></h3>
			</div>
			<span class="tg-bookwriter">By: <a href="javascript:void(0);"><?php echo htmlspecialchars($row['ten_tac_gia'], ENT_QUOTES, 'UTF-8'); ?></a></span>
				<span class="tg-stars"><span></span></span>
			<a class="tg-btn tg-btnstyletwo" href="productdetail.php?id=<?php echo $row['ma_sach']; ?>">
					<i class="fa fa-book"></i>
					<em>Mượn sách</em>
				</a>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
</div>