<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_author.php';

$authors = getDanhSachTacGia($conn);

include __DIR__ . '/../view/author/grid-author.php';
