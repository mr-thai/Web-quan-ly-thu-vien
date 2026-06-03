<?php
/* ===== TRANG LỊCH SỬ MƯỢN TRẢ ADMIN START ===== */
require_once __DIR__ . "/app/config.php";

$page     = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$per_page = 20;
$offset   = ($page - 1) * $per_page;

$search     = isset($_GET['search']) ? trim($_GET['search']) : '';
$filter_tt  = isset($_GET['trang_thai']) ? $_GET['trang_thai'] : '';

$where_parts = [];
$params      = [];
$types       = '';

if ($search !== '') {
    $like = "%$search%";
    $where_parts[] = "(nd.ho_ten LIKE ? OR s.ten_sach LIKE ? OR nd.so_dien_thoai LIKE ?)";
    $params[] = $like; $params[] = $like; $params[] = $like;
    $types   .= 'sss';
}
if ($filter_tt !== '') {
    $where_parts[] = "ctpm.trang_thai = ?";
    $params[] = $filter_tt;
    $types   .= 's';
}

$where_sql = $where_parts ? 'WHERE ' . implode(' AND ', $where_parts) : '';

$sql_count = "SELECT COUNT(*) AS tong
              FROM chi_tiet_phieu_muon ctpm
              JOIN phieu_muon pm ON ctpm.ma_phieu_muon = pm.ma_phieu_muon
              JOIN nguoi_dung nd ON pm.ma_nguoi_dung = nd.ma_nguoi_dung
              JOIN sach s ON ctpm.ma_sach = s.ma_sach
              $where_sql";

$total_rows = 0;
if ($stmt = $conn->prepare($sql_count)) {
    if ($types) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $total_rows = (int)($stmt->get_result()->fetch_assoc()['tong'] ?? 0);
    $stmt->close();
}
$total_pages = max(1, (int)ceil($total_rows / $per_page));

$sql_data = "SELECT ctpm.ma_chi_tiet_phieu, ctpm.ma_phieu_muon, nd.ho_ten, nd.so_dien_thoai,
                    s.ten_sach, pm.ngay_muon, pm.ngay_hen_tra,
                    ctpm.ngay_tra_thuc_te, ctpm.trang_thai, ctpm.ghi_chu_tinh_trang
             FROM chi_tiet_phieu_muon ctpm
             JOIN phieu_muon pm ON ctpm.ma_phieu_muon = pm.ma_phieu_muon
             JOIN nguoi_dung nd ON pm.ma_nguoi_dung = nd.ma_nguoi_dung
             JOIN sach s ON ctpm.ma_sach = s.ma_sach
             $where_sql
             ORDER BY pm.ngay_muon DESC
             LIMIT ? OFFSET ?";

$rows = [];
$all_params   = array_merge($params, [$per_page, $offset]);
$all_types    = $types . 'ii';
if ($stmt = $conn->prepare($sql_data)) {
    $stmt->bind_param($all_types, ...$all_params);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    $stmt->close();
}

