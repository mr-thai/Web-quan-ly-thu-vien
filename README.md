# GIDOC - Hệ Thống Quản Lý Thư Viện Trực Tuyến

> GIDOC (trước đây được biết đến với tên gọi Manlib) là một hệ thống ứng dụng web quản lý thư viện sách trực tuyến. Dự án cung cấp một nền tảng hiện đại giúp độc giả dễ dàng tìm kiếm, xem chi tiết và thực hiện các thao tác mượn/trả sách tự động. Đồng thời, hỗ trợ ban quản trị thư viện theo dõi và vận hành tài liệu một cách hiệu quả.

## 🚀 Tính năng chính

### Dành cho Độc giả (Người dùng)
- **Đăng ký & Đăng nhập**: Quản lý tài khoản cá nhân, bảo mật thông tin.
- **Khám phá Sách**: Xem danh sách các đầu sách nổi bật, sách bán chạy, sách mới phát hành.
- **Tìm kiếm & Lọc**: Dễ dàng tìm kiếm sách theo tên, danh mục hoặc tác giả.
- **Giỏ mượn sách**: Thêm sách vào "giỏ mượn" và tiến hành thủ tục mượn sách trực tuyến nhanh chóng.
- **Quản lý "Sách của tôi"**: Theo dõi danh sách các cuốn sách đang mượn, lịch sử mượn trả.
- **Thông tin Tác giả**: Tra cứu thông tin chi tiết về các tác giả và các tác phẩm của họ.

### Dành cho Quản trị viên (Admin)
- Bảng điều khiển (Dashboard) thống kê tổng quan.
- Quản lý danh mục sách, thêm/sửa/xóa sách.
- Quản lý người dùng.
- Theo dõi, xét duyệt và quản lý các đơn mượn/trả sách.

## 🛠 Công nghệ sử dụng

- **Frontend**: HTML5, CSS3, JavaScript, jQuery, Bootstrap, Owl Carousel.
- **Backend**: PHP thuần.
- **Database**: MySQL.

## 📋 Yêu cầu hệ thống

Để chạy dự án trên máy cá nhân (Localhost), bạn cần cài đặt một trong các phần mềm tạo máy chủ ảo như:
- [XAMPP](https://www.apachefriends.org/index.html) (Khuyên dùng)
- [WAMP](https://www.wampserver.com/en/)
- Hoặc bất kỳ môi trường nào hỗ trợ **PHP 7.x/8.x** và **MySQL**.

## ⚙️ Hướng dẫn cài đặt

Thực hiện các bước sau để chạy dự án trên máy của bạn:

1. **Clone repository về máy:**
   ```bash
   git clone <đường_dẫn_repo_của_bạn>
   ```

2. **Di chuyển dự án vào thư mục máy chủ ảo:**
   - Nếu dùng XAMPP: Copy toàn bộ thư mục dự án vào thư mục `C:\xampp\htdocs\`.
   - Nếu dùng WAMP: Copy vào `C:\wamp\www\`.
   - *Đổi tên thư mục dự án thành `gidoc` cho tiện sử dụng nếu muốn.*

3. **Cài đặt Cơ sở dữ liệu (Database):**
   - Mở ứng dụng XAMPP/WAMP và khởi động **Apache** và **MySQL**.
   - Truy cập vào phpMyAdmin qua trình duyệt: `http://localhost/phpmyadmin/`
   - Tạo một database mới với tên: `qltv` (Bảng mã: `utf8_general_ci` hoặc `utf8mb4_unicode_ci`).
   - Chọn database vừa tạo, chuyển sang tab **Import** (Nhập).
   - Chọn file `qltv.sql` nằm ở thư mục gốc của dự án và nhấn **Go** (Thực hiện) để import dữ liệu.

4. **Cấu hình kết nối Database:**
   - Mở file `app/config.php` (nếu có) hoặc các file kết nối database tương ứng.
   - Kiểm tra và đảm bảo thông tin kết nối đúng với môi trường của bạn (thường username là `root` và password để trống).

5. **Chạy dự án:**
   - Mở trình duyệt và truy cập: `http://localhost/Web-quan-ly-thu-vien/` (hoặc `http://localhost/gidoc/` tùy theo tên thư mục bạn đã đặt ở bước 2).

## 📁 Cấu trúc thư mục chính

```text
├── admin/          # Khu vực dành riêng cho Quản trị viên
├── app/            # Chứa các file xử lý logic (Controller), giao diện (View) và cấu hình (Config)
├── css/            # Các file stylesheet
├── fonts/          # Font chữ sử dụng trong dự án
├── images/         # Hình ảnh giao diện và banner
├── js/             # Các file JavaScript và thư viện (jQuery, Bootstrap js, Owl Carousel)
├── uploads/        # Thư mục lưu trữ hình ảnh tải lên (ảnh bìa sách, avatar...)
├── qltv.sql        # File backup cơ sở dữ liệu MySQL
├── index.php       # Trang chủ
├── login.php       # Trang đăng nhập
├── register.php    # Trang đăng ký
├── cartmuon.php    # Trang giỏ mượn sách
└── ...             # Các trang tính năng khác
```

## 🤝 Đóng góp
Mọi ý kiến đóng góp xin vui lòng tạo Issue hoặc gửi Pull Request. Chúng tôi luôn hoan nghênh những ý tưởng mới để hoàn thiện GIDOC!

## 📄 Giấy phép
Dự án được phát triển cho mục đích học tập và tham khảo.
