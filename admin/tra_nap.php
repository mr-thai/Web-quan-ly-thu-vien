<?php 
    require_once __DIR__ . "/app/config.php";
    
    // Handle Quick Return Action
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'quick_return') {
        $ma_chi_tiet = (int)$_POST['ma_chi_tiet_phieu'];
        $conn->query("UPDATE chi_tiet_phieu_muon SET trang_thai = 'da_tra', ngay_tra_thuc_te = NOW() WHERE ma_chi_tiet_phieu = $ma_chi_tiet");
        $message = "Đã thu hồi sách thành công!";
    }

    // Get all books currently borrowed across the system
    $sql = "SELECT ct.ma_chi_tiet_phieu, s.ma_sach, s.ten_sach, pm.ngay_hen_tra, nd.ho_ten, nd.so_dien_thoai
            FROM chi_tiet_phieu_muon ct
            JOIN phieu_muon pm ON ct.ma_phieu_muon = pm.ma_phieu_muon
            JOIN sach s ON ct.ma_sach = s.ma_sach
            JOIN nguoi_dung nd ON pm.ma_nguoi_dung = nd.ma_nguoi_dung
            WHERE ct.trang_thai = 'dang_muon'
            ORDER BY pm.ngay_hen_tra ASC";
    $result = $conn->query($sql);
    $dang_muon = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $dang_muon[] = $row;
        }
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quản lý Trả Sách Nhanh</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/manlib-admin.css?v=3" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "app/view/include/sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "app/view/include/topbar.php"; ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Quản Lý Trả Sách Nhanh</h1>
                    </div>
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-success"><?php echo $message; ?></div>
                    <?php endif; ?>
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh Sách Sách Đang Cho Mượn (Toàn Hệ Thống)</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Người Mượn</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Tên Sách</th>
                                            <th>Ngày Hẹn Trả</th>
                                            <th>Trạng Thái</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($dang_muon as $item): 
                                            $tre_han = time() > strtotime($item['ngay_hen_tra']);
                                        ?>
                                        <tr>
                                            <td class="align-middle"><strong><?php echo htmlspecialchars($item['ho_ten']); ?></strong></td>
                                            <td class="align-middle"><?php echo htmlspecialchars($item['so_dien_thoai']); ?></td>
                                            <td class="align-middle"><?php echo htmlspecialchars($item['ten_sach']); ?></td>
                                            <td class="align-middle"><?php echo date('d/m/Y', strtotime($item['ngay_hen_tra'])); ?></td>
                                            <td class="align-middle">
                                                <?php if($tre_han): ?>
                                                    <span class="badge badge-danger">Trễ Hạn</span>
                                                <?php else: ?>
                                                    <span class="badge badge-success">Đang Mượn</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="align-middle">
                                                <form method="POST" onsubmit="return confirm('Xác nhận độc giả đã trả cuốn sách này?');">
                                                    <input type="hidden" name="action" value="quick_return">
                                                    <input type="hidden" name="ma_chi_tiet_phieu" value="<?php echo $item['ma_chi_tiet_phieu']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check mr-1"></i>Xác Nhận Trả</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Vietnamese.json"
                }
            });
        });
    </script>
</body>
</html>
