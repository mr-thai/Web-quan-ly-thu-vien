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