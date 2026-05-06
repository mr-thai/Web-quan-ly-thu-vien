<?php 
    require_once __DIR__ . "/app/config.php";
    require_once __DIR__ . "/app/controller/xulynguoidung.php";
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
        <?php include "app/view/include/sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "app/view/include/topbar.php"; ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Nạp phạt</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form class="form-inline">
                                <div class="form-group mb-2 mr-2 flex-grow-1">
                                    <label for="phoneSearch" class="sr-only">Số điện thoại</label>
                                    <input type="text" class="form-control w-100" id="phoneSearch" placeholder="Nhập số điện thoại người dùng">
                                </div>
                                <button type="button" class="btn btn-primary mb-2">
                                    <i class="fas fa-search mr-1"></i>Tìm kiếm
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Thông tin người mượn</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <h2 class="text-gray-900 font-weight-bold">Nguyễn Văn An</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted">Số điện thoại</div>
                                    <div class="text-gray-800">0901111222</div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted">Email</div>
                                    <div class="text-gray-800">an.nguyen@email.com</div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted">Trạng thái</div>
                                    <span class="badge badge-success">Đang hoạt động</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted">Ngày tạo</div>
                                    <div class="text-gray-800">01/10/2023</div>
                                </div>
                                <div class="col-12 mb-0">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted">Địa chỉ</div>
                                    <div class="text-gray-800">Quận 1, TP.HCM</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách vi phạm</h6>
                            <button class="btn btn-outline-success btn-sm" type="button" id="confirmSelectedBtn">
                                <i class="fas fa-check-circle mr-1"></i>Quyết toán các dòng đã chọn
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="fineAlert" class="alert alert-warning d-none" role="alert">
                                Vui lòng chọn ít nhất một dòng để quyết toán.
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 40px;">
                                                <input type="checkbox" id="selectAllFines">
                                            </th>
                                            <th>Tên sách</th>
                                            <th>Loại vi phạm</th>
                                            <th>Giá gốc (VNĐ)</th>
                                            <th>Số tiền phạt</th>
                                            <th>Ngày tạo</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="fine-select"></td>
                                            <td>Số Đỏ</td>
                                            <td><span class="badge badge-danger">Trễ hạn</span></td>
                                            <td>75,000</td>
                                            <td style="min-width: 150px;">
                                                <input type="text" class="form-control form-control-sm fine-input" value="5,000">
                                            </td>
                                            <td>25/10/2023</td>
                                            <td>
                                                <button class="btn btn-success btn-sm" type="button">Xác nhận</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="fine-select"></td>
                                            <td>Chí Phèo</td>
                                            <td><span class="badge badge-warning">Hư hỏng</span></td>
                                            <td>45,000</td>
                                            <td style="min-width: 150px;">
                                                <input type="text" class="form-control form-control-sm fine-input" value="4,500">
                                            </td>
                                            <td>20/12/2023</td>
                                            <td>
                                                <button class="btn btn-success btn-sm" type="button">Xác nhận</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="fine-select"></td>
                                            <td>Harry Potter và Hòn Đá Phù Thủy</td>
                                            <td><span class="badge badge-danger">Mất sách</span></td>
                                            <td>180,000</td>
                                            <td style="min-width: 150px;">
                                                <input type="text" class="form-control form-control-sm fine-input" value="180,000">
                                            </td>
                                            <td>18/11/2023</td>
                                            <td>
                                                <button class="btn btn-success btn-sm" type="button">Xác nhận</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tổng kết</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-xs font-weight-bold text-uppercase text-muted">Tổng tiền cần đóng</div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800" id="totalFine">0 VNĐ</div>
                                </div>
                                <button class="btn btn-success" type="button" id="confirmAllBtn">
                                    <i class="fas fa-check mr-1"></i>Xác nhận đã nạp phạt
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
                
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "app/view/include/footer.php"; ?>
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
            var fineInputs = document.querySelectorAll('.fine-input');
            var totalFine = document.getElementById('totalFine');
            var selectAll = document.getElementById('selectAllFines');
            var fineCheckboxes = document.querySelectorAll('.fine-select');
            var confirmSelectedBtn = document.getElementById('confirmSelectedBtn');
            var alertBox = document.getElementById('fineAlert');

            function parseMoney(value) {
                if (!value) {
                    return 0;
                }
                return Number(value.toString().replace(/[^0-9]/g, '')) || 0;
            }

            function formatMoney(amount) {
                return amount.toLocaleString('vi-VN') + ' VNĐ';
            }

            function updateTotal() {
                var total = 0;
                fineInputs.forEach(function (input) {
                    total += parseMoney(input.value);
                });
                if (totalFine) {
                    totalFine.textContent = formatMoney(total);
                }
            }

            function updateSelectAllState() {
                var checkedCount = 0;
                fineCheckboxes.forEach(function (box) {
                    if (box.checked) {
                        checkedCount++;
                    }
                });
                if (selectAll) {
                    selectAll.checked = checkedCount === fineCheckboxes.length && fineCheckboxes.length > 0;
                    selectAll.indeterminate = checkedCount > 0 && checkedCount < fineCheckboxes.length;
                }
            }

            if (selectAll) {
                selectAll.addEventListener('change', function () {
                    fineCheckboxes.forEach(function (box) {
                        box.checked = selectAll.checked;
                    });
                    if (alertBox) {
                        alertBox.classList.add('d-none');
                    }
                });
            }

            fineCheckboxes.forEach(function (box) {
                box.addEventListener('change', function () {
                    updateSelectAllState();
                    if (alertBox) {
                        alertBox.classList.add('d-none');
                    }
                });
            });

            if (confirmSelectedBtn) {
                confirmSelectedBtn.addEventListener('click', function () {
                    var anyChecked = false;
                    fineCheckboxes.forEach(function (box) {
                        if (box.checked) {
                            anyChecked = true;
                        }
                    });
                    if (!anyChecked && alertBox) {
                        alertBox.classList.remove('d-none');
                    }
                });
            }

            fineInputs.forEach(function (input) {
                input.addEventListener('input', updateTotal);
            });

            updateTotal();
            updateSelectAllState();
        })();
    </script>

</body>

</html>