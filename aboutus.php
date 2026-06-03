<?php require_once 'app/config.php'; ?>
<!doctype html>
<html class="no-js" lang="vi"> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Giới thiệu - Manlib Thư Viện</title>
	<meta name="description" content="Khám phá Thư viện Manlib - Nơi hội tụ tinh hoa tri thức. Hơn 115.000 đầu sách, không gian học tập hiện đại.">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/color.css?v=4">
	<style>
        /* ===== ABOUT US CUSTOM STYLES ===== */
        .about-hero {
            position: relative;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            padding: 100px 0 120px;
            text-align: center;
            overflow: hidden;
            color: white;
        }
        .about-hero::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .about-hero__content { position: relative; z-index: 1; }
        .about-hero__badge {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase;
            margin-bottom: 24px;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .about-hero__title {
            font-family: 'Merriweather', serif;
            font-size: 48px; font-weight: 800;
            margin: 0 0 20px; line-height: 1.2;
        }
        .about-hero__title span { color: var(--gold); }
        .about-hero__desc {
            font-size: 18px; color: rgba(255,255,255,0.85);
            max-width: 700px; margin: 0 auto; line-height: 1.7;
        }
        
        .about-wave { position: relative; margin-top: -60px; z-index: 2; line-height: 0; }
        .about-wave svg { width: 100%; height: 60px; }

        /* Story Section */
        .story-section { padding: 80px 0; background: var(--background); }
        .story-img-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 16px;
            position: relative;
        }
        .story-img-grid img {
            width: 100%; height: 100%; object-fit: cover;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            transition: transform 0.3s ease;
        }
        .story-img-grid img:hover { transform: scale(1.03); z-index: 10; position: relative; box-shadow: var(--shadow-lg); }
        .story-img-1 { grid-column: 1 / 2; grid-row: 1 / 3; height: 420px; }
        .story-img-2 { grid-column: 2 / 3; grid-row: 1 / 2; height: 202px; }
        .story-img-3 { grid-column: 2 / 3; grid-row: 2 / 3; height: 202px; }
        
        .story-content h2 { font-family: 'Merriweather', serif; font-size: 36px; font-weight: 800; color: var(--text-main); margin-bottom: 24px; }
        .story-content p { font-size: 15px; color: var(--text-muted); line-height: 1.8; margin-bottom: 16px; }

        /* Stats Section */
        .stats-section { padding: 60px 0; background: var(--surface); border-top: 1px solid var(--border-light); border-bottom: 1px solid var(--border-light); }
        .stat-item { text-align: center; padding: 20px; }
        .stat-item__icon {
            width: 70px; height: 70px; margin: 0 auto 16px;
            background: var(--surface-warm); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; color: var(--primary);
        }
        .stat-item__num { font-size: 36px; font-weight: 800; color: var(--text-main); line-height: 1; margin-bottom: 8px; }
        .stat-item__lbl { font-size: 14px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; }

        /* Services */
        .services-section { padding: 80px 0; background: var(--background); }
        .svc-card {
            background: white; border-radius: var(--radius-lg);
            padding: 40px 30px; text-align: center;
            box-shadow: var(--shadow-sm); border: 1px solid var(--border-light);
            transition: all 0.3s; height: 100%; margin-bottom: 30px;
        }
        .svc-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-lg); border-color: var(--primary); }
        .svc-card__icon {
            width: 80px; height: 80px; margin: 0 auto 24px;
            background: rgba(139,94,60,0.1); border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 32px; color: var(--primary);
            transition: all 0.3s;
        }
        .svc-card:hover .svc-card__icon { background: var(--primary); color: white; transform: rotateY(180deg); }
        .svc-card h3 { font-size: 20px; font-weight: 700; color: var(--text-main); margin-bottom: 16px; }
        .svc-card p { font-size: 14px; color: var(--text-muted); line-height: 1.7; margin: 0; }

        /* Hours & Info */
        .info-section { padding: 80px 0; background: var(--surface-warm); }
        .info-box {
            background: white; border-radius: var(--radius-lg); padding: 40px;
            box-shadow: var(--shadow-md); border-top: 5px solid var(--primary);
        }
        .info-box h3 { font-size: 22px; font-weight: 700; color: var(--text-main); margin-bottom: 24px; border-bottom: 1px solid var(--border-light); padding-bottom: 16px; }
        .info-list { list-style: none; padding: 0; margin: 0; }
        .info-list li { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px dashed var(--border-light); font-size: 15px; }
        .info-list li:last-child { border: none; }
        .info-list li strong { color: var(--text-main); }
        .info-list li span { color: var(--text-muted); }
	</style>
