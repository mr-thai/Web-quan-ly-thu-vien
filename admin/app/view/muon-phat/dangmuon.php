<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Sách đang mượn</h6>
        <button type="button" class="btn btn-success btn-sm" id="processReturnBtn" <?php echo empty($sach_dang_muon) ? 'disabled' : ''; ?>>
            <i class="fas fa-undo mr-1"></i>Xử lý trả
        </button>
    </div>
    <div class="card-body">
        <div id="returnAlert" class="alert alert-warning d-none" role="alert">
            Vui lòng chọn ít nhất một cuốn sách để xử lý.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" id="selectAllBooks">
                        </th>
                        <th>Mã sách</th>
                        <th>Tên sách</th>
                        <th>Ngày mượn</th>
                        <th>Ngày hẹn trả</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($sach_dang_muon)): ?>
                        <?php foreach ($sach_dang_muon as $sach): ?>
                            <?php
                                $ngay_hen_tra = strtotime($sach['ngay_hen_tra']);
                                $now = time();
                                $trang_thai_badge = $now > $ngay_hen_tra ? 'badge-danger' : 'badge-success';
                                $trang_thai_text = $now > $ngay_hen_tra ? 'Trễ hạn' : 'Đang mượn';
                            ?>
                            <tr>
                                <td><input type="checkbox" class="book-select" data-id="<?php echo $sach['ma_chi_tiet_phieu']; ?>"></td>
                                <td>#S<?php echo str_pad($sach['ma_sach'], 3, '0', STR_PAD_LEFT); ?></td>
                                <td><?php echo htmlspecialchars($sach['ten_sach']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($sach['ngay_muon'])); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($sach['ngay_hen_tra'])); ?></td>
                                <td><span class="badge <?php echo $trang_thai_badge; ?>"><?php echo $trang_thai_text; ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Không có sách đang mượn</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var processBtn = document.getElementById('processReturnBtn');
    var selectAllCheckbox = document.getElementById('selectAllBooks');
    var bookCheckboxes = document.querySelectorAll('.book-select');
    var modal = document.getElementById('returnProcessModal');
    var selectedBooksList = document.getElementById('selectedBooksList');
    var hiddenBookData = document.getElementById('hiddenBookData');
    var returnAlert = document.getElementById('returnAlert');

    function updateSelectAllState() {
        var checkedCount = 0;
        bookCheckboxes.forEach(function(checkbox) {
            if (checkbox.checked) checkedCount++;
        });
        selectAllCheckbox.checked = checkedCount === bookCheckboxes.length && bookCheckboxes.length > 0;
        selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < bookCheckboxes.length;
    }

    selectAllCheckbox.addEventListener('change', function() {
        bookCheckboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });

    bookCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', updateSelectAllState);
    });

    processBtn.addEventListener('click', function() {
        var selectedCheckboxes = document.querySelectorAll('.book-select:checked');
        
        if (selectedCheckboxes.length === 0) {
            returnAlert.classList.remove('d-none');
            return;
        }

        returnAlert.classList.add('d-none');
        hiddenBookData.innerHTML = '';

        var tableHTML = '';
        selectedCheckboxes.forEach(function(checkbox, index) {
            var row = checkbox.closest('tr');
            var cells = row.querySelectorAll('td');
            var bookId = checkbox.getAttribute('data-id');
            var maSach = cells[1].textContent.trim();
            var tenSach = cells[2].textContent.trim();
            var ngayMuon = cells[3].textContent.trim();
            var ngayHenTra = cells[4].textContent.trim();
            var giaSach = cells[5].textContent.trim().split('đ')[0] || '0';
            
            tableHTML += '<tr><td>' + maSach + '</td>' +
                        '<td>' + tenSach + '</td>' +
                        '<td>' + ngayMuon + '</td>' +
                        '<td>' + ngayHenTra + '</td>' +
                        '<td>' + giaSach + '</td></tr>';
            
            var hiddenInput = document.createElement('div');
            hiddenInput.innerHTML = '<input type="hidden" name="ma_chi_tiet_phieu[]" value="' + bookId + '">';
            hiddenBookData.appendChild(hiddenInput);
        });
        
        selectedBooksList.innerHTML = tableHTML;

        if (window.$ && window.$.fn && window.$.fn.modal) {
            window.$(modal).modal('show');
        }
    });

    updateSelectAllState();
});
</script>
<div class="modal fade" id="returnProcessModal" tabindex="-1" role="dialog" aria-labelledby="returnProcessLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="returnProcessLabel">Xử lý trả sách</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="return_book">
                        
                        <div class="mb-3">
                            <div class="text-gray-900 font-weight-bold"><?php echo $nguoi_dung ? htmlspecialchars($nguoi_dung['ho_ten']) : 'Chưa chọn người dùng'; ?></div>
                            <div class="text-muted">Số điện thoại: <?php echo $nguoi_dung ? htmlspecialchars($nguoi_dung['so_dien_thoai']) : '--'; ?></div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Tình trạng sách</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="statusNormal" name="trang_thai" value="da_tra" class="custom-control-input" checked>
                                <label class="custom-control-label" for="statusNormal">Trả bình thường</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="statusDamaged" name="trang_thai" value="hu_hong" class="custom-control-input">
                                <label class="custom-control-label" for="statusDamaged">Hư hỏng</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="statusLost" name="trang_thai" value="mat_sach" class="custom-control-input">
                                <label class="custom-control-label" for="statusLost">Mất sách</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="statusLate" name="trang_thai" value="tra_tre_han" class="custom-control-input">
                                <label class="custom-control-label" for="statusLate">Trả trễ hạn</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="damageNote" class="font-weight-bold">Ghi chú</label>
                            <textarea id="damageNote" name="ghi_chu_tinh_trang" class="form-control" rows="3" placeholder="Mô tả chi tiết hư hỏng, mất sách (nếu có)"></textarea>
                        </div>

                        <div class="form-group mb-0">
                            <label class="font-weight-bold">Danh sách sách xử lý</label>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm mb-0" id="selectedBooksTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Mã sách</th>
                                            <th>Tên sách</th>
                                            <th>Ngày mượn</th>
                                            <th>Ngày hẹn trả</th>
                                            <th>Giá gốc</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selectedBooksList">
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Vui lòng chọn sách từ danh sách trên</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <input type="hidden" name="ngay_tra_thuc_te" value="<?php echo date('Y-m-d H:i:s'); ?>">
                        <div id="hiddenBookData"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                        <button class="btn btn-success" type="submit">Xác nhận cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>