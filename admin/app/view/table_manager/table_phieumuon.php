<div class="container-fluid">

                    <?php $nguoi_dung_list = $nguoi_dung_list ?? array(); ?>
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($message); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Quản lý phiếu mượn</h1>
                        
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID phiếu</th>
                                            <th>Người mượn</th>
                                            <th>Ngày mượn</th>
                                            <th>Ngày hẹn trả</th>
                                            <th>Ngày trả</th>
                                            <th>Tổng sách</th>
                                            <th>Tổng trễ hạn</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $loan_modals = array(); ?>
                                        <?php if (!empty($phieu_muon_list)): ?>
                                            <?php foreach ($phieu_muon_list as $phieu): ?>
                                                <?php
                                                    $id_pm = (int)$phieu['ma_phieu_muon'];
                                                    $trang_thai = $phieu['trang_thai'];

                                                    $trang_thai_text = 'Đang mượn';
                                                    $trang_thai_badge = 'badge-primary';

                                                    if ($trang_thai === 'da_tra') {
                                                        $trang_thai_text = 'Đã trả';
                                                        $trang_thai_badge = 'badge-success';
                                                    } elseif ($trang_thai === 'tre_han') {
                                                        $trang_thai_text = 'Trễ hạn';
                                                        $trang_thai_badge = 'badge-danger';
                                                    }

                                                    $chi_tiet_list = $chi_tiet_by_phieu[$id_pm] ?? array();
                                                    
                                                    // Tính tổng sách trễ hạn
                                                    $tong_tre_han = 0;
                                                    foreach ($chi_tiet_list as $ct) {
                                                        if ($ct['trang_thai'] === 'tra_tre_han' || 
                                                            ($ct['trang_thai'] === 'dang_muon' && strtotime($phieu['ngay_hen_tra']) < time())) {
                                                            $tong_tre_han++;
                                                        }
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $id_pm; ?></td>
                                                    <td>
                                                        <div class="font-weight-bold"><?php echo htmlspecialchars($phieu['ho_ten']); ?></div>
                                                        <small class="text-muted">@<?php echo htmlspecialchars($phieu['ten_dang_nhap']); ?></small>
                                                    </td>
                                                    <td><?php echo to_datetime_display($phieu['ngay_muon']); ?></td>
                                                    <td><?php echo to_datetime_display($phieu['ngay_hen_tra']); ?></td>
                                                    <td><?php echo to_datetime_display($phieu['ngay_tra']); ?></td>
                                                    <td><?php echo count($chi_tiet_list); ?></td>
                                                    <td><span class="badge badge-warning"><?php echo $tong_tre_han; ?></span></td>
                                                    <td><span class="badge <?php echo $trang_thai_badge; ?>"><?php echo $trang_thai_text; ?></span></td>
                                                    <td class="text-nowrap">
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal-<?php echo $id_pm; ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editLoanModal-<?php echo $id_pm; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <?php if ($trang_thai !== 'da_tra'): ?>
                                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#returnLoanModal-<?php echo $id_pm; ?>">
                                                                <i class="fas fa-undo"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                        <a href="phieumuon.php?delete_id=<?php echo $id_pm; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa phiếu mượn này?');">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <?php ob_start(); ?>

                                                <div class="modal fade" id="detailModal-<?php echo $id_pm; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Chi tiết phiếu mượn #<?php echo $id_pm; ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="mb-2"><strong>Người mượn:</strong> <?php echo htmlspecialchars($phieu['ho_ten']); ?> (@<?php echo htmlspecialchars($phieu['ten_dang_nhap']); ?>)</p>
                                                                <p class="mb-3"><strong>Ghi chú:</strong> <?php echo htmlspecialchars($phieu['ghi_chu'] ?: 'Không có'); ?></p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-sm table-bordered mb-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Mã sách</th>
                                                                                <th>Tên sách</th>
                                                                                <th>Số lượng</th>
                                                                                <th>Trạng thái</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php if (!empty($chi_tiet_list)): ?>
                                                                                <?php foreach ($chi_tiet_list as $ct): ?>
                                                                                    <?php
                                                                                        $ct_status = $ct['trang_thai'];
                                                                                        $ct_text = 'Đang mượn';
                                                                                        if ($ct_status === 'da_tra') {
                                                                                            $ct_text = 'Đã trả';
                                                                                        } elseif ($ct_status === 'tre_han') {
                                                                                            $ct_text = 'Trễ hạn';
                                                                                        }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?php echo htmlspecialchars($ct['ma_sach']); ?></td>
                                                                                        <td><?php echo htmlspecialchars($ct['ten_sach'] ?: 'Không xác định'); ?></td>
                                                                                        <td><?php echo (int)$ct['So_Luong']; ?></td>
                                                                                        <td><?php echo $ct_text; ?></td>
                                                                                    </tr>
                                                                                <?php endforeach; ?>
                                                                            <?php else: ?>
                                                                                <tr>
                                                                                    <td colspan="4" class="text-center">Không có dữ liệu chi tiết.</td>
                                                                                </tr>
                                                                            <?php endif; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="editLoanModal-<?php echo $id_pm; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="POST" action="phieumuon.php">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Cập nhật phiếu mượn #<?php echo $id_pm; ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="action" value="edit">
                                                                    <input type="hidden" name="ma_phieu_muon" value="<?php echo $id_pm; ?>">

                                                                    <div class="form-group">
                                                                        <label>Người mượn</label>
                                                                        <select name="ma_nguoi_dung" class="form-control" required>
                                                                            <?php foreach ($nguoi_dung_list as $nguoi_dung): ?>
                                                                                <option value="<?php echo (int)$nguoi_dung['ma_nguoi_dung']; ?>" <?php echo (int)$nguoi_dung['ma_nguoi_dung'] === (int)$phieu['ma_nguoi_dung'] ? 'selected' : ''; ?>>
                                                                                    <?php echo htmlspecialchars($nguoi_dung['ho_ten'] . ' (@' . $nguoi_dung['ten_dang_nhap'] . ')'); ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Ngày mượn</label>
                                                                        <input type="datetime-local" name="ngay_muon" class="form-control" required value="<?php echo to_datetime_local($phieu['ngay_muon']); ?>">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Ngày hẹn trả</label>
                                                                        <input type="datetime-local" name="ngay_hen_tra" class="form-control" required value="<?php echo to_datetime_local($phieu['ngay_hen_tra']); ?>">
                                                                    </div>

                                                                    <div class="form-group mb-0">
                                                                        <label>Ghi chú</label>
                                                                        <textarea name="ghi_chu" class="form-control" rows="3"><?php echo htmlspecialchars($phieu['ghi_chu']); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if ($trang_thai !== 'da_tra'): ?>
                                                    <div class="modal fade" id="returnLoanModal-<?php echo $id_pm; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" action="phieumuon.php">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Trả sách phiếu #<?php echo $id_pm; ?></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="action" value="return">
                                                                        <input type="hidden" name="ma_phieu_muon" value="<?php echo $id_pm; ?>">

                                                                        <p class="mb-2"><strong>Người mượn:</strong> <?php echo htmlspecialchars($phieu['ho_ten']); ?></p>
                                                                        <p class="mb-3"><strong>Ngày hẹn trả:</strong> <?php echo to_datetime_display($phieu['ngay_hen_tra']); ?></p>

                                                                        <div class="form-group mb-0">
                                                                            <label>Ngày trả thực tế</label>
                                                                            <input type="datetime-local" name="ngay_tra" class="form-control" required value="<?php echo date('Y-m-d\TH:i'); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                                        <button type="submit" class="btn btn-success">Xác nhận trả sách</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <?php $loan_modals[] = ob_get_clean(); ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                                            <tr>
                                                                <td colspan="9" class="text-center">Không có phiếu mượn nào.</td>
                                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if (!empty($loan_modals)): ?>
                                <?php echo implode("\n", $loan_modals); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>