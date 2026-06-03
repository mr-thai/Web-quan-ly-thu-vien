<?php
$author = $author ?? [];
$authorBooks = $authorBooks ?? false;
?>
<div class="tg-sectionspace tg-haslayout">
				<div class="tg-sectionspace tg-haslayout">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="tg-authordetail">
									<?php
										$authorImage = !empty($author['avatar_url']) ? ltrim($author['avatar_url'], '/') : 'images/author/imag-' . str_pad((($author['ma_tac_gia'] % 26) ?: 1), 2, '0', STR_PAD_LEFT) . '.jpg';
									?>
									<figure class="tg-authorimg">

									<img src="<?php echo htmlspecialchars($authorImage); ?>" alt="<?php echo htmlspecialchars($author['ho_ten'] ?? 'Author'); ?>">
									</figure>
									<div class="tg-authorcontentdetail">
										<div class="tg-sectionhead">
											<h2><span><?php echo intval($author['so_sach']); ?> Published Books</span><?php echo htmlspecialchars(!empty($author['but_danh']) ? $author['but_danh'] : $author['ho_ten']); ?></h2>
											<ul class="tg-socialicons">
												<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
												<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
												<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
												<li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
												<li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
											</ul>
										</div>
										<div class="tg-description">
											<?php if (!empty($author['tieu_su'])): ?>
												<p><?php echo nl2br(htmlspecialchars($author['tieu_su'])); ?></p>
											<?php elseif (!empty($author['ghi_chu'])): ?>
												<p><?php echo nl2br(htmlspecialchars($author['ghi_chu'])); ?></p>
											<?php else: ?>
												<p>đang cập nhật.</p>
											<?php endif; ?>
										</div>

										<div class="tg-booksfromauthor">
											<div class="tg-sectionhead">
												<h2>Sách của <?php echo htmlspecialchars(!empty($author['but_danh']) ? $author['but_danh'] : $author['ho_ten']); ?></h2>
											</div>
											<div class="row">
												<?php if (is_object($authorBooks) && $authorBooks->num_rows > 0): ?>
													<?php while ($book = $authorBooks->fetch_assoc()):
														$bookImage = !empty($book['url_anh']) ? ltrim($book['url_anh'], '/') : 'images/books/img-01.jpg';
													?>
													<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
														<div class="tg-postbook">
															<figure class="tg-featureimg">
																<div class="tg-bookimg">
																	<div class="tg-frontcover"><img src="<?php echo htmlspecialchars($bookImage); ?>" alt="<?php echo htmlspecialchars($book['ten_sach']); ?>"></div>
																	<div class="tg-backcover"><img src="<?php echo htmlspecialchars($bookImage); ?>" alt="<?php echo htmlspecialchars($book['ten_sach']); ?>"></div>
																</div>
																
															</figure>
															<div class="tg-postbookcontent">
																<div class="tg-booktitle">
																	<h3><a href="productdetail.php?id=<?php echo intval($book['ma_sach']); ?>"><?php echo htmlspecialchars($book['ten_sach']); ?></a></h3>
																</div>
																<span class="tg-bookwriter">Năm XB: <a href="javascript:void(0);"><?php echo htmlspecialchars($book['nam_xuat_ban']); ?></a></span>
																<span class="tg-bookprice"><ins><?php echo number_format((float)$book['gia_sach'], 0, ',', '.'); ?> đ</ins></span>
																<a class="tg-btn tg-btnstyletwo" href="productdetail.php?id=<?php echo intval($book['ma_sach']); ?>">
																	<i class="fa fa-book"></i>
																	<em>Mượn sách</em>
																</a>
															</div>
														</div>
													</div>
													<?php endwhile; ?>
												<?php else: ?>
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<p>Chưa có sách nào được liên kết với tác giả này.</p>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>