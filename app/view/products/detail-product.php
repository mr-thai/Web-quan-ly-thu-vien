<?php $book = $book ?? []; ?>
<div class="tg-productdetail">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="tg-postbook">
				<figure class="tg-featureimg" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); overflow: hidden; max-width: 350px; margin: 0 auto;">
					<img src="<?php echo htmlspecialchars($bookImage ?? 'default-book-image.jpg'); ?>" alt="<?php echo htmlspecialchars($book['ten_sach'] ?? 'Sách'); ?>" style="width: 100%; aspect-ratio: 2/3; object-fit: cover; display: block;">
				</figure>
				<div class="tg-postbookcontent">
					<form method="GET" action="app/controller/control_muon_sach.php" style="display:inline;">
						<input type="hidden" name="action" value="add">
						<input type="hidden" name="id" value="<?php echo (int)($book['ma_sach'] ?? 0); ?>">
						<button type="submit" class="tg-btn tg-active tg-btn-lg" onclick="return confirm('Thêm vào giỏ mượn?')" style="width: 100%; margin-top: 20px; height: 50px; font-size: 16px;">
							<i class="fa fa-book"></i> Mượn sách
						</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<div class="tg-productcontent">
				<ul class="tg-bookscategories">
					<li><a href="javascript:void(0);"><?php echo htmlspecialchars($book['ten_the_loai'] ?? ''); ?></a></li>
				</ul>
				<div class="tg-booktitle">
					<h3><?php echo htmlspecialchars($book['ten_sach'] ?? ''); ?></h3>
				</div>
				<span class="tg-bookwriter">By: <a href="javascript:void(0);"><?php echo htmlspecialchars($book['ten_tac_gia'] ?? ''); ?></a></span>
				<span class="tg-stars"><span></span></span>
				<?php if (!empty($book['mo_ta'])): ?>
					<div class="tg-description">
						<p><?php echo nl2br(htmlspecialchars($book['mo_ta'])); ?></p>
					</div>
				<?php endif; ?>
				<div class="tg-sectionhead">
					<h2>Thông tin sách</h2>
				</div>
				<ul class="tg-productinfo">
					<?php $infoItems = $infoItems ?? []; foreach ($infoItems as [$label, $value]): ?>
						<li><span><?php echo htmlspecialchars($label); ?>:</span><span><?php echo htmlspecialchars((string)$value); ?></span></li>
					<?php endforeach; ?>
					<li><span>Trạng thái:</span><span><?php echo ((int)($book['so_luong_con'] ?? 0) > 0) ? 'Còn sách' : 'Hết sách'; ?></span></li>
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
						<img src="<?php echo htmlspecialchars($authorImage ?? 'default-author-image.jpg'); ?>" alt="<?php echo htmlspecialchars($book['ten_tac_gia'] ?? 'Tác giả'); ?>" style="width:100px;height:100px;object-fit:cover;display:block;border-radius:50%;">
					</figure>
					<div class="tg-authorinfo">
						<div class="tg-authorhead">
							<div class="tg-leftarea">
								<div class="tg-authorname">
									<h2><?php echo htmlspecialchars($book['ten_tac_gia'] ?? ''); ?></h2>
								</div>
							</div>
						</div>
						<?php if (!empty($book['tac_gia_avatar'])): ?>
							<div class="tg-description">
								<p>Ảnh tác giả được lấy từ cơ sở dữ liệu.</p>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>