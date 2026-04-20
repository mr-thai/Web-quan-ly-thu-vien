<?php
$message = '';
$keyword = trim($_GET['keyword'] ?? '');


$the_loai_list = array();
$the_loai_rs = mysqli_query($conn, "SELECT id_the_loai, ten_the_loai FROM the_loai ORDER BY ten_the_loai ASC");
if ($the_loai_rs) {
    while ($row = mysqli_fetch_assoc($the_loai_rs)) {
        $the_loai_list[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
   
    $id_sach = (int)($_POST['id_sach'] ?? 0);
    $ma_sach = trim($_POST['ma_sach'] ?? '');
    $isbn = trim($_POST['isbn'] ?? '');
    $ten_sach = trim($_POST['ten_sach'] ?? '');
    $nha_xuat_ban = trim($_POST['nha_xuat_ban'] ?? '');
    $id_the_loai = (int)($_POST['id_the_loai'] ?? 0);
    $so_trang = (int)($_POST['so_trang'] ?? 0);
    $gia_sach = (float)($_POST['gia_sach'] ?? 0);
    $so_luong = (int)($_POST['so_luong'] ?? 0);
    $vi_tri_ke = trim($_POST['vi_tri_ke'] ?? '');
    $mo_ta = trim($_POST['mo_ta'] ?? '');

    $so_luong = max(0, $so_luong);
    $sl_con_input = trim($_POST['so_luong_con'] ?? '');
    $so_luong_con = ($sl_con_input === '') ? $so_luong : (int)$sl_con_input;
    $so_luong_con = min($so_luong, max(0, $so_luong_con));
    
    $trang_thai = ($so_luong_con > 0) ? 'con' : 'het';

    if ($ma_sach === '' || $isbn === '' || $ten_sach === '' || $id_the_loai <= 0) {
        $message = 'Vui lòng điền đầy đủ các trường bắt buộc!';
    } else {
        if ($action === 'add') {
            $sql = "INSERT INTO sach (ma_sach, isbn, ten_sach, nha_xuat_ban, id_the_loai, so_trang, gia_sach, so_luong, so_luong_con, vi_tri_ke, mo_ta, trang_thai) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssiiidiiss', $ma_sach, $isbn, $ten_sach, $nha_xuat_ban, $id_the_loai, $so_trang, $gia_sach, $so_luong, $so_luong_con, $vi_tri_ke, $mo_ta, $trang_thai);
        } 
        elseif ($action === 'edit') {
            $sql = "UPDATE sach SET ma_sach=?, isbn=?, ten_sach=?, nha_xuat_ban=?, id_the_loai=?, so_trang=?, gia_sach=?, so_luong=?, so_luong_con=?, vi_tri_ke=?, mo_ta=?, trang_thai=? 
                    WHERE id_sach=?";
            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param($stmt, 'ssssiiidiissi', $ma_sach, $isbn, $ten_sach, $nha_xuat_ban, $id_the_loai, $so_trang, $gia_sach, $so_luong, $so_luong_con, $vi_tri_ke, $mo_ta, $trang_thai, $id_sach);
        }

        if (isset($stmt) && mysqli_stmt_execute($stmt)) {
            $message = "Thao tác thành công!";
            mysqli_stmt_close($stmt);
        } else {
            $message = "Lỗi: " . mysqli_error($conn);
        }
    }
}

if (isset($_GET['delete_id'])) {
    $del_id = (int)$_GET['delete_id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM sach WHERE id_sach = ?");
    mysqli_stmt_bind_param($stmt, 'i', $del_id);
    $message = mysqli_stmt_execute($stmt) ? "Đã xóa sách." : "Lỗi xóa sách.";
}

$sql_select = "SELECT s.*, tl.ten_the_loai, COALESCE(tg_agg.tac_gia_text, '') AS tac_gia_text
               FROM sach s
               LEFT JOIN the_loai tl ON s.id_the_loai = tl.id_the_loai
               LEFT JOIN (
                   SELECT tgs.ma_sach, GROUP_CONCAT(DISTINCT tg.ho_ten ORDER BY tg.ho_ten SEPARATOR ', ') AS tac_gia_text
                   FROM tac_gia_sach tgs
                   LEFT JOIN tac_gia tg ON tgs.ma_tac_gia = tg.ma_tac_gia
                   GROUP BY tgs.ma_sach
               ) tg_agg ON tg_agg.ma_sach = s.ma_sach";

if ($keyword !== '') {
    $search = "%$keyword%";
    $sql_select .= " WHERE s.ma_sach LIKE ? OR s.ten_sach LIKE ? OR tl.ten_the_loai LIKE ? OR tg_agg.tac_gia_text LIKE ?";
    $stmt = mysqli_prepare($conn, $sql_select . " ORDER BY s.id_sach DESC");
    mysqli_stmt_bind_param($stmt, 'ssss', $search, $search, $search, $search);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($conn, $sql_select . " ORDER BY s.id_sach DESC");
}
?>