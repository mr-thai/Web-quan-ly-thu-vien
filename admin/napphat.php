<?php 
    require_once __DIR__ . "/app/config.php";
    require_once __DIR__ . "/app/controller/control_napphat.php";
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

                    <?php include "app/view/muon-phat/search.php"; ?>

                    <?php include "app/view/muon-phat/info-user.php"; ?>

                    <?php include "app/view/muon-phat/vipham.php"; ?>
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
            var confirmAllBtn = document.getElementById('confirmAllBtn');
            var alertBox = document.getElementById('fineAlert');
            var selectedFinesData = document.getElementById('selectedFinesData');

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
                fineCheckboxes.forEach(function (checkbox) {
                    if (checkbox.checked) {
                        var dataId = checkbox.getAttribute('data-id');
                        var input = document.querySelector('.fine-input[data-id="' + dataId + '"]');
                        if (input) {
                            total += parseMoney(input.value);
                        }
                    }
                });
                if (totalFine) {
                    totalFine.textContent = formatMoney(total);
                }
                updateSelectedFinesData();
            }

            function updateSelectedFinesData() {
                if (!selectedFinesData) return;
                selectedFinesData.innerHTML = '';
                
                fineCheckboxes.forEach(function (checkbox) {
                    if (checkbox.checked) {
                        var dataId = checkbox.getAttribute('data-id');
                        var input = document.querySelector('.fine-input[data-id="' + dataId + '"]');
                        if (input) {
                            var hidden = document.createElement('input');
                            hidden.type = 'hidden';
                            hidden.name = 'ma_phat[]';
                            hidden.value = dataId;
                            selectedFinesData.appendChild(hidden);
                            
                            var hiddenAmount = document.createElement('input');
                            hiddenAmount.type = 'hidden';
                            hiddenAmount.name = 'so_tien_phat_' + dataId;
                            hiddenAmount.value = parseMoney(input.value);
                            selectedFinesData.appendChild(hiddenAmount);
                        }
                    }
                });
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
                    updateTotal();
                });
            }

            fineCheckboxes.forEach(function (box) {
                box.addEventListener('change', function () {
                    updateSelectAllState();
                    if (alertBox) {
                        alertBox.classList.add('d-none');
                    }
                    updateTotal();
                });
            });

            if (confirmAllBtn) {
                confirmAllBtn.addEventListener('click', function () {
                    var anyChecked = false;
                    fineCheckboxes.forEach(function (box) {
                        if (box.checked) {
                            anyChecked = true;
                        }
                    });
                    if (!anyChecked && alertBox) {
                        alertBox.classList.remove('d-none');
                    } else if (anyChecked) {
                        // Submit the form
                        var form = document.querySelector('form');
                        if (form) {
                            form.submit();
                        }
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