<?php /* ===== HERO BANNER TRANG CHỦ START ===== */ ?>
<section class="manlib-hero">
    <div class="manlib-hero__bg"></div>
    <div class="container manlib-hero__inner">
        <div class="row" style="align-items:center;min-height:520px;display:flex;flex-wrap:wrap;">

            <!-- Nội dung trái -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding:60px 0;">
                <span class="manlib-hero__eyebrow">
                    <i class="fa fa-book-open" style="margin-right:6px;"></i>Thư viện sách trực tuyến
                </span>
                <h1 class="manlib-hero__title">
                    Khám phá thế giới<br><span>tri thức</span> không giới hạn
                </h1>
                <p class="manlib-hero__desc">
                    Hơn <strong>1.000 đầu sách</strong> thuộc mọi thể loại đang chờ bạn khám phá.
                    Tìm kiếm, mượn và theo dõi sách mọi lúc, mọi nơi chỉ với vài thao tác đơn giản.
                </p>
                <div class="manlib-hero__actions">
                    <a href="products.php" class="manlib-hero__btn manlib-hero__btn--primary">
                        <i class="fa fa-search"></i> Tìm sách ngay
                    </a>
                    <?php if (!isset($_SESSION['nguoi_dung'])): ?>
                    <a href="register.php" class="manlib-hero__btn manlib-hero__btn--outline">
                        <i class="fa fa-user-plus"></i> Đăng ký miễn phí
                    </a>
                    <?php else: ?>
                    <a href="sachcuatoi.php" class="manlib-hero__btn manlib-hero__btn--outline">
                        <i class="fa fa-list"></i> Sách của tôi
                    </a>
                    <?php endif; ?>
                </div>
                <!-- Số liệu nhỏ -->
                <div class="manlib-hero__stats">
                    <div class="manlib-hero__stat">
                        <span class="manlib-hero__stat-num">1,000+</span>
                        <span class="manlib-hero__stat-lbl">Đầu sách</span>
                    </div>
                    <div class="manlib-hero__stat-divider"></div>
                    <div class="manlib-hero__stat">
                        <span class="manlib-hero__stat-num">500+</span>
                        <span class="manlib-hero__stat-lbl">Thành viên</span>
                    </div>
                    <div class="manlib-hero__stat-divider"></div>
                    <div class="manlib-hero__stat">
                        <span class="manlib-hero__stat-num">20+</span>
                        <span class="manlib-hero__stat-lbl">Thể loại</span>
                    </div>
                </div>
            </div>

            <!-- Ảnh minh họa phải -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 hidden-xs" style="text-align:center;padding:40px 20px;">
                <div class="manlib-hero__illustration">
                    <div class="manlib-hero__book manlib-hero__book--1">
                        <div class="manlib-hero__book-cover" style="background:linear-gradient(145deg,#8B5E3C,#6D4A2E);">
                            <i class="fa fa-book" style="font-size:32px;color:rgba(255,255,255,0.4);"></i>
                        </div>
                    </div>
                    <div class="manlib-hero__book manlib-hero__book--2">
                        <div class="manlib-hero__book-cover" style="background:linear-gradient(145deg,#5C8A6E,#3D6B52);">
                            <i class="fa fa-leaf" style="font-size:28px;color:rgba(255,255,255,0.4);"></i>
                        </div>
                    </div>
                    <div class="manlib-hero__book manlib-hero__book--3">
                        <div class="manlib-hero__book-cover" style="background:linear-gradient(145deg,#D4AF37,#B8941F);">
                            <i class="fa fa-star" style="font-size:28px;color:rgba(255,255,255,0.4);"></i>
                        </div>
                    </div>
                    <div class="manlib-hero__center">
                        <i class="fa fa-book" style="font-size:64px;color:var(--primary);opacity:0.15;"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Sóng phân cách -->
    <div class="manlib-hero__wave">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C360,60 720,0 1440,30 L1440,60 L0,60 Z" fill="#FAF7F4"/>
        </svg>
    </div>
</section>

<!-- THỂ LOẠI NỔI BẬT START -->
<section style="padding:40px 0 60px;background:var(--background);">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 style="font-size:14px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:2px;margin-bottom:20px;text-align:center;">Khám phá theo thể loại</h3>
            </div>
        </div>
        <div class="row" style="display:flex;flex-wrap:wrap;gap:0;">
            <?php
            $genres = [
                ['icon'=>'fa-book',          'label'=>'Văn học',       'color'=>'#8B5E3C', 'bg'=>'#FDF6EE'],
                ['icon'=>'fa-flask',         'label'=>'Khoa học',      'color'=>'#5C8A6E', 'bg'=>'#EDF7F2'],
                ['icon'=>'fa-lightbulb-o',   'label'=>'Self-help',     'color'=>'#D4AF37', 'bg'=>'#FEFCEC'],
                ['icon'=>'fa-magic',         'label'=>'Fantasy',       'color'=>'#7B3FA0', 'bg'=>'#F5EDFC'],
                ['icon'=>'fa-history',       'label'=>'Lịch sử',       'color'=>'#C0392B', 'bg'=>'#FEF0EE'],
                ['icon'=>'fa-child',         'label'=>'Thiếu nhi',     'color'=>'#E67E22', 'bg'=>'#FEF5EB'],
            ];
            foreach ($genres as $g): ?>
            <div class="col-xs-6 col-sm-4 col-md-2" style="padding:6px;">
                <a href="products.php" style="display:flex;flex-direction:column;align-items:center;padding:20px 12px;background:<?= $g['bg'] ?>;border-radius:14px;border:1.5px solid <?= $g['color'] ?>22;text-decoration:none;transition:all 0.25s;gap:10px;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 20px <?= $g['color'] ?>22'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                    <div style="width:48px;height:48px;border-radius:12px;background:<?= $g['color'] ?>;display:flex;align-items:center;justify-content:center;">
                        <i class="fa <?= $g['icon'] ?>" style="color:white;font-size:20px;"></i>
                    </div>
                    <span style="font-size:13px;font-weight:600;color:<?= $g['color'] ?>;text-align:center;"><?= $g['label'] ?></span>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- THỂ LOẠI NỔI BẬT END -->

