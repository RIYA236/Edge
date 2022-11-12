<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Edge</title>
	<meta name="description" content="">
    <!-- CSS FILES -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/flexslider.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" data-name="skins">
    <link rel="stylesheet" href="css/layout/wide.css" data-name="layout">
    <link rel="stylesheet" href="css/animate.css"/>
</head>
<body class="home">
    <?php 
        include "home_header.php"; 
        include "connection.php";
        include "month.php";
    ?>
        <!--start info service-->
        <section class="info_service">
            <div class="container">
                <div class="row sub_content">
                    <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInDown">
                        <h1 class="intro text-center">Edge</h1>
                        <p class="lead text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa nesciunt odit sunt vitae voluptatibus. Ad animi dicta dolore et illo incidunt sint.</p>
                    </div>
                    <div class="rs_box wow fadeIn">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="serviceBox_1">
                                <div class="service_icon">
                                    <i class="fa fa-laptop"></i>
                                    <h3>Modern Design</h3>
                                </div>
                                <div class="service_content">
                                    <p>Lorem ipsum dolor sit amet, cons adipiscing elit. Aenean commodo ligula eget dolor. Cum sociis natoque penatibus mag dis parturient.</p>
                                    <a class="read" href="#">Read more</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="serviceBox_1">
                                <div class="service_icon">
                                    <i class="fa fa-heart"></i>
                                    <h3>Clean &amp; Minimal</h3>
                                </div>
                                <div class="service_content">
                                    <p>Lorem ipsum dolor sit amet, cons adipiscing elit. Aenean commodo ligula eget dolor. Cum sociis natoque penatibus mag dis parturient.</p>
                                    <a class="read" href="#">Read more</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="serviceBox_1">
                                <div class="service_icon">
                                    <i class="fa fa-trophy"></i>
                                    <h3>Branding Theme</h3>
                                </div>
                                <div class="service_content">
                                    <p>Lorem ipsum dolor sit amet, cons adipiscing elit. Aenean commodo ligula eget dolor. Cum sociis natoque penatibus mag dis parturient.</p>
                                    <a class="read" href="#">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--end info service-->
        <section class="feature_bottom">
            <div class="container">
                <div class="row sub_content">
                    <div class="col-lg-8 col-md-8 col-sm-8 wow fadeInLeft">
                        <div class="dividerHeading">
                            <h4><span>Why Choose Us?</span></h4>
                        </div>
                        <div class="row">
<!-- blog section start-->
        <?php
            $sqlquery = $connection->prepare("select * from `blogs` order by `blog_id` desc limit 2");
            $sqlquery->execute();
            $results = $sqlquery;
            foreach($results as $result){
                $blog_date = $result['blog_created_date'];
                $date = (explode(" ", $blog_date));
                $date = (explode("-", $date[0]));
                $day = $date[2];
                $month = $date[1];
                $year = $date[0];
        ?>
                            <div class="col-lg-6  rec_blog">
                              <div class="blog_Post">
                                <div class="blogPic">
                                    <img alt="" src="images/blog/blog_6.png">
                                    <div class="blog-hover">
                                        <a href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>">
                                            <span class="icon">
                                                <i class="fa fa-link"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="blogDetail">
                                    <div class="blogTitle">
                                        <a href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>">
                                            <h2><?php echo $result['blog_title']; ?></h2>
                                        </a>
                                        <span>
                                            <i class="fa fa-calendar"></i>
                                            <?php echo  " " . $day . monthName($month) . ", " . $year ; ?>
                                        </span>
                                    </div>
                                    <div class="blogContent">
                                        <p><?php echo substr($result['blog_description'], 0, 200), "..."; ?><a href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>"> read more</a></p>
                                    </div>
                                    <div class="blogMeta">
                                        <a>
                                            <i class="fa fa-user"></i>
                                            <?php echo $result['blog_posted_by']; ?>
                                        </a>
                                    </div>
                                </div>
                              </div>
                            </div>
<?php } ?>
                        </div>
                    </div>
<!-- blog section end -->
                    <!-- TESTIMONIALS -->
                    <div class="col-lg-4 col-md-4 col-sm-4 wow fadeInRight">
                        <div class="dividerHeading">
                            <h4><span>What Client's Say</span></h4>
                        </div>
                        <div id="testimonial-carousel" class="testimonial carousel slide">
                            <div class="carousel-inner">
