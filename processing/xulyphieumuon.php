<?php
$message = '';
$keyword = trim($_GET['keyword'] ?? '');
$status_filter = trim($_GET['status'] ?? '');

if (!defined('FINE_PER_BOOK_PER_DAY')) {
    define('FINE_PER_BOOK_PER_DAY', 2000);
}

function pm_to_sql_datetime($value, $fallback_now = false)
{
    $value = trim((string)$value);
    if ($value === '') {
        return $fallback_now ? date('Y-m-d H:i:s') : '';
    }

    $ts = strtotime($value);
    if ($ts === false) {
        return $fallback_now ? date('Y-m-d H:i:s') : '';
    }

    return date('Y-m-d H:i:s', $ts);
}

function pm_next_detail_id($conn)
{
    $next_id = 1;
    $rs = mysqli_query($conn, "SELECT COALESCE(MAX(id_chi_tiet_phieu), 0) + 1 AS next_id FROM chi_tiet_phieu_muon");
    if ($rs) {
        $row = mysqli_fetch_assoc($rs);
        $next_id = (int)($row['next_id'] ?? 1);
        mysqli_free_result($rs);
    }
    return $next_id;
}

function pm_update_book_stock($conn, $ma_sach, $so_luong_con)
{
    $so_luong_con = max(0, (int)$so_luong_con);
    $trang_thai = $so_luong_con > 0 ? 'con' : 'het';

    $stmt = mysqli_prepare($conn, "UPDATE sach SET so_luong_con = ?, trang_thai = ? WHERE ma_sach = ?");
    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, 'iss', $so_luong_con, $trang_thai, $ma_sach);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $ok;
}

