<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_muon_sach.php';

if (!isset($_SESSION['nguoi_dung'])) {
    header('Location: ../login.php');
    exit();
}

$ma_nguoi_dung = (int)$_SESSION['nguoi_dung']['ma_nguoi_dung'];
$phieuMuon = layPhieuMuonTatCa($conn, $ma_nguoi_dung);
