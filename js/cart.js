function updateReturnDate() {
            const selectedTime = document.querySelector('input[name="thoigian_muon"]:checked').value;
            const days = parseInt(selectedTime);
            const today = new Date();
            const returnDate = new Date(today.getTime() + days * 24 * 60 * 60 * 1000);
            
            const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            const formattedDate = returnDate.toLocaleDateString('vi-VN', options);
            
            document.getElementById('return-date').textContent = formattedDate;
        }

        // Cập nhật ngày trả khi thay đổi lựa chọn
        document.querySelectorAll('input[name="thoigian_muon"]').forEach(radio => {
            radio.addEventListener('change', updateReturnDate);
        });

        // Tính toán ngày trả ban đầu
        updateReturnDate();