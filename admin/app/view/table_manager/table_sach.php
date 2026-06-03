<div class="container-fluid">

<?php $result = isset($result) ? $result : null; ?>
<?php if (!empty($message)): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($message); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Quản lý sách</h1>
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addBookModal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Thêm sách
    </button>
</div>

<div class="card shadow mb-4">                        
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã sách</th>
                        <th>Tên sách</th>
                        <th>Ảnh sách</th>
                        <th>Tác giả</th>
                        <th>ISBN</th>
                        <th>Thể loại</th>
                        <th>Giá</th>
                        <th>Tổng SL</th>
                        <th>Còn lại</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($sach = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($sach['ma_sach']); ?></td>
                                <td><?php echo htmlspecialchars($sach['ten_sach']); ?></td>
                                <td class="text-center">
                                    <?php if (!empty($sach['url_anh_hien_thi'])): ?>
                                        <img src="<?php echo htmlspecialchars($sach['url_anh_hien_thi']); ?>" alt="Ảnh sách" style="width:60px;height:80px;object-fit:cover;border-radius:4px;">
                                    <?php else: ?>
                                        --
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($sach['ten_tac_gia'] !== '' ? $sach['ten_tac_gia'] : '--'); ?></td>
                                <td><?php echo htmlspecialchars($sach['isbn']); ?></td>
                                <td><?php echo htmlspecialchars($sach['ten_the_loai']); ?></td>
                                <td><?php echo number_format((float)$sach['gia_sach'], 0, ',', '.'); ?> đ</td>
                                <td><?php echo (int)$sach['so_luong']; ?></td>
                                <td><?php echo (int)$sach['so_luong_con']; ?></td>
                                <td>
                                </td>
                                <td class="text-nowrap">
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editBookModal-<?php echo (int)$sach['ma_sach']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="sach.php?delete_id=<?php echo (int)$sach['ma_sach']; ?>" class="btn btn-danger btn-sm btn-delete-record">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <div class="modal fade" id="editBookModal-<?php echo (int)$sach['ma_sach']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="sach.php">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Cập nhật sách</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="action" value="edit">
                                                <input type="hidden" name="ma_sach" value="<?php echo (int)$sach['ma_sach']; ?>">

                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label>Mã sách</label>
                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($sach['ma_sach']); ?>" readonly>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>ISBN</label>
                                                        <input type="text" name="isbn" class="form-control" required value="<?php echo htmlspecialchars($sach['isbn']); ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Tên thể loại</label>
                                                        <input type="text" name="ten_the_loai" class="form-control" value="<?php echo htmlspecialchars($sach['ten_the_loai']); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Tác giả</label>
                                                        <select name="ma_tacgia" class="form-control" required>
                                                            <?php foreach ((isset($tac_gia_list) ? $tac_gia_list : []) as $tac_gia): ?>
                                                                <option value="<?php echo (int)$tac_gia['ma_tac_gia']; ?>" <?php echo (int)$tac_gia['ma_tac_gia'] === (int)$sach['ma_tacgia'] ? 'selected' : ''; ?>>
                                                                    <?php echo htmlspecialchars($tac_gia['ho_ten']); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Tên sách</label>
                                                        <input type="text" name="ten_sach" class="form-control" required value="<?php echo htmlspecialchars($sach['ten_sach']); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label>Nhà xuất bản</label>
                                                        <input type="text" name="nha_xuat_ban" class="form-control" required value="<?php echo htmlspecialchars($sach['nha_xuat_ban']); ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Năm xuất bản</label>
                                                        <input type="number" min="0" name="nam_xuat_ban" class="form-control" value="<?php echo (int)$sach['nam_xuat_ban']; ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Số trang</label>
                                                        <input type="number" min="0" name="so_trang" class="form-control" value="<?php echo (int)$sach['so_trang']; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label>Giá sách</label>
                                                        <input type="number" min="0" step="1000" name="gia_sach" class="form-control" value="<?php echo (float)$sach['gia_sach']; ?>">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Tổng số lượng</label>
                                                        <input type="number" min="0" name="so_luong" class="form-control" value="<?php echo (int)$sach['so_luong']; ?>">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Số lượng còn</label>
                                                        <input type="number" min="0" name="so_luong_con" class="form-control" value="<?php echo (int)$sach['so_luong_con']; ?>">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Vị trí kệ</label>
                                                        <input type="text" name="vi_tri_ke" class="form-control" required value="<?php echo htmlspecialchars($sach['vi_tri_ke']); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-0">
                                                    <label>Mô tả</label>
                                                    <textarea name="mo_ta" class="form-control" rows="3"><?php echo htmlspecialchars($sach['mo_ta']); ?></textarea>
                                                </div>

                                                <div class="form-group mt-3 mb-0">
                                                    <label>Ảnh sách (Tải lên từ máy hoặc link)</label>
                                                    <!-- Input phụ để giữ URL cũ nếu không đổi ảnh -->
                                                    <input type="hidden" name="old_url_anh" value="<?php echo htmlspecialchars($sach['url_anh'] ?? ''); ?>">
                                                    <input type="file" class="filepond" name="url_anh" accept="image/png, image/jpeg, image/gif, image/webp" />
                                                    <small class="text-muted">Đang dùng: <?php echo htmlspecialchars($sach['url_anh'] ?? 'Chưa có ảnh'); ?></small>
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
                            <td colspan="11" class="text-center">Không có sách nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="sach.php">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm sách mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Mã sách</label>
                            <input type="text" name="ma_sach" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>ISBN</label>
                            <input type="text" name="isbn" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tên thể loại</label>
                            <input type="text" name="ten_the_loai" class="form-control" value="Văn học">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Tác giả</label>
                            <select name="ma_tacgia" class="form-control" required>
                                <?php foreach ((isset($tac_gia_list) ? $tac_gia_list : []) as $tac_gia): ?>
                                    <option value="<?php echo (int)$tac_gia['ma_tac_gia']; ?>"><?php echo htmlspecialchars($tac_gia['ho_ten']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tên sách</label>
                            <input type="text" name="ten_sach" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Nhà xuất bản</label>
                            <input type="text" name="nha_xuat_ban" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Năm xuất bản</label>
                            <input type="number" min="0" name="nam_xuat_ban" class="form-control" value="2025">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Số trang</label>
                            <input type="number" min="0" name="so_trang" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Giá sách</label>
                            <input type="number" min="0" step="1000" name="gia_sach" class="form-control" value="0">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tổng số lượng</label>
                            <input type="number" min="0" name="so_luong" class="form-control" value="1">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Số lượng còn</label>
                            <input type="number" min="0" name="so_luong_con" class="form-control" value="1">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Vị trí kệ</label>
                            <input type="text" name="vi_tri_ke" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label>Mô tả</label>
                        <textarea name="mo_ta" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group mt-3 mb-0">
                        <label>Ảnh bìa sách</label>
                        <input type="file" class="filepond" name="url_anh" accept="image/png, image/jpeg, image/gif, image/webp" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Thêm sách</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- FilePond CSS -->
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<!-- FilePond JS -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    FilePond.registerPlugin(FilePondPluginFileEncode, FilePondPluginImagePreview);
    
    // Khởi tạo FilePond cho tất cả các input class filepond
    const inputElements = document.querySelectorAll('input.filepond');
    Array.from(inputElements).forEach(inputElement => {
        FilePond.create(inputElement, {
            storeAsFile: false, // FileEncode plugin sẽ chuyển file thành base64 hidden input
            labelIdle: 'Kéo thả ảnh vào đây hoặc <span class="filepond--label-action">Chọn từ máy</span>',
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1.4',
            imageResizeTargetWidth: 400,
            imageResizeTargetHeight: 560,
            stylePanelLayout: 'compact',
            styleLoadIndicatorPosition: 'center bottom',
            styleProgressIndicatorPosition: 'right bottom',
            styleButtonRemoveItemPosition: 'left bottom',
            styleButtonProcessItemPosition: 'right bottom',
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('click', function(e) {
    let target = e.target.closest('a.btn-delete-record');
    if (target) {
        e.preventDefault();
        const href = target.getAttribute('href');
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: "Dữ liệu không thể khôi phục sau khi xóa!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74a3b',
            cancelButtonColor: '#858796',
            confirmButtonText: 'Có, Xóa!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    }
});
</script>
</div>