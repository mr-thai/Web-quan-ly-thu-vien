<?php
function sach_delete($conn, $ma_sach)
{
    mysqli_begin_transaction($conn);
    
    // Xoá ảnh liên kết trước (tránh lỗi khóa ngoại)
    $stmtAnh = mysqli_prepare($conn, "DELETE FROM anh_sach WHERE ma_sach = ?");
    mysqli_stmt_bind_param($stmtAnh, 'i', $ma_sach);
    mysqli_stmt_execute($stmtAnh);
    mysqli_stmt_close($stmtAnh);
    
    // Xoá sách
    $stmt = mysqli_prepare($conn, "DELETE FROM sach WHERE ma_sach = ?");
    mysqli_stmt_bind_param($stmt, 'i', $ma_sach);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    if ($ok) {
        mysqli_commit($conn);
    } else {
        mysqli_rollback($conn);
    }
    return $ok;
}
?>