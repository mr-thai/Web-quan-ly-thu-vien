<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <title>Book Library</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/transitions.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">
	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>

	<div id="tg-wrapper" class="tg-wrapper tg-haslayout">
		<!--************************************
				Header Start
		*************************************-->
		<?php include 'app/view/header.php'; ?>
		<!--************************************
				Header End
		*************************************-->
		<!--************************************
				Inner Banner Start
		*************************************-->
		<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-07.jpg">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="tg-innerbannercontent">
							<h1>Tất cả sách</h1>
							<ol class="tg-breadcrumb">
								<li><a href="javascript:void(0);">home</a></li>
								<li><a href="javascript:void(0);">Products</a></li>
								<li class="tg-active">Product Title Here</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--************************************
				Inner Banner End
		*************************************-->
		<!--************************************
				Main Start
		*************************************-->
		<main id="tg-main" class="tg-main tg-haslayout">
			<!--************************************
					News Grid Start
			*************************************-->
			<div class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div id="tg-twocolumns" class="tg-twocolumns">
							<div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 pull-right">
								<div id="tg-content" class="tg-content">
									
									<?php include 'app/view/banner-product.php'; ?>

									<div class="tg-productdetail">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
												<div class="tg-postbook">
													<figure class="tg-featureimg"><img src="images/books/img-07.jpg" alt="image description"></figure>
													<div class="tg-postbookcontent">
														<span class="tg-bookprice">
															<ins>$25.18</ins>
															<del>$27.20</del>
														</span>
														<span class="tg-bookwriter">You save $4.02</span>
														<ul class="tg-delevrystock">
															<li><i class="icon-rocket"></i><span>Free delivery worldwide</span></li>
															<li><i class="icon-checkmark-circle"></i><span>Dispatch from the USA in 2 working days </span></li>
															<li><i class="icon-store"></i><span>Status: <em>In Stock</em></span></li>
														</ul>
														<div class="tg-quantityholder">
															<em class="minus">-</em>
															<input type="text" class="result" value="0" id="quantity1" name="quantity">
															<em class="plus">+</em>
														</div>
														<a class="tg-btn tg-active tg-btn-lg" href="javascript:void(0);">Mượn sách</a>
														<a class="tg-btnaddtowishlist" href="javascript:void(0);">
															<span>add to wishlist</span>
														</a>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
												<div class="tg-productcontent">
													<ul class="tg-bookscategories">
														<li><a href="javascript:void(0);">Art &amp; Photography</a></li>
													</ul>
													<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
													<div class="tg-booktitle">
														<h3>Drive Safely, No Bumping</h3>
													</div>
													<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
													<span class="tg-stars"><span></span></span>
													<span class="tg-addreviews"><a href="javascript:void(0);">Add Your Review</a></span>
													<div class="tg-share">
														<span>Share:</span>
														<ul class="tg-socialicons">
															<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
															<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
															<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
															<li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
															<li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
														</ul>
													</div>
													<div class="tg-description">
														<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etdoloreat magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisi nisi ut aliquip ex ea commodo consequat aute.</p>
														<p>Arure dolor in reprehenderit in voluptate velit esse cillum dolore fugiat nulla aetur excepteur sint occaecat cupidatat non proident, sunt in culpa quistan officia serunt mollit anim id est laborum sed ut perspiciatis unde omnis iste natus... <a href="javascript:void(0);">More</a></p>
													</div>
													<div class="tg-sectionhead">
														<h2>Product Details</h2>
													</div>
													<ul class="tg-productinfo">
														<li><span>Format:</span><span>Hardback</span></li>
														<li><span>Pages:</span><span>528 pages</span></li>
														<li><span>Dimensions:</span><span>153 x 234 x 43mm | 758g</span></li>
														<li><span>Publication Date:</span><span>June 27, 2017</span></li>
														<li><span>Publisher:</span><span>Sunshine Orlando</span></li>
														<li><span>Language:</span><span>English</span></li>
														<li><span>Illustrations note:</span><span>b&amp;w images thru-out; 1 x 16pp colour plates</span></li>
														<li><span>ISBN10:</span><span>1234567890</span></li>
														<li><span>ISBN13:</span><span>1234567890000</span></li>
														<li><span>Other Fomate:</span><span>CD-Audio, Paperback, E-Book</span></li>
													</ul>
													<div class="tg-alsoavailable">
														<figure>
															<img src="images/img-02.jpg" alt="image description">
															<figcaption>
																<h3>Also Available in:</h3>
																<ul>
																	<li><span>CD-Audio $18.30</span></li>
																	<li><span>Paperback $20.10</span></li>
																	<li><span>E-Book $11.30</span></li>
																</ul>
															</figcaption>
														</figure>
													</div>
												</div>
											</div>
											<div class="tg-productdescription">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<div class="tg-sectionhead">
														<h2>Product Description</h2>
													</div>
													<ul class="tg-themetabs" role="tablist">
														<li role="presentation" class="active"><a href="#description" data-toggle="tab">Description</a></li>
														<li role="presentation"><a href="#review" data-toggle="tab">Reviews</a></li>
													</ul>
													<div class="tg-tab-content tab-content">
														<div role="tabpanel" class="tg-tab-pane tab-pane active" id="description">
															<div class="tg-description">
																<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veni quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenden voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
																<figure class="tg-alignleft">
																	<img src="images/placeholdervtwo.jpg" alt="image description">
																	<iframe src="https://www.youtube.com/embed/aLwpuDpZm1k?rel=0&amp;controls=0&amp;showinfo=0"></iframe>
																</figure>
																<ul class="tg-liststyle">
																	<li><span>Sed do eiusmod tempor incididunt ut labore et dolore</span></li>
																	<li><span>Magna aliqua enim ad minim veniam</span></li>
																	<li><span>Quis nostrud exercitation ullamco laboris nisi ut</span></li>
																	<li><span>Aliquip ex ea commodo consequat aute dolor reprehenderit</span></li>
																	<li><span>Voluptate velit esse cillum dolore eu fugiat nulla pariatur</span></li>
																	<li><span>Magna aliqua enim ad minim veniam</span></li>
																	<li><span>Quis nostrud exercitation ullamco laboris nisi ut</span></li>
																</ul>
																<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam remmata aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enimsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos quistatoa.</p>
															</div>
														</div>
														<div role="tabpanel" class="tg-tab-pane tab-pane" id="review">
															<div class="tg-description">
																<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veni quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenden voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
																<figure class="tg-alignleft">
																	<img src="images/placeholdervtwo.jpg" alt="image description">
																	<iframe src="https://www.youtube.com/embed/aLwpuDpZm1k?rel=0&amp;controls=0&amp;showinfo=0"></iframe>
																</figure>
																<ul class="tg-liststyle">
																	<li><span>Sed do eiusmod tempor incididunt ut labore et dolore</span></li>
																	<li><span>Magna aliqua enim ad minim veniam</span></li>
																	<li><span>Quis nostrud exercitation ullamco laboris nisi ut</span></li>
																	<li><span>Aliquip ex ea commodo consequat aute dolor reprehenderit</span></li>
																	<li><span>Voluptate velit esse cillum dolore eu fugiat nulla pariatur</span></li>
																	<li><span>Magna aliqua enim ad minim veniam</span></li>
																	<li><span>Quis nostrud exercitation ullamco laboris nisi ut</span></li>
																</ul>
																<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam remmata aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enimsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos quistatoa.</p>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tg-aboutauthor">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<div class="tg-sectionhead">
														<h2>About Author</h2>
													</div>
													<div class="tg-authorbox">
														<figure class="tg-authorimg">
															<img src="images/author/imag-24.jpg" alt="image description">
														</figure>
														<div class="tg-authorinfo">
															<div class="tg-authorhead">
																<div class="tg-leftarea">
																	<div class="tg-authorname">
																		<h2>Kathrine Culbertson</h2>
																		<span>Author Since: June 27, 2017</span>
																	</div>
																</div>
																<div class="tg-rightarea">
																	<ul class="tg-socialicons">
																		<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
																		<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
																		<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
																		<li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
																		<li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
																	</ul>
																</div>
															</div>
															<div class="tg-description">
																<p>Laborum sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium totam rem aperiam eaque ipsa quae ab illo inventore veritatis etation.</p>
															</div>
															<a class="tg-btn tg-active" href="javascript:void(0);">View All Books</a>
														</div>
													</div>
												</div>
											</div>
											<div class="tg-relatedproducts">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<div class="tg-sectionhead">
														<h2><span>Related Products</span>You May Also Like</h2>
														<a class="tg-btn" href="javascript:void(0);">View All</a>
													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<div id="tg-relatedproductslider" class="tg-relatedproductslider tg-relatedbooks owl-carousel">
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-01.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-01.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>add to wishlist</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Help Me Find My Stomach</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	<span class="tg-bookprice">
																		<ins>$25.18</ins>
																		<del>$27.20</del>
																	</span>
																	<a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
																		<i class="fa fa-shopping-basket"></i>
																		<em>Add To Basket</em>
																	</a>
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-02.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-02.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>add to wishlist</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Drive Safely, No Bumping</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	<span class="tg-bookprice">
																		<ins>$25.18</ins>
																		<del>$27.20</del>
																	</span>
																	<a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
																		<i class="fa fa-shopping-basket"></i>
																		<em>Add To Basket</em>
																	</a>
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-03.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-03.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>add to wishlist</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Let The Good Times Roll Up</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	<span class="tg-bookprice">
																		<ins>$25.18</ins>
																		<del>$27.20</del>
																	</span>
																	<a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
																		<i class="fa fa-shopping-basket"></i>
																		<em>Add To Basket</em>
																	</a>
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-04.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-04.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>add to wishlist</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Our State Fair Is A Great State Fair</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	<span class="tg-bookprice">
																		<ins>$25.18</ins>
																		<del>$27.20</del>
																	</span>
																	<a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
																		<i class="fa fa-shopping-basket"></i>
																		<em>Add To Basket</em>
																	</a>
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-05.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-05.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>add to wishlist</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Put The Petal To The Metal</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	<span class="tg-bookprice">
																		<ins>$25.18</ins>
																		<del>$27.20</del>
																	</span>
																	<a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
																		<i class="fa fa-shopping-basket"></i>
																		<em>Add To Basket</em>
																	</a>
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-06.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-06.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>add to wishlist</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Help Me Find My Stomach</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	<span class="tg-bookprice">
																		<ins>$25.18</ins>
																		<del>$27.20</del>
																	</span>
																	<a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
																		<i class="fa fa-shopping-basket"></i>
																		<em>Add To Basket</em>
																	</a>
																</div>
															</div>
														</div>
														<div class="item">
															<div class="tg-postbook">
																<figure class="tg-featureimg">
																	<div class="tg-bookimg">
																		<div class="tg-frontcover"><img src="images/books/img-03.jpg" alt="image description"></div>
																		<div class="tg-backcover"><img src="images/books/img-03.jpg" alt="image description"></div>
																	</div>
																	<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																		<i class="icon-heart"></i>
																		<span>add to wishlist</span>
																	</a>
																</figure>
																<div class="tg-postbookcontent">
																	<ul class="tg-bookscategories">
																		<li><a href="javascript:void(0);">Adventure</a></li>
																		<li><a href="javascript:void(0);">Fun</a></li>
																	</ul>
																	<div class="tg-themetagbox"></div>
																	<div class="tg-booktitle">
																		<h3><a href="javascript:void(0);">Let The Good Times Roll Up</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																	<span class="tg-stars"><span></span></span>
																	<span class="tg-bookprice">
																		<ins>$25.18</ins>
																		<del>$27.20</del>
																	</span>
																	<a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
																		<i class="fa fa-shopping-basket"></i>
																		<em>Add To Basket</em>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 pull-left">
								<?php include 'app/view/aside-products.php'; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--************************************
					News Grid End
			*************************************-->
		</main>
		<!--************************************
				Main End
		*************************************-->
		<!--************************************
				Footer Start
		*************************************-->
		<?php include 'app/view/footer.php'; ?>
		<!--************************************
				Footer End
		*************************************-->
	</div>
	<!--************************************
			Wrapper End
	*************************************-->
	<script src="js/vendor/jquery-library.js"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
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