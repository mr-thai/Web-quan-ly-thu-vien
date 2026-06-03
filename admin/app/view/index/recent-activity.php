<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4" style="border: none; border-radius: 12px;">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: var(--surface); border-bottom: 1px solid var(--border); border-radius: 12px 12px 0 0;">
                <h6 class="m-0 font-weight-bold" style="color: var(--primary);">Hoạt động gần đây</h6>
                <a href="phieumuon.php" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">Xem tất cả</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="color: var(--text-main);">
                        <thead style="background: var(--bg);">
                            <tr>
                                <th style="border-top: none; font-size: 12px; text-transform: uppercase; color: var(--text-muted); border-bottom: 1px solid var(--border);">Độc giả</th>
                                <th style="border-top: none; font-size: 12px; text-transform: uppercase; color: var(--text-muted); border-bottom: 1px solid var(--border);">Sách</th>
                                <th style="border-top: none; font-size: 12px; text-transform: uppercase; color: var(--text-muted); border-bottom: 1px solid var(--border);">Hành động</th>
                                <th style="border-top: none; font-size: 12px; text-transform: uppercase; color: var(--text-muted); border-bottom: 1px solid var(--border);">Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($recentActivity)): ?>
                                <?php foreach($recentActivity as $act): 
                                    $isReturned = ($act['trang_thai'] === 'da_tra' || !empty($act['ngay_tra_thuc_te']));
                                    $actionText = $isReturned ? 'Đã trả sách' : 'Mượn sách';
                                    $actionBadge = $isReturned ? 'badge-success' : 'badge-primary';
                                    $time = $isReturned ? $act['ngay_tra_thuc_te'] : $act['ngay_muon'];
                                ?>
                                <tr>
                                    <td class="align-middle font-weight-bold"><?php echo htmlspecialchars($act['ho_ten']); ?></td>
                                    <td class="align-middle text-muted"><?php echo htmlspecialchars($act['ten_sach']); ?></td>
                                    <td class="align-middle"><span class="badge <?php echo $actionBadge; ?>" style="padding: 6px 10px; border-radius: 6px;"><?php echo $actionText; ?></span></td>
                                    <td class="align-middle text-muted small"><?php echo date('H:i - d/m/Y', strtotime($time)); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Chưa có hoạt động nào</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
