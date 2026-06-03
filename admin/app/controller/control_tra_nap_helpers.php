<?php

require_once __DIR__ . '/../model/model_update_return_book.php';
require_once __DIR__ . '/../model/model_add_phat.php';
require_once __DIR__ . '/../model/model_update_phat.php';

function pm_sanitize_text($value) {
    return trim((string) $value);
}

function pm_normalize_post_list($value) {
    if (is_array($value)) {
        return array_values(array_filter($value, function ($item) {
            return $item !== null && $item !== '';
        }));
    }

    return isset($value) && $value !== '' ? array($value) : array();
}

function pm_filter_positive_int_list($value) {
    $list = pm_normalize_post_list($value);
    $filtered = array();

    foreach ($list as $item) {
        $item = (int) $item;
        if ($item > 0) {
            $filtered[] = $item;
        }
    }

    return $filtered;
}

function pm_is_valid_return_status($status) {
    return in_array($status, array('da_tra', 'hu_hong', 'mat_sach', 'tra_tre_han'), true);
}

function pm_parse_money_value($value, $default = 0) {
    if ($value === null || $value === '') {
        return (float) $default;
    }

    if (is_string($value)) {
        $value = str_replace(array('.', ' ', ','), array('', '', '.'), $value);
    }

    return is_numeric($value) ? (float) $value : (float) $default;
}

function process_return_items($conn, $ma_chi_tiet_list, $ngay_tra_thuc_te, $trang_thai, $ghi_chu_tinh_trang, $post_data = array()) {
    $updated_count = 0;
    $created_fine_count = 0;
    $skipped_count = 0;
    $items = array();

    $ngay_tra_thuc_tr = pm_sanitize_text($ngay_tra_thuc_te);
    if ($ngay_tra_thuc_tr === '') {
        $ngay_tra_thuc_tr = date('Y-m-d H:i:s');
    }

    $ghi_chu_tinh_trang = pm_sanitize_text($ghi_chu_tinh_trang);

    // Normalize potential per-item arrays from POST
    $trang_thai_items = isset($post_data['trang_thai_item']) && is_array($post_data['trang_thai_item']) ? array_values($post_data['trang_thai_item']) : null;
    $so_tien_phat_items = isset($post_data['so_tien_phat_item']) && is_array($post_data['so_tien_phat_item']) ? array_values($post_data['so_tien_phat_item']) : null;
    $gia_goc_items = isset($post_data['gia_goc_item']) && is_array($post_data['gia_goc_item']) ? array_values($post_data['gia_goc_item']) : null;

    foreach ($ma_chi_tiet_list as $idx => $ma_chi_tiet_phieu) {
        $ma_chi_tiet_phieu = (int) $ma_chi_tiet_phieu;
        if ($ma_chi_tiet_phieu <= 0) {
            $skipped_count++;
            continue;
        }

        // Determine per-item status and amounts (fall back to scalar $trang_thai if provided)
        $status_item = 'da_tra';
        if (is_array($trang_thai_items) && isset($trang_thai_items[$idx])) {
            $status_item = pm_sanitize_text($trang_thai_items[$idx]);
        } elseif ($trang_thai) {
            $status_item = pm_sanitize_text($trang_thai);
        }

        if (!pm_is_valid_return_status($status_item)) {
            $skipped_count++;
            continue;
        }

        // Parse per-item money values
        $gia_goc = pm_parse_money_value($gia_goc_items[$idx] ?? ($post_data['gia_goc'] ?? 0), 0);
        $so_tien_phat = pm_parse_money_value($so_tien_phat_items[$idx] ?? ($post_data['so_tien_phat'] ?? null), 0);

        // Use sanitized datetime variable when calling update
        pm_update_return_book($conn, $ma_chi_tiet_phieu, $ngay_tra_thuc_tr, $status_item, $ghi_chu_tinh_trang);
        $updated_count++;

        // Create fines when necessary
        if ($status_item === 'hu_hong' || $status_item === 'mat_sach') {
            if ($so_tien_phat <= 0) {
                $so_tien_phat = $gia_goc > 0 ? $gia_goc : 0;
            }
            pm_add_phat($conn, $ma_chi_tiet_phieu, $status_item, $gia_goc, $so_tien_phat);
            $created_fine_count++;
        } elseif ($status_item === 'tra_tre_han') {
            if ($so_tien_phat <= 0) {
                $so_tien_phat = 5000;
            }
            pm_add_phat($conn, $ma_chi_tiet_phieu, 'tre_han', $gia_goc, $so_tien_phat);
            $created_fine_count++;
        }

        // record item details for receipt
        $items[] = array(
            'ma_chi_tiet_phieu' => $ma_chi_tiet_phieu,
            'trang_thai' => $status_item,
            'gia_goc' => $gia_goc,
            'so_tien_phat' => $so_tien_phat,
        );
    }

    return array(
        'updated_count' => $updated_count,
        'created_fine_count' => $created_fine_count,
        'skipped_count' => $skipped_count,
        'items' => $items,
    );
}

function process_confirm_phat($conn, $ma_phat_list, $so_tien_phat_list) {
    $updated_count = 0;
    $skipped_count = 0;

    $ma_phat_list = pm_filter_positive_int_list($ma_phat_list);
    $so_tien_phat_list = pm_normalize_post_list($so_tien_phat_list);

    foreach ($ma_phat_list as $index => $ma_phat) {
        $so_tien_phat = pm_parse_money_value($so_tien_phat_list[$index] ?? 0, 0);

        if ($ma_phat > 0 && $so_tien_phat > 0) {
            pm_update_phat($conn, $ma_phat, $so_tien_phat);
            $updated_count++;
        } else {
            $skipped_count++;
        }
    }

    return $updated_count;
}
