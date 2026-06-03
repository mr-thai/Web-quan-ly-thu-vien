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