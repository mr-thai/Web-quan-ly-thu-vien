<?php
require_once __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/controller/control_logic_login.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <img src="images/logo.png" alt="logo" class="img-responsive center-block">
                        <h3 class="panel-title">Đăng nhập hệ thống</h3>
                        <p class="text-muted">Sử dụng tài khoản thư viện của bạn để tiếp tục.</p>
                    </div>
                    <div class="panel-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                        <?php endif; ?>

                        <?php if (isset($_GET['registered'])): ?>
                            <div class="alert alert-success">Đăng ký thành công. Vui lòng đăng nhập bằng tài khoản vừa tạo.</div>
                        <?php endif; ?>

                        <form method="post" action="login.php<?php echo $next !== '' ? '?next=' . urlencode($next) : ''; ?>">
                            <input type="hidden" name="next" value="<?php echo htmlspecialchars($next); ?>">
                            <div class="form-group">
                                <label for="identifier">Tên đăng nhập hoặc email</label>
                                <input type="text" class="form-control" id="identifier" name="identifier" placeholder="Nhập tên đăng nhập hoặc email" value="<?php echo htmlspecialchars($_POST['identifier'] ?? ''); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </form>

                        <hr>
                        <div class="text-center">
                            <p class="text-muted">Chưa có tài khoản?</p>
                            <a href="register.php<?php echo $next !== '' ? '?next=' . urlencode($next) : ''; ?>" class="btn btn-default btn-block">Tạo tài khoản mới</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>