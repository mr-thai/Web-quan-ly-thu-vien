<?php /* ===== SIDEBAR ADMIN START ===== */
$sidebar_page = basename($_SERVER['PHP_SELF']);
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- LOGO / BRAND START -->
    <a class="sidebar-brand ml-logo" href="index.php">
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
    <!-- LOGO / BRAND END -->

    <hr class="sidebar-divider my-0">

    <!-- NAV: DASHBOARD START -->
    <li class="nav-item <?= $sidebar_page === 'index.php' ? 'active' : '' ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Bảng điều khiển</span>
        </a>
    </li>
    <!-- NAV: DASHBOARD END -->

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Mượn & Trả</div>

    <!-- NAV: TRẢ SÁCH START -->
    <li class="nav-item <?= $sidebar_page === 'trasach.php' ? 'active' : '' ?>">
        <a class="nav-link" href="trasach.php">
            <i class="fas fa-fw fa-undo-alt"></i>
            <span>Trả & Nạp phạt</span>
        </a>
    </li>
    <!-- NAV: TRẢ SÁCH END -->

    <!-- NAV: PHIẾU MƯỢN START -->
    <li class="nav-item <?= $sidebar_page === 'phieumuon.php' ? 'active' : '' ?>">
        <a class="nav-link" href="phieumuon.php">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Phiếu mượn</span>
        </a>
    </li>
    <!-- NAV: PHIẾU MƯỢN END -->

    <!-- NAV: NẠP PHẠT START -->
    <li class="nav-item <?= $sidebar_page === 'napphat.php' ? 'active' : '' ?>">
        <a class="nav-link" href="napphat.php">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Quản lý phạt</span>
        </a>
    </li>
    <!-- NAV: NẠP PHẠT END -->

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Quản lý dữ liệu</div>

    <!-- NAV: SÁCH START -->
    <li class="nav-item <?= $sidebar_page === 'sach.php' ? 'active' : '' ?>">
        <a class="nav-link" href="sach.php">
            <i class="fas fa-fw fa-book"></i>
            <span>Sách</span>
        </a>
    </li>
    <!-- NAV: SÁCH END -->

    <!-- NAV: TÁC GIẢ START -->
    <li class="nav-item <?= $sidebar_page === 'tacgia.php' ? 'active' : '' ?>">
        <a class="nav-link" href="tacgia.php">
            <i class="fas fa-fw fa-user-edit"></i>
            <span>Tác giả</span>
        </a>
    </li>
    <!-- NAV: TÁC GIẢ END -->

    <!-- NAV: NGƯỜI DÙNG START -->
    <li class="nav-item <?= $sidebar_page === 'nguoidung.php' ? 'active' : '' ?>">
        <a class="nav-link" href="nguoidung.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Người dùng</span>
        </a>
    </li>
    <!-- NAV: NGƯỜI DÙNG END -->

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Báo cáo</div>

    <!-- NAV: THỐNG KÊ START -->
    <li class="nav-item <?= $sidebar_page === 'thongke.php' ? 'active' : '' ?>">
        <a class="nav-link" href="thongke.php">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Thống kê</span>
        </a>
    </li>
    <!-- NAV: THỐNG KÊ END -->

    <!-- NAV: LỊCH SỬ MƯỢN START -->
    <li class="nav-item <?= $sidebar_page === 'lichsumuon.php' ? 'active' : '' ?>">
        <a class="nav-link" href="lichsumuon.php">
            <i class="fas fa-fw fa-history"></i>
            <span>Lịch sử mượn trả</span>
        </a>
    </li>
    <!-- NAV: LỊCH SỬ MƯỢN END -->

    <hr class="sidebar-divider">

    <!-- NAV: VỀ TRANG CHỦ START -->
    <li class="nav-item">
        <a class="nav-link" href="../index.php" target="_blank" style="opacity:0.7;">
            <i class="fas fa-fw fa-external-link-alt"></i>
            <span>Xem trang chủ</span>
        </a>
    </li>
    <!-- NAV: VỀ TRANG CHỦ END -->

    <hr class="sidebar-divider d-none d-md-block">


</ul>
<?php /* ===== SIDEBAR ADMIN END ===== */ ?>