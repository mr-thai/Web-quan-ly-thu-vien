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
                        <h1 class="h3 mb-0 text-gray-800">Trả sách</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form class="form-inline">
                                <div class="form-group mb-2 mr-2 flex-grow-1">
                                    <label for="phoneSearch" class="sr-only">Số điện thoại</label>
                                    <input type="text" class="form-control w-100" id="phoneSearch" placeholder="Nhập số điện thoại người mượn">
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
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary text-white">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-gray-900 font-weight-bold">Nguyễn Văn An</div>
                                    <div class="text-muted small">@nguyenvana</div>
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
                            <h6 class="m-0 font-weight-bold text-primary">Sách đang mượn</h6>
                            <button type="button" class="btn btn-success btn-sm" id="processReturnBtn">
                                <i class="fas fa-undo mr-1"></i>Xử lý trả
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="returnAlert" class="alert alert-warning d-none" role="alert">
                                Vui lòng chọn ít nhất một cuốn sách để xử lý.
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 40px;">
                                                <input type="checkbox" id="selectAllBooks">
                                            </th>
                                            <th>Mã sách</th>
                                            <th>Tên sách</th>
                                            <th>Ngày mượn</th>
                                            <th>Ngày hẹn trả</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="book-select"></td>
                                            <td>#S001</td>
                                            <td>Mắt Biếc</td>
                                            <td>01/10/2023</td>
                                            <td>15/10/2023</td>
                                            <td><span class="badge badge-success">Đang mượn</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="book-select"></td>
                                            <td>#S005</td>
                                            <td>Harry Potter và Hòn Đá Phù Thủy</td>
                                            <td>01/10/2023</td>
                                            <td>10/10/2023</td>
                                            <td><span class="badge badge-danger">Trễ hạn</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="book-select"></td>
                                            <td>#S004</td>
                                            <td>Dế Mèn Phiêu Lưu Ký</td>
                                            <td>05/10/2023</td>
                                            <td>20/10/2023</td>
                                            <td><span class="badge badge-success">Đang mượn</span></td>
                                        </tr>
                                    </tbody>
                                </table>
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

    <!-- Return Processing Modal -->
    <div class="modal fade" id="returnProcessModal" tabindex="-1" role="dialog" aria-labelledby="returnProcessLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="returnProcessLabel">Xử lý trả sách</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="text-gray-900 font-weight-bold">Nguyễn Văn An</div>
                        <div class="text-muted">Số điện thoại: 0901111222</div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Tình trạng sách</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="statusNormal" name="returnStatus" class="custom-control-input" checked>
                            <label class="custom-control-label" for="statusNormal">Trả bình thường</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="statusDamaged" name="returnStatus" class="custom-control-input">
                            <label class="custom-control-label" for="statusDamaged">Hư hỏng</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="statusLost" name="returnStatus" class="custom-control-input">
                            <label class="custom-control-label" for="statusLost">Mất sách</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="damageNote" class="font-weight-bold">Ghi chú</label>
                        <textarea id="damageNote" class="form-control" rows="3" placeholder="Mô tả chi tiết hư hỏng, mất sách (nếu có)"></textarea>
                    </div>

                    <div class="form-group mb-0">
                        <label class="font-weight-bold">Danh sách sách xử lý</label>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Mã sách</th>
                                        <th>Tên sách</th>
                                        <th>Ngày mượn</th>
                                        <th>Ngày hẹn trả</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#S001</td>
                                        <td>Mắt Biếc</td>
                                        <td>01/10/2023</td>
                                        <td>15/10/2023</td>
                                        <td><span class="badge badge-success">Đang mượn</span></td>
                                    </tr>
                                    <tr>
                                        <td>#S005</td>
                                        <td>Harry Potter và Hòn Đá Phù Thủy</td>
                                        <td>01/10/2023</td>
                                        <td>10/10/2023</td>
                                        <td><span class="badge badge-danger">Trễ hạn</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <button class="btn btn-success" type="button">Xác nhận cập nhật</button>
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
            var processBtn = document.getElementById('processReturnBtn');
            var alertBox = document.getElementById('returnAlert');
            var selectAll = document.getElementById('selectAllBooks');
            var checkboxes = document.querySelectorAll('.book-select');

            function updateSelectAllState() {
                var checkedCount = 0;
                checkboxes.forEach(function (box) {
                    if (box.checked) {
                        checkedCount++;
                    }
                });
                if (selectAll) {
                    selectAll.checked = checkedCount === checkboxes.length && checkboxes.length > 0;
                    selectAll.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
                }
            }

            if (selectAll) {
                selectAll.addEventListener('change', function () {
                    checkboxes.forEach(function (box) {
                        box.checked = selectAll.checked;
                    });
                    if (alertBox) {
                        alertBox.classList.add('d-none');
                    }
                });
            }

            checkboxes.forEach(function (box) {
                box.addEventListener('change', function () {
                    updateSelectAllState();
                    if (alertBox) {
                        alertBox.classList.add('d-none');
                    }
                });
            });

            if (processBtn) {
                processBtn.addEventListener('click', function () {
                    var anyChecked = false;
                    checkboxes.forEach(function (box) {
                        if (box.checked) {
                            anyChecked = true;
                        }
                    });

                    if (!anyChecked) {
                        if (alertBox) {
                            alertBox.classList.remove('d-none');
                            alertBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                        return;
                    }

                    $('#returnProcessModal').modal('show');
                });
            }

            updateSelectAllState();
        })();
    </script>

</body>

</html>