<?php
try{
    $sqlquery = $connection->prepare("select * from `testimonial` limit 1");
    $sqlquery -> execute();
    $results = $sqlquery->fetchAll();
    foreach($results as $result){
?>
								<div class="active item">
									<div class="testimonial-item">
										<div class="icon"><i class="fa fa-quote-right"></i></div>
										<blockquote>
											<p><?php echo $result['client_review']; ?></p>
										</blockquote>
										<div class="icon-tr"></div>
										<div class="testimonial-review">
											<img src="images/testimonials/1.png" alt="testimoni">
											<h1><?php echo $result['client_name']; ?>,<small><?php echo $result['company_name']; ?></small></h1>
										</div>
									</div>
								</div>
<?php
}
}catch(PDOException $e){
    echo "Not found";
}
?>
<?php
try{
    $sqlquery = $connection->prepare("select * from `testimonial` ORDER BY `client_id` DESC limit 10 offset 1");
    $sqlquery -> execute();
    $results = $sqlquery->fetchAll();
    foreach($results as $result){
?>
                <div class="item">
                    <div class="testimonial-item">
                        <div class="icon"><i class="fa fa-quote-right"></i></div>
                        <blockquote>
                            <p><?php echo $result['client_review']; ?></p>
                        </blockquote>
                        <div class="icon-tr"></div>
                        <div class="testimonial-review">
                            <img src="images/testimonials/1.png" alt="testimoni">
                            <h1><?php echo $result['client_name']; ?>,<small><?php echo $result['company_name']; ?></small></h1>
                        </div>
                    </div>
                </div>
<?php
}
}catch(PDOException $e){
    echo "Not found";
}
?>
                            </div>
                        <div class="testimonial-buttons"><a href="#testimonial-carousel" data-slide="prev"><i class="fa fa-chevron-left"></i></a>&#32;
                            <a href="#testimonial-carousel" data-slide="next"><i class="fa fa-chevron-right"></i></a></div>
                        </div>
                    </div><!-- TESTIMONIALS END -->
                </div>
            </div>
        </section>
        <section class="clients">
            <div class="container">
                <div class="row sub_content">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="dividerHeading">
                            <h4><span>Our Clients</span></h4>
                        </div>
                        <div class="our_clients">
                            <ul class="client_items clearfix">
                                <li class="col-sm-3 col-md-3 col-lg-3"><a data-placement="bottom" data-toggle="tooltip" title="Client 1" ><img src="images/clients/1.png" alt="" /></a></li>
                                <li class="col-sm-3 col-md-3 col-lg-3"><a data-placement="bottom" data-toggle="tooltip" title="Client 2" ><img src="images/clients/2.png" alt="" /></a></li>
                                <li class="col-sm-3 col-md-3 col-lg-3"><a data-placement="bottom" data-toggle="tooltip" title="Client 3" ><img src="images/clients/3.png" alt="" /></a></li>
                                <li class="col-sm-3 col-md-3 col-lg-3"><a data-placement="bottom" data-toggle="tooltip" title="Client 4" ><img src="images/clients/4.png" alt="" /></a></li>
                                <!-- <li class="col-sm-3 col-md-3 col-lg-3"><a href="services.html" data-placement="bottom" data-toggle="tooltip" title="Client 4" ><img src="images/clients/4.png" alt="" /></a></li> -->
                            </ul><!--/ .client_items-->
                        </div>
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
                <div class="col-sm-6 col-md-3 col-lg-4">
                    <div class="widget_title">
                        <h4><span>About Us</span></h4>
                    </div>
                    <div class="widget_content">
                        <p>Donec earum rerum hic tenetur ans sapiente delectus, ut aut reiciendise voluptat maiores alias consequaturs aut perferendis doloribus asperiores.</p>
                        <ul class="contact-details-alt">
                            <li><i class="fa fa-map-marker"></i> <p><strong>Address</strong>: India</p></li>
                            <li><i class="fa fa-phone"></i> <p><strong>Phone</strong>:<a href="tel:1234567890"> (+91) 12345 67890 </a></p></li>
                            <li><i class="fa fa-envelope"></i> <p><strong>Email</strong>: <a href="mailto:noreply@edge.com" class="hidden-sm">noreply@edge.com</a></p></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-4">
                    <div class="widget_title">
                        <h4><span>Recent Blogs</span></h4>
                    </div>
                    <div class="widget_content">
                        <ul class="links">
                          <?php
                            $sqlquery = $connection->prepare("select * from `blogs` order by `blog_id` desc limit 3 ");
                            $sqlquery->execute();
                            $results = $sqlquery;
                            foreach($results as $result){
                                $blog_date = $result['blog_created_date'];
                                $date = (explode(" ", $blog_date));
                                $date = (explode("-", $date[0]));
                                $day = $date[2];
                                $month = $date[1];
                                $year = $date[0];
                          ?>
                            <li><a href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>"><?php echo $result['blog_title']; ?><span> <?php echo monthName($month) . $day . "," . $year; ?> </span></a></li>
                          <?php
                            }
                          ?>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-sm-6 col-md-3 col-lg-3">
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
                </div> -->
                <div class="col-sm-6 col-md-3 col-lg-4">
                    <div class="widget_title">
                        <h4><span>Flickr Gallery</span></h4>
                    </div>
                    <div class="widget_content">
                        <div class="flickr">
                            <ul id="flickrFeed" class="flickr-feed"></ul>
                        </div>
                    </div>
                </div>

            <div class="col-sm-6">
                <p class="copyright">Copyright &copy;Edge <?php echo date('Y'); ?></p>
            </div>

            </div>
        </div>
    </footer>
	<!--end footer-->
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/retina-1.1.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script> <!-- jQuery cookie -->
    <script type="text/javascript" src="js/jquery.smartmenus.min.js"></script>
    <script type="text/javascript" src="js/jquery.smartmenus.bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.jcarousel.js"></script>
    <script type="text/javascript" src="js/jflickrfeed.js"></script>
    <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="js/swipe.js"></script>
    <script type="text/javascript" src="js/jquery-scrolltofixed-min.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $('.flexslider.top_slider').flexslider({
            animation: "fade",
            controlNav: false,
            directionNav: true,
            prevText: "&larr;",
            nextText: "&rarr;"
        });
    </script>
        <script type="text/javascript" src="js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
</body>
</html>
