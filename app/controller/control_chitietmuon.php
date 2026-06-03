<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_muon_sach.php';

if (!isset($_GET['id']) || !isset($_SESSION['nguoi_dung'])) {
    header('Location: ../sachcuatoi.php');
    exit();
}

$ma_phieu_muon = (int)$_GET['id'];

$phieu = $conn->query(
    "SELECT pm.*, nd.ho_ten, nd.email, nd.so_dien_thoai 
    FROM phieu_muon pm 
    JOIN nguoi_dung nd ON pm.ma_nguoi_dung = nd.ma_nguoi_dung 
    WHERE pm.ma_phieu_muon = $ma_phieu_muon 
    AND pm.ma_nguoi_dung = " . (int)$_SESSION['nguoi_dung']['ma_nguoi_dung']
)->fetch_assoc();

if (!$phieu) {
    header('Location: ../sachcuatoi.php');
    exit();
}

$chiTiet = layChiTietPhieuMuon($conn, $ma_phieu_muon);
