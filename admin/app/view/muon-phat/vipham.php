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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectAllCheckbox = document.getElementById('selectAllFines');
        var fineCheckboxes = document.querySelectorAll('.fine-select');
        var fineInputs = document.querySelectorAll('.fine-input');
        var totalFineDisplay = document.getElementById('totalFine');
        var confirmAllBtn = document.getElementById('confirmAllBtn');
        var selectedFinesData = document.getElementById('selectedFinesData');
        var fineAlert = document.getElementById('fineAlert');

        function calculateTotal() {
            var total = 0;
            fineCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var dataId = checkbox.getAttribute('data-id');
                    var input = document.querySelector('.fine-input[data-id="' + dataId + '"]');
                    if (input) {
                        var value = parseInt(input.value.replace(/\D/g, '')) || 0;
                        total += value;
                    }
                }
            });
            totalFineDisplay.textContent = number_format(total) + ' VNĐ';
        }

        function number_format(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function updateSelectAllState() {
            var checkedCount = 0;
            fineCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) checkedCount++;
            });
            selectAllCheckbox.checked = checkedCount === fineCheckboxes.length && fineCheckboxes.length > 0;
            selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < fineCheckboxes.length;
        }

        selectAllCheckbox.addEventListener('change', function() {
            fineCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
            calculateTotal();
            updateSelectAllState();
        });

        fineCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                calculateTotal();
                updateSelectAllState();
            });
        });

        fineInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                // Format number as user types
                var value = this.value.replace(/\D/g, '');
                this.value = number_format(parseInt(value) || 0);
                calculateTotal();
            });
        });

        confirmAllBtn.addEventListener('click', function(e) {
            var selectedCheckboxes = document.querySelectorAll('.fine-select:checked');
        
            if (selectedCheckboxes.length === 0) {
                fineAlert.classList.remove('d-none');
                fineAlert.scrollIntoView({ behavior: 'smooth', block: 'start' });
                e.preventDefault();
                return;
            }

            fineAlert.classList.add('d-none');
            selectedFinesData.innerHTML = '';

            selectedCheckboxes.forEach(function(checkbox) {
                var dataId = checkbox.getAttribute('data-id');
                var input = document.querySelector('.fine-input[data-id="' + dataId + '"]');
                var amount = input.value.replace(/\D/g, '');

                var hiddenInput1 = document.createElement('input');
                hiddenInput1.type = 'hidden';
                hiddenInput1.name = 'ma_phat[]';
                hiddenInput1.value = dataId;
            
                var hiddenInput2 = document.createElement('input');
                hiddenInput2.type = 'hidden';
                hiddenInput2.name = 'so_tien_phat[]';
                hiddenInput2.value = amount;
            
                selectedFinesData.appendChild(hiddenInput1);
                selectedFinesData.appendChild(hiddenInput2);
            });

            // Submit form
            confirmAllBtn.closest('form').submit();
        });

        updateSelectAllState();
        calculateTotal();
    });
    </script>
                    <i class="fas fa-check mr-1"></i>Xác nhận đã nạp phạt
                </button>
            </form>
        </div>
    </div>
</div>