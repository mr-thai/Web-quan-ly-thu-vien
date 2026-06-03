<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/model_search.php';

$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$baseUrl = rtrim(dirname(dirname(dirname($scriptName))), '/');
if ($baseUrl === '.') {
	$baseUrl = '';
}

$search_form_action = 'app/controller/control_search.php';

$keyword = trim($_GET['search'] ?? $_GET['q'] ?? '');
$results = ['books' => [], 'authors' => []];

if ($keyword !== '') {
	$results = getSearchResultByType($conn, $keyword);
}

function h($value)
{
	return htmlspecialchars((string)$value);
}

function searchImage($path, $fallback)
{
	if (!empty($path)) {
		return ltrim($path, '/');
	}

	return $fallback;
}
?>
<!doctype html>
<html class="no-js" lang="vi">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kết quả tìm kiếm</title>
	<base href="<?php echo h($baseUrl !== '' ? $baseUrl : '.'); ?>/">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/transitions.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/color.css?v=2">
	<link rel="stylesheet" href="css/responsive.css">
</head>
<body>
<div id="tg-wrapper" class="tg-wrapper tg-haslayout">
	<?php include __DIR__ . '/../view/header.php'; ?>

	<main id="tg-main" class="tg-main tg-haslayout">
		<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-07.jpg">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="tg-innerbannercontent">
							<h1>Kết quả tìm kiếm</h1>
							<ol class="tg-breadcrumb">
								<li><a href="index.php">home</a></li>
								<li class="tg-active"><?php echo h($keyword !== '' ? $keyword : 'Search'); ?></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>

		<section class="tg-sectionspace tg-haslayout">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="tg-sectionhead">
							<h2><span>Tìm kiếm</span><?php echo $keyword !== '' ? h($keyword) : 'Nhập từ khóa để tìm'; ?></h2>
						</div>
					</div>
				</div>

				<?php if ($keyword === ''): ?>
					<div class="row">
						<div class="col-xs-12">
							<p>Vui lòng nhập tiêu đề sách, ISBN, tên tác giả hoặc bút danh để tìm kiếm.</p>
						</div>
					</div>
				<?php else: ?>
					<div class="row">
						<div class="col-xs-12">
							<h3 style="margin-top: 0;">Sách</h3>
						</div>
						<?php if (!empty($results['books'])): ?>
							<?php foreach ($results['books'] as $book):
								$bookImage = searchImage($book['url_anh'] ?? '', 'images/products/img-01.jpg');
							?>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
									<div class="tg-postbook" style="margin-bottom: 30px;">
										<figure class="tg-featureimg">
											<div class="tg-bookimg">
												<a class="tg-frontcover" href="<?php echo h($book['detail_url']); ?>">
													<img src="<?php echo h($bookImage); ?>" alt="<?php echo h($book['ten_sach']); ?>" style="width:200px;height:300px;object-fit:cover;display:block;">
												</a>
											</div>
										</figure>
										<div class="tg-postbookcontent">
											<div class="tg-booktitle">
												<h3><a href="<?php echo h($book['detail_url']); ?>"><?php echo h($book['ten_sach']); ?></a></h3>
											</div>
											<span class="tg-bookwriter">Bởi: <a href="<?php echo h('authordetail.php?id=' . (int)$book['ma_tac_gia']); ?>"><?php echo h($book['but_danh'] ?: $book['ten_tac_gia']); ?></a></span>
											<div class="tg-description">
												<p><?php echo h(mb_strimwidth((string)($book['mo_ta'] ?? ''), 0, 120, '...')); ?></p>
											</div>
											<a class="tg-btn tg-btnstyletwo" href="<?php echo h($book['detail_url']); ?>">
												<i class="fa fa-book"></i><em>Xem chi tiết</em>
											</a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div class="col-xs-12"><p>Không tìm thấy sách phù hợp.</p></div>
						<?php endif; ?>
					</div>

					<div class="row" style="margin-top: 20px;">
						<div class="col-xs-12">
							<h3>Tác giả</h3>
						</div>
						<?php if (!empty($results['authors'])): ?>
							<?php foreach ($results['authors'] as $author):
								$authorImage = !empty($author['avatar_url']) ? ltrim($author['avatar_url'], '/') : 'images/author/imag-24.jpg';
								$authorName = !empty($author['but_danh']) ? $author['but_danh'] : $author['ho_ten'];
							?>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
									<div class="tg-author" style="margin-bottom: 30px;">
										<figure><a href="<?php echo h($author['detail_url']); ?>"><img src="<?php echo h($authorImage); ?>" alt="<?php echo h($authorName); ?>"></a></figure>
										<div class="tg-authorcontent">
											<h2><a href="<?php echo h($author['detail_url']); ?>"><?php echo h($authorName); ?></a></h2>
											<span><?php echo (int)$author['so_sach']; ?> Tổng sách</span>
											<div class="tg-description">
												<p><?php echo h(mb_strimwidth((string)($author['tieu_su'] ?: $author['ghi_chu'] ?: ''), 0, 120, '...')); ?></p>
											</div>
											<a class="tg-btn tg-btnstyletwo" href="<?php echo h($author['detail_url']); ?>">
												<i class="fa fa-user"></i><em>Xem tác giả</em>
											</a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div class="col-xs-12"><p>Không tìm thấy tác giả phù hợp.</p></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	</main>

	<?php include __DIR__ . '/../view/footer.php'; ?>
</div>

<script src="js/vendor/jquery-library.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.vide.min.js"></script>
<script src="js/countdown.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/parallax.js"></script>
<script src="js/countTo.js"></script>
<script src="js/appear.js"></script>
<script src="js/gmap3.js"></script>
<script src="js/main.js"></script>
</body>
</html>
