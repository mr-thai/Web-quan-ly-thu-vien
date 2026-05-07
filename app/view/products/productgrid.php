<?php
$products = $products ?? false;
?>
<div class="tg-productgrid">
	<?php if($products): while($row = $products->fetch_assoc()): 
		$bookImage = ltrim($row['url_anh'], '/');
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
					<li><a href="javascript:void(0);"><?php echo htmlspecialchars($row['ten_the_loai']); ?></a></li>
				</ul>
				<div class="tg-booktitle">
			<h3><a href="productdetail.php?id=<?php echo $row['ma_sach']; ?>"><?php echo htmlspecialchars($row['ten_sach']); ?></a></h3>
			</div>
			<span class="tg-bookwriter">By: <a href="javascript:void(0);"><?php echo htmlspecialchars($row['ten_tac_gia']); ?></a></span>
				<span class="tg-stars"><span></span></span>
			<a class="tg-btn tg-btnstyletwo" href="productdetail.php?id=<?php echo $row['ma_sach']; ?>">
					<i class="fa fa-book"></i>
					<em>Mượn sách</em>
				</a>
			</div>
		</div>
	</div>
	<?php endwhile; endif; ?>
</div>