</head>
<body>
	<div id="tg-wrapper" class="tg-wrapper tg-haslayout">
		
		<?php include 'app/view/header.php'; ?>

		<main id="tg-main" class="tg-main tg-haslayout">
			
            <!-- HERO START -->
            <section class="about-hero">
                <div class="container about-hero__content">
                    <span class="about-hero__badge"><i class="fa fa-info-circle" style="margin-right:6px;"></i> Về chúng tôi</span>
                    <h1 class="about-hero__title">Khám Phá Thế Giới<br><span>Tri Thức</span> Bất Tận</h1>
                    <p class="about-hero__desc">
                        Hành trình từ một thư viện truyền thống trở thành Trung tâm Thông tin hiện đại, 
                        Manlib tự hào là "giảng đường thứ hai" đồng hành cùng hàng ngàn tri thức trẻ.
                    </p>
                </div>
            </section>
            <div class="about-wave">
                <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path d="M0,30 C360,60 720,0 1440,30 L1440,60 L0,60 Z" fill="var(--background)"/>
                </svg>
            </div>
            <!-- HERO END -->

            <!-- OUR STORY START -->
            <section class="story-section">
                <div class="container">
                    <div class="row" style="display:flex;flex-wrap:wrap;align-items:center;">
                        <div class="col-xs-12 col-md-6 mb-4">
                            <div class="story-img-grid">
                                <img src="images/about-1.jpg" onerror="this.src='images/parallax/bgparallax-07.jpg'" class="story-img-1" alt="Thư viện">
                                <img src="images/about-2.jpg" onerror="this.src='images/parallax/bgparallax-01.jpg'" class="story-img-2" alt="Học tập">
                                <img src="images/about-3.jpg" onerror="this.src='images/parallax/bgparallax-03.jpg'" class="story-img-3" alt="Sách">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6" style="padding-left:40px;">
                            <div class="story-content">
                                <span style="font-size:13px;font-weight:700;color:var(--secondary);text-transform:uppercase;letter-spacing:2px;display:block;margin-bottom:12px;">Câu chuyện của Manlib</span>
                                <h2>Nền tảng vững chắc cho Tương lai</h2>
                                <p>Thư viện Manlib (tiền thân là Trung tâm Thông tin - Thư viện Nguyễn Thúc Hào) đóng vai trò là cốt lõi trong hệ sinh thái học thuật. Chúng tôi không chỉ lưu trữ sách mà còn tạo ra không gian kết nối tri thức.</p>
                                <p>Với sự phát triển không ngừng, Manlib đã chuyển mình mạnh mẽ, ứng dụng công nghệ hiện đại vào quản lý mượn trả tự động, số hóa hàng vạn giáo trình, tạo điều kiện thuận lợi nhất cho việc nghiên cứu và tự học.</p>
                                <div style="margin-top:30px;border-left:4px solid var(--gold);padding-left:20px;">
                                    <p style="font-size:16px;font-style:italic;color:var(--text-main);margin:0;">
                                        "Mục tiêu của chúng tôi là mang mọi cuốn sách đến tận tay người đọc một cách nhanh nhất, dễ dàng nhất."
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- OUR STORY END -->

            <!-- STATS START -->
            <section class="stats-section">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-3">
                            <div class="stat-item">
                                <div class="stat-item__icon"><i class="fa fa-book"></i></div>
                                <div class="stat-item__num">115K+</div>
                                <div class="stat-item__lbl">Đầu sách</div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="stat-item">
                                <div class="stat-item__icon" style="color:var(--secondary);background:rgba(92,138,110,0.1);"><i class="fa fa-users"></i></div>
                                <div class="stat-item__num">1,500</div>
                                <div class="stat-item__lbl">Chỗ ngồi</div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="stat-item">
                                <div class="stat-item__icon" style="color:var(--gold);background:rgba(212,175,55,0.1);"><i class="fa fa-laptop"></i></div>
                                <div class="stat-item__num">7,000+</div>
                                <div class="stat-item__lbl">Tài liệu số</div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="stat-item">
                                <div class="stat-item__icon" style="color:var(--accent);background:rgba(192,57,43,0.1);"><i class="fa fa-building-o"></i></div>
                                <div class="stat-item__num">9,000</div>
                                <div class="stat-item__lbl">Mét vuông</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- STATS END -->

            <!-- SERVICES START -->
            <section class="services-section">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-center" style="margin-bottom:50px;">
                            <span style="font-size:13px;font-weight:700;color:var(--secondary);text-transform:uppercase;letter-spacing:2px;display:block;margin-bottom:12px;">Những gì chúng tôi mang lại</span>
                            <h2 style="font-family:'Merriweather',serif;font-size:36px;font-weight:800;color:var(--text-main);margin:0;">Dịch Vụ & Tiện Ích Đỉnh Cao</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="svc-card">
                                <div class="svc-card__icon"><i class="fa fa-exchange"></i></div>
                                <h3>Mượn - Trả Tự Động</h3>
                                <p>Hệ thống phần mềm quản lý trực tuyến giúp bạn dễ dàng theo dõi, đặt trước và gia hạn sách chỉ với vài cú click.</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="svc-card">
                                <div class="svc-card__icon" style="color:var(--secondary);background:rgba(92,138,110,0.1);"><i class="fa fa-cloud-download"></i></div>
                                <h3>Tài Liệu E-Learning</h3>
                                <p>Kho tàng giáo trình số khổng lồ, luận văn, luận án sẵn sàng phục vụ nghiên cứu ở mọi nơi, mọi lúc.</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="svc-card">
                                <div class="svc-card__icon" style="color:var(--gold);background:rgba(212,175,55,0.1);"><i class="fa fa-coffee"></i></div>
                                <h3>Không Gian Mở</h3>
                                <p>7 tầng chức năng với các phòng họp nhóm, phòng đọc yên tĩnh và khu vực thảo luận có trang bị máy chiếu.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- SERVICES END -->

            <!-- HOURS & INFO START -->
            <section class="info-section">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 mb-4">
                            <div class="info-box">
                                <h3><i class="fa fa-clock-o" style="color:var(--primary);margin-right:10px;"></i>Giờ hoạt động</h3>
                                <ul class="info-list">
                                    <li><strong>Thứ 2 - Thứ 6:</strong> <span>08:00 - 17:00</span></li>
                                    <li><strong>Thứ 7:</strong> <span>08:00 - 12:00</span></li>
                                    <li><strong>Chủ nhật & Ngày Lễ:</strong> <span>Đóng cửa</span></li>
                                </ul>
                                <div style="margin-top:24px;padding:16px;background:var(--surface-warm);border-radius:8px;font-size:14px;color:var(--text-muted);">
                                    <i class="fa fa-info-circle" style="color:var(--secondary);margin-right:6px;"></i> Hệ thống mượn sách trực tuyến mở 24/7.
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="info-box">
                                <h3><i class="fa fa-map-marker" style="color:var(--accent);margin-right:10px;"></i>Thông tin liên hệ</h3>
                                <ul class="info-list">
                                    <li><strong>Địa chỉ:</strong> <span>Tòa nhà Thư viện, Trường ĐH XYZ</span></li>
                                    <li><strong>Hotline hỗ trợ:</strong> <span>0901 234 567</span></li>
                                    <li><strong>Email liên hệ:</strong> <span>support@manlib.edu.vn</span></li>
                                </ul>
                                <div style="margin-top:24px;">
                                    <a href="contactus.php" class="tg-btn" style="width:100%;text-align:center;"><i class="fa fa-envelope"></i> Gửi tin nhắn ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- HOURS & INFO END -->

		</main>
		
		<?php include 'app/view/footer.php'; ?>
		
	</div>
	
	<script src="js/vendor/jquery-library.js"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>