// Đồng bộ trạng thái phiếu đang mượn theo thời gian thực.
mysqli_query($conn, "UPDATE phieu_muon SET trang_thai = 'tre_han' WHERE trang_thai = 'dang_muon' AND ngay_hen_tra < NOW() AND ngay_tra IS NULL");
mysqli_query($conn, "UPDATE phieu_muon SET trang_thai = 'dang_muon' WHERE trang_thai = 'tre_han' AND ngay_hen_tra >= NOW() AND ngay_tra IS NULL");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $id_nguoi_dung = (int)($_POST['id_nguoi_dung'] ?? 0);
        $ngay_muon = pm_to_sql_datetime($_POST['ngay_muon'] ?? '', true);
        $ngay_hen_tra = pm_to_sql_datetime($_POST['ngay_hen_tra'] ?? '', false);
        $ghi_chu = trim($_POST['ghi_chu'] ?? '');
        $ma_sach_list = $_POST['ma_sach'] ?? array();
        $so_luong_list = $_POST['so_luong'] ?? array();

        $book_items = array();
        foreach ($ma_sach_list as $idx => $ma_sach_raw) {
            $ma_sach = trim((string)$ma_sach_raw);
            $so_luong = isset($so_luong_list[$idx]) ? (int)$so_luong_list[$idx] : 0;

            if ($ma_sach === '' || $so_luong <= 0) {
                continue;
            }

            if (!isset($book_items[$ma_sach])) {
                $book_items[$ma_sach] = 0;
            }
            $book_items[$ma_sach] += $so_luong;
        }

        if ($id_nguoi_dung <= 0 || $ngay_hen_tra === '' || empty($book_items)) {
            $message = 'Vui lòng nhập đầy đủ dữ liệu phiếu mượn và danh sách sách.';
        } elseif (strtotime($ngay_hen_tra) <= strtotime($ngay_muon)) {
            $message = 'Ngày hẹn trả phải lớn hơn ngày mượn.';
        } else {
            mysqli_begin_transaction($conn);
            $ok = true;

            $tong_so_sach = 0;
            foreach ($book_items as $qty) {
                $tong_so_sach += (int)$qty;
            }

            $stmt_pm = mysqli_prepare(
                $conn,
                "INSERT INTO phieu_muon (id_nguoi_dung, ngay_muon, ngay_hen_tra, ngay_tra, tong_so_sach, trang_thai, ghi_chu)
                 VALUES (?, ?, ?, NULL, ?, 'dang_muon', ?)"
            );

            if ($stmt_pm) {
                mysqli_stmt_bind_param($stmt_pm, 'issis', $id_nguoi_dung, $ngay_muon, $ngay_hen_tra, $tong_so_sach, $ghi_chu);
                if (!mysqli_stmt_execute($stmt_pm)) {
                    $ok = false;
                    $message = 'Lỗi tạo phiếu mượn: ' . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt_pm);
            } else {
                $ok = false;
                $message = 'Không thể khởi tạo truy vấn tạo phiếu mượn.';
            }

            $id_phieu_muon = $ok ? (int)mysqli_insert_id($conn) : 0;
            $next_detail_id = pm_next_detail_id($conn);

            if ($ok) {
                foreach ($book_items as $ma_sach => $qty) {
                    $stmt_book = mysqli_prepare($conn, "SELECT so_luong_con, gia_sach FROM sach WHERE ma_sach = ? FOR UPDATE");
                    if (!$stmt_book) {
                        $ok = false;
                        $message = 'Không thể kiểm tra tồn kho sách.';
                        break;
                    }

                    mysqli_stmt_bind_param($stmt_book, 's', $ma_sach);
                    mysqli_stmt_execute($stmt_book);
                    $book_rs = mysqli_stmt_get_result($stmt_book);
                    $book_row = $book_rs ? mysqli_fetch_assoc($book_rs) : null;
                    mysqli_stmt_close($stmt_book);

                    if (!$book_row) {
                        $ok = false;
                        $message = 'Không tìm thấy mã sách: ' . $ma_sach;
                        break;
                    }

                    $so_luong_con = (int)$book_row['so_luong_con'];
                    if ($so_luong_con < $qty) {
                        $ok = false;
                        $message = 'Sách ' . $ma_sach . ' không đủ số lượng tồn.';
                        break;
                    }

                    if (!pm_update_book_stock($conn, $ma_sach, $so_luong_con - $qty)) {
                        $ok = false;
                        $message = 'Không thể cập nhật tồn kho cho sách ' . $ma_sach;
                        break;
                    }

                    $gia_sach_luc_muon = (float)$book_row['gia_sach'];
                    $ngay_tra_mac_dinh = '1000-01-01 00:00:00';

                    $stmt_detail = mysqli_prepare(
                        $conn,
                        "INSERT INTO chi_tiet_phieu_muon (id_chi_tiet_phieu, id_phieu_muon, ma_sach, gia_sach_luc_muon, So_Luong, ngay_tra_thuc_te, so_ngay_tre, tien_phat, trang_thai)
                         VALUES (?, ?, ?, ?, ?, ?, 0, 0, 'dang_muon')"
                    );

                    if (!$stmt_detail) {
                        $ok = false;
                        $message = 'Không thể tạo chi tiết phiếu mượn.';
                        break;
                    }

                    mysqli_stmt_bind_param(
                        $stmt_detail,
                        'iisdis',
                        $next_detail_id,
                        $id_phieu_muon,
                        $ma_sach,
                        $gia_sach_luc_muon,
                        $qty,
                        $ngay_tra_mac_dinh
                    );

                    if (!mysqli_stmt_execute($stmt_detail)) {
                        $ok = false;
                        $message = 'Lỗi thêm chi tiết phiếu mượn: ' . mysqli_error($conn);
                        mysqli_stmt_close($stmt_detail);
                        break;
                    }

                    mysqli_stmt_close($stmt_detail);
                    $next_detail_id++;
                }
            }

            if ($ok) {
                mysqli_commit($conn);
                $message = 'Tạo phiếu mượn thành công.';
            } else {
                mysqli_rollback($conn);
                if ($message === '') {
                    $message = 'Không thể tạo phiếu mượn.';
                }
            }
        }
    }

    if ($action === 'edit') {
        $id_phieu_muon = (int)($_POST['id_phieu_muon'] ?? 0);
        $id_nguoi_dung = (int)($_POST['id_nguoi_dung'] ?? 0);
        $ngay_muon = pm_to_sql_datetime($_POST['ngay_muon'] ?? '', true);
        $ngay_hen_tra = pm_to_sql_datetime($_POST['ngay_hen_tra'] ?? '', false);
        $ghi_chu = trim($_POST['ghi_chu'] ?? '');

        if ($id_phieu_muon <= 0 || $id_nguoi_dung <= 0 || $ngay_hen_tra === '') {
            $message = 'Dữ liệu cập nhật phiếu mượn không hợp lệ.';
        } elseif (strtotime($ngay_hen_tra) <= strtotime($ngay_muon)) {
            $message = 'Ngày hẹn trả phải lớn hơn ngày mượn.';
        } else {
            $stmt = mysqli_prepare(
                $conn,
                "UPDATE phieu_muon
                 SET id_nguoi_dung = ?, ngay_muon = ?, ngay_hen_tra = ?, ghi_chu = ?
                 WHERE id_phieu_muon = ?"
            );

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'isssi', $id_nguoi_dung, $ngay_muon, $ngay_hen_tra, $ghi_chu, $id_phieu_muon);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_query(
                        $conn,
                        "UPDATE phieu_muon
                         SET trang_thai = CASE
                             WHEN ngay_tra IS NOT NULL THEN 'da_tra'
                             WHEN ngay_hen_tra < NOW() THEN 'tre_han'
                             ELSE 'dang_muon'
                         END
                         WHERE id_phieu_muon = " . $id_phieu_muon
                    );

                    $message = 'Cập nhật phiếu mượn thành công.';
                } else {
                    $message = 'Lỗi cập nhật phiếu mượn: ' . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = 'Không thể khởi tạo truy vấn cập nhật phiếu mượn.';
            }
        }
    }

    if ($action === 'return') {
        $id_phieu_muon = (int)($_POST['id_phieu_muon'] ?? 0);
        $ngay_tra = pm_to_sql_datetime($_POST['ngay_tra'] ?? '', true);

        if ($id_phieu_muon <= 0) {
            $message = 'ID phiếu mượn không hợp lệ.';
        } else {
            mysqli_begin_transaction($conn);
            $ok = true;

            $stmt_pm = mysqli_prepare($conn, "SELECT id_phieu_muon, ngay_hen_tra, trang_thai FROM phieu_muon WHERE id_phieu_muon = ? FOR UPDATE");
            $phieu = null;
            if ($stmt_pm) {
                mysqli_stmt_bind_param($stmt_pm, 'i', $id_phieu_muon);
                mysqli_stmt_execute($stmt_pm);
                $rs_pm = mysqli_stmt_get_result($stmt_pm);
                $phieu = $rs_pm ? mysqli_fetch_assoc($rs_pm) : null;
                mysqli_stmt_close($stmt_pm);
            }

            if (!$phieu) {
                $ok = false;
                $message = 'Không tìm thấy phiếu mượn cần trả.';
            }

            if ($ok && $phieu['trang_thai'] === 'da_tra') {
                $ok = false;
                $message = 'Phiếu mượn này đã được trả trước đó.';
            }

            $detail_rows = array();
            if ($ok) {
                $stmt_detail = mysqli_prepare(
                    $conn,
                    "SELECT id_chi_tiet_phieu, ma_sach, So_Luong
                     FROM chi_tiet_phieu_muon
                     WHERE id_phieu_muon = ? AND trang_thai IN ('dang_muon', 'tre_han')
                     FOR UPDATE"
                );

                if ($stmt_detail) {
                    mysqli_stmt_bind_param($stmt_detail, 'i', $id_phieu_muon);
                    mysqli_stmt_execute($stmt_detail);
                    $rs_detail = mysqli_stmt_get_result($stmt_detail);
                    if ($rs_detail) {
                        while ($row = mysqli_fetch_assoc($rs_detail)) {
                            $detail_rows[] = $row;
                        }
                    }
                    mysqli_stmt_close($stmt_detail);
                } else {
                    $ok = false;
                    $message = 'Không thể tải chi tiết phiếu mượn để trả sách.';
                }
            }

            if ($ok) {
                $so_ngay_tre = 0;
                $hen_tra_ts = strtotime($phieu['ngay_hen_tra']);
                $tra_ts = strtotime($ngay_tra);
                if ($hen_tra_ts !== false && $tra_ts !== false && $tra_ts > $hen_tra_ts) {
                    $so_ngay_tre = (int)ceil(($tra_ts - $hen_tra_ts) / 86400);
                }

                $tong_tien_phat = 0;
                foreach ($detail_rows as $row) {
                    $id_chi_tiet = (int)$row['id_chi_tiet_phieu'];
                    $ma_sach = $row['ma_sach'];
                    $so_luong = (int)$row['So_Luong'];
                    $tien_phat = $so_ngay_tre > 0 ? ($so_luong * $so_ngay_tre * FINE_PER_BOOK_PER_DAY) : 0;
                    $tong_tien_phat += $tien_phat;

                    $stmt_update_detail = mysqli_prepare(
                        $conn,
                        "UPDATE chi_tiet_phieu_muon
                         SET ngay_tra_thuc_te = ?, so_ngay_tre = ?, tien_phat = ?, trang_thai = 'da_tra'
                         WHERE id_chi_tiet_phieu = ?"
                    );

                    if (!$stmt_update_detail) {
                        $ok = false;
                        $message = 'Không thể cập nhật chi tiết trả sách.';
                        break;
                    }

                    mysqli_stmt_bind_param($stmt_update_detail, 'sidi', $ngay_tra, $so_ngay_tre, $tien_phat, $id_chi_tiet);
                    if (!mysqli_stmt_execute($stmt_update_detail)) {
                        $ok = false;
                        $message = 'Lỗi cập nhật chi tiết trả sách: ' . mysqli_error($conn);
                        mysqli_stmt_close($stmt_update_detail);
                        break;
                    }
                    mysqli_stmt_close($stmt_update_detail);

                    $stmt_stock = mysqli_prepare($conn, "SELECT so_luong_con FROM sach WHERE ma_sach = ? FOR UPDATE");
                    if (!$stmt_stock) {
                        $ok = false;
                        $message = 'Không thể kiểm tra tồn kho khi trả sách.';
                        break;
                    }

                    mysqli_stmt_bind_param($stmt_stock, 's', $ma_sach);
                    mysqli_stmt_execute($stmt_stock);
                    $rs_stock = mysqli_stmt_get_result($stmt_stock);
                    $stock_row = $rs_stock ? mysqli_fetch_assoc($rs_stock) : null;
                    mysqli_stmt_close($stmt_stock);

                    if (!$stock_row) {
                        $ok = false;
                        $message = 'Không tìm thấy sách ' . $ma_sach . ' khi hoàn kho.';
                        break;
                    }

                    $so_luong_con = (int)$stock_row['so_luong_con'];
                    if (!pm_update_book_stock($conn, $ma_sach, $so_luong_con + $so_luong)) {
                        $ok = false;
                        $message = 'Không thể hoàn kho cho sách ' . $ma_sach;
                        break;
                    }
                }

                if ($ok) {
                    $stmt_update_pm = mysqli_prepare(
                        $conn,
                        "UPDATE phieu_muon SET ngay_tra = ?, trang_thai = 'da_tra' WHERE id_phieu_muon = ?"
                    );

                    if ($stmt_update_pm) {
                        mysqli_stmt_bind_param($stmt_update_pm, 'si', $ngay_tra, $id_phieu_muon);
                        if (!mysqli_stmt_execute($stmt_update_pm)) {
                            $ok = false;
                            $message = 'Không thể cập nhật trạng thái phiếu mượn.';
                        }
                        mysqli_stmt_close($stmt_update_pm);
                    } else {
                        $ok = false;
                        $message = 'Không thể khởi tạo truy vấn cập nhật trạng thái phiếu mượn.';
                    }
                }

                if ($ok && $tong_tien_phat > 0) {
                    $ly_do = 'Phạt trả trễ phiếu #' . $id_phieu_muon;

                    $stmt_check_phat = mysqli_prepare($conn, "SELECT id_phat FROM phat WHERE id_phieu_muon = ? LIMIT 1");
                    $existing_id = 0;
                    if ($stmt_check_phat) {
                        mysqli_stmt_bind_param($stmt_check_phat, 'i', $id_phieu_muon);
                        mysqli_stmt_execute($stmt_check_phat);
                        $rs_check = mysqli_stmt_get_result($stmt_check_phat);
                        $row_check = $rs_check ? mysqli_fetch_assoc($rs_check) : null;
                        $existing_id = (int)($row_check['id_phat'] ?? 0);
                        mysqli_stmt_close($stmt_check_phat);
                    }

                    if ($existing_id > 0) {
                        $stmt_update_phat = mysqli_prepare(
                            $conn,
                            "UPDATE phat
                             SET so_tien = ?, ly_do = ?, ngay_phat = ?, trang_thai = 'chua_thanh_toan'
                             WHERE id_phat = ?"
                        );
                        if ($stmt_update_phat) {
                            mysqli_stmt_bind_param($stmt_update_phat, 'dssi', $tong_tien_phat, $ly_do, $ngay_tra, $existing_id);
                            if (!mysqli_stmt_execute($stmt_update_phat)) {
                                $ok = false;
                                $message = 'Không thể cập nhật thông tin phạt.';
                            }
                            mysqli_stmt_close($stmt_update_phat);
                        } else {
                            $ok = false;
                            $message = 'Không thể khởi tạo truy vấn cập nhật thông tin phạt.';
                        }
                    } else {
                        $stmt_insert_phat = mysqli_prepare(
                            $conn,
                            "INSERT INTO phat (id_phieu_muon, so_tien, ly_do, ngay_phat, trang_thai)
                             VALUES (?, ?, ?, ?, 'chua_thanh_toan')"
                        );
                        if ($stmt_insert_phat) {
                            mysqli_stmt_bind_param($stmt_insert_phat, 'idss', $id_phieu_muon, $tong_tien_phat, $ly_do, $ngay_tra);
                            if (!mysqli_stmt_execute($stmt_insert_phat)) {
                                $ok = false;
                                $message = 'Không thể tạo thông tin phạt.';
                            }
                            mysqli_stmt_close($stmt_insert_phat);
                        } else {
                            $ok = false;
                            $message = 'Không thể khởi tạo truy vấn tạo thông tin phạt.';
                        }
                    }
                }
            }

            if ($ok) {
                mysqli_commit($conn);
                $message = 'Xác nhận trả sách thành công.';
            } else {
                mysqli_rollback($conn);
            }
        }
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    if ($delete_id > 0) {
        mysqli_begin_transaction($conn);
        $ok = true;

        $stmt_pm = mysqli_prepare($conn, "SELECT id_phieu_muon FROM phieu_muon WHERE id_phieu_muon = ? FOR UPDATE");
        if ($stmt_pm) {
            mysqli_stmt_bind_param($stmt_pm, 'i', $delete_id);
            mysqli_stmt_execute($stmt_pm);
            $rs_pm = mysqli_stmt_get_result($stmt_pm);
            $pm_row = $rs_pm ? mysqli_fetch_assoc($rs_pm) : null;
            mysqli_stmt_close($stmt_pm);
            if (!$pm_row) {
                $ok = false;
                $message = 'Không tìm thấy phiếu mượn cần xóa.';
            }
        } else {
            $ok = false;
            $message = 'Không thể khởi tạo truy vấn kiểm tra phiếu mượn.';
        }

        if ($ok) {
            $detail_rs = mysqli_query(
                $conn,
                "SELECT ma_sach, So_Luong, trang_thai FROM chi_tiet_phieu_muon WHERE id_phieu_muon = " . $delete_id . " FOR UPDATE"
            );

            if ($detail_rs) {
                while ($detail = mysqli_fetch_assoc($detail_rs)) {
                    if ($detail['trang_thai'] === 'da_tra') {
                        continue;
                    }

                    $ma_sach = $detail['ma_sach'];
                    $so_luong = (int)$detail['So_Luong'];
                    $stock_stmt = mysqli_prepare($conn, "SELECT so_luong_con FROM sach WHERE ma_sach = ? FOR UPDATE");
                    if (!$stock_stmt) {
                        $ok = false;
                        $message = 'Không thể kiểm tra tồn kho trước khi xóa phiếu mượn.';
                        break;
                    }

                    mysqli_stmt_bind_param($stock_stmt, 's', $ma_sach);
                    mysqli_stmt_execute($stock_stmt);
                    $stock_rs = mysqli_stmt_get_result($stock_stmt);
                    $stock_row = $stock_rs ? mysqli_fetch_assoc($stock_rs) : null;
                    mysqli_stmt_close($stock_stmt);

                    if (!$stock_row) {
                        $ok = false;
                        $message = 'Không tìm thấy sách ' . $ma_sach . ' để hoàn kho khi xóa phiếu.';
                        break;
                    }

                    if (!pm_update_book_stock($conn, $ma_sach, (int)$stock_row['so_luong_con'] + $so_luong)) {
                        $ok = false;
                        $message = 'Không thể hoàn kho sách ' . $ma_sach . ' khi xóa phiếu.';
                        break;
                    }
                }
                mysqli_free_result($detail_rs);
            }
        }

        if ($ok) {
            if (!mysqli_query($conn, "DELETE FROM phat WHERE id_phieu_muon = " . $delete_id)) {
                $ok = false;
                $message = 'Không thể xóa thông tin phạt liên quan.';
            }
        }

        if ($ok) {
            if (!mysqli_query($conn, "DELETE FROM chi_tiet_phieu_muon WHERE id_phieu_muon = " . $delete_id)) {
                $ok = false;
                $message = 'Không thể xóa chi tiết phiếu mượn.';
            }
        }

        if ($ok) {
            if (!mysqli_query($conn, "DELETE FROM phieu_muon WHERE id_phieu_muon = " . $delete_id)) {
                $ok = false;
                $message = 'Không thể xóa phiếu mượn.';
            }
        }

        if ($ok) {
            mysqli_commit($conn);
            $message = 'Xóa phiếu mượn thành công.';
        } else {
            mysqli_rollback($conn);
        }
    }
}

