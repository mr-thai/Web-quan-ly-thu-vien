<?php
require_once __DIR__ . "/app/config.php";
require_once __DIR__ . "/app/controller/control_tra_nap_helpers.php";

$message = '';
$msgType = 'success';

// Xử lý khi submit form trả sách
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'return_book') {
    $ma_chi_tiet_phieu = (int)($_POST['ma_chi_tiet_phieu'] ?? 0);
    $trang_thai = trim($_POST['trang_thai'] ?? 'da_tra');
    $so_tien_phat = (float)($_POST['so_tien_phat'] ?? 0);
    $gia_goc = (float)($_POST['gia_goc'] ?? 0);
    $ghi_chu = trim($_POST['ghi_chu'] ?? '');

    if ($ma_chi_tiet_phieu > 0) {
        $post_data = [
            'trang_thai_item' => [$ma_chi_tiet_phieu => $trang_thai],
            'so_tien_phat_item' => [$ma_chi_tiet_phieu => $so_tien_phat],
            'gia_goc_item' => [$ma_chi_tiet_phieu => $gia_goc]
        ];

        $result = process_return_items($conn, [$ma_chi_tiet_phieu], date('Y-m-d H:i:s'), $trang_thai, $ghi_chu, $post_data);
        
        if (!empty($result['error'])) {
            $message = $result['error'];
            $msgType = 'danger';
        } elseif (($result['updated_count'] ?? 0) > 0) {
            $message = 'Đã xử lý trả sách thành công!';
            $msgType = 'success';
        } else {
            $message = 'Không thể xử lý. Vui lòng kiểm tra lại.';
            $msgType = 'warning';
        }
    }
}

// Lấy danh sách sách đang mượn (Có tìm kiếm)
$search = trim($_GET['search'] ?? '');
$sql = "SELECT ct.ma_chi_tiet_phieu, ct.trang_thai, s.ma_sach, s.ten_sach, s.gia_sach, 
               pm.ma_phieu_muon, pm.ngay_muon, pm.ngay_hen_tra,
               nd.ho_ten, nd.so_dien_thoai
        FROM chi_tiet_phieu_muon ct
        JOIN phieu_muon pm ON ct.ma_phieu_muon = pm.ma_phieu_muon
        JOIN sach s ON ct.ma_sach = s.ma_sach
        JOIN nguoi_dung nd ON pm.ma_nguoi_dung = nd.ma_nguoi_dung
        WHERE ct.trang_thai = 'dang_muon' AND pm.trang_thai != 'da_tra'";

if ($search !== '') {
    $search_esc = $conn->real_escape_string($search);
    $sql .= " AND (nd.ho_ten LIKE '%$search_esc%' 
                OR nd.so_dien_thoai LIKE '%$search_esc%' 
                OR s.ten_sach LIKE '%$search_esc%' 
                OR pm.ma_phieu_muon = '$search_esc')";
}
$sql .= " ORDER BY pm.ngay_hen_tra ASC";

$rs = mysqli_query($conn, $sql);
$dang_muon = [];
$stats = ['total' => 0, 'late' => 0];

