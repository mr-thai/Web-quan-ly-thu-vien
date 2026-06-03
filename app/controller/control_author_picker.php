<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_author.php';

$pickedBooks = getSachDuocChonBoiTacGia($conn, 5);

include __DIR__ . '/../view/author/picker-author.php';
