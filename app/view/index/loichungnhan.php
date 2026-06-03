<?php /* ===== SECTION: BANNER CTA + THỐNG KÊ START ===== */ ?>

<!-- THỐNG KÊ NHANH START -->
<section style="background:var(--surface);padding:56px 0;border-top:1px solid var(--border-light);border-bottom:1px solid var(--border-light);">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-3">
                <div style="text-align:center;padding:20px;">
                    <div style="width:56px;height:56px;background:rgba(139,94,60,0.1);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                        <i class="fa fa-book" style="font-size:22px;color:var(--primary);"></i>
                    </div>
                    <div style="font-size:30px;font-weight:800;color:var(--text-main);line-height:1;margin-bottom:6px;">1,000+</div>
                    <div style="font-size:13px;color:var(--text-muted);font-weight:500;">Đầu sách</div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div style="text-align:center;padding:20px;">
                    <div style="width:56px;height:56px;background:rgba(92,138,110,0.1);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                        <i class="fa fa-users" style="font-size:22px;color:var(--secondary);"></i>
                    </div>
                    <div style="font-size:30px;font-weight:800;color:var(--text-main);line-height:1;margin-bottom:6px;">500+</div>
                    <div style="font-size:13px;color:var(--text-muted);font-weight:500;">Thành viên</div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div style="text-align:center;padding:20px;">
                    <div style="width:56px;height:56px;background:rgba(212,175,55,0.1);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                        <i class="fa fa-user-circle-o" style="font-size:22px;color:var(--gold);"></i>
                    </div>
                    <div style="font-size:30px;font-weight:800;color:var(--text-main);line-height:1;margin-bottom:6px;">50+</div>
                    <div style="font-size:13px;color:var(--text-muted);font-weight:500;">Tác giả</div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div style="text-align:center;padding:20px;">
                    <div style="width:56px;height:56px;background:rgba(192,57,43,0.1);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                        <i class="fa fa-tag" style="font-size:22px;color:var(--accent);"></i>
                    </div>
                    <div style="font-size:30px;font-weight:800;color:var(--text-main);line-height:1;margin-bottom:6px;">20+</div>
                    <div style="font-size:13px;color:var(--text-muted);font-weight:500;">Thể loại</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- THỐNG KÊ NHANH END -->

<!-- CTA BANNER START -->
<section style="background:linear-gradient(135deg,#3D2010 0%,#6D4A2E 50%,#8B5E3C 100%);padding:80px 0;position:relative;overflow:hidden;">
    <!-- Pattern nền -->
    <div style="position:absolute;inset:0;opacity:0.04;background-image:repeating-linear-gradient(45deg,transparent,transparent 20px,rgba(255,255,255,1) 20px,rgba(255,255,255,1) 21px);"></div>

    <div class="container" style="position:relative;z-index:1;">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 col-sm-offset-1 col-md-offset-2 col-lg-offset-2" style="text-align:center;">

                <span style="display:inline-block;background:rgba(212,175,55,0.2);color:#F0D080;font-size:12px;font-weight:700;padding:6px 18px;border-radius:999px;margin-bottom:20px;letter-spacing:1.5px;border:1px solid rgba(212,175,55,0.3);">
                    <i class="fa fa-star" style="margin-right:6px;"></i>THAM GIA CỘNG ĐỒNG ĐỌC SÁCH
                </span>

                <h2 style="color:white;font-size:34px;font-weight:800;margin:0 0 16px;line-height:1.25;font-family:'Merriweather',serif;">
                    Bắt đầu hành trình<br>
                    <span style="color:#F0D080;">đọc sách</span> của bạn ngay hôm nay
                </h2>

                <p style="color:rgba(255,255,255,0.75);font-size:16px;line-height:1.75;margin:0 auto 36px;max-width:520px;">
                    Đăng ký miễn phí và khám phá hơn <strong style="color:#F0D080;">1.000 đầu sách</strong> từ
                    kho thư viện phong phú. Mượn, đọc và trả đơn giản chỉ với vài bước.
                </p>

                <!-- Testimonial nhỏ -->
                <div style="display:flex;justify-content:center;gap:24px;flex-wrap:wrap;margin-bottom:36px;">
                    <?php
                    $testimonials = [
                        ['text' => '"Giao diện dễ dùng, tìm sách rất nhanh!"', 'name' => 'Lan Anh', 'role' => 'Sinh viên'],
                        ['text' => '"Thư viện rất phong phú, mượn trả tiện lợi."', 'name' => 'Minh Tuấn', 'role' => 'Giảng viên'],
                    ];
                    foreach ($testimonials as $t):
                    ?>
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:16px;padding:18px 22px;max-width:260px;text-align:left;backdrop-filter:blur(4px);">
                        <p style="color:rgba(255,255,255,0.85);font-size:13px;font-style:italic;margin:0 0 10px;line-height:1.6;">
                            <?= $t['text'] ?>
                        </p>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <div style="width:32px;height:32px;border-radius:50%;background:rgba(212,175,55,0.3);display:flex;align-items:center;justify-content:center;">
                                <i class="fa fa-user" style="color:#F0D080;font-size:14px;"></i>
                            </div>
                            <div>
                                <strong style="color:white;font-size:13px;display:block;"><?= $t['name'] ?></strong>
                                <span style="color:rgba(255,255,255,0.5);font-size:11px;"><?= $t['role'] ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Nút CTA -->
                <div style="display:flex;justify-content:center;gap:14px;flex-wrap:wrap;">
                    <a href="register.php" style="display:inline-flex;align-items:center;gap:8px;background:#F0D080;color:#3D2010;padding:14px 30px;border-radius:999px;font-size:16px;font-weight:700;text-decoration:none;box-shadow:0 6px 20px rgba(240,208,128,0.35);transition:all 0.25s;" onmouseover="this.style.background='#FFE090';this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#F0D080';this.style.transform=''">
                        <i class="fa fa-user-plus"></i> Đăng ký miễn phí
                    </a>
                    <a href="products.php" style="display:inline-flex;align-items:center;gap:8px;background:transparent;color:rgba(255,255,255,0.9);padding:14px 30px;border-radius:999px;font-size:16px;font-weight:600;text-decoration:none;border:2px solid rgba(255,255,255,0.3);transition:all 0.25s;" onmouseover="this.style.background='rgba(255,255,255,0.1)';this.style.borderColor='rgba(255,255,255,0.6)'" onmouseout="this.style.background='transparent';this.style.borderColor='rgba(255,255,255,0.3)'">
                        <i class="fa fa-search"></i> Khám phá sách
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- CTA BANNER END -->

<?php /* ===== SECTION: BANNER CTA + THỐNG KÊ END ===== */ ?>