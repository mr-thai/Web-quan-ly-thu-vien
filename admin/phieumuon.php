<?php 
    require_once "../processing/config.php"; 
    require_once "../processing/xulyphieumuon.php";

    function to_datetime_local($value) {
        if (!$value || $value === '0000-00-00 00:00:00' || $value === '1000-01-01 00:00:00') {
            return '';
        }
        return date('Y-m-d\TH:i', strtotime($value));
    }

    function to_datetime_display($value) {
        if (!$value || $value === '0000-00-00 00:00:00' || $value === '1000-01-01 00:00:00') {
            return '--';
        }
        return date('d/m/Y H:i', strtotime($value));
    }
?>




<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="utf-7">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bảng điều khiển SB Admin 2</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">Quản lý library</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Bảng điều khiển</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Giao diện
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Dữ liệu</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Thành phần tùy chỉnh:</h6>
                        <a class="collapse-item" href="nguoidung.php">Người dùng</a>
                        <a class="collapse-item" href="sach.php">Sách</a>
                        <a class="collapse-item" href="tacgia.php">Tác giả</a>
                        <a class="collapse-item" href="theloai.php">Thể loại</a>
                        <a class="collapse-item" href="phieumuon.php">Phiếu mượn</a>
                        <a class="collapse-item" href="thongtinphat.php">Thông tin phạt</a>
                        <a class="collapse-item" href="cards.html">Thẻ</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Tiện ích</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tiện ích tùy chỉnh:</h6>
                        <a class="collapse-item" href="utilities-color.html">Màu sắc</a>
                        <a class="collapse-item" href="utilities-border.html">Viền</a>
                        <a class="collapse-item" href="utilities-animation.html">Hoạt hình</a>
                        <a class="collapse-item" href="utilities-other.html">Khác</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Tiện ích bổ sung
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Trang</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Màn hình đăng nhập:</h6>
                        <a class="collapse-item" href="login.html">Đăng nhập</a>
                        <a class="collapse-item" href="register.html">Đăng ký</a>
                        <a class="collapse-item" href="forgot-password.html">Quên mật khẩu</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Các trang khác:</h6>
                        <a class="collapse-item" href="404.html">Trang 404</a>
                        <a class="collapse-item" href="blank.html">Trang trống</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Biểu đồ</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Bảng</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Tìm kiếm..."
                                aria-label="Tìm kiếm" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Tìm kiếm..." aria-label="Tìm kiếm"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Trung tâm cảnh báo
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">12 tháng 12, 2019</div>
                                        <span class="font-weight-bold">Một báo cáo hàng tháng mới đã sẵn sàng để tải xuống!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">7 tháng 12, 2019</div>
                                        $290.29 đã được gửi vào tài khoản của bạn!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">2 tháng 12, 2019</div>
                                        Cảnh báo chi tiêu: Chúng tôi nhận thấy chi tiêu bất thường cao cho tài khoản của bạn.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Hiển thị tất cả cảnh báo</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Trung tâm tin nhắn
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Xin chào! Tôi đang tự hỏi liệu bạn có thể giúp tôi với một vấn đề mà tôi đang gặp phải.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58p</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Tôi có những bức ảnh mà bạn đã đặt hàng tháng trước, bạn muốn chúng được gửi như thế nào?</div>
                                        <div class="small text-gray-500">Jae Chun · 1n</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Báo cáo tháng trước trông tuyệt vời, tôi rất hài lòng với tiến độ cho đến nay, hãy tiếp tục công việc tốt!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2n</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Tôi có phải là một chú chó ngoan không? Lý do tôi hỏi là vì ai đó nói với tôi rằng mọi người nói điều này với tất cả các chú chó, ngay cả khi chúng không ngoan...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2t</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Đọc thêm tin nhắn</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Hồ sơ
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cài đặt
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Nhật ký hoạt động
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php if (!empty($message)): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($message); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Quản lý phiếu mượn</h1>
                        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addLoanModal">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Tạo phiếu mượn
                        </button>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <form class="form-inline" method="GET" action="phieumuon.php">
                                <input type="text" name="keyword" class="form-control mr-2 mb-2" placeholder="Tìm theo ID, tài khoản hoặc tên" value="<?php echo htmlspecialchars($keyword); ?>">
                                <select name="status" class="form-control mr-2 mb-2">
                                    <option value="" <?php echo $status_filter === '' ? 'selected' : ''; ?>>Tất cả trạng thái</option>
                                    <option value="dang_muon" <?php echo $status_filter === 'dang_muon' ? 'selected' : ''; ?>>Đang mượn</option>
                                    <option value="tre_han" <?php echo $status_filter === 'tre_han' ? 'selected' : ''; ?>>Trễ hạn</option>
                                    <option value="da_tra" <?php echo $status_filter === 'da_tra' ? 'selected' : ''; ?>>Đã trả</option>
                                </select>
                                <button class="btn btn-primary mr-2 mb-2" type="submit">
                                    <i class="fas fa-search fa-sm"></i> Lọc
                                </button>
                                <a href="phieumuon.php" class="btn btn-secondary mb-2">Đặt lại</a>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID phiếu</th>
                                            <th>Người mượn</th>
                                            <th>Ngày mượn</th>
                                            <th>Ngày hẹn trả</th>
                                            <th>Ngày trả</th>
                                            <th>Tổng sách</th>
                                            <th>Trạng thái</th>
                                            <th>Tiền phạt</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $loan_modals = array(); ?>
                                        <?php if (!empty($phieu_muon_list)): ?>
                                            <?php foreach ($phieu_muon_list as $phieu): ?>
                                                <?php
                                                    $id_pm = (int)$phieu['id_phieu_muon'];
                                                    $trang_thai = 'dang_muon';
                                                    if (!empty($phieu['ngay_tra'])) {
                                                        $trang_thai = 'da_tra';
                                                    } elseif (strtotime($phieu['ngay_hen_tra']) < time()) {
                                                        $trang_thai = 'tre_han';
                                                    }

                                                    $trang_thai_text = 'Đang mượn';
                                                    $trang_thai_badge = 'badge-primary';

                                                    if ($trang_thai === 'da_tra') {
                                                        $trang_thai_text = 'Đã trả';
                                                        $trang_thai_badge = 'badge-success';
                                                    } elseif ($trang_thai === 'tre_han') {
                                                        $trang_thai_text = 'Trễ hạn';
                                                        $trang_thai_badge = 'badge-danger';
                                                    }

                                                    $chi_tiet_list = $chi_tiet_by_phieu[$id_pm] ?? array();
                                                ?>
                                                <tr>
                                                    <td><?php echo $id_pm; ?></td>
                                                    <td>
                                                        <div class="font-weight-bold"><?php echo htmlspecialchars($phieu['ho_ten']); ?></div>
                                                        <small class="text-muted">@<?php echo htmlspecialchars($phieu['ten_dang_nhap']); ?></small>
                                                    </td>
                                                    <td><?php echo to_datetime_display($phieu['ngay_muon']); ?></td>
                                                    <td><?php echo to_datetime_display($phieu['ngay_hen_tra']); ?></td>
                                                    <td><?php echo to_datetime_display($phieu['ngay_tra']); ?></td>
                                                    <td><?php echo (int)$phieu['tong_so_sach']; ?></td>
                                                    <td><span class="badge <?php echo $trang_thai_badge; ?>"><?php echo $trang_thai_text; ?></span></td>
                                                    <td><?php echo number_format((float)$phieu['tong_tien_phat'], 0, ',', '.'); ?> đ</td>
                                                    <td class="text-nowrap">
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal-<?php echo $id_pm; ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editLoanModal-<?php echo $id_pm; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <?php if ($trang_thai !== 'da_tra'): ?>
                                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#returnLoanModal-<?php echo $id_pm; ?>">
                                                                <i class="fas fa-undo"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                        <a href="phieumuon.php?delete_id=<?php echo $id_pm; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa phiếu mượn này?');">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <?php ob_start(); ?>

                                                <div class="modal fade" id="detailModal-<?php echo $id_pm; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Chi tiết phiếu mượn #<?php echo $id_pm; ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="mb-2"><strong>Người mượn:</strong> <?php echo htmlspecialchars($phieu['ho_ten']); ?> (@<?php echo htmlspecialchars($phieu['ten_dang_nhap']); ?>)</p>
                                                                <p class="mb-3"><strong>Ghi chú:</strong> <?php echo htmlspecialchars($phieu['ghi_chu'] ?: 'Không có'); ?></p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-sm table-bordered mb-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Mã sách</th>
                                                                                <th>Tên sách</th>
                                                                                <th>Số lượng</th>
                                                                                <th>Giá lúc mượn</th>
                                                                                <th>Trạng thái</th>
                                                                                <th>Ngày trả thực tế</th>
                                                                                <th>Tiền phạt</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php if (!empty($chi_tiet_list)): ?>
                                                                                <?php foreach ($chi_tiet_list as $ct): ?>
                                                                                    <?php
                                                                                        $ct_status = $ct['trang_thai'];
                                                                                        $ct_text = 'Đang mượn';
                                                                                        if ($ct_status === 'da_tra') {
                                                                                            $ct_text = 'Đã trả';
                                                                                        } elseif ($ct_status === 'tre_han') {
                                                                                            $ct_text = 'Trễ hạn';
                                                                                        } elseif ($ct_status === 'mat_sach') {
                                                                                            $ct_text = 'Mất sách';
                                                                                        }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?php echo htmlspecialchars($ct['ma_sach']); ?></td>
                                                                                        <td><?php echo htmlspecialchars($ct['ten_sach'] ?: 'Không xác định'); ?></td>
                                                                                        <td><?php echo (int)$ct['So_Luong']; ?></td>
                                                                                        <td><?php echo number_format((float)$ct['gia_sach_luc_muon'], 0, ',', '.'); ?> đ</td>
                                                                                        <td><?php echo $ct_text; ?></td>
                                                                                        <td><?php echo to_datetime_display($ct['ngay_tra_thuc_te']); ?></td>
                                                                                        <td><?php echo number_format((float)$ct['tien_phat'], 0, ',', '.'); ?> đ</td>
                                                                                    </tr>
                                                                                <?php endforeach; ?>
                                                                            <?php else: ?>
                                                                                <tr>
                                                                                    <td colspan="7" class="text-center">Không có dữ liệu chi tiết.</td>
                                                                                </tr>
                                                                            <?php endif; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="editLoanModal-<?php echo $id_pm; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="POST" action="phieumuon.php">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Cập nhật phiếu mượn #<?php echo $id_pm; ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="action" value="edit">
                                                                    <input type="hidden" name="id_phieu_muon" value="<?php echo $id_pm; ?>">

                                                                    <div class="form-group">
                                                                        <label>Người mượn</label>
                                                                        <select name="id_nguoi_dung" class="form-control" required>
                                                                            <?php foreach ($nguoi_dung_list as $nguoi_dung): ?>
                                                                                <option value="<?php echo (int)$nguoi_dung['id_nguoi_dung']; ?>" <?php echo (int)$nguoi_dung['id_nguoi_dung'] === (int)$phieu['id_nguoi_dung'] ? 'selected' : ''; ?>>
                                                                                    <?php echo htmlspecialchars($nguoi_dung['ho_ten'] . ' (@' . $nguoi_dung['ten_dang_nhap'] . ')'); ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Ngày mượn</label>
                                                                        <input type="datetime-local" name="ngay_muon" class="form-control" required value="<?php echo to_datetime_local($phieu['ngay_muon']); ?>">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Ngày hẹn trả</label>
                                                                        <input type="datetime-local" name="ngay_hen_tra" class="form-control" required value="<?php echo to_datetime_local($phieu['ngay_hen_tra']); ?>">
                                                                    </div>

                                                                    <div class="form-group mb-0">
                                                                        <label>Ghi chú</label>
                                                                        <textarea name="ghi_chu" class="form-control" rows="3"><?php echo htmlspecialchars($phieu['ghi_chu']); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if ($trang_thai !== 'da_tra'): ?>
                                                    <div class="modal fade" id="returnLoanModal-<?php echo $id_pm; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" action="phieumuon.php">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Trả sách phiếu #<?php echo $id_pm; ?></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="action" value="return">
                                                                        <input type="hidden" name="id_phieu_muon" value="<?php echo $id_pm; ?>">

                                                                        <p class="mb-2"><strong>Người mượn:</strong> <?php echo htmlspecialchars($phieu['ho_ten']); ?></p>
                                                                        <p class="mb-3"><strong>Ngày hẹn trả:</strong> <?php echo to_datetime_display($phieu['ngay_hen_tra']); ?></p>

                                                                        <div class="form-group mb-0">
                                                                            <label>Ngày trả thực tế</label>
                                                                            <input type="datetime-local" name="ngay_tra" class="form-control" required value="<?php echo date('Y-m-d\TH:i'); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                                        <button type="submit" class="btn btn-success">Xác nhận trả sách</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <?php $loan_modals[] = ob_get_clean(); ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="9" class="text-center">Không có phiếu mượn nào.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if (!empty($loan_modals)): ?>
                                <?php echo implode("\n", $loan_modals); ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="modal fade" id="addLoanModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form method="POST" action="phieumuon.php">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tạo phiếu mượn mới</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="action" value="add">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Người mượn</label>
                                                <select name="id_nguoi_dung" class="form-control" required>
                                                    <option value="">-- Chọn người dùng --</option>
                                                    <?php foreach ($nguoi_dung_list as $nguoi_dung): ?>
                                                        <option value="<?php echo (int)$nguoi_dung['id_nguoi_dung']; ?>">
                                                            <?php echo htmlspecialchars($nguoi_dung['ho_ten'] . ' (@' . $nguoi_dung['ten_dang_nhap'] . ')'); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label>Ngày mượn</label>
                                                <input type="datetime-local" name="ngay_muon" class="form-control" required value="<?php echo date('Y-m-d\TH:i'); ?>">
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label>Ngày hẹn trả</label>
                                                <input type="datetime-local" name="ngay_hen_tra" class="form-control" required value="<?php echo date('Y-m-d\TH:i', strtotime('+14 days')); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Ghi chú</label>
                                            <textarea name="ghi_chu" class="form-control" rows="2" placeholder="Ghi chú thêm (nếu có)"></textarea>
                                        </div>

                                        <hr>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <h6 class="mb-0">Danh sách sách mượn</h6>
                                            <button type="button" class="btn btn-outline-primary btn-sm" id="addBookRow">
                                                <i class="fas fa-plus"></i> Thêm dòng sách
                                            </button>
                                        </div>

                                        <div id="bookRows">
                                            <div class="form-row align-items-center borrow-book-row">
                                                <div class="col-md-8 mb-2">
                                                    <select name="ma_sach[]" class="form-control" required>
                                                        <option value="">-- Chọn sách --</option>
                                                        <?php foreach ($sach_list as $sach): ?>
                                                            <option value="<?php echo htmlspecialchars($sach['ma_sach']); ?>" <?php echo (int)$sach['so_luong_con'] <= 0 ? 'disabled' : ''; ?>>
                                                                <?php echo htmlspecialchars($sach['ma_sach'] . ' - ' . $sach['ten_sach'] . ' (Còn: ' . (int)$sach['so_luong_con'] . ')'); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <input type="number" min="1" name="so_luong[]" class="form-control" required value="1">
                                                </div>
                                                <div class="col-md-1 mb-2 text-right">
                                                    <button type="button" class="btn btn-outline-danger btn-sm btn-remove-book">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="bookRowTemplate" class="d-none">
                                            <div class="form-row align-items-center borrow-book-row mt-2">
                                                <div class="col-md-8 mb-2">
                                                    <select name="ma_sach[]" class="form-control" required>
                                                        <option value="">-- Chọn sách --</option>
                                                        <?php foreach ($sach_list as $sach): ?>
                                                            <option value="<?php echo htmlspecialchars($sach['ma_sach']); ?>" <?php echo (int)$sach['so_luong_con'] <= 0 ? 'disabled' : ''; ?>>
                                                                <?php echo htmlspecialchars($sach['ma_sach'] . ' - ' . $sach['ten_sach'] . ' (Còn: ' . (int)$sach['so_luong_con'] . ')'); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <input type="number" min="1" name="so_luong[]" class="form-control" required value="1">
                                                </div>
                                                <div class="col-md-1 mb-2 text-right">
                                                    <button type="button" class="btn btn-outline-danger btn-sm btn-remove-book">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary">Tạo phiếu mượn</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Bản quyền &copy; Trang web của bạn 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng rời đi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn đã sẵn sàng kết thúc phiên hiện tại của mình.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <a class="btn btn-primary" href="login.html">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>
        (function () {
            var bookRows = document.getElementById('bookRows');
            var template = document.getElementById('bookRowTemplate');
            var addButton = document.getElementById('addBookRow');

            if (!bookRows || !template || !addButton) {
                return;
            }

            function refreshRemoveButtons() {
                var rows = bookRows.querySelectorAll('.borrow-book-row');

                for (var i = 0; i < rows.length; i++) {
                    var btn = rows[i].querySelector('.btn-remove-book');
                    if (btn) {
                        btn.disabled = rows.length === 1;
                    }
                }
            }

            addButton.addEventListener('click', function () {
                var wrapper = document.createElement('div');
                wrapper.innerHTML = template.innerHTML.trim();
                if (wrapper.firstElementChild) {
                    bookRows.appendChild(wrapper.firstElementChild);
                    refreshRemoveButtons();
                }
            });

            bookRows.addEventListener('click', function (event) {
                var button = event.target.closest('.btn-remove-book');
                if (!button) {
                    return;
                }

                var row = button.closest('.borrow-book-row');
                if (row) {
                    row.remove();
                    refreshRemoveButtons();
                }
            });

            refreshRemoveButtons();
        })();
    </script>

</body>

</html>