<style>
/* ===== HERO STYLES ===== */
.manlib-hero {
    background: linear-gradient(135deg, #3D2010 0%, #6D4A2E 40%, #8B5E3C 100%);
    position: relative;
    overflow: hidden;
}
.manlib-hero__bg {
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.manlib-hero__inner { position: relative; z-index: 1; }

.manlib-hero__eyebrow {
    display: inline-flex; align-items: center;
    background: rgba(212,175,55,0.2);
    color: #F0D080;
    font-size: 13px; font-weight: 600;
    padding: 6px 16px;
    border-radius: 999px;
    margin-bottom: 20px;
    border: 1px solid rgba(212,175,55,0.3);
    letter-spacing: 0.5px;
}

.manlib-hero__title {
    color: white !important;
    font-size: 42px !important;
    font-weight: 800 !important;
    line-height: 1.2 !important;
    margin: 0 0 20px !important;
}
.manlib-hero__title span {
    color: #F0D080;
    position: relative;
}
.manlib-hero__title span::after {
    content: '';
    position: absolute;
    left: 0; right: 0; bottom: -4px;
    height: 3px;
    background: rgba(240,208,128,0.4);
    border-radius: 999px;
}

.manlib-hero__desc {
    color: rgba(255,255,255,0.78) !important;
    font-size: 16px !important;
    line-height: 1.75 !important;
    margin-bottom: 32px !important;
    max-width: 480px;
}
.manlib-hero__desc strong { color: #F0D080; }

.manlib-hero__actions { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 40px; }

.manlib-hero__btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 13px 26px;
    border-radius: 999px;
    font-size: 15px; font-weight: 600;
    text-decoration: none;
    transition: all 0.25s ease;
    cursor: pointer;
}
.manlib-hero__btn--primary {
    background: #F0D080; color: #3D2010 !important;
    box-shadow: 0 4px 16px rgba(240,208,128,0.3);
}
.manlib-hero__btn--primary:hover {
    background: #FFE090; transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(240,208,128,0.4);
    color: #3D2010 !important; text-decoration: none;
}
.manlib-hero__btn--outline {
    background: transparent; color: rgba(255,255,255,0.9) !important;
    border: 2px solid rgba(255,255,255,0.3);
}
.manlib-hero__btn--outline:hover {
    background: rgba(255,255,255,0.1);
    border-color: rgba(255,255,255,0.6);
    color: white !important; text-decoration: none;
}

.manlib-hero__stats {
    display: flex; align-items: center; gap: 24px;
}
.manlib-hero__stat { text-align: left; }
.manlib-hero__stat-num {
    display: block; font-size: 22px; font-weight: 800; color: white; line-height: 1;
}
.manlib-hero__stat-lbl { font-size: 12px; color: rgba(255,255,255,0.6); margin-top: 3px; display: block; }
.manlib-hero__stat-divider { width: 1px; height: 36px; background: rgba(255,255,255,0.2); }

/* Illustration */
.manlib-hero__illustration {
    position: relative; width: 320px; height: 320px;
    margin: 0 auto;
    display: flex; align-items: center; justify-content: center;
}
.manlib-hero__center {
    position: absolute; inset: 0;
    display: flex; align-items: center; justify-content: center;
}
.manlib-hero__book {
    position: absolute;
    border-radius: 10px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.35);
    animation: bookFloat 4s ease-in-out infinite;
}
.manlib-hero__book-cover {
    display: flex; align-items: center; justify-content: center;
    border-radius: 10px;
}
.manlib-hero__book--1 { width: 110px; height: 150px; top: 20px; left: 40px; animation-delay: 0s; }
.manlib-hero__book--1 .manlib-hero__book-cover { width: 110px; height: 150px; }
.manlib-hero__book--2 { width: 95px; height: 130px; top: 60px; right: 50px; animation-delay: 1.5s; }
.manlib-hero__book--2 .manlib-hero__book-cover { width: 95px; height: 130px; }
.manlib-hero__book--3 { width: 80px; height: 110px; bottom: 30px; left: 100px; animation-delay: 0.8s; }
.manlib-hero__book--3 .manlib-hero__book-cover { width: 80px; height: 110px; }

@keyframes bookFloat {
    0%, 100% { transform: translateY(0) rotate(-2deg); }
    50% { transform: translateY(-12px) rotate(2deg); }
}

.manlib-hero__wave { position: relative; margin-top: -1px; line-height: 0; }
.manlib-hero__wave svg { width: 100%; height: 60px; display: block; }

@media (max-width: 767px) {
    .manlib-hero__title { font-size: 28px !important; }
    .manlib-hero__desc { font-size: 14px !important; }
    .manlib-hero__stats { gap: 16px; }
    .manlib-hero__stat-num { font-size: 18px; }
}
/* ===== HERO STYLES END ===== */
</style>
<?php /* ===== HERO BANNER TRANG CHỦ END ===== */ ?>
