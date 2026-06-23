# Hệ Thống Quản Lý Thư Viện (Web-quan-ly-thu-vien)

Đây là một ứng dụng web Quản lý Thư viện được xây dựng bằng **PHP** và cơ sở dữ liệu **MySQL**. Hệ thống cung cấp giao diện cho cả Người đọc (User) và Quản trị viên (Admin) với đầy đủ các tính năng mượn/trả sách, quản lý người dùng, tác giả, và xử lý vi phạm.

## Tính năng nổi bật

### Dành cho Người đọc (User)
- Đăng ký / Đăng nhập tài khoản.
- Xem danh sách sách và thông tin chi tiết từng cuốn sách.
- Xem thông tin tác giả.
- Giỏ mượn sách (Thêm sách vào giỏ để mượn).
- Theo dõi các sách đã mượn ("Sách của tôi").
- Xem lịch sử mượn và chi tiết phiếu mượn.
- Giao diện thân thiện, dễ sử dụng.

### Dành cho Quản trị viên (Admin)
- **Quản lý Thống kê (Dashboard)**: Xem tổng quan về sách, lượt mượn, người dùng.
- **Quản lý Sách**: Thêm, sửa, xóa thông tin sách, cập nhật hình ảnh.
- **Quản lý Tác giả**: Quản lý thông tin các tác giả.
- **Quản lý Người dùng**: Xem và quản lý danh sách độc giả.
- **Quản lý Phiếu mượn**: Phê duyệt các yêu cầu mượn sách từ người dùng.
- **Xử lý Trả sách**: Ghi nhận trả sách và cập nhật trạng thái kho.
- **Quản lý Lịch sử mượn**: Xem lại lịch sử các giao dịch.
- **Xử lý Vi phạm / Nộp phạt**: Quản lý độc giả trả sách muộn, làm mất sách và ghi nhận nộp phạt.

## Yêu cầu hệ thống

Để chạy được dự án này, máy tính của bạn cần cài đặt một môi trường máy chủ ảo cục bộ như:
- **XAMPP** (Khuyên dùng) / WAMP / MAMP / Laragon.
- **PHP** phiên bản >= 7.x
- **MySQL** / MariaDB.

## Hướng dẫn cài đặt

1. **Clone hoặc tải mã nguồn:**
   Tải hoặc git clone repository này về máy tính của bạn.
   ```bash
   git clone https://github.com/username/Web-quan-ly-thu-vien.git
   ```

2. **Cấu hình thư mục chứa code (Quan trọng):**
   - Copy toàn bộ thư mục dự án và đổi tên thành `Quan_ly_thu_vien_phuc` (Điều này bắt buộc vì hệ thống cấu hình đường dẫn tuyệt đối với tên thư mục này trong `app/config.php`).
   - Đặt thư mục `Quan_ly_thu_vien_phuc` vào thư mục gốc của web server (Ví dụ: đối với XAMPP là thư mục `htdocs`).
   - Đường dẫn đúng trên XAMPP sẽ là: `C:\xampp\htdocs\Quan_ly_thu_vien_phuc`

3. **Cấu hình Cơ sở dữ liệu (Database):**
   - Mở trình duyệt và truy cập vào công cụ quản lý MySQL: `http://localhost/phpmyadmin/`
   - Tạo một cơ sở dữ liệu mới với tên là: `qltv`
   - Chọn mục **Import** (Nhập), tải lên file `qltv.sql` nằm trong thư mục gốc của dự án và nhấn **Go** (Thực hiện) để tạo các bảng dữ liệu.

4. **Kiểm tra thông tin kết nối Database:**
   Mở file `app/config.php` và đảm bảo thông tin kết nối đúng với cấu hình máy chủ của bạn (mặc định của XAMPP thường là user: `root`, mật khẩu để trống):
   ```php
   $host = "localhost";
   $user = "root";
   $pass = "";
   $db   = "qltv";
   ```

5. **Chạy ứng dụng:**
   - Đảm bảo đã bật **Apache** và **MySQL** trên bảng điều khiển XAMPP/WAMP.
   - Mở trình duyệt web và truy cập vào địa chỉ:
     - Dành cho Người đọc: `http://localhost/Quan_ly_thu_vien_phuc/`
     - Dành cho Admin: `http://localhost/Quan_ly_thu_vien_phuc/admin/`

## Cấu trúc thư mục chính

```text
Web-quan-ly-thu-vien/
│
├── admin/                  # Giao diện và logic chức năng dành cho Quản trị viên
├── app/                    # Chứa mã nguồn chính (Mô hình MVC: controller, model, view)
│   └── config.php          # File cấu hình kết nối CSDL và các hàm tiện ích
├── css/                    # Các file stylesheet CSS
├── fonts/                  # Chứa font chữ tùy chỉnh
├── images/                 # Hình ảnh sách, banner và giao diện tĩnh
├── js/                     # Các file script JavaScript
├── uploads/                # Hình ảnh được người dùng/admin upload lên (vd: ảnh sách)
├── qltv.sql                # File dump CSDL MySQL để import
└── ...                     # Các file PHP giao diện chính (index.php, login.php, register.php, ...)
```

## Đóng góp
Nếu bạn muốn cải thiện dự án, vui lòng fork repository này và tạo pull request hoặc mở các issues để báo lỗi / đề xuất tính năng mới.