$where_parts = array();

if ($keyword !== '') {
    $keyword_escaped = mysqli_real_escape_string($conn, $keyword);
    $where_parts[] = "(CAST(pm.id_phieu_muon AS CHAR) LIKE '%" . $keyword_escaped . "%' OR nd.ten_dang_nhap LIKE '%" . $keyword_escaped . "%' OR nd.ho_ten LIKE '%" . $keyword_escaped . "%')";
}

if ($status_filter === 'dang_muon') {
    $where_parts[] = "pm.ngay_tra IS NULL AND pm.ngay_hen_tra >= NOW()";
} elseif ($status_filter === 'tre_han') {
    $where_parts[] = "pm.ngay_tra IS NULL AND pm.ngay_hen_tra < NOW()";
} elseif ($status_filter === 'da_tra') {
    $where_parts[] = "pm.ngay_tra IS NOT NULL";
}

$phieu_muon_list = array();
$chi_tiet_by_phieu = array();
$nguoi_dung_list = array();
$sach_list = array();

$sql = "SELECT pm.*, nd.ho_ten, nd.ten_dang_nhap,
               COALESCE(SUM(ct.So_Luong), 0) AS tong_so_sach,
               COALESCE(SUM(ct.tien_phat), 0) AS tong_tien_phat
        FROM phieu_muon pm
        LEFT JOIN nguoi_dung nd ON pm.id_nguoi_dung = nd.id_nguoi_dung
        LEFT JOIN chi_tiet_phieu_muon ct ON pm.id_phieu_muon = ct.id_phieu_muon";

