<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" class="no-js" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Edge_Portfolio</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- CSS FILES -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" data-name="skins">
    <link rel="stylesheet" href="css/layout/wide.css" data-name="layout">

    <link rel="stylesheet" type="text/css" href="css/switcher.css" media="screen" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php include "header.php"; ?>
<?php include "connection.php"; ?>

<?php

if(isset($_GET['portfolio_id'])){
    $portfolio_id = $_GET['portfolio_id'];
}

?>
	<!--start wrapper-->
	<section class="wrapper">
    <section class="page_head">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Portfolio</li>
                        </ul>
                    </nav>

                    <div class="page_title">
                        <h2>Portfolio</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content portfolio_single">
			<div class="container">

<?php
try{
    $sqlquery = $connection->prepare("select * from `portfolio` where `portfolio_id` = :portfolio_id");
    $sqlquery->bindValue("portfolio_id", $portfolio_id , PDO::PARAM_INT);

    $sqlquery->execute();
    $results = $sqlquery;

    foreach($results as $result){
?>
				<div class="row sub_content">
					<div class="col-lg-8 col-md-8 col-sm-8">
						<!--Project Details Page-->
						<div class="porDetCarousel">
							<div class="carousel-content">
								<img class="carousel-item" src="images/portfolio/portfolio_slider1.png" alt="">
								<img class="carousel-item" src="images/portfolio/portfolio_slider2.png" alt="">
								<img class="carousel-item" src="images/portfolio/portfolio_slider3.png" alt="">
							</div>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="project_description">
							<div class="widget_title">
								<h4><span>Project Descriptions</span></h4>
							</div>

							<p><?php echo $result[7]; ?></p>
						</div>
						<div class="project_details">
							<div class="widget_title">
								<h4><span>Project Details</span></h4>
							</div>
							<ul class="details">
								<li><span>Client :</span><?php echo $result[2]; ?></li>
								<li><span>Company :</span><?php echo $result[3]; ?></li>
								<li><span>Category :</span><?php echo $result[4]; ?></li>
								<li><span>Date :</span><?php echo $result[5]; ?></li>
								<li><span>Project URL :</span> <a href="#"><?php echo $result[6]; ?></a></li>
							</ul>
						</div>
					</div>
				</div>

<?php
    }
}catch(PDOException $e){
    echo "No data";
}
?>
				<div class="row sub_content">
					<div class="carousel-intro">
						<div class="col-md-12">
							<div class="dividerHeading">
								<h4><span>Recent Work</span></h4>
							</div>
							<div class="carousel-navi">
								<div id="work-prev" class="arrow-left jcarousel-prev"><i class="fa fa-angle-left"></i></div>
								<div id="work-next" class="arrow-right jcarousel-next"><i class="fa fa-angle-right"></i></div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>

                    <div class="jcarousel recent-work-jc">
                        <ul class="jcarousel-list">

<?php 

try{    
    $sqlquery = $connection->prepare("select * from `portfolio` order by portfolio_id desc limit 8");
    $sqlquery->execute();

    $results = $sqlquery;
    foreach($results as $result){

?>
                            <!-- Recent Work Item -->
                            <li class="col-sm-3 col-md-3 col-lg-3">
                                <figure class="touching effect-bubba">
                                    <img src="images/portfolio/portfolio_1.png" alt="" class="img-responsive">

                                    <div class="option">
                                        <a href='portfolio_post.php?portfolio_id=<?php echo $result[0]; ?>' class="fa fa-link"></a>
                                        <a href="images/portfolio/portfolio_1.png" class="fa fa-search mfp-image"></a>
                                    </div>
                                    <figcaption class="item-description">
                                        <h5>Touch and Swipe</h5>
                                        <p><?php echo $result[1]; ?></p>
                                    </figcaption>
                                </figure>
                            </li>
<?php
    }
}catch(PDOException $e){
    echo "No Data";
}

