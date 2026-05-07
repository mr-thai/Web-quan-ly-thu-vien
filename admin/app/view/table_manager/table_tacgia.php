                <div class="container-fluid">
                    <?php
                        $message = $message ?? '';
                        $result = $result ?? null;
                    ?>

                    <?php if (!empty($message)): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($message); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Quản lý tác giả</h1>
                        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addAuthorModal">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Thêm tác giả
                        </button>
                    </div>

                    <div class="card shadow mb-4">
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã tác giả</th>
                                            <th>Ảnh tác giả</th>
                                            <th>Họ tên</th>
                                            <th>Bút danh</th>
                                            <th>Ngày sinh</th>
                                            <th>Ngày mất</th>
                                            <th>Quốc tịch</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                            <?php while ($tacgia = mysqli_fetch_assoc($result)): ?>
                                                <?php
                                                    if (!empty($tacgia['avatar_url'])) {
                                                        $avatarUrl = $tacgia['avatar_url'];
                                                        if ($avatarUrl[0] === '/') {
                                                            $avatarUrl = '/Quan_ly_thu_vien' . $avatarUrl;
                                                        } else {
                                                            $avatarUrl = '../' . ltrim($avatarUrl, '/');
                                                        }
                                                    } else {
                                                        $avatarUrl = '/Quan_ly_thu_vien/images/author/imag-24.jpg';
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo (int)$tacgia['ma_tac_gia']; ?></td>
                                                    <td>
                                                        <img src="<?php echo htmlspecialchars($avatarUrl); ?>"
                                                             alt="Ảnh tác giả"
                                                             style="width: 60px; height: 60px; ">
                                                    </td>
                                                    <td><?php echo htmlspecialchars($tacgia['ho_ten']); ?></td>
                                                    <td><?php echo htmlspecialchars($tacgia['but_danh']); ?></td>
                                                    <td><?php echo !empty($tacgia['ngay_sinh']) ? date('d/m/Y', strtotime($tacgia['ngay_sinh'])) : '--'; ?></td>
                                                    <td><?php echo !empty($tacgia['ngay_mat']) ? date('d/m/Y', strtotime($tacgia['ngay_mat'])) : '--'; ?></td>
                                                    <td><?php echo htmlspecialchars($tacgia['quoc_tich']); ?></td>
                                                    <td class="text-nowrap">
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAuthorModal-<?php echo (int)$tacgia['ma_tac_gia']; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <a href="tacgia.php?delete_id=<?php echo (int)$tacgia['ma_tac_gia']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa tác giả này?');">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="editAuthorModal-<?php echo (int)$tacgia['ma_tac_gia']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <form method="POST" action="tacgia.php">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Cập nhật tác giả</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="action" value="edit">
                                                                    <input type="hidden" name="ma_tac_gia" value="<?php echo (int)$tacgia['ma_tac_gia']; ?>">

                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label>Họ tên</label>
                                                                            <input type="text" name="ho_ten" class="form-control" required value="<?php echo htmlspecialchars($tacgia['ho_ten']); ?>">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Bút danh</label>
                                                                            <input type="text" name="but_danh" class="form-control" value="<?php echo htmlspecialchars($tacgia['but_danh']); ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                            <label>Ngày sinh</label>
                                                                            <input type="date" name="ngay_sinh" class="form-control" value="<?php echo htmlspecialchars($tacgia['ngay_sinh']); ?>">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label>Ngày mất</label>
                                                                            <input type="date" name="ngay_mat" class="form-control" value="<?php echo htmlspecialchars($tacgia['ngay_mat']); ?>">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label>Quốc tịch</label>
                                                                            <input type="text" name="quoc_tich" class="form-control" value="<?php echo htmlspecialchars($tacgia['quoc_tich']); ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Đường dẫn ảnh tác giả</label>
                                                                        <input type="text" name="avatar_url" class="form-control" value="<?php echo htmlspecialchars($tacgia['avatar_url'] ?? ''); ?>" placeholder="Ví dụ: images/author/abc.jpg">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Tiểu sử</label>
                                                                        <textarea name="tieu_su" class="form-control" rows="3"><?php echo htmlspecialchars($tacgia['tieu_su']); ?></textarea>
                                                                    </div>
                                                                    <div class="form-group mb-0">
                                                                        <label>Ghi chú</label>
                                                                        <textarea name="ghi_chu" class="form-control" rows="2"><?php echo htmlspecialchars($tacgia['ghi_chu']); ?></textarea>
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
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Không có tác giả nào.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="addAuthorModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form method="POST" action="tacgia.php">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Thêm tác giả mới</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="action" value="add">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Họ tên</label>
                                                <input type="text" name="ho_ten" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Bút danh</label>
                                                <input type="text" name="but_danh" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Ngày sinh</label>
                                                <input type="date" name="ngay_sinh" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Ngày mất</label>
                                                <input type="date" name="ngay_mat" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Quốc tịch</label>
                                                <input type="text" name="quoc_tich" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Đường dẫn ảnh tác giả</label>
                                            <input type="text" name="avatar_url" class="form-control" placeholder="Ví dụ: images/author/abc.jpg">
                                        </div>

                                        <div class="form-group">
                                            <label>Tiểu sử</label>
                                            <textarea name="tieu_su" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label>Ghi chú</label>
                                            <textarea name="ghi_chu" class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary">Thêm tác giả</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>