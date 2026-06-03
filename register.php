<?php
require_once __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/controller/control_logic_register.php';

$next = isset($_GET['next']) ? $_GET['next'] : (isset($_POST['next']) ? $_POST['next'] : '');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký - Manlib</title>
    <meta name="description" content="Tạo tài khoản Manlib để mượn sách và quản lý thư viện cá nhân.">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/color.css?v=3">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #FAF0E6 0%, #F5E6D3 50%, #EDD9C0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }
        .auth-wrapper {
            display: flex;
            width: 100%;
            max-width: 960px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(139,94,60,0.2);
        }
        /* Bên trái */
        .auth-left {
            flex: 1;
            background: linear-gradient(160deg, var(--primary) 0%, var(--primary-hover) 100%);
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .auth-left::before {
            content: '\f02d';
            font-family: FontAwesome;
            position: absolute;
            right: -30px; bottom: -20px;
            font-size: 200px;
            color: rgba(255,255,255,0.05);
        }
        .auth-left h2 { color: white; font-size: 26px; margin-bottom: 10px; }
        .auth-left p  { color: rgba(255,255,255,0.72); font-size: 14px; line-height: 1.7; margin-bottom: 24px; }
        .auth-step {
            display: flex; align-items: flex-start; gap: 12px;
            margin-bottom: 18px;
        }
        .auth-step-num {
            width: 28px; height: 28px; flex-shrink: 0;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: white;
        }
        .auth-step-text strong { color: white; font-size: 14px; display: block; margin-bottom: 2px; }
        .auth-step-text span   { color: rgba(255,255,255,0.6); font-size: 12px; }

        /* Bên phải */
        .auth-right {
            background: white;
            padding: 40px 44px;
            width: 480px;
            flex-shrink: 0;
        }
        .auth-logo { text-align: center; margin-bottom: 24px; }
        /* Removed auth logo styles */
        .auth-logo p { color: var(--text-muted); font-size: 13px; margin-top: 4px; margin-bottom: 0; }

        .auth-right h3 { font-size: 19px; font-weight: 700; color: var(--text-main); margin-bottom: 20px; }

        .form-row { display: flex; gap: 12px; }
        .form-row .form-group { flex: 1; }
        .form-group { margin-bottom: 14px; }
        .form-group label { font-size: 13px; font-weight: 600; color: var(--text-main); margin-bottom: 5px; display: block; }
        .input-icon { position: relative; }
        .input-icon i {
            position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
            color: var(--text-muted); pointer-events: none; z-index: 1;
        }
        .input-icon input { padding-left: 38px !important; }

        .btn-block { width: 100%; margin-top: 6px; padding: 12px !important; font-size: 15px !important; border-radius: 10px !important; }

        .auth-divider { display: flex; align-items: center; gap: 12px; margin: 16px 0; }
        .auth-divider::before, .auth-divider::after { content: ''; flex: 1; height: 1px; background: var(--border-color); }
        .auth-divider span { font-size: 13px; color: var(--text-muted); white-space: nowrap; }

        @media (max-width: 680px) {
            .auth-wrapper { flex-direction: column; }
            .auth-left    { display: none; }
            .auth-right   { width: 100%; padding: 28px 20px; }
            .form-row     { flex-direction: column; gap: 0; }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">

    <!-- Bên trái: Hướng dẫn -->
    <div class="auth-left">
        <div style="position:relative;z-index:1;">
            <div style="margin-bottom:28px;">
                <a href="index.php" class="ml-logo ml-logo--admin">
                    <div class="ml-icon-wrapper">
                        <div class="ml-book-page"></div>
                        <div class="ml-book-page"></div>
                        <div class="ml-book-page"></div>
                        <div class="ml-book-cover"></div>
                    </div>
                    <div class="ml-text-wrapper">
                        <h1 class="ml-text-main">Man<span>lib</span></h1>
                    </div>
                </a>
            </div>
            <h2>Đăng ký chỉ 1 phút!</h2>
            <p>Tạo tài khoản miễn phí và bắt đầu mượn sách ngay hôm nay.</p>

            <div class="auth-step">
                <div class="auth-step-num">1</div>
                <div class="auth-step-text">
                    <strong>Điền thông tin</strong>
                    <span>Tên, email và số điện thoại</span>
                </div>
            </div>
            <div class="auth-step">
                <div class="auth-step-num">2</div>
                <div class="auth-step-text">
                    <strong>Tạo tài khoản</strong>
                    <span>Đặt tên đăng nhập và mật khẩu</span>
                </div>
            </div>
            <div class="auth-step">
                <div class="auth-step-num">3</div>
                <div class="auth-step-text">
                    <strong>Mượn sách</strong>
                    <span>Tìm và mượn sách yêu thích ngay</span>
                </div>
            </div>

            <div style="margin-top:32px;padding:16px;background:rgba(255,255,255,0.08);border-radius:12px;border:1px solid rgba(255,255,255,0.12);">
                <p style="color:white;margin:0;font-size:13px;font-weight:600;">
                    <i class="fa fa-shield" style="color:var(--gold);margin-right:6px;"></i>
                    Tài khoản miễn phí, không cần thẻ tín dụng.
                </p>
            </div>
        </div>
    </div>

    <!-- Bên phải: Form đăng ký -->
    <div class="auth-right">
        <div class="auth-logo">
            <a href="index.php" class="ml-logo">
                <div class="ml-icon-wrapper">
                    <div class="ml-book-page"></div>
                    <div class="ml-book-page"></div>
                    <div class="ml-book-page"></div>
                    <div class="ml-book-cover"></div>
                </div>
                <div class="ml-text-wrapper">
                    <h1 class="ml-text-main">Man<span>lib</span></h1>
                </div>
            </a>
            <p>Hệ thống quản lý thư viện</p>
        </div>

        <h3>Tạo tài khoản mới</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger" style="margin-bottom:14px;font-size:14px;">
                <i class="fa fa-exclamation-circle" style="margin-right:6px;"></i><?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="register.php<?= $next !== '' ? '?next=' . urlencode($next) : '' ?>">
            <input type="hidden" name="next" value="<?= htmlspecialchars($next) ?>">

            <!-- Hàng 1: Họ tên + Tên đăng nhập -->
            <div class="form-row">
                <div class="form-group">
                    <label for="ho_ten">Họ và tên <span style="color:var(--accent);">*</span></label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input type="text" class="form-control" id="ho_ten" name="ho_ten"
                               placeholder="Nguyễn Văn A"
                               value="<?= htmlspecialchars($_POST['ho_ten'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ten_dang_nhap">Tên đăng nhập <span style="color:var(--accent);">*</span></label>
                    <div class="input-icon">
                        <i class="fa fa-at"></i>
                        <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap"
                               placeholder="username123"
                               value="<?= htmlspecialchars($_POST['ten_dang_nhap'] ?? '') ?>" required>
                    </div>
                </div>
            </div>

            <!-- Hàng 2: Email + SĐT -->
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-icon">
                        <i class="fa fa-envelope-o"></i>
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="example@email.com"
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="so_dien_thoai">Số điện thoại</label>
                    <div class="input-icon">
                        <i class="fa fa-phone"></i>
                        <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                               placeholder="0912 345 678"
                               value="<?= htmlspecialchars($_POST['so_dien_thoai'] ?? '') ?>">
                    </div>
                </div>
            </div>

            <!-- Hàng 3: Mật khẩu + Xác nhận -->
            <div class="form-row">
                <div class="form-group">
                    <label for="mat_khau">Mật khẩu <span style="color:var(--accent);">*</span></label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" id="mat_khau" name="mat_khau"
                               placeholder="Tối thiểu 4 ký tự" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="xac_nhan_mat_khau">Xác nhận mật khẩu <span style="color:var(--accent);">*</span></label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" id="xac_nhan_mat_khau" name="xac_nhan_mat_khau"
                               placeholder="Nhập lại mật khẩu" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="tg-btn btn-block" style="margin-top:10px;">
                <i class="fa fa-user-plus"></i> Tạo tài khoản
            </button>
        </form>

        <div class="auth-divider"><span>Đã có tài khoản?</span></div>

        <a href="login.php<?= $next !== '' ? '?next=' . urlencode($next) : '' ?>" class="btn btn-secondary btn-block">
            <i class="fa fa-sign-in"></i> Đăng nhập ngay
        </a>

        <div style="text-align:center;margin-top:20px;">
            <a href="index.php" style="font-size:13px;color:var(--text-muted);">
                <i class="fa fa-arrow-left" style="margin-right:4px;"></i>Quay về trang chủ
            </a>
        </div>
    </div>

</div>

<script src="js/vendor/jquery-library.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
</body>
</html>