?>

                            <!-- Recent Work Item -->
                            <li class="col-sm-3 col-md-3 col-lg-3">
                                <figure class="touching effect-bubba">
                                    <img src="images/portfolio/portfolio_2.png" alt="" class="img-responsive">

                                    <div class="option">
                                        <a href="portfolio_single.html" class="fa fa-link"></a>
                                        <a href="images/portfolio/portfolio_2.png" class="fa fa-search mfp-image"></a>
                                    </div>
                                    <figcaption class="item-description">
                                        <h5>Touch and Swipe</h5>
                                        <p>Technology</p>
                                    </figcaption>
                                </figure>
                            </li>

                            <!-- Recent Work Item -->
                            <li class="col-sm-3 col-md-3 col-lg-3">
                                <figure class="touching effect-bubba">
                                    <img src="images/portfolio/portfolio_3.png" alt="" class="img-responsive">

                                    <div class="option">
                                        <a href="portfolio_single.html" class="fa fa-link"></a>
                                        <a href="images/portfolio/portfolio_3.png" class="fa fa-search mfp-image"></a>
                                    </div>
                                    <figcaption class="item-description">
                                        <h5>Touch and Swipe</h5>
                                        <p>Technology</p>
                                    </figcaption>
                                </figure>
                            </li>

                            <!-- Recent Work Item -->
                            <li class="col-sm-3 col-md-3 col-lg-3">
                                <figure class="touching effect-bubba">
                                    <img src="images/portfolio/portfolio_4.png" alt="" class="img-responsive">

                                    <div class="option">
                                        <a href="portfolio_single.html" class="fa fa-link"></a>
                                        <a href="images/portfolio/portfolio_4.png" class="fa fa-search mfp-image"></a>
                                    </div>
                                    <figcaption class="item-description">
                                        <h5>Touch and Swipe</h5>
                                        <p>Technology</p>
                                    </figcaption>
                                </figure>
                            </li>

                            <!-- Recent Work Item -->
                            <li class="col-sm-3 col-md-3 col-lg-3">
                                <figure class="touching effect-bubba">
                                    <img src="images/portfolio/portfolio_5.png" alt="" class="img-responsive">

                                    <div class="option">
                                        <a href="portfolio_single.html" class="fa fa-link"></a>
                                        <a href="images/portfolio/portfolio_5.png" class="fa fa-search mfp-image"></a>
                                    </div>
                                    <figcaption class="item-description">
                                        <h5>Touch and Swipe</h5>
                                        <p>Technology</p>
                                    </figcaption>
                                </figure>
                            </li>

                            <!-- Recent Work Item -->
                            <li class="col-sm-3 col-md-3 col-lg-3">
                                <figure class="touching effect-bubba">
                                    <img src="images/portfolio/portfolio_6.png" alt="" class="img-responsive">

                                    <div class="option">
                                        <a href="portfolio_single.html" class="fa fa-link"></a>
                                        <a href="images/portfolio/portfolio_6.png" class="fa fa-search mfp-image"></a>
                                    </div>
                                    <figcaption class="item-description">
                                        <h5>Touch and Swipe</h5>
                                        <p>Technology</p>
                                    </figcaption>
                                </figure>
                            </li>

                            <!-- Recent Work Item -->
                            <li class="col-sm-3 col-md-3 col-lg-3">
                                <figure class="touching effect-bubba">
                                    <img src="images/portfolio/portfolio_7.png" alt="" class="img-responsive">

                                    <div class="option">
                                        <a href="portfolio_single.html" class="fa fa-link"></a>
                                        <a href="images/portfolio/portfolio_7.png" class="fa fa-search mfp-image"></a>
                                    </div>
                                    <figcaption class="item-description">
                                        <h5>Touch and Swipe</h5>
                                        <p>Technology</p>
                                    </figcaption>
                                </figure>
                            </li>

                            <!-- Recent Work Item -->
                            <li class="col-sm-3 col-md-3 col-lg-3">
                                <figure class="touching effect-bubba">
                                    <img src="images/portfolio/portfolio_8.png" alt="" class="img-responsive">

                                    <div class="option">
                                        <a href="portfolio_single.html" class="fa fa-link"></a>
                                        <a href="images/portfolio/portfolio_8.png" class="fa fa-search mfp-image"></a>
                                    </div>
                                    <figcaption class="item-description">
                                        <h5>Touch and Swipe</h5>
                                        <p>Technology</p>
                                    </figcaption>
                                </figure>
                            </li>
                        </ul>
                    </div>
				</div>
			</div>
		</section>
	</section>
	<!--end wrapper-->

	<!--start footer-->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="widget_title">
                        <h4><span>About Us</span></h4>
                    </div>
                    <div class="widget_content">
                        <p>Donec earum rerum hic tenetur ans sapiente delectus, ut aut reiciendise voluptat maiores alias consequaturs aut perferendis doloribus asperiores.</p>
                        <ul class="contact-details-alt">
                            <li><i class="fa fa-map-marker"></i> <p><strong>Address</strong>: #2021 Lorem Ipsum</p></li>
                            <li><i class="fa fa-user"></i> <p><strong>Phone</strong>:(+91) 9000-12345</p></li>
                            <li><i class="fa fa-envelope"></i> <p><strong>Email</strong>: <a href="#">mail@example.com</a></p></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="widget_title">
                        <h4><span>Recent Posts</span></h4>
                    </div>
                    <div class="widget_content">
                        <ul class="links">
                        <li> <a href="#">Aenean commodo ligula eget dolor<span>November 07, 2020</span></a></li>
                        <li> <a href="#">Temporibus autem quibusdam <span>November 05, 2020</span></a></li>
                        <li> <a href="#">Debitis aut rerum saepe <span>November 03, 2020</span></a></li>
                        <li> <a href="#">Et voluptates repudiandae <span>November 02, 2020</span></a></li>
                    </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="widget_title">
                        <h4><span>Twitter</span></h4>

                    </div>
                    <div class="widget_content">
                        <ul class="tweet_list">
                            <li class="tweet_content item">
                            <p class="tweet_link"><a href="#">@yahooobaba </a> Lorem ipsum dolor et, consectetur adipiscing eli</p>
                            <span class="time">29 September 2020</span>
                        </li>
                            <li class="tweet_content item">
                            <p class="tweet_link"><a href="#">@yahooobaba </a> Lorem ipsum dolor et, consectetur adipiscing eli</p>
                            <span class="time">29 September 2020</span>
                        </li>
                            <li class="tweet_content item">
                            <p class="tweet_link"><a href="#">@yahooobaba </a> Lorem ipsum dolor et, consectetur adipiscing eli</p>
                            <span class="time">29 September 2020</span>
                        </li>
                        </ul>
                    </div>
                    <div class="widget_content">
                        <div class="tweet_go"></div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="widget_title">
                        <h4><span>Flickr Gallery</span></h4>
                    </div>
                    <div class="widget_content">
                        <div class="flickr">
                            <ul id="flickrFeed" class="flickr-feed"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
	<!--end footer-->
	
	<section class="footer_bottom">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 ">
                    <p class="copyright">&copy; Copyright 2020 Edge | Powered by  <a href="https://www.yahoobaba.net/">Yahoo Baba</a></p>
				</div>
				<div class="col-sm-6 ">
					<div class="footer_social">
						<ul class="footbot_social">
							<li><a class="fb" href="#." data-placement="top" data-toggle="tooltip" title="Facbook"><i class="fa fa-facebook"></i></a></li>
							<li><a class="twtr" href="#." data-placement="top" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a class="dribbble" href="#." data-placement="top" data-toggle="tooltip" title="Dribbble"><i class="fa fa-dribbble"></i></a></li>
							<li><a class="skype" href="#." data-placement="top" data-toggle="tooltip" title="Skype"><i class="fa fa-skype"></i></a></li>
							<li><a class="rss" href="#." data-placement="top" data-toggle="tooltip" title="RSS"><i class="fa fa-rss"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/retina-1.1.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script> <!-- jQuery cookie -->
    <script type="text/javascript" src="js/styleswitch.js"></script> <!-- Style Colors Switcher -->
    <script type="text/javascript" src="js/jquery.smartmenus.min.js"></script>
    <script type="text/javascript" src="js/jquery.smartmenus.bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.jcarousel.js"></script>
    <script type="text/javascript" src="js/jflickrfeed.js"></script>
    <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="js/swipe.js"></script>
    <script type="text/javascript" src="js/jquery-scrolltofixed-min.js"></script>


	<script type="text/javascript">
		$(document).ready(function() {
			$.fn.carousel = function(op) {
				var op, ui = {};
				op = $.extend({
					speed: 500,
					autoChange: false,
					interval: 5000
				}, op);
				ui.carousel = this;
				ui.items    = ui.carousel.find('.carousel-item');
				ui.itemsLen = ui.items.length;

				// CREATE CONTROLS
				ui.ctrl 	= $('<div />', {'class': 'carousel-control'});
				ui.prev 	= $('<div />', {'class': 'carousel-prev'});
				ui.next 	= $('<div />', {'class': 'carousel-next'});
				ui.pagList  = $('<ul />', {'class': 'carousel-pagination'});
				ui.pagItem  = $('<li></li>');
				for (var i = 0; i < ui.itemsLen; i++) {
					ui.pagItem.clone().appendTo(ui.pagList);
				}
				ui.prev.appendTo(ui.ctrl);
				ui.next.appendTo(ui.ctrl);
				ui.pagList.appendTo(ui.ctrl);
				ui.ctrl.appendTo(ui.carousel);
				ui.carousel.find('.carousel-pagination li').eq(0).addClass('active');
				ui.carousel.find('.carousel-item').each(function() {
					$(this).hide();
				});
				ui.carousel.find('.carousel-item').eq(0).show().addClass('active');
				
				
				// CHANGE ITEM
				var changeImage = function(direction, context) {
					var current = ui.carousel.find('.carousel-item.active');

					if (direction == 'index') {
						if(current.index() === context.index())
							return false;

						context.addClass('active').siblings().removeClass('active');

						ui.items.eq(context.index()).addClass('current').fadeIn(op.speed, function() {
							current.removeClass('active').hide();
							$(this).addClass('active').removeClass('current');
						});
					} 

					if (direction == 'prev') {
						if (current.index() == 0) {
							ui.carousel.find('.carousel-item:last').addClass('current').fadeIn(op.speed, function() {
								current.removeClass('active').hide();
								$(this).addClass('active').removeClass('current');
							});
						}
						else {
							current.prev().addClass('current').fadeIn(op.speed, function() {
								current.removeClass('active').hide();
								$(this).addClass('active').removeClass('current');
							});
						}
					}

					if (direction == undefined) {
						if (current.index() == ui.itemsLen - 1) {
							ui.carousel.find('.carousel-item:first').addClass('current').fadeIn(300, function() {
								current.removeClass('active').hide();
								$(this).addClass('active').removeClass('current');
							});
						}
						else {
							current.next().addClass('current').fadeIn(300, function() {
								current.removeClass('active').hide();
								$(this).addClass('active').removeClass('current');
							});
						}
					}
					ui.carousel.find('.carousel-pagination li').eq( ui.carousel.find('.carousel-item.current').index() ).addClass('active').siblings().removeClass('active');
				};

				ui.carousel
					.on('click', 'li', function() {
						changeImage('index', $(this));
					})
					.on('click', '.carousel-prev', function() {
						changeImage('prev');
					})
					.on('click', '.carousel-next', function() {
						changeImage();
					});
				
				// AUTO CHANGE
				if (op.autoChange) {
					var changeInterval = setInterval(changeImage, op.interval);
					ui.carousel
						.on('mouseenter', function() {
							clearInterval(changeInterval);
						})
						.on('mouseleave', function() {
							changeInterval = setInterval(changeImage, op.interval);
						});
				}
				return this;
			};
			
			$('.porDetCarousel').each(function() {
				$(this).carousel({
					autoChange: true
				});
			});
		});
	</script>
	<script src="js/main.js"></script>
	
	<!-- Start Style Switcher -->
	<div class="switcher"></div>
	<!-- End Style Switcher -->
</body>
</html>