<?php
require_once __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/controller/control_logic_register.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký</title>
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
            <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <img src="images/logo.png" alt="logo" class="img-responsive center-block">
                        <h3 class="panel-title">Tạo tài khoản mới</h3>
                        <p class="text-muted">Đăng ký để mượn sách và quản lý thông tin cá nhân.</p>
                    </div>
                    <div class="panel-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                        <?php endif; ?>

                        <form method="post" action="register.php<?php echo $next !== '' ? '?next=' . urlencode($next) : ''; ?>">
                            <input type="hidden" name="next" value="<?php echo htmlspecialchars($next); ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="ho_ten">Họ và tên</label>
                                        <input type="text" class="form-control" id="ho_ten" name="ho_ten" placeholder="Nhập họ và tên" value="<?php echo htmlspecialchars($_POST['ho_ten'] ?? ''); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="ten_dang_nhap">Tên đăng nhập</label>
                                        <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap" placeholder="Nhập tên đăng nhập" value="<?php echo htmlspecialchars($_POST['ten_dang_nhap'] ?? ''); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="so_dien_thoai">Số điện thoại</label>
                                        <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" placeholder="Nhập số điện thoại" value="<?php echo htmlspecialchars($_POST['so_dien_thoai'] ?? ''); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="mat_khau">Mật khẩu</label>
                                        <input type="password" class="form-control" id="mat_khau" name="mat_khau" placeholder="Nhập mật khẩu" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="xac_nhan_mat_khau">Xác nhận mật khẩu</label>
                                        <input type="password" class="form-control" id="xac_nhan_mat_khau" name="xac_nhan_mat_khau" placeholder="Nhập lại mật khẩu" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Đăng ký tài khoản</button>
                        </form>

                        <hr>
                        <div class="text-center">
                            <p class="text-muted">Đã có tài khoản?</p>
                            <a href="login.php<?php echo $next !== '' ? '?next=' . urlencode($next) : ''; ?>" class="btn btn-default btn-block">Quay lại đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>