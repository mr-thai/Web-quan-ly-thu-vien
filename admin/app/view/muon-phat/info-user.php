<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thông tin người mượn</h6>
    </div>
    <div class="card-body">
        <?php if ($nguoi_dung): ?>
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h2 class="text-gray-900 font-weight-bold"><?php echo htmlspecialchars($nguoi_dung['ho_ten']); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase text-muted">Số điện thoại</div>
                    <div class="text-gray-800"><?php echo htmlspecialchars($nguoi_dung['so_dien_thoai']); ?></div>
                </div>
                <div class="col-6 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase text-muted">Email</div>
                    <div class="text-gray-800"><?php echo htmlspecialchars($nguoi_dung['email']); ?></div>
                </div>
                <div class="col-6 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase text-muted">Trạng thái</div>
                    <span class="badge badge-<?php echo $nguoi_dung['trang_thai'] == 1 ? 'success' : 'danger'; ?>">
                        <?php echo $nguoi_dung['trang_thai'] == 1 ? 'Đang hoạt động' : 'Bị khóa'; ?>
                    </span>
                </div>
                <div class="col-6 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase text-muted">Ngày tạo</div>
                    <div class="text-gray-800"><?php echo date('d/m/Y', strtotime($nguoi_dung['ngay_tao'])); ?></div>
                </div>
                <div class="col-12 mb-0">
                    <div class="text-xs font-weight-bold text-uppercase text-muted">Tên đăng nhập</div>
                    <div class="text-gray-800">@<?php echo htmlspecialchars($nguoi_dung['ten_dang_nhap']); ?></div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-muted text-center">Vui lòng tìm kiếm một người dùng</div>
        <?php endif; ?>
    </div>
</div>