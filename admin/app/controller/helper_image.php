<?php
function process_base64_image($input_data, $upload_dir) {
    // Nếu rỗng, trả về rỗng
    if (empty($input_data)) {
        return '';
    }

    // Kiểm tra xem input có phải là JSON của FilePond (plugin File Encode) không
    $decoded = json_decode($input_data, true);
    if (is_array($decoded) && isset($decoded['data'])) {
        // FilePond base64 string
        $base64_string = $decoded['data'];
        $extension = 'jpg'; // Mặc định
        if (isset($decoded['type'])) {
            $mime = $decoded['type'];
            if (strpos($mime, 'image/png') !== false) $extension = 'png';
            elseif (strpos($mime, 'image/gif') !== false) $extension = 'gif';
            elseif (strpos($mime, 'image/webp') !== false) $extension = 'webp';
        }
    } else {
        // Hoặc là một chuỗi Base64 thông thường dạng data:image/...;base64,
        if (strpos($input_data, 'data:image') === 0) {
            list($type, $input_data) = explode(';', $input_data);
            list(, $input_data) = explode(',', $input_data);
            $base64_string = $input_data;
            $extension = 'jpg';
            if (strpos($type, 'png') !== false) $extension = 'png';
            elseif (strpos($type, 'gif') !== false) $extension = 'gif';
            elseif (strpos($type, 'webp') !== false) $extension = 'webp';
        } else {
            // Nếu là URL bình thường (http) hoặc đường dẫn tương đối (images/...)
            return $input_data;
        }
    }

    // Decode base64
    $image_data = base64_decode($base64_string);
    if ($image_data === false) {
        error_log("Base64 decode failed.");
        return ''; // Decode thất bại
    }

    // Chuyển đổi mọi định dạng sang JPG để tối ưu và đồng bộ
    $image = @imagecreatefromstring($image_data);
    if ($image !== false) {
        $width = imagesx($image);
        $height = imagesy($image);
        $bg = imagecreatetruecolor($width, $height);
        // Nền trắng cho ảnh PNG/GIF trong suốt
        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
        imagecopy($bg, $image, 0, 0, 0, 0, $width, $height);
        
        ob_start();
        imagejpeg($bg, null, 90); // Chất lượng 90%
        $image_data = ob_get_clean();
        
        imagedestroy($image);
        imagedestroy($bg);
        $extension = 'jpg'; // Ép kiểu đuôi file
    }

    // Tạo thư mục nếu chưa có
    $target_dir = __DIR__ . '/../../../' . $upload_dir;
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Tạo tên file mã hóa ngẫu nhiên
    $filename = md5(uniqid(rand(), true)) . '.' . $extension;
    $filepath = $target_dir . '/' . $filename;

    // Ghi file
    if (file_put_contents($filepath, $image_data)) {
        // Trả về đường dẫn lưu trong DB (đường dẫn tương đối so với thư mục gốc)
        return $upload_dir . '/' . $filename;
    } else {
        error_log("Failed to write image file to: " . $filepath);
    }

    return '';
}
?>