if ($rs) {
    while ($row = mysqli_fetch_assoc($rs)) {
        $dang_muon[] = $row;
        $stats['total']++;
        if (strtotime($row['ngay_hen_tra']) < time()) {
            $stats['late']++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Quầy trả sách - Manlib Admin">
    <title>Quầy Trả Sách - Manlib Admin</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/manlib-admin.css?v=3" rel="stylesheet">
    
    <style>
        .return-card {
            border: 1px solid var(--border-light);
            border-radius: var(--radius-lg);
            background: #fff;
            transition: all 0.3s;
            overflow: hidden;
            display: flex;
            box-shadow: var(--shadow-sm);
        }
        .return-card:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }
        .return-card__img {
            width: 100px;
            background: #f8f9fc;
            display: flex; align-items: center; justify-content: center;
            border-right: 1px solid var(--border-light);
        }
        .return-card__img img { max-width: 100%; max-height: 140px; object-fit: cover; }
        .return-card__body { padding: 16px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .return-card__title { font-size: 16px; font-weight: 700; color: var(--text-main); margin-bottom: 4px; }
        .return-card__user { font-size: 13px; color: var(--secondary); font-weight: 600; margin-bottom: 8px; }
        .return-card__meta { font-size: 12px; color: var(--text-muted); display: flex; gap: 12px; margin-bottom: 12px; }
        .return-card__meta span { display: flex; align-items: center; gap: 4px; }
        .badge-late { background: #fee2e2; color: #ef4444; border: 1px solid #fecaca; }
        .badge-ontime { background: #dcfce7; color: #22c55e; border: 1px solid #bbf7d0; }
        
        .stat-box {
            background: #fff; border-radius: var(--radius-md); padding: 20px;
            border-left: 4px solid var(--primary);
            box-shadow: var(--shadow-sm);
        }
        .stat-box.late { border-left-color: #ef4444; }
        .stat-box__label { font-size: 12px; text-transform: uppercase; font-weight: 700; color: var(--text-muted); letter-spacing: 1px; }
        .stat-box__val { font-size: 28px; font-weight: 800; color: var(--text-main); margin-top: 4px; }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include "app/view/include/sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column" style="background:#f4f5f7;">
            <div id="content">
                <?php include "app/view/include/topbar.php"; ?>

                <div class="container-fluid">
                    
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="font-family:'Merriweather',serif;font-weight:700;">
                            <i class="fas fa-undo text-primary mr-2"></i>Quầy Trả Sách
                        </h1>
                    </div>

                    <?php if ($message): ?>
                        <div class="alert alert-<?= $msgType ?> alert-dismissible fade show shadow-sm" role="alert" style="border-radius:10px;border:none;">
                            <strong>Thông báo:</strong> <?= htmlspecialchars($message) ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- Stats & Search -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stat-box">
                                <div class="stat-box__label">Đang mượn (Tổng)</div>
                                <div class="stat-box__val"><?= $stats['total'] ?></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stat-box late">
                                <div class="stat-box__label text-danger">Quá hạn chưa trả</div>
                                <div class="stat-box__val text-danger"><?= $stats['late'] ?></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <div class="card shadow-sm h-100" style="border:none;border-radius:10px;">
                                <div class="card-body d-flex flex-column justify-content-center">
                                    <form method="GET" action="trasach.php" class="d-flex">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Tìm tên độc giả, SĐT, hoặc tên sách..." aria-label="Search" aria-describedby="basic-addon2" style="padding:24px 20px;border-radius:10px 0 0 10px;" value="<?= htmlspecialchars($search) ?>">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" style="padding:0 24px;border-radius:0 10px 10px 0;">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                                <?php if($search !== ''): ?>
                                                    <a href="trasach.php" class="btn btn-secondary ml-2" style="border-radius:10px;"><i class="fas fa-times"></i> Hủy tìm</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book List -->
                    <div class="row">
                        <?php if (count($dang_muon) > 0): ?>
                            <?php foreach ($dang_muon as $item): 
                                $isLate = strtotime($item['ngay_hen_tra']) < time();
                                $lateDays = $isLate ? floor((time() - strtotime($item['ngay_hen_tra'])) / (60 * 60 * 24)) : 0;
                                $img = !empty($item['url_anh']) ? '../' . ltrim($item['url_anh'], '/') : '../images/products/img-01.jpg';
                            ?>
                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="return-card">
                                    <div class="return-card__img">
                                        <img src="<?= htmlspecialchars($img) ?>" alt="Cover" onerror="this.src='../images/products/img-01.jpg'">
                                    </div>
                                    <div class="return-card__body">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="return-card__title"><?= htmlspecialchars($item['ten_sach']) ?> <small class="text-muted">#S<?= $item['ma_sach'] ?></small></div>
                                                <?php if ($isLate): ?>
                                                    <span class="badge badge-late py-1 px-2 rounded-pill">Trễ <?= $lateDays ?> ngày</span>
                                                <?php else: ?>
                                                    <span class="badge badge-ontime py-1 px-2 rounded-pill">Đúng hạn</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="return-card__user"><i class="fas fa-user mr-1"></i> <?= htmlspecialchars($item['ho_ten']) ?> (<?= htmlspecialchars($item['so_dien_thoai']) ?>)</div>
                                            
                                            <div class="return-card__meta">
                                                <span><i class="fas fa-calendar-alt"></i> Mượn: <?= date('d/m/Y', strtotime($item['ngay_muon'])) ?></span>
                                                <span><i class="fas fa-clock"></i> Hạn: <?= date('d/m/Y', strtotime($item['ngay_hen_tra'])) ?></span>
                                                <span><i class="fas fa-file-invoice"></i> Phiếu #<?= $item['ma_phieu_muon'] ?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-2 text-right">
                                            <button class="btn btn-primary btn-sm btn-return" 
                                                    data-id="<?= $item['ma_chi_tiet_phieu'] ?>"
                                                    data-name="<?= htmlspecialchars($item['ten_sach']) ?>"
                                                    data-user="<?= htmlspecialchars($item['ho_ten']) ?>"
                                                    data-price="<?= $item['gia_sach'] ?>"
                                                    data-late="<?= $isLate ? '1' : '0' ?>"
                                                    style="border-radius:8px;font-weight:600;padding:6px 16px;">
                                                <i class="fas fa-undo mr-1"></i> Xử lý trả sách
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="card shadow-sm border-0" style="border-radius:15px;">
                                    <div class="card-body text-center py-5">
                                        <i class="fas fa-check-circle text-success" style="font-size:48px;opacity:0.5;margin-bottom:16px;"></i>
                                        <h4 class="text-gray-800">Không có sách nào đang được mượn</h4>
                                        <p class="text-muted">Tất cả sách đã được trả hoặc không tìm thấy kết quả phù hợp.</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

            <?php include "app/view/include/footer.php"; ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <!-- Modal Trả Sách -->
    <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius:16px;border:none;">
                <form method="POST" action="trasach.php">
                    <div class="modal-header" style="background:var(--primary);color:white;border-radius:16px 16px 0 0;">
                        <h5 class="modal-title font-weight-bold"><i class="fas fa-clipboard-check mr-2"></i>Xác nhận trả sách</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" name="action" value="return_book">
                        <input type="hidden" name="ma_chi_tiet_phieu" id="modal_ma_chi_tiet">
                        <input type="hidden" name="gia_goc" id="modal_gia_goc">

                        <div class="mb-3 p-3" style="background:#f8f9fc;border-radius:10px;border:1px solid #e3e6f0;">
                            <h6 class="font-weight-bold text-primary mb-1" id="modal_book_name">Tên sách</h6>
                            <div class="text-muted small">Độc giả: <span id="modal_user_name" class="font-weight-bold"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-gray-800">Tình trạng sách khi trả:</label>
                            <select class="form-control" name="trang_thai" id="modal_trang_thai" style="border-radius:8px;">
                                <option value="da_tra">Bình thường (Đã trả)</option>
                                <option value="tra_tre_han">Trả trễ hạn</option>
                                <option value="hu_hong">Hư hỏng</option>
                                <option value="mat_sach">Mất sách</option>
                            </select>
                        </div>

                        <div class="form-group" id="fine_group" style="display:none;">
                            <label class="font-weight-bold text-danger">Tiền phạt (VNĐ):</label>
                            <input type="number" class="form-control border-danger" name="so_tien_phat" id="modal_tien_phat" placeholder="Nhập số tiền phạt..." style="border-radius:8px;">
                            <small class="text-muted mt-1" id="fine_hint"></small>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-gray-800">Ghi chú (Tùy chọn):</label>
                            <textarea class="form-control" name="ghi_chu" rows="2" placeholder="Ghi chú thêm về tình trạng sách..." style="border-radius:8px;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top:none;padding-top:0;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:8px;">Hủy bỏ</button>
                        <button type="submit" class="btn btn-primary" style="border-radius:8px;font-weight:600;"><i class="fas fa-check mr-1"></i> Hoàn tất trả sách</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.btn-return').click(function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const user = $(this).data('user');
                const price = $(this).data('price');
                const isLate = $(this).data('late') == '1';

                $('#modal_ma_chi_tiet').val(id);
                $('#modal_book_name').text(name);
                $('#modal_user_name').text(user);
                $('#modal_gia_goc').val(price);

                if (isLate) {
                    $('#modal_trang_thai').val('tra_tre_han');
                    $('#fine_group').slideDown();
                    $('#modal_tien_phat').val('5000');
                    $('#fine_hint').text('');
                } else {
                    $('#modal_trang_thai').val('da_tra');
                    $('#fine_group').hide();
                    $('#modal_tien_phat').val('');
                }

                $('#returnModal').modal('show');
            });

            $('#modal_trang_thai').change(function() {
                const val = $(this).val();
                const price = $('#modal_gia_goc').val();

                if (val === 'hu_hong' || val === 'mat_sach') {
                    $('#fine_group').slideDown();
                    $('#modal_tien_phat').val(price);
                    $('#fine_hint').text('Gợi ý: Đền bù 100% giá gốc cuốn sách (' + new Intl.NumberFormat('vi-VN').format(price) + ' VNĐ)');
                } else if (val === 'tra_tre_han') {
                    $('#fine_group').slideDown();
                    $('#modal_tien_phat').val('5000');
                    $('#fine_hint').text('');
                } else {
                    $('#fine_group').slideUp();
                    $('#modal_tien_phat').val('');
                }
            });
        });
    </script>
</body>
</html>