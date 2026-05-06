<?php require_once 'app/config.php'; 
require_once 'app/model/model_product.php';
?>

<?php
$bookImage = 'images/products/img-01.jpg';
$row = [];
$featuredBook = getSachBanChay($conn);
if ($featuredBook && $row = $featuredBook->fetch_assoc()) {
    $bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
}
?>
<div class="tg-featurebook alert" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<div class="tg-featureditm">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-sm hidden-xs">
				<figure><a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>"><img src="<?php echo $bookImage; ?>" alt="image description" style="width:250px;height:300px;object-fit:cover;display:block;"></a></figure>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="tg-featureditmcontent">
					<div class="tg-themetagbox"><span class="tg-themetag">featured</span></div>
					<div class="tg-booktitle">
						<h3><a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>"><?php echo htmlspecialchars($row['ten_sach'], ENT_QUOTES, 'UTF-8'); ?></a></h3>
					</div>
					<span class="tg-bookwriter">By: <a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>"><?php echo htmlspecialchars($row['ten_tac_gia'], ENT_QUOTES, 'UTF-8'); ?></a></span>
					<span class="tg-stars"><span></span></span>
					<div class="tg-priceandbtn">
						<a class="tg-btn tg-btnstyletwo tg-active" href="app/controller/control_muon_sach.php?action=add&id=<?php echo $row['ma_sach']; ?>">
							<i class="fa fa-book"></i>
							<em>Mượn sách</em>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>