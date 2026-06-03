<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Sách đang mượn</h6>
    </div>
    <div class="card-body">
        <div id="returnAlert" class="alert alert-warning d-none" role="alert">
            Vui lòng chọn ít nhất một cuốn sách để xử lý.
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($receipt) && is_array($receipt)): ?>
            <!-- Receipt modal -->
            <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Biên lai xử lý trả sách</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Mã chi tiết</th>
                                            <th>Tên sách</th>
                                            <th>Trạng thái</th>
                                            <th>Giá gốc (VNĐ)</th>
                                            <th>Tiền phạt (VNĐ)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($receipt['items'] as $it): ?>
                                            <?php
                                                $status_map = array('da_tra' => 'Bình thường', 'hu_hong' => 'Hư hỏng', 'mat_sach' => 'Mất', 'tra_tre_han' => 'Trễ hạn');
                                                $st = $status_map[$it['trang_thai']] ?? $it['trang_thai'];
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($it['ma_chi_tiet_phieu']); ?></td>
                                                <td><?php echo htmlspecialchars($it['ten_sach'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($st); ?></td>
                                                <td><?php echo number_format((float)$it['gia_goc'], 0, ',', '.'); ?></td>
                                                <td><?php echo number_format((float)$it['so_tien_phat'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right font-weight-bold mt-3">Tổng tiền phạt: <?php echo number_format((float)($receipt['total_fine'] ?? 0), 0, ',', '.'); ?> VNĐ</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" onclick="window.print();">In biên lai</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                (function(){
                    if (window.jQuery) {
                        jQuery(function(){ jQuery('#receiptModal').modal('show'); });
                    } else if (document.readyState === 'complete' || document.readyState === 'interactive') {
                        var el = document.getElementById('receiptModal');
                        if (el && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                            var m = new bootstrap.Modal(el); m.show();
                        }
                    }
                })();
            </script>
        <?php endif; ?>

        <form method="POST" id="transactionForm" action="">
            <input type="hidden" name="action" value="return_book">
            <input type="hidden" name="ngay_tra_thuc_te" id="ngayTraInput" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <div class="table-responsive">
                <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 40px;">
                                <input type="checkbox" id="selectAllBooks">
                            </th>
                            <th>Mã sách</th>
                            <th>Tên sách</th>
                            <th>Ngày hẹn trả</th>
                            <th>Trạng thái hệ thống</th>
                            <th>Tình trạng thực tế</th>
                            <th>Tiền phạt phát sinh (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($sach_dang_muon)): ?>
                            <?php foreach ($sach_dang_muon as $i => $sach): ?>
                                <?php
                                    $ngay_hen_tra_ts = strtotime($sach['ngay_hen_tra']);
                                    $now = time();
                                    $system_status_badge = $now > $ngay_hen_tra_ts ? 'badge-danger' : 'badge-success';
                                    $system_status_text = $now > $ngay_hen_tra_ts ? 'Trễ hạn' : 'Trong hạn';
                                    $gia_sach_val = isset($sach['gia_sach']) ? (float) $sach['gia_sach'] : 0;
                                ?>
                                <tr class="book-row" data-index="<?php echo $i; ?>" data-price="<?php echo $gia_sach_val; ?>" data-due="<?php echo htmlspecialchars($sach['ngay_hen_tra']); ?>">
                                    <td>
                                        <input type="checkbox" class="book-select" data-index="<?php echo $i; ?>">
                                    </td>
                                    <td>#S<?php echo str_pad($sach['ma_sach'], 3, '0', STR_PAD_LEFT); ?></td>
                                    <td><?php echo htmlspecialchars($sach['ten_sach']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($sach['ngay_hen_tra'])); ?></td>
                                    <td><span class="badge <?php echo $system_status_badge; ?>"><?php echo $system_status_text; ?></span></td>
                                    <td>
                                        <select name="trang_thai_item[]" class="form-control form-control-sm status-select" disabled>
                                            <option value="da_tra">Bình thường</option>
                                            <option value="hu_hong">Hư hỏng</option>
                                            <option value="mat_sach">Mất</option>
                                            <option value="tra_tre_han">Trễ hạn</option>
                                        </select>
                                    </td>
                                    <td style="min-width:140px;">
                                        <input type="text" name="so_tien_phat_item[]" class="form-control form-control-sm fine-input" value="0" disabled>
                                        <input type="hidden" name="ma_chi_tiet_phieu[]" class="hidden-ma" disabled value="<?php echo $sach['ma_chi_tiet_phieu']; ?>">
                                        <input type="hidden" name="gia_goc_item[]" class="hidden-price" disabled value="<?php echo $gia_sach_val; ?>">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">Không có sách đang mượn</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="card mt-3 shadow-sm" style="position: sticky; bottom: 10px; z-index: 30;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase text-muted">Tổng số sách trả</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalBooks">0</div>
                    </div>
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase text-muted">Tổng tiền phạt</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalFine">0 VNĐ</div>
                    </div>
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase text-muted">Ghi chú</div>
                        <textarea name="ghi_chu_tinh_trang" class="form-control form-control-sm" rows="2" placeholder="Ghi chú chung (nếu có)"></textarea>
                    </div>
                    <div>
                        <button type="button" id="completeTransactionBtn" class="btn btn-primary btn-lg">Hoàn tất xử lý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>