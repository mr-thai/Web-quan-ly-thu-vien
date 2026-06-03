<div class="row">
    <!-- Books Borrowed Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm h-100" style="border-radius: 12px; border: none;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(13, 148, 136, 0.1); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-book fa-lg" style="color: var(--primary);"></i>
                    </div>
                    <span class="badge" style="background: rgba(13, 148, 136, 0.1); color: var(--primary);">Tháng này</span>
                </div>
                <h6 class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 11px; letter-spacing: 1px;">Sách đã mượn</h6>
                <h2 class="font-weight-bold text-gray-900 mb-0"><?php echo number_format(isset($borrowedThisMonth) ? $borrowedThisMonth : 0, 0, ',', '.'); ?></h2>
            </div>
        </div>
    </div>

    <!-- Books Returned Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm h-100" style="border-radius: 12px; border: none;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-undo fa-lg" style="color: #10b981;"></i>
                    </div>
                    <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">Tháng này</span>
                </div>
                <h6 class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 11px; letter-spacing: 1px;">Sách đã trả</h6>
                <h2 class="font-weight-bold text-gray-900 mb-0"><?php echo number_format(isset($returnedThisMonth) ? $returnedThisMonth : 0, 0, ',', '.'); ?></h2>
            </div>
        </div>
    </div>

    <!-- Paid Fines Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm h-100" style="border-radius: 12px; border: none;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-coins fa-lg" style="color: #3b82f6;"></i>
                    </div>
                    <span class="badge" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">Tháng này</span>
                </div>
                <h6 class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 11px; letter-spacing: 1px;">Tiền phạt đã nộp</h6>
                <h2 class="font-weight-bold text-gray-900 mb-0"><?php echo number_format(isset($paidFinesThisMonth) ? $paidFinesThisMonth: 0, 0, ',', '.'); ?> <span style="font-size: 16px; font-weight: normal; color: #94a3b8;">đ</span></h2>
            </div>
        </div>
    </div>

    <!-- Pending Fines Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm h-100" style="border-radius: 12px; border: none;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(239, 68, 68, 0.1); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-exclamation-triangle fa-lg" style="color: #ef4444;"></i>
                    </div>
                    <span class="badge" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">Tồn đọng</span>
                </div>
                <h6 class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 11px; letter-spacing: 1px;">Phiếu phạt chưa nộp</h6>
                <h2 class="font-weight-bold text-gray-900 mb-0"><?php echo number_format(isset($unpaidFinesCount) ? $unpaidFinesCount : 0, 0, ',', '.'); ?></h2>
            </div>
        </div>
    </div>
</div>