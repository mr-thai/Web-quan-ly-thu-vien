(function () {
            var fineInputs = document.querySelectorAll('.fine-input');
            var totalFine = document.getElementById('totalFine');
            var selectAll = document.getElementById('selectAllFines');
            var fineCheckboxes = document.querySelectorAll('.fine-select');
            var confirmAllBtn = document.getElementById('confirmAllBtn');
            var alertBox = document.getElementById('fineAlert');
            var selectedFinesData = document.getElementById('selectedFinesData');

            function parseMoney(value) {
                if (!value) {
                    return 0;
                }
                return Number(value.toString().replace(/[^0-9]/g, '')) || 0;
            }

            function formatMoney(amount) {
                return amount.toLocaleString('vi-VN') + ' VNĐ';
            }

            function updateTotal() {
                var total = 0;
                fineCheckboxes.forEach(function (checkbox) {
                    if (checkbox.checked) {
                        var dataId = checkbox.getAttribute('data-id');
                        var input = document.querySelector('.fine-input[data-id="' + dataId + '"]');
                        if (input) {
                            total += parseMoney(input.value);
                        }
                    }
                });
                if (totalFine) {
                    totalFine.textContent = formatMoney(total);
                }
                updateSelectedFinesData();
            }

            function updateSelectedFinesData() {
                if (!selectedFinesData) return;
                selectedFinesData.innerHTML = '';
                
                fineCheckboxes.forEach(function (checkbox) {
                    if (checkbox.checked) {
                        var dataId = checkbox.getAttribute('data-id');
                        var input = document.querySelector('.fine-input[data-id="' + dataId + '"]');
                        if (input) {
                            var hidden = document.createElement('input');
                            hidden.type = 'hidden';
                            hidden.name = 'ma_phat[]';
                            hidden.value = dataId;
                            selectedFinesData.appendChild(hidden);
                            
                            var hiddenAmount = document.createElement('input');
                            hiddenAmount.type = 'hidden';
                            hiddenAmount.name = 'so_tien_phat_' + dataId;
                            hiddenAmount.value = parseMoney(input.value);
                            selectedFinesData.appendChild(hiddenAmount);
                        }
                    }
                });
            }

            function updateSelectAllState() {
                var checkedCount = 0;
                fineCheckboxes.forEach(function (box) {
                    if (box.checked) {
                        checkedCount++;
                    }
                });
                if (selectAll) {
                    selectAll.checked = checkedCount === fineCheckboxes.length && fineCheckboxes.length > 0;
                    selectAll.indeterminate = checkedCount > 0 && checkedCount < fineCheckboxes.length;
                }
            }

            if (selectAll) {
                selectAll.addEventListener('change', function () {
                    fineCheckboxes.forEach(function (box) {
                        box.checked = selectAll.checked;
                    });
                    if (alertBox) {
                        alertBox.classList.add('d-none');
                    }
                    updateTotal();
                });
            }

            fineCheckboxes.forEach(function (box) {
                box.addEventListener('change', function () {
                    updateSelectAllState();
                    if (alertBox) {
                        alertBox.classList.add('d-none');
                    }
                    updateTotal();
                });
            });

            if (confirmAllBtn) {
                confirmAllBtn.addEventListener('click', function () {
                    var anyChecked = false;
                    fineCheckboxes.forEach(function (box) {
                        if (box.checked) {
                            anyChecked = true;
                        }
                    });
                    if (!anyChecked && alertBox) {
                        alertBox.classList.remove('d-none');
                    } else if (anyChecked) {
                        // Submit the form
                        var form = document.querySelector('form');
                        if (form) {
                            form.submit();
                        }
                    }
                });
            }

            fineInputs.forEach(function (input) {
                input.addEventListener('input', updateTotal);
            });

            updateTotal();
            updateSelectAllState();
        })();