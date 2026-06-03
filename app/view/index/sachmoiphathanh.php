<?php
/* ===== SECTION: SÁCH MỚI PHÁT HÀNH START ===== */
$sach_moi_phat_hanh = $sach_moi_phat_hanh ?? false;
$row = $row ?? [];
$bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
$moTa      = !empty($row['mo_ta'])  ? mb_strimwidth($row['mo_ta'], 0, 180, '...')  : 'Một cuốn sách mới vừa được bổ sung vào thư viện. Đừng bỏ lỡ cơ hội khám phá tác phẩm hấp dẫn này!';
?>
<section class="tg-sectionspace tg-haslayout" style="background:var(--surface-warm);">
    <div class="container">
        <div class="row" style="display:flex;flex-wrap:wrap;align-items:center;">

            <!-- Nội dung trái -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div style="padding-right:32px;">
                    <span style="display:inline-block;font-size:11px;font-weight:700;color:var(--secondary);text-transform:uppercase;letter-spacing:2.5px;margin-bottom:14px;">
                        Vừa bổ sung
                    </span>
                    <h2 style="font-size:30px;font-weight:800;margin:0 0 16px;line-height:1.2;font-family:'Merriweather',serif;">
                        Sách Phát Hành Mới
                    </h2>
                    <p style="font-size:15px;color:var(--text-muted);line-height:1.8;margin-bottom:24px;">
                        Cập nhật liên tục những đầu sách mới nhất từ các tác giả trong và ngoài nước.
                        Đăng ký thành viên để nhận thông báo sách mới sớm nhất.
                    </p>

                    <!-- Lợi ích -->
                    <div style="display:flex;flex-direction:column;gap:14px;margin-bottom:32px;">
                        <div style="display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:36px;height:36px;background:var(--secondary);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa fa-calendar" style="color:white;font-size:14px;"></i>
                            </div>
                            <div>
                                <strong style="font-size:14px;color:var(--text-main);display:block;margin-bottom:2px;">Cập nhật hàng tuần</strong>
                                <span style="font-size:13px;color:var(--text-muted);">Sách mới được bổ sung định kỳ mỗi tuần.</span>
                            </div>
                        </div>
                        <div style="display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:36px;height:36px;background:var(--primary);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa fa-clock-o" style="color:white;font-size:14px;"></i>
                            </div>
                            <div>
                                <strong style="font-size:14px;color:var(--text-main);display:block;margin-bottom:2px;">Mượn 14 ngày miễn phí</strong>
                                <span style="font-size:13px;color:var(--text-muted);">Thời hạn mượn 2 tuần, có thể gia hạn.</span>
                            </div>
                        </div>
                        <div style="display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:36px;height:36px;background:var(--gold);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa fa-star" style="color:white;font-size:14px;"></i>
                            </div>
                            <div>
                                <strong style="font-size:14px;color:var(--text-main);display:block;margin-bottom:2px;">Mượn tối đa 5 cuốn</strong>
                                <span style="font-size:13px;color:var(--text-muted);">Đặt trước nhiều cuốn cùng một lúc.</span>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;gap:12px;flex-wrap:wrap;">
                        <a class="tg-btn" href="products.php" style="min-width:140px;">
                            <i class="fa fa-book"></i> Xem tất cả sách
                        </a>
                        <a class="tg-btn tg-active" href="register.php" style="min-width:140px;">
                            <i class="fa fa-user-plus"></i> Tham gia ngay
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sách mới bên phải -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding-top:30px;">
                <?php if (!empty($row) && isset($row['ma_sach'])): ?>
                <div style="background:var(--surface);border-radius:20px;padding:28px;box-shadow:var(--shadow-lg);border:1px solid var(--border-light);display:flex;gap:24px;align-items:flex-start;position:relative;overflow:hidden;">
                    <!-- Dải "Mới" -->
                    <div style="position:absolute;top:16px;right:-8px;background:var(--accent);color:white;font-size:11px;font-weight:700;padding:4px 20px 4px 12px;border-radius:4px 0 0 4px;letter-spacing:1px;">MỚI</div>

                    <!-- Ảnh sách -->
                    <div style="flex-shrink:0;">
                        <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>">
                            <img src="<?= htmlspecialchars($bookImage) ?>" alt="<?= htmlspecialchars($row['ten_sach']) ?>"
                                 style="width:120px;height:168px;object-fit:cover;border-radius:12px;box-shadow:0 12px 32px rgba(139,94,60,0.25);transition:transform 0.3s ease;"
                                 onmouseover="this.style.transform='scale(1.04) rotate(-1deg)'" onmouseout="this.style.transform=''">
                        </a>
                    </div>

                    <!-- Thông tin sách -->
                    <div style="flex:1;min-width:0;">
                        <span style="display:inline-block;font-size:11px;font-weight:700;color:var(--secondary);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px;"><?= htmlspecialchars($row['ten_the_loai'] ?? '') ?></span>
                        <h3 style="margin:0 0 8px;font-size:18px;line-height:1.35;font-family:'Merriweather',serif;">
                            <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>" style="color:var(--text-main);"><?= htmlspecialchars($row['ten_sach'] ?? '') ?></a>
                        </h3>
                        <p style="font-size:13px;color:var(--text-muted);margin:0 0 6px;">
                            Tác giả: <strong style="color:var(--primary);"><?= htmlspecialchars($row['ten_tac_gia'] ?? '') ?></strong>
                        </p>
                        <?php if (!empty($row['nha_xuat_ban'])): ?>
                        <p style="font-size:12px;color:var(--text-light);margin:0 0 12px;">
                            NXB <?= htmlspecialchars($row['nha_xuat_ban']) ?>
                            <?= !empty($row['nam_xuat_ban']) ? '&bull; ' . (int)$row['nam_xuat_ban'] : '' ?>
                        </p>
                        <?php endif; ?>
                        <p style="font-size:13px;color:var(--text-muted);line-height:1.65;margin:0 0 16px;"><?= htmlspecialchars($moTa) ?></p>
                        <div style="display:flex;gap:8px;align-items:center;">
                            <a class="tg-btn" href="app/controller/control_muon_sach.php?action=add&id=<?= intval($row['ma_sach']) ?>" style="padding:8px 18px;font-size:13px;">
                                <i class="fa fa-book"></i> Mượn ngay
                            </a>
                            <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>" style="font-size:13px;color:var(--primary);font-weight:600;">
                                Chi tiết <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div style="text-align:center;padding:60px;color:var(--text-muted);">
                    <i class="fa fa-book" style="font-size:48px;opacity:0.2;display:block;margin-bottom:12px;"></i>
                    <p>Chưa có sách mới.</p>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<?php /* ===== SECTION: SÁCH MỚI PHÁT HÀNH END ===== */ ?>