<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Cơ cấu tiền phạt</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Thống kê nhanh</div>
                    <a class="dropdown-item" href="tra_nap.php">Nạp phạt</a>
                    <a class="dropdown-item" href="phieumuon.php">Phiếu mượn</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="tra_nap.php">Trả sách</a>
                </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
                <span class="mr-2">
                    <i class="fas fa-circle text-primary"></i> Trễ hạn
                </span>
                <span class="mr-2">
                    <i class="fas fa-circle text-success"></i> Hư hỏng
                </span>
                <span class="mr-2">
                    <i class="fas fa-circle text-info"></i> Mất sách
                </span>
            </div>
        </div>
    </div>
</div>