if (!empty($where_parts)) {
    $sql .= " WHERE " . implode(' AND ', $where_parts);
}

$sql .= " GROUP BY pm.id_phieu_muon ORDER BY pm.id_phieu_muon DESC";

$pm_rs = mysqli_query($conn, $sql);
if ($pm_rs) {
    while ($row = mysqli_fetch_assoc($pm_rs)) {
        $phieu_muon_list[] = $row;
    }
    mysqli_free_result($pm_rs);
}

if (!empty($phieu_muon_list)) {
    $id_list = array();
    foreach ($phieu_muon_list as $phieu_item) {
        $id_list[] = (int)$phieu_item['id_phieu_muon'];
    }

    $id_list_sql = implode(',', $id_list);
    $detail_sql = "SELECT ct.*, s.ten_sach
                   FROM chi_tiet_phieu_muon ct
                   LEFT JOIN sach s ON ct.ma_sach = s.ma_sach
                   WHERE ct.id_phieu_muon IN (" . $id_list_sql . ")
                   ORDER BY ct.id_phieu_muon DESC, ct.id_chi_tiet_phieu ASC";

    $detail_rs = mysqli_query($conn, $detail_sql);
    if ($detail_rs) {
        while ($detail_row = mysqli_fetch_assoc($detail_rs)) {
            $id_pm = (int)$detail_row['id_phieu_muon'];
            if (!isset($chi_tiet_by_phieu[$id_pm])) {
                $chi_tiet_by_phieu[$id_pm] = array();
            }
            $chi_tiet_by_phieu[$id_pm][] = $detail_row;
        }
        mysqli_free_result($detail_rs);
    }
}

$nguoi_dung_rs = mysqli_query($conn, "SELECT id_nguoi_dung, ten_dang_nhap, ho_ten, trang_thai FROM nguoi_dung ORDER BY ho_ten ASC");
if ($nguoi_dung_rs) {
    while ($row = mysqli_fetch_assoc($nguoi_dung_rs)) {
        $nguoi_dung_list[] = $row;
    }
    mysqli_free_result($nguoi_dung_rs);
}

$sach_rs = mysqli_query($conn, "SELECT ma_sach, ten_sach, so_luong_con FROM sach ORDER BY ten_sach ASC");
if ($sach_rs) {
    while ($row = mysqli_fetch_assoc($sach_rs)) {
        $sach_list[] = $row;
    }
    mysqli_free_result($sach_rs);
}
?>