<?php
require_once __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/controller/control_logic_login.php';

$next = isset($_GET['next']) ? $_GET['next'] : '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập - Manlib</title>
    <meta name="description" content="Đăng nhập vào hệ thống thư viện Manlib để mượn và quản lý sách.">
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
            max-width: 900px;
            min-height: 540px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(139,94,60,0.2);
        }
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
            content: '\f518';
            font-family: FontAwesome;
            position: absolute;
            right: -30px; bottom: -30px;
            font-size: 200px;
            color: rgba(255,255,255,0.06);
            line-height: 1;
        }
        .auth-left h2 { color: white; font-size: 28px; margin-bottom: 12px; }
        .auth-left p { color: rgba(255,255,255,0.75); font-size: 15px; line-height: 1.7; margin-bottom: 28px; }
        .auth-left ul { list-style: none; padding: 0; margin: 0; }
        .auth-left ul li { color: rgba(255,255,255,0.85); font-size: 14px; margin-bottom: 12px; display: flex; align-items: center; gap: 10px; }
        .auth-left ul li i { color: var(--gold); }

        .auth-right {
            background: white;
            padding: 48px 44px;
            width: 420px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .auth-logo { text-align: center; margin-bottom: 28px; }
        /* Deleted old auth logo styles */
        .auth-logo p { color: var(--text-muted); font-size: 14px; margin-top: 6px; margin-bottom: 0; }

        .auth-right h3 { font-size: 20px; font-weight: 700; color: var(--text-main); margin-bottom: 24px; }

        .form-group label { font-size: 13px; font-weight: 600; color: var(--text-main); margin-bottom: 6px; display: block; }

        .btn-block { width: 100%; margin-top: 4px; padding: 12px !important; font-size: 15px !important; border-radius: 10px !important; }

        .auth-divider { display: flex; align-items: center; gap: 12px; margin: 20px 0; }
        .auth-divider::before, .auth-divider::after { content: ''; flex: 1; height: 1px; background: var(--border-color); }
        .auth-divider span { font-size: 13px; color: var(--text-muted); }

        @media (max-width: 640px) {
            .auth-wrapper { flex-direction: column; }
            .auth-left { display: none; }
            .auth-right { width: 100%; padding: 32px 24px; }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">

    <!-- Bên trái: Giới thiệu -->
    <div class="auth-left">
        <div style="position:relative;z-index:1;">
            <div style="margin-bottom:32px;">
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
            <h2>Chào mừng trở lại!</h2>
            <p>Đăng nhập để tiếp tục khám phá kho sách phong phú và quản lý sách mượn của bạn.</p>
            <ul>
                <li><i class="fa fa-book"></i> Mượn sách trực tuyến dễ dàng</li>
                <li><i class="fa fa-clock-o"></i> Theo dõi thời hạn trả sách</li>
                <li><i class="fa fa-search"></i> Tìm kiếm nhanh theo tên, tác giả</li>
                <li><i class="fa fa-history"></i> Xem lịch sử mượn sách</li>
            </ul>
        </div>
    </div>

    <!-- Bên phải: Form đăng nhập -->
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

        <h3>Đăng nhập</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger" style="margin-bottom:16px;">
                <i class="fa fa-exclamation-circle" style="margin-right:6px;"></i><?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['registered'])): ?>
            <div class="alert alert-success" style="margin-bottom:16px;">
                <i class="fa fa-check-circle" style="margin-right:6px;"></i>Đăng ký thành công! Vui lòng đăng nhập.
            </div>
        <?php endif; ?>

        <form method="post" action="login.php<?= $next !== '' ? '?next=' . urlencode($next) : '' ?>">
            <input type="hidden" name="next" value="<?= htmlspecialchars($next) ?>">

            <div class="form-group">
                <label for="email">Tên đăng nhập hoặc email</label>
                <div style="position:relative;">
                    <input type="text" class="form-control" id="email" name="email"
                           placeholder="Nhập tên đăng nhập hoặc email"
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required
                           style="padding-left:42px!important;">
                    <i class="fa fa-user" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--text-muted);"></i>
                </div>
            </div>

            <div class="form-group" style="margin-top:16px;">
                <label for="password">Mật khẩu</label>
                <div style="position:relative;">
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Nhập mật khẩu" required
                           style="padding-left:42px!important;">
                    <i class="fa fa-lock" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--text-muted);"></i>
                </div>
            </div>

            <button type="submit" class="tg-btn btn-block" style="margin-top:24px;">
                <i class="fa fa-sign-in"></i> Đăng nhập
            </button>
        </form>

        <div class="auth-divider"><span>hoặc</span></div>

        <div style="text-align:center;">
            <p style="color:var(--text-muted);font-size:14px;margin-bottom:12px;">Chưa có tài khoản?</p>
            <a href="register.php<?= $next !== '' ? '?next=' . urlencode($next) : '' ?>" class="btn btn-secondary btn-block">
                <i class="fa fa-user-plus"></i> Tạo tài khoản mới
            </a>
        </div>

        <div style="text-align:center;margin-top:24px;">
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