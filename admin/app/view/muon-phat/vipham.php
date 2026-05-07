<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách vi phạm</h6>
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
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($danh_sach_phat)): ?>
                        <?php foreach ($danh_sach_phat as $phat): ?>
                            <?php
                                $loai_vi_pham_map = array('tre_han' => 'Trễ hạn', 'hu_hong' => 'Hư hỏng', 'mat_sach' => 'Mất sách');
                                $loai_badge_map = array('tre_han' => 'badge-danger', 'hu_hong' => 'badge-warning', 'mat_sach' => 'badge-danger');
                                $loai_text = $loai_vi_pham_map[$phat['loai_vi_pham']] ?? $phat['loai_vi_pham'];
                                $loai_badge = $loai_badge_map[$phat['loai_vi_pham']] ?? 'badge-secondary';
                            ?>
                            <tr>
                                <td><input type="checkbox" class="fine-select" data-id="<?php echo $phat['ma_phat']; ?>"></td>
                                <td><?php echo htmlspecialchars($phat['ten_sach']); ?></td>
                                <td><span class="badge <?php echo $loai_badge; ?>"><?php echo $loai_text; ?></span></td>
                                <td><?php echo number_format($phat['gia_goc_sach'], 0, ',', '.'); ?></td>
                                <td style="min-width: 150px;">
                                    <input type="text" class="form-control form-control-sm fine-input" data-id="<?php echo $phat['ma_phat']; ?>" value="<?php echo number_format($phat['so_tien_phat'], 0, ',', '.'); ?>">
                                </td>
                                <td><?php echo date('d/m/Y', strtotime($phat['ngay_tao'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Không có vi phạm</td>
                        </tr>
                    <?php endif; ?>
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
                <div class="text-xs font-weight-bold text-uppercase text-muted">Tổng tiền cần đóng (các dòng chọn)</div>
                <div class="h4 mb-0 font-weight-bold text-gray-800" id="totalFine">0 VNĐ</div>
            </div>
            <form method="POST" action="" style="display: inline;">
                <input type="hidden" name="action" value="confirm_phat">
                <div id="selectedFinesData"></div>
                <button class="btn btn-success" type="button" id="confirmAllBtn">
                        <i class="fas fa-check mr-1"></i>Xác nhận đã nạp phạt
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../../../js/vipham.js"></script>