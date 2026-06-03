(function () {
            var bookRows = document.getElementById('bookRows');
            var template = document.getElementById('bookRowTemplate');
            var addButton = document.getElementById('addBookRow');

            if (!bookRows || !template || !addButton) {
                return;
            }

            function refreshRemoveButtons() {
                var rows = bookRows.querySelectorAll('.borrow-book-row');

                for (var i = 0; i < rows.length; i++) {
                    var btn = rows[i].querySelector('.btn-remove-book');
                    if (btn) {
                        btn.disabled = rows.length === 1;
                    }
                }
            }

            addButton.addEventListener('click', function () {
                var wrapper = document.createElement('div');
                wrapper.innerHTML = template.innerHTML.trim();
                if (wrapper.firstElementChild) {
                    bookRows.appendChild(wrapper.firstElementChild);
                    refreshRemoveButtons();
                }
            });

            bookRows.addEventListener('click', function (event) {
                var button = event.target.closest('.btn-remove-book');
                if (!button) {
                    return;
                }

                var row = button.closest('.borrow-book-row');
                if (row) {
                    row.remove();
                    refreshRemoveButtons();
                }
            });

            refreshRemoveButtons();
        })();