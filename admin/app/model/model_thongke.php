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
