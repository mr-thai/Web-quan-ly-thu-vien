<?php
/* ===== TRANG THỐNG KÊ ADMIN START ===== */
require_once __DIR__ . "/app/config.php";
require_once __DIR__ . "/app/model/model_thongke.php";

$year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

$dashboardStats    = thongke_get_dashboard_stats($conn);
$dashboardAreaChart = thongke_get_monthly_dashboard_data($conn, $year);
$dashboardPieChart  = thongke_get_fine_breakdown($conn);
$topReaders         = thongke_get_top_readers($conn);
$recentActivity     = thongke_get_recent_activity($conn);

$borrowedThisMonth  = $dashboardStats['borrowedThisMonth'];
$returnedThisMonth  = $dashboardStats['returnedThisMonth'];
$paidFinesThisMonth = $dashboardStats['paidFinesThisMonth'];
$unpaidFinesCount   = $dashboardStats['unpaidFinesCount'];

$totalSach = 0;
$resSach = $conn->query("SELECT COUNT(*) AS tong FROM sach");
if ($resSach) {
    $totalSach = (int)($resSach->fetch_assoc()['tong'] ?? 0);
}
$totalNguoiDung = 0;
$resND = $conn->query("SELECT COUNT(*) AS tong FROM nguoi_dung WHERE trang_thai = 1");
if ($resND) {
    $totalNguoiDung = (int)($resND->fetch_assoc()['tong'] ?? 0);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Thống kê - Manlib Admin</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/manlib-admin.css?v=3" rel="stylesheet">
</head>
<body id="page-top">
<div id="wrapper">

    <?php include "app/view/include/sidebar.php"; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include "app/view/include/topbar.php"; ?>

            <div class="container-fluid">

                <!-- TIÊU ĐỀ TRANG START -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-chart-bar mr-2" style="color:var(--adm-primary);"></i>Thống kê tổng quan
                    </h1>
                    <form method="get" class="d-flex align-items-center gap-2">
                        <label style="margin:0 8px 0 0;font-size:14px;">Năm:</label>
                        <select name="year" class="form-control form-control-sm" onchange="this.form.submit()" style="width:auto;">
                            <?php for ($y = (int)date('Y'); $y >= 2020; $y--): ?>
                                <option value="<?= $y ?>" <?= $y === $year ? 'selected' : '' ?>><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                    </form>
                </div>
                <!-- TIÊU ĐỀ TRANG END -->

                <!-- THẺ THỐNG KÊ START -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Mượn tháng này</div>
                                        <div class="h5 mb-0 font-weight-bold"><?= $borrowedThisMonth ?> cuốn</div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-book fa-2x" style="color:var(--adm-primary);opacity:0.3;"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Đã trả tháng này</div>
                                        <div class="h5 mb-0 font-weight-bold"><?= $returnedThisMonth ?> cuốn</div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-undo-alt fa-2x" style="color:var(--adm-secondary);opacity:0.3;"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Tổng sách trong kho</div>
                                        <div class="h5 mb-0 font-weight-bold"><?= $totalSach ?></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-book-open fa-2x" style="color:var(--adm-gold);opacity:0.3;"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Phạt chưa đóng</div>
                                        <div class="h5 mb-0 font-weight-bold"><?= $unpaidFinesCount ?> trường hợp</div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-exclamation-triangle fa-2x" style="color:var(--adm-accent);opacity:0.3;"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- THẺ THỐNG KÊ END -->

                <!-- BIỂU ĐỒ START -->
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold">Mượn & Trả theo tháng năm <?= $year ?></h6>
                            </div>
                            <div class="card-body">
                                <canvas id="borrowReturnChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold">Phân loại vi phạm</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="fineChart" height="160"></canvas>
                                <div class="mt-3">
                                    <?php $fineColors = ['#8B5E3C','#5C8A6E','#C0392B']; ?>
                                    <?php foreach ($dashboardPieChart['labels'] as $i => $label): ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <span style="width:14px;height:14px;border-radius:3px;background:<?= $fineColors[$i] ?>;display:inline-block;margin-right:10px;"></span>
                                        <span style="font-size:13px;flex:1;"><?= $label ?></span>
                                        <strong style="font-size:13px;"><?= number_format($dashboardPieChart['values'][$i], 0, ',', '.') ?>đ</strong>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BIỂU ĐỒ END -->

                <!-- ĐỌC GIẢ TÍCH CỰC START -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header"><h6 class="m-0 font-weight-bold">Đọc giả mượn nhiều nhất</h6></div>
                            <div class="card-body p-0">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Họ tên</th>
                                            <th>SĐT</th>
                                            <th class="text-center">Tổng mượn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($topReaders as $i => $reader): ?>
                                        <tr>
                                            <td><strong><?= $i + 1 ?></strong></td>
                                            <td><?= htmlspecialchars($reader['ho_ten']) ?></td>
                                            <td><?= htmlspecialchars($reader['so_dien_thoai']) ?></td>
                                            <td class="text-center"><span class="badge badge-primary"><?= (int)$reader['total_borrows'] ?> cuốn</span></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($topReaders)): ?>
                                        <tr><td colspan="4" class="text-center text-muted py-3">Chưa có dữ liệu</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header"><h6 class="m-0 font-weight-bold">Hoạt động gần đây</h6></div>
                            <div class="card-body p-0">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Độc giả</th>
                                            <th>Sách</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($recentActivity as $act):
                                            $badge = 'badge-info'; $label = 'Đang mượn';
                                            if ($act['trang_thai'] === 'da_tra')       { $badge = 'badge-success'; $label = 'Đã trả'; }
                                            elseif ($act['trang_thai'] === 'tra_tre_han') { $badge = 'badge-warning'; $label = 'Trễ hạn'; }
                                            elseif ($act['trang_thai'] === 'hu_hong')  { $badge = 'badge-danger';  $label = 'Hư hỏng'; }
                                        ?>
                                        <tr>
                                            <td style="max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= htmlspecialchars($act['ho_ten']) ?></td>
                                            <td style="max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-size:12px;"><?= htmlspecialchars($act['ten_sach']) ?></td>
                                            <td><span class="badge <?= $badge ?>"><?= $label ?></span></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($recentActivity)): ?>
                                        <tr><td colspan="3" class="text-center text-muted py-3">Chưa có hoạt động</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ĐỌC GIẢ TÍCH CỰC END -->

            </div>
        </div>
        <?php include "app/view/include/footer.php"; ?>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<script>
