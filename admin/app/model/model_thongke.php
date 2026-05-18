<?php

function thongke_get_dashboard_stats($conn) {
    $currentYear = (int) date('Y');
    $currentMonth = (int) date('m');

    $stats = [
        'borrowedThisMonth' => 0,
        'returnedThisMonth' => 0,
        'paidFinesThisMonth' => 0,
        'unpaidFinesCount' => 0,
    ];

    if (!isset($conn) || !($conn instanceof mysqli)) {
        return $stats;
    }

    $sqlBorrowed = "SELECT COUNT(*) AS total
                    FROM chi_tiet_phieu_muon ctpm
                    INNER JOIN phieu_muon pm ON ctpm.ma_phieu_muon = pm.ma_phieu_muon
                    WHERE YEAR(pm.ngay_muon) = ? AND MONTH(pm.ngay_muon) = ?";
    if ($stmt = $conn->prepare($sqlBorrowed)) {
        $stmt->bind_param('ii', $currentYear, $currentMonth);
        $stmt->execute();
        $stats['borrowedThisMonth'] = (int)($stmt->get_result()->fetch_assoc()['total'] ?? 0);
        $stmt->close();
    }

    $sqlReturned = "SELECT COUNT(*) AS total
                    FROM chi_tiet_phieu_muon
                    WHERE ngay_tra_thuc_te IS NOT NULL
                      AND YEAR(ngay_tra_thuc_te) = ?
                      AND MONTH(ngay_tra_thuc_te) = ?";
    if ($stmt = $conn->prepare($sqlReturned)) {
        $stmt->bind_param('ii', $currentYear, $currentMonth);
        $stmt->execute();
        $stats['returnedThisMonth'] = (int)($stmt->get_result()->fetch_assoc()['total'] ?? 0);
        $stmt->close();
    }

    $sqlPaidFines = "SELECT COALESCE(SUM(so_tien_phat), 0) AS total
                     FROM vi_pham_phat
                     WHERE trang_thai_thanh_toan = 'da_dong'
                       AND YEAR(ngay_thu_tien) = ?
                       AND MONTH(ngay_thu_tien) = ?";
    if ($stmt = $conn->prepare($sqlPaidFines)) {
        $stmt->bind_param('ii', $currentYear, $currentMonth);
        $stmt->execute();
        $stats['paidFinesThisMonth'] = (float)($stmt->get_result()->fetch_assoc()['total'] ?? 0);
        $stmt->close();
    }

    $sqlUnpaidFines = "SELECT COUNT(*) AS total
                       FROM vi_pham_phat
                       WHERE trang_thai_thanh_toan = 'chua_dong'";
    if ($resultUnpaid = $conn->query($sqlUnpaidFines)) {
        $stats['unpaidFinesCount'] = (int)($resultUnpaid->fetch_assoc()['total'] ?? 0);
    }

    return $stats;
}

function thongke_get_monthly_dashboard_data($conn, $year = null) {
    $year = $year !== null ? (int) $year : (int) date('Y');

    $months = [
        1 => 'T1', 2 => 'T2', 3 => 'T3', 4 => 'T4', 5 => 'T5', 6 => 'T6',
        7 => 'T7', 8 => 'T8', 9 => 'T9', 10 => 'T10', 11 => 'T11', 12 => 'T12',
    ];

    $data = [
        'labels' => array_values($months),
        'borrowed' => array_fill(0, 12, 0),
        'returned' => array_fill(0, 12, 0),
        'fines' => array_fill(0, 12, 0),
    ];

    if (!isset($conn) || !($conn instanceof mysqli)) {
        return $data;
    }

    $sqlBorrowed = "SELECT MONTH(pm.ngay_muon) AS month_index, COUNT(*) AS total
                    FROM chi_tiet_phieu_muon ctpm
                    INNER JOIN phieu_muon pm ON ctpm.ma_phieu_muon = pm.ma_phieu_muon
                    WHERE YEAR(pm.ngay_muon) = ?
                    GROUP BY MONTH(pm.ngay_muon)";
    if ($stmt = $conn->prepare($sqlBorrowed)) {
        $stmt->bind_param('i', $year);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $monthIndex = (int) ($row['month_index'] ?? 0);
            if ($monthIndex >= 1 && $monthIndex <= 12) {
                $data['borrowed'][$monthIndex - 1] = (int) ($row['total'] ?? 0);
            }
        }
        $stmt->close();
    }

    $sqlReturned = "SELECT MONTH(ngay_tra_thuc_te) AS month_index, COUNT(*) AS total
                    FROM chi_tiet_phieu_muon
                    WHERE ngay_tra_thuc_te IS NOT NULL
                      AND YEAR(ngay_tra_thuc_te) = ?
                    GROUP BY MONTH(ngay_tra_thuc_te)";
    if ($stmt = $conn->prepare($sqlReturned)) {
        $stmt->bind_param('i', $year);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $monthIndex = (int) ($row['month_index'] ?? 0);
            if ($monthIndex >= 1 && $monthIndex <= 12) {
                $data['returned'][$monthIndex - 1] = (int) ($row['total'] ?? 0);
            }
        }
        $stmt->close();
    }

    $sqlFines = "SELECT MONTH(ngay_tao) AS month_index, COALESCE(SUM(so_tien_phat), 0) AS total
                 FROM vi_pham_phat
                 WHERE YEAR(ngay_tao) = ?
                 GROUP BY MONTH(ngay_tao)";
    if ($stmt = $conn->prepare($sqlFines)) {
        $stmt->bind_param('i', $year);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $monthIndex = (int) ($row['month_index'] ?? 0);
            if ($monthIndex >= 1 && $monthIndex <= 12) {
                $data['fines'][$monthIndex - 1] = (float) ($row['total'] ?? 0);
            }
        }
        $stmt->close();
    }

    return $data;
}

function thongke_get_fine_breakdown($conn) {
    $data = [
        'labels' => ['Trễ hạn', 'Hư hỏng', 'Mất sách'],
        'values' => [0, 0, 0],
    ];

    if (!isset($conn) || !($conn instanceof mysqli)) {
        return $data;
    }

    $sql = "SELECT loai_vi_pham, COALESCE(SUM(so_tien_phat), 0) AS total
            FROM vi_pham_phat
            GROUP BY loai_vi_pham";

    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $viPham = $row['loai_vi_pham'] ?? '';
            $total = (float) ($row['total'] ?? 0);

            if ($viPham === 'tre_han') {
                $data['values'][0] = $total;
            } elseif ($viPham === 'hu_hong') {
                $data['values'][1] = $total;
            } elseif ($viPham === 'mat_sach') {
                $data['values'][2] = $total;
            }
        }
        $result->free();
    }

    return $data;
}
