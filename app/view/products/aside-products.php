<?php
$danh_sach = $danh_sach ?? false;
?>
<aside id="tg-sidebar" class="tg-sidebar">
	
	<div class="tg-widget tg-widgettrending">
		<div class="tg-widgettitle">
			<h3>Sách Nổi Bật</h3>
		</div>
		<?php if($danh_sach): while($row = $danh_sach->fetch_assoc()): ?>
		<?php
			$bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
		?>
		<div class="tg-widgetcontent">
			<ul>
				<li>
					<article class="tg-post">
							<figure><a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>"><img src="<?php echo htmlspecialchars($bookImage); ?>" alt="image description"></a></figure>
						<div class="tg-postcontent">
							<div class="tg-posttitle">
								<h3><a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>"><?php echo htmlspecialchars($row['ten_sach']); ?></a></h3>
							</div>
							<span class="tg-bookwriter">By: <a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>"><?php echo htmlspecialchars($row['ten_tac_gia']); ?></a></span>
						</div>
					</article>
				</li>
			</ul>
		</div>
		<?php endwhile; endif; ?>
	</div>
	<div class="tg-widget tg-widgetblogers">
		<div class="tg-widgettitle">
			<h3>Top Authors</h3>
		</div>
		<?php 
		$danh_sach_tac_gia = getDanhSachSachAuthor_aside($conn);
		while($row = $danh_sach_tac_gia->fetch_assoc() ): 
		?>
		<?php
			$authorImage = !empty($row['avatar_url']) ? ltrim($row['avatar_url'], '/') : 'images/author/imag-24.jpg';
		?>
		<div class="tg-widgetcontent">
			<ul>
				<li>
					<div class="tg-author">
						<figure><a href="authordetail.php?id=<?php echo intval($row['ma_tac_gia']); ?>"><img src="<?php echo htmlspecialchars($authorImage); ?>" alt="<?php echo htmlspecialchars($row['ten_tac_gia']); ?>" style="width:100px;height:100px;"></a></figure>
						<div class="tg-authorcontent">
							<h2><a href="authordetail.php?id=<?php echo intval($row['ma_tac_gia']); ?>"><?php echo htmlspecialchars($row['ten_tac_gia']); ?></a></h2>
							<span><?php echo (int)$row['so_sach']; ?> Published Books</span>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<?php endwhile; ?>
	</div>
</aside>