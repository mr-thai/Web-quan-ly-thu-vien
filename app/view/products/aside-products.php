<?php
$danh_sach = $danh_sach ?? false;
?>
<aside id="tg-sidebar" class="tg-sidebar">
	
	<!-- New Arrivals Widget -->
	<div class="tg-widget tg-widgettrending" style="background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 30px; border: 1px solid var(--border-color);">
		<div class="tg-widgettitle" style="background: var(--primary); padding: 15px 20px; border-bottom: none;">
			<h3 style="color: white; margin: 0; font-size: 16px; font-weight: 700;"><i class="fa fa-fire" style="margin-right: 8px;"></i>Sách Mới Cập Nhật</h3>
		</div>
		<div class="tg-widgetcontent" style="padding: 0;">
			<ul style="list-style: none; margin: 0; padding: 0;">
				<?php if($danh_sach): while($row = $danh_sach->fetch_assoc()): ?>
				<?php
					$bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
				?>
				<li style="padding: 15px 20px; border-bottom: 1px solid var(--border-color); display: flex; gap: 15px; align-items: center; transition: var(--transition);">
					<figure style="margin: 0; flex-shrink: 0;">
						<a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>">
							<img src="<?php echo htmlspecialchars($bookImage); ?>" alt="<?php echo htmlspecialchars($row['ten_sach']); ?>" style="width: 60px; height: 90px; object-fit: cover; border-radius: var(--radius-md); box-shadow: var(--shadow-sm);">
						</a>
					</figure>
					<div class="tg-postcontent">
						<h4 style="margin: 0 0 5px 0; font-size: 14px; font-weight: 700; line-height: 1.4;">
							<a href="productdetail.php?id=<?php echo intval($row['ma_sach']); ?>" style="color: var(--text-main); transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-main)'"><?php echo htmlspecialchars($row['ten_sach']); ?></a>
						</h4>
						<span style="font-size: 12px; color: var(--text-muted); display: block;"><i class="fa fa-user" style="margin-right: 5px;"></i><?php echo htmlspecialchars($row['ten_tac_gia']); ?></span>
					</div>
				</li>
				<?php endwhile; endif; ?>
			</ul>
		</div>
	</div>

	<!-- Top Authors Widget -->
	<div class="tg-widget tg-widgetblogers" style="background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); overflow: hidden; border: 1px solid var(--border-color);">
		<div class="tg-widgettitle" style="background: var(--primary); padding: 15px 20px; border-bottom: none;">
			<h3 style="color: white; margin: 0; font-size: 16px; font-weight: 700;"><i class="fa fa-users" style="margin-right: 8px;"></i>Tác Giả Nổi Bật</h3>
		</div>
		<div class="tg-widgetcontent" style="padding: 0;">
			<ul style="list-style: none; margin: 0; padding: 0;">
				<?php 
				$danh_sach_tac_gia = getDanhSachSachAuthor_aside($conn);
				while($row = $danh_sach_tac_gia->fetch_assoc() ): 
				?>
				<?php
					$authorImage = !empty($row['avatar_url']) ? ltrim($row['avatar_url'], '/') : 'images/author/imag-24.jpg';
				?>
				<li style="padding: 15px 20px; border-bottom: 1px solid var(--border-color); display: flex; gap: 15px; align-items: center;">
					<figure style="margin: 0; flex-shrink: 0;">
						<a href="authordetail.php?id=<?php echo intval($row['ma_tac_gia']); ?>">
							<img src="<?php echo htmlspecialchars($authorImage); ?>" alt="<?php echo htmlspecialchars($row['ten_tac_gia']); ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; box-shadow: var(--shadow-sm);">
						</a>
					</figure>
					<div class="tg-authorcontent">
						<h4 style="margin: 0 0 3px 0; font-size: 14px; font-weight: 700;">
							<a href="authordetail.php?id=<?php echo intval($row['ma_tac_gia']); ?>" style="color: var(--text-main); transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-main)'"><?php echo htmlspecialchars($row['ten_tac_gia']); ?></a>
						</h4>
						<span style="font-size: 12px; color: var(--primary); font-weight: 600;"><?php echo (int)$row['so_sach']; ?> Cuốn Sách</span>
					</div>
				</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</aside>