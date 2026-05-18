(function () {
    'use strict';

    if (window.__traNapScriptLoaded) return;
    window.__traNapScriptLoaded = true;
    try { console.log('tra_nap.js initialized'); } catch (e) {}

    function formatNumber(value) {
        var numericValue = String(value || '').replace(/\D/g, '');
        if (numericValue === '') numericValue = '0';
        return numericValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function parseMoney(value) {
        return parseInt(String(value || '').replace(/\D/g, ''), 10) || 0;
    }

    function qs(selector) { return document.querySelector(selector); }
    function qsa(selector) { return Array.prototype.slice.call(document.querySelectorAll(selector)); }

    function recalcTotals() {
        var rows = qsa('.book-row');
        var totalBooks = 0;
        var totalFine = 0;

        rows.forEach(function (row) {
            var checkbox = row.querySelector('.book-select');
            var fineInput = row.querySelector('.fine-input');
            if (!checkbox || !fineInput) return;
            if (checkbox.checked) {
                totalBooks++;
                totalFine += parseMoney(fineInput.value);
            }
        });

        var totalBooksEl = qs('#totalBooks');
        var totalFineEl = qs('#totalFine');
        if (totalBooksEl) totalBooksEl.textContent = String(totalBooks);
        if (totalFineEl) totalFineEl.textContent = formatNumber(totalFine) + ' VNĐ';
    }

    function enableRowInputs(row, enabled) {
        var select = row.querySelector('.status-select');
        var fine = row.querySelector('.fine-input');
        var hiddenMa = row.querySelector('.hidden-ma');
        var hiddenPrice = row.querySelector('.hidden-price');
        if (select) select.disabled = !enabled;
        if (fine) fine.disabled = !enabled;
        if (hiddenMa) hiddenMa.disabled = !enabled;
        if (hiddenPrice) hiddenPrice.disabled = !enabled;
    }

    function defaultFineForRow(row) {
        var select = row.querySelector('.status-select');
        var price = parseMoney(row.querySelector('.hidden-price') ? row.querySelector('.hidden-price').value : 0);
        var due = row.getAttribute('data-due');
        var dueTs = due ? Date.parse(due) : 0;
        var now = Date.now();
        var defaultFine = 0;

        var status = select ? select.value : 'da_tra';
        // Rules: trễ = 10,000; hư hỏng = 70% of original price; mất = full original price
        if (status === 'hu_hong') {
            defaultFine = Math.round((price || 0) * 0.7);
        } else if (status === 'mat_sach') {
            defaultFine = (price || 0);
        } else if (status === 'tra_tre_han') {
            defaultFine = 10000;
        } else if (status === 'da_tra') {
            // if returned normally but past due date, apply late fee
            if (dueTs && now > dueTs) {
                defaultFine = 10000;
            } else {
                defaultFine = 0;
            }
        }

        return defaultFine;
    }

    function bindAll() {
        var rows = qsa('.book-row');
        // initially disable inputs
        rows.forEach(function (r) { enableRowInputs(r, false); });
        recalcTotals();

        // delegated change handler
        document.addEventListener('change', function (e) {
            var t = e.target;

            if (t.matches('.book-select')) {
                try { console.log('book-select changed', t); } catch (e) {}
                var row = t.closest('.book-row');
                if (!row) return;
                enableRowInputs(row, t.checked);
                if (t.checked) {
                    var f = row.querySelector('.fine-input');
                    if (f) f.value = formatNumber(defaultFineForRow(row));
                }
                recalcTotals();
                return;
            }

            if (t.matches('.status-select')) {
                var row2 = t.closest('.book-row');
                if (!row2) return;
                var cb = row2.querySelector('.book-select');
                if (cb && cb.checked) {
                    var f2 = row2.querySelector('.fine-input');
                    if (f2) f2.value = formatNumber(defaultFineForRow(row2));
                    recalcTotals();
                }
                return;
            }

            if (t.matches('#selectAllBooks')) {
                var rowsAll = qsa('.book-row');
                rowsAll.forEach(function (r) {
                    var cb = r.querySelector('.book-select');
                    if (!cb) return;
                    cb.checked = t.checked;
                    enableRowInputs(r, t.checked);
                    if (t.checked) {
                        var f3 = r.querySelector('.fine-input');
                        if (f3) f3.value = formatNumber(defaultFineForRow(r));
                    }
                });
                recalcTotals();
                return;
            }
        });

        // delegated input handler for fine inputs
        document.addEventListener('input', function (e) {
            var t = e.target;
            if (t.matches('.fine-input')) {
                t.value = formatNumber(t.value);
                recalcTotals();
            }
        });

        // delegated click for complete button
        document.addEventListener('click', function (e) {
            var btn = e.target.closest && e.target.closest('#completeTransactionBtn');
            if (!btn) return;
            var form = qs('#transactionForm');
            var any = qsa('.book-select:checked').length > 0;
            if (!any) {
                var alert = qs('#returnAlert');
                if (alert) { alert.classList.remove('d-none'); alert.scrollIntoView({behavior:'smooth', block:'center'}); }
                return;
            }

            qsa('.book-row').forEach(function (r) {
                var cb = r.querySelector('.book-select');
                if (cb && cb.checked) enableRowInputs(r, true);
            });

            if (form) form.submit();
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bindAll);
    } else {
        // DOM already ready — run immediately
        bindAll();
    }
})();