function lichsu_badge($tt) {
    $map = [
        'dang_muon'   => ['badge-info',    'Đang mượn'],
        'da_tra'      => ['badge-success', 'Đã trả'],
        'tra_tre_han' => ['badge-warning', 'Trễ hạn'],
        'hu_hong'     => ['badge-danger',  'Hư hỏng'],
        'mat_sach'    => ['badge-danger',  'Mất sách'],
    ];
    return $map[$tt] ?? ['badge-secondary', $tt];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lịch sử mượn trả - Manlib Admin</title>
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
                        <i class="fas fa-history mr-2" style="color:var(--adm-primary);"></i>Lịch sử mượn trả
                    </h1>
                    <span class="text-muted" style="font-size:14px;">Tổng cộng: <strong><?= $total_rows ?></strong> bản ghi</span>
                </div>
                <!-- TIÊU ĐỀ TRANG END -->

                <!-- BỘ LỌC START -->
                <div class="card shadow mb-4">
                    <div class="card-body py-3">
                        <form method="get" class="form-inline" style="gap:12px;flex-wrap:wrap;">
                            <div style="display:flex;align-items:center;gap:8px;flex:1;min-width:200px;">
                                <label style="margin:0;white-space:nowrap;">Tìm kiếm:</label>
                                <input type="text" name="search" class="form-control form-control-sm" style="flex:1;"
                                       placeholder="Tên độc giả, tên sách, SĐT..." value="<?= htmlspecialchars($search) ?>">
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <label style="margin:0;white-space:nowrap;">Trạng thái:</label>
                                <select name="trang_thai" class="form-control form-control-sm">
                                    <option value="">Tất cả</option>
                                    <option value="dang_muon"   <?= $filter_tt === 'dang_muon'   ? 'selected' : '' ?>>Đang mượn</option>
                                    <option value="da_tra"      <?= $filter_tt === 'da_tra'      ? 'selected' : '' ?>>Đã trả</option>
                                    <option value="tra_tre_han" <?= $filter_tt === 'tra_tre_han' ? 'selected' : '' ?>>Trễ hạn</option>
                                    <option value="hu_hong"     <?= $filter_tt === 'hu_hong'     ? 'selected' : '' ?>>Hư hỏng</option>
                                    <option value="mat_sach"    <?= $filter_tt === 'mat_sach'    ? 'selected' : '' ?>>Mất sách</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-search mr-1"></i> Lọc
                            </button>
                            <?php if ($search || $filter_tt): ?>
                            <a href="lichsumuon.php" class="btn btn-secondary btn-sm">
                                <i class="fas fa-times mr-1"></i> Xóa lọc
                            </a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
                <!-- BỘ LỌC END -->

                <!-- BẢNG DỮ LIỆU START -->
                <div class="card shadow mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Độc giả</th>
                                        <th>SĐT</th>
                                        <th>Tên sách</th>
                                        <th>Ngày mượn</th>
                                        <th>Hạn trả</th>
                                        <th>Ngày trả thực tế</th>
                                        <th>Trạng thái</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($rows)): ?>
                                    <tr>
                                        <td colspan="9" class="text-center py-4" style="color:var(--adm-muted);">
                                            <i class="fas fa-search" style="font-size:24px;opacity:0.3;display:block;margin-bottom:8px;"></i>
                                            Không tìm thấy bản ghi nào.
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                    <?php foreach ($rows as $i => $row):
                                        list($badge_class, $badge_label) = lichsu_badge($row['trang_thai']);
                                        $ngay_muon  = $row['ngay_muon']  ? date('d/m/Y', strtotime($row['ngay_muon']))  : '--';
                                        $ngay_hen   = $row['ngay_hen_tra'] ? date('d/m/Y', strtotime($row['ngay_hen_tra'])) : '--';
                                        $ngay_tra   = $row['ngay_tra_thuc_te'] ? date('d/m/Y', strtotime($row['ngay_tra_thuc_te'])) : '--';
                                        $is_overdue = ($row['trang_thai'] === 'dang_muon' && $row['ngay_hen_tra'] && strtotime($row['ngay_hen_tra']) < time());
                                    ?>
                                    <tr <?= $is_overdue ? 'style="background:rgba(192,57,43,0.04);"' : '' ?>>
                                        <td style="font-size:12px;color:var(--adm-muted);">#<?= $row['ma_phieu_muon'] ?></td>
                                        <td><strong><?= htmlspecialchars($row['ho_ten']) ?></strong></td>
                                        <td style="font-size:13px;"><?= htmlspecialchars($row['so_dien_thoai']) ?></td>
                                        <td style="max-width:180px;">
                                            <span style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;font-size:13px;">
                                                <?= htmlspecialchars($row['ten_sach']) ?>
                                            </span>
                                        </td>
                                        <td style="font-size:13px;white-space:nowrap;"><?= $ngay_muon ?></td>
                                        <td style="font-size:13px;white-space:nowrap;<?= $is_overdue ? 'color:var(--adm-accent);font-weight:700;' : '' ?>"><?= $ngay_hen ?></td>
                                        <td style="font-size:13px;white-space:nowrap;"><?= $ngay_tra ?></td>
                                        <td><span class="badge <?= $badge_class ?>"><?= $badge_label ?></span></td>
                                        <td style="font-size:12px;color:var(--adm-muted);max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?= htmlspecialchars($row['ghi_chu_tinh_trang'] ?? '') ?>">
                                            <?= htmlspecialchars($row['ghi_chu_tinh_trang'] ?? '--') ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- BẢNG DỮ LIỆU END -->

                <!-- PHÂN TRANG START -->
                <?php if ($total_pages > 1): ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>&trang_thai=<?= urlencode($filter_tt) ?>">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php for ($p = max(1, $page - 2); $p <= min($total_pages, $page + 2); $p++): ?>
                        <li class="page-item <?= $p === $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $p ?>&search=<?= urlencode($search) ?>&trang_thai=<?= urlencode($filter_tt) ?>"><?= $p ?></a>
                        </li>
                        <?php endfor; ?>
                        <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>&trang_thai=<?= urlencode($filter_tt) ?>">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>
                <!-- PHÂN TRANG END -->

            </div>
        </div>
        <?php include "app/view/include/footer.php"; ?>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
<?php /* ===== TRANG LỊCH SỬ MƯỢN TRẢ ADMIN END ===== */ ?>
