<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4" style="border: none; border-radius: 12px; height: calc(100% - 1.5rem);">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: var(--surface); border-bottom: 1px solid var(--border); border-radius: 12px 12px 0 0;">
            <h6 class="m-0 font-weight-bold" style="color: var(--primary);">Độc Giả Tích Cực Nhất</h6>
            <i class="fas fa-medal" style="color: #f59e0b;"></i>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush" style="border-radius: 0 0 12px 12px;">
                <?php if(!empty($topReaders)): ?>
                    <?php foreach($topReaders as $index => $reader): 
                        // Assign medal colors for top 3
                        $iconColor = '#94a3b8'; // Default gray
                        if ($index == 0) $iconColor = '#fbbf24'; // Gold
                        if ($index == 1) $iconColor = '#9ca3af'; // Silver
                        if ($index == 2) $iconColor = '#b45309'; // Bronze
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 16px 20px; border-color: var(--border);">
                        <div class="d-flex align-items-center">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--bg); display: flex; align-items: center; justify-content: center; margin-right: 15px; border: 1px solid var(--border);">
                                <i class="fas fa-user" style="color: <?php echo $iconColor; ?>;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 font-weight-bold" style="color: var(--text-main); font-size: 14px;"><?php echo htmlspecialchars($reader['ho_ten']); ?></h6>
                                <small style="color: var(--text-muted); font-size: 12px;"><?php echo htmlspecialchars($reader['so_dien_thoai']); ?></small>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="badge" style="background: rgba(13, 148, 136, 0.1); color: var(--primary); font-size: 13px; padding: 6px 10px; border-radius: 6px;">
                                <?php echo (int)$reader['total_borrows']; ?> <i class="fas fa-book ml-1" style="font-size: 10px;"></i>
                            </span>
                        </div>
                    </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item text-center py-4 text-muted" style="border: none;">
                        Chưa có dữ liệu độc giả
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
