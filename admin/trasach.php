<?php 
    require_once __DIR__ . "/app/config.php";
    require_once __DIR__ . "/app/controller/control_trasach.php";
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
    <link href="css/manlib-admin.css?v=2" rel="stylesheet">
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

                    <?php include "app/view/muon-phat/search.php"; ?>

                   
                    <?php include "app/view/muon-phat/info-user.php"; ?>
                
                    <?php include "app/view/muon-phat/dangmuon.php"; ?>
                        
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
            var selectedBooksList = document.getElementById('selectedBooksList');
            var hiddenBookData = document.getElementById('hiddenBookData');

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
                    var selectedBooks = [];
                    
                    checkboxes.forEach(function (box) {
                        if (box.checked) {
                            anyChecked = true;
                            var row = box.closest('tr');
                            if (row) {
                                var cells = row.querySelectorAll('td');
                                selectedBooks.push({
                                    ma_chi_tiet: box.getAttribute('data-id'),
                                    ma_sach: cells[1].textContent.replace('#S', ''),
                                    ten_sach: cells[2].textContent,
                                    ngay_muon: cells[3].textContent,
                                    ngay_hen_tra: cells[4].textContent,
                                    gia_goc: cells[5] ? cells[5].getAttribute('data-price') : '0'
                                });
                            }
                        }
                    });

                    if (!anyChecked) {
                        if (alertBox) {
                            alertBox.classList.remove('d-none');
                            alertBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                        return;
                    }

                    // Populate modal with selected books
                    if (selectedBooksList && selectedBooks.length > 0) {
                        selectedBooksList.innerHTML = '';
                        hiddenBookData.innerHTML = '';
                        
                        selectedBooks.forEach(function (book) {
                            var row = document.createElement('tr');
                            row.innerHTML = '<td>#S' + book.ma_sach.padStart(3, '0') + '</td>' +
                                          '<td>' + book.ten_sach + '</td>' +
                                          '<td>' + book.ngay_muon + '</td>' +
                                          '<td>' + book.ngay_hen_tra + '</td>' +
                                          '<td>' + (book.gia_goc || '--') + '</td>';
                            selectedBooksList.appendChild(row);
                            
                            // Add hidden inputs for each selected book
                            var hidden = document.createElement('input');
                            hidden.type = 'hidden';
                            hidden.name = 'ma_chi_tiet_phieu';
                            hidden.value = book.ma_chi_tiet;
                            hiddenBookData.appendChild(hidden);
                        });
                    }

                    $('#returnProcessModal').modal('show');
                });
            }

            updateSelectAllState();
        })();
    </script>

</body>

</html>