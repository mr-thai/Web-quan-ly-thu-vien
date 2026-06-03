<?php
function sach_get_all($conn, $keyword = '')
{
    $sql = "SELECT s.*, tg.ho_ten AS ten_tac_gia,
                   COALESCE(a_main.url_anh, a_any.url_anh) AS url_anh,
                   CASE
                       WHEN COALESCE(a_main.url_anh, a_any.url_anh) LIKE '/uploads/%'
                           THEN CONCAT('/Quan_ly_thu_vien_phuc', COALESCE(a_main.url_anh, a_any.url_anh))
                       ELSE COALESCE(a_main.url_anh, a_any.url_anh)
                   END AS url_anh_hien_thi
            FROM sach s
            LEFT JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia
            LEFT JOIN (
                SELECT ma_sach, MAX(url_anh) AS url_anh
                FROM anh_sach
                WHERE anh_chinh = 1
                GROUP BY ma_sach
            ) a_main ON s.ma_sach = a_main.ma_sach
            LEFT JOIN (
                SELECT ma_sach, MAX(url_anh) AS url_anh
                FROM anh_sach
                GROUP BY ma_sach
            ) a_any ON s.ma_sach = a_any.ma_sach";

    if ($keyword !== '') {
        $search = '%' . $keyword . '%';
        $stmt = mysqli_prepare(
            $conn,
            $sql . " WHERE CAST(s.ma_sach AS CHAR) LIKE ?
                      OR s.ten_sach LIKE ?
                      OR s.isbn LIKE ?
                      OR tg.ho_ten LIKE ?
                      OR s.nha_xuat_ban LIKE ?
                      ORDER BY s.ma_sach DESC"
        );
        mysqli_stmt_bind_param($stmt, 'sssss', $search, $search, $search, $search, $search);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    return mysqli_query($conn, $sql . " ORDER BY s.ma_sach DESC");
}
?>