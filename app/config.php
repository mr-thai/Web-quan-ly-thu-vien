<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "qltv";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

/**
 * Normalize URL ảnh từ database để đảm bảo hiển thị chính xác
 */
function getImageUrl($imageUrl = '') {
    if (empty($imageUrl)) {
        return '/Quan_ly_thu_vien_phuc/images/books/default.jpg';
    }
    
    // Nếu đã là URL đầy đủ (http/https), trả về ngay
    if (preg_match('~^(?:f|ht)tps?://~i', $imageUrl)) {
        return $imageUrl;
    }
    
    // Nếu bắt đầu bằng /, thêm domain prefix
    if (strpos($imageUrl, '/') === 0) {
        return '/Quan_ly_thu_vien_phuc' . $imageUrl;
    }
    
    // Nếu là đường dẫn tương đối, thêm /Quan_ly_thu_vien_phuc/
    return '/Quan_ly_thu_vien_phuc/' . ltrim($imageUrl, '/');
}
?>