window.borrowData = <?= json_encode($dashboardAreaChart, JSON_UNESCAPED_UNICODE) ?>;
window.fineData   = <?= json_encode($dashboardPieChart,  JSON_UNESCAPED_UNICODE) ?>;
</script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script>
(function() {
    var ctx1 = document.getElementById('borrowReturnChart');
    if (ctx1 && window.borrowData) {
        new Chart(ctx1.getContext('2d'), {
            type: 'line',
            data: {
                labels: window.borrowData.labels,
                datasets: [
                    {
                        label: 'Mượn', data: window.borrowData.borrowed,
                        borderColor: '#8B5E3C', backgroundColor: 'rgba(139,94,60,0.08)',
                        borderWidth: 2, fill: true, tension: 0.4, pointRadius: 4,
                        pointBackgroundColor: '#8B5E3C'
                    },
                    {
                        label: 'Trả', data: window.borrowData.returned,
                        borderColor: '#5C8A6E', backgroundColor: 'rgba(92,138,110,0.08)',
                        borderWidth: 2, fill: true, tension: 0.4, pointRadius: 4,
                        pointBackgroundColor: '#5C8A6E'
                    }
                ]
            },
            options: {
                maintainAspectRatio: true, responsive: true,
                legend: { display: true, position: 'top' },
                scales: {
                    xAxes: [{ gridLines: { color: 'rgba(0,0,0,0.04)' } }],
                    yAxes: [{ ticks: { beginAtZero: true, stepSize: 1 }, gridLines: { color: 'rgba(0,0,0,0.04)' } }]
                }
            }
        });
    }

    var ctx2 = document.getElementById('fineChart');
    if (ctx2 && window.fineData) {
        new Chart(ctx2.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: window.fineData.labels,
                datasets: [{ data: window.fineData.values, backgroundColor: ['#8B5E3C','#5C8A6E','#C0392B'], borderWidth: 0 }]
            },
            options: {
                maintainAspectRatio: true, responsive: true,
                cutoutPercentage: 65,
                legend: { display: false }
            }
        });
    }
})();
</script>
</body>
</html>
<?php /* ===== TRANG THỐNG KÊ ADMIN END ===== */ ?>
