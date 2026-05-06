<div class="container-fluid">

                    <?php if (!empty($message)): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($message); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Quản lý người dùng</h1>
                        
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên đăng nhập</th>
                                            <th>Họ và tên</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên đăng nhập</th>
                                            <th>Họ và tên</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if (isset($result) && $result && mysqli_num_rows($result) > 0): ?>
                                            <?php while ($user = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                    <td><?php echo $user['ma_nguoi_dung']; ?></td>
                                                    <td><?php echo htmlspecialchars($user['ten_dang_nhap']); ?></td>
                                                    <td><?php echo htmlspecialchars($user['ho_ten']); ?></td>
                                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                                    <td><?php echo htmlspecialchars($user['so_dien_thoai']); ?></td>
                                                    <td>
                                                        <?php if ((string)$user['trang_thai'] === '1'): ?>
                                                            <span class="badge badge-success">Hoạt động</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-secondary">Không hoạt động</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo $user['ngay_tao']; ?></td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUserModal-<?php echo $user['ma_nguoi_dung']; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <a href="nguoidung.php?delete_id=<?php echo $user['ma_nguoi_dung']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa người dùng này?');">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editUserModal-<?php echo $user['ma_nguoi_dung']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserLabel-<?php echo $user['ma_nguoi_dung']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="POST" action="nguoidung.php">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editUserLabel-<?php echo $user['ma_nguoi_dung']; ?>">Chỉnh sửa người dùng</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="action" value="edit">
                                                                    <input type="hidden" name="ma_nguoi_dung" value="<?php echo $user['ma_nguoi_dung']; ?>">
                                                                    <div class="form-group">
                                                                        <label>Tên đăng nhập</label>
                                                                        <input type="text" name="ten_dang_nhap" class="form-control" required value="<?php echo htmlspecialchars($user['ten_dang_nhap']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Họ và tên</label>
                                                                        <input type="text" name="ho_ten" class="form-control" required value="<?php echo htmlspecialchars($user['ho_ten']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input type="email" name="email" class="form-control" required value="<?php echo htmlspecialchars($user['email']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Số điện thoại</label>
                                                                        <input type="text" name="so_dien_thoai" class="form-control" required value="<?php echo htmlspecialchars($user['so_dien_thoai']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Trạng thái</label>
                                                                        <select name="trang_thai" class="form-control" required>
                                                                            <option value="1" <?php echo $user['trang_thai'] === '1' ? 'selected' : ''; ?>>Hoạt động</option>
                                                                            <option value="0" <?php echo $user['trang_thai'] === '0' ? 'selected' : ''; ?>>Không hoạt động</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mật khẩu (để trống nếu không đổi)</label>
                                                                        <input type="password" name="mat_khau" class="form-control" placeholder="Mật khẩu mới">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Không có người dùng nào.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>