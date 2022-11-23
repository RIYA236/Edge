<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Edge Responsive Multipurpose Template</title>
	<meta name="description" content="">

    <!-- CSS FILES -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" data-name="skins">
    <link rel="stylesheet" href="css/layout/wide.css" data-name="layout">

    <link rel="stylesheet" type="text/css" href="css/switcher.css" media="screen" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<?php include "header.php"; ?>
<?php include "connection.php"; ?>
	
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

    <form method="POST">

		<section class="content portfolio medium-images">
			<div class="container">
				<div class="row sub_content">
					<div class="row1">
                        <!--begin isotope -->
                        <div class="col-lg-12 isotope">
                            <!--begin portfolio filter -->
                            <ul id="filter">
                                <!-- <input type="submit" name="All" class="all" value="All" />
                                <input type="submit" name="Responsive" class="responsive" value="Responsive" />
                                <input type="submit" name="Mobile" class="mobile" value="Mobile" />
                                <input type="submit" name="Branding" class="branding" value="Branding" /> -->
                                <a href='portfolio.php?category=all' class="filter_list">All</a>
                                <a href='portfolio.php?category=responsive' class="filter_list">Responsive</a>
                                <a href='portfolio.php?category=mobile' class="filter_list">Mobile</a>
                                <a href='portfolio.php?category=branding' class="filter_list">Branding</a>
                            </ul>
                            <!--end portfolio filter -->

                            <!--begin portfolio_list -->
                            <ul id="list" class="portfolio_list clearfix ">
                                <!--begin List Item -->

<?php
if(isset($_GET['category'])){

    $category = $_GET['category'];

    if($category == "all"){
        all_data($connection);
    }else if($category == "responsive"){
        Responsive($connection);
    }else if($category == "mobile"){
        Mobile($connection);
    }else if($category == "branding"){
        Branding($connection);
    }
}
else if(!isset($_GET['category'])){
    all_data($connection);
}

?>

<?php
function Responsive($connection){
try{
    $sqlquery = $connection->prepare("select * from `portfolio` where `portfolio_category`='responsive' order by `portfolio_id` desc");
    $sqlquery->execute();

    $res = $sqlquery->rowCount();
    $limit = 2;
    $GLOBALS['total_responsive'] = ceil($res / $limit);

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    if(!isset($_GET['page'])){
        $initial_page = (1-1) * $limit; 
    }else if($_GET['page'] != ""){
        $initial_page = ($page - 1) * $limit; 
    }else{
        $initial_page = (1-1) * $limit; 
    }

    $sqlquery = $connection->prepare("select * from `portfolio` where `portfolio_category`='responsive' order by `portfolio_id` desc limit $initial_page , $limit");
    $sqlquery->execute();
    $results = $sqlquery;

    foreach($results as $result){
?>
                            <a href='portfolio_post.php?portfolio_id=<?php echo $result['portfolio_id']; ?>' class="responsive_box">
                                <li class="list_item col-lg-4 col-md-6 col-sm-6">
                                    <figure class="touching effect-bubba">
                                        <img src="images/portfolio/portfolio_2.png" alt="image"/>
                                        <figcaption>
                                            <h5>Touch and Swipe</h5>
                                            <p><?php echo $result['portfolio_category'].$result[0] . "r"; ?></p>
                                        </figcaption>
                                    </figure>
                                </li>
                            </a>
<?php
    }
  }catch(PDOException $e){
    echo "No data";
}
}

?>

<?php
function Mobile($connection){
try{
    $sqlquery = $connection->prepare("select * from `portfolio` where `portfolio_category`='mobile' order by `portfolio_id` desc");
    $sqlquery->execute();

    $res = $sqlquery->rowCount();
    $limit = 1;
    $GLOBALS['total_mobile'] = ceil($res / $limit);

if(isset($_GET['page'])){
    $page = $_GET['page'];
}

if(!isset($_GET['page'])){
    $initial_page = (1 - 1) * $limit;
}else if($_GET['page'] != ""){
    $initial_page = ($page - 1) * $limit;
}else{
    $initial_page = (1 - 1) * $limit;
}

    $sqlquery = $connection->prepare("select * from `portfolio` where `portfolio_category`='mobile' order by `portfolio_id` desc limit $initial_page , $limit");
    $sqlquery->execute();

    $results = $sqlquery;
    foreach($results as $result){
?>
                            <a href='portfolio_post.php?portfolio_id=<?php echo $result['portfolio_id']; ?>'>
                                <li class="list_item col-lg-4 col-md-6 col-sm-6">
                                    <figure class="touching effect-bubba">
                                        <img src="images/portfolio/portfolio_2.png" alt="image"/>
                                        <figcaption>
                                            <h5>Touch and Swipe</h5>
                                            <p><?php echo $result['portfolio_category'] . $result['portfolio_id'] . "m"; ?></p>
                                        </figcaption>
                                    </figure>
                                </li>
                            </a>
<?php
    }
  }catch(PDOException $e){
    echo "No data";
}
}

?>
<!-- <script>
    var a = document.getElementById("1");
    b = $(a).html();
    console.log(b);
    c = $(a).addClass("active");
    console.log(c);
</script> -->

<?php
function Branding($connection){
try{
    $sqlquery = $connection->prepare("select * from `portfolio` order by `portfolio_id` desc");
    $sqlquery->execute();
    $res = $sqlquery->rowCount();
    $limit = 3;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    $GLOBALS['total_branding'] = ceil($res / $limit);
  
    if(!isset($_GET['page'])){
        $initial_page = (1-1) * $limit;
    }else if($page != ""){
        $initial_page = ($page-1) * $limit;
    }else{
        $initial_page = (1 - 1) * $limit;
    }

    $sqlquery = $connection->prepare("select * from `portfolio` order by `portfolio_id` desc limit $initial_page , $limit");
    $sqlquery->execute();

    $results = $sqlquery;
    foreach($results as $result){
?>
                            <a href='portfolio_post.php?portfolio_id=<?php echo $result['portfolio_id']; ?>'>
                                <li class="list_item col-lg-4 col-md-6 col-sm-6">
                                    <figure class="touching effect-bubba">
                                        <img src="images/portfolio/portfolio_2.png" alt="image"/>
                                        <figcaption>
                                            <h5>Touch and Swipe</h5>
                                            <p><?php echo $result['portfolio_category'] . $result['portfolio_id'] . "b" ; ?></p>
                                        </figcaption>
                                    </figure>
                                </li>
                            </a>
<?php
    }
  }catch(PDOException $e){
    echo "No data";
}
}

?>
<?php

function all_data($connection){
try{
    $query = "select * from `portfolio` order by `portfolio_id` desc";
    $sqlquery = $connection->prepare($query);
    $sqlquery->execute();

    $res = $sqlquery->rowCount();
    $limit = 6;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    $GLOBALS['total_pages'] = ceil($res / 6);
   
    if(!isset($_GET['page'])){
        $initial_page = (1-1) * $limit;
    }else if($page != ""){
        $initial_page = ($page- 1) * $limit;
    }else{
        $initial_page = (1 - 1) * $limit;
    }

    $query = "select * from `portfolio` order by `portfolio_id` desc limit $initial_page , $limit";
    $sqlquery = $connection->prepare($query);
    $sqlquery->execute();

    $results = $sqlquery;
    foreach($results as $result){
?>
                            <a href='portfolio_post.php?portfolio_id=<?php echo $result['portfolio_id']; ?>'>
                                <li class="list_item col-lg-4 col-md-6 col-sm-6">
                                    <figure class="touching effect-bubba">
                                        <img src="images/portfolio/portfolio_2.png" alt="image"/>
                                        <figcaption>
                                            <h5>Touch and Swipe</h5>
                                            <p><?php echo $result['portfolio_category'].$result['portfolio_id'] . "a"; ?></p>
                                        </figcaption>
                                    </figure>
                                </li>
                            </a>
<?php
        }
    }catch(PDOException $e){
            echo "No data";
        }
    }
?>
                    </ul> <!--end portfolio_list -->
                        </div>
                        <!--end isotope -->
                        <div class="col-sm-12 text-center">
                            <ul class="pagination">
                            <?php
if(isset($_GET['category'])){

    $category = $_GET['category'];

    if($category == "responsive"){
        $GLOBALS['total_pages'] = $GLOBALS['total_responsive'];
    }else if($category == "mobile"){
        $GLOBALS['total_pages'] = $GLOBALS['total_mobile'];
    }else if($category == "branding"){
        $GLOBALS['total_pages'] = $GLOBALS['total_branding'];
    }else if($category == "all"){
        $GLOBALS['total_pages'] = $GLOBALS['total_pages'];
    }    
}
?>
                    <?php
                    if(isset($_GET['category']) && isset($_GET['page'])  && isset($_GET['total_pages'])  ){
                            if(($_GET['page']) != 1 && ($_GET['page'] <= $GLOBALS['total_pages']) ){
                            $previous = ($_GET['page'] - 1); 
                    ?>

                    <li id="prev"><a href="portfolio.php?category=<?php echo $_GET['category']; ?>&page=1" id="previous" >&laquo;</a></li>
                    <li id="prev"><a href="portfolio.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $previous ?>" id="previous" >&#8249;</a></li>

                    <?php
                                }
                            }
                        else{
                            if(isset($_GET['page'])){
                                if( ($_GET['page']) != "" && ($_GET['page']) != 1 && ($_GET['page'] <= $GLOBALS['total_pages'])){
                                $previous = ($_GET['page'] - 1); 
                    ?>

                    <li id="prev"><a href="portfolio.php?page=1" id="previous" >&laquo;</a></li>
                    <li id="prev"><a href="portfolio.php?page=<?php echo $previous; ?>" id="previous" >&#8249;</a></li>

                    <?php
                            }
                        }
                    }
                    ?>

            <?php
            if(  isset($GLOBALS['total_pages'])  ){
                // if($_GET['page'] <= $GLOBALS['total_pages']){
                for($i= 1; $i<= $GLOBALS['total_pages']; $i++){
//                                    if(isset($_GET['page'])){
                    if($total_pages<=20){
                            if(isset($_GET['category'])){
                                if(isset($_GET['page'])){
                                    if($_GET['page'] <= $GLOBALS['total_pages']){
                            ?>
                    <li><a href="portfolio.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                    }
                                }else{
                            ?>
                    <li><a href="portfolio.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                }
                            }
                            else{
                                if(isset($_GET['page'])){
                                    if($_GET['page'] <= $GLOBALS['total_pages']){
                            ?>
                    <li><a href="portfolio.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                                }
                            }else{
                    ?>
                    <li><a href="portfolio.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                                }
                            }
                        }
                    }

                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        if($page == ""){
                          $page = 1;
                        }else if($page > $total_pages){
                          $page = 1;
                        }
                      }else{
                        $page = 1;
                      }

                    for($i= ($page - 10) ; $i< ( $page + 10 ) && $i<= $total_pages; $i++){
                            if( $total_pages>20 && $i>0 ){
                                    if(isset($_GET['category'])){
                                        if(isset($_GET['page'])){
                                            if($_GET['page'] <= $GLOBALS['total_pages']){
                                    ?>
                            <li><a href="portfolio.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                            }
                                        }else{
                                    ?>
                            <li><a href="portfolio.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                        }
                                    }
                                    else{
                                        if(isset($_GET['page'])){
                                            if($_GET['page'] <= $GLOBALS['total_pages']){
                                    ?>
                            <li><a href="portfolio.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                        }
                                    }else{
                            ?>
                            <li><a href="portfolio.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                                        }
                                    }
                                }
                            }
                        
                    
                    }
                        ?>
<?php
if(isset($GLOBALS['total_pages'])){
if(isset($_GET['category'])){
    if(isset($_GET['page'])){
            if( ($_GET['page']) != "" &&  (($_GET['page']) != $GLOBALS['total_pages'])  &&  (($_GET['page']) < $GLOBALS['total_pages'])   ){
                $next = $_GET['page'] + 1 ;
?>

    <li id="next"><a href="portfolio.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $next; ?>" id="next">&#8250;</a></li>
    <li id="next"><a href="portfolio.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $GLOBALS['total_pages']; ?>" id="next">&raquo;</a></li>

<?php
        }
    }else{
?>
        <li id="next"><a href="portfolio.php?category=<?php echo $_GET['category']; ?>&page=2" id="next">&#8250;</a></li>
        <li id="next"><a href="portfolio.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $GLOBALS['total_pages']; ?>" id="next">&raquo;</a></li>
<?php
    }
}else{
    if(isset($_GET['page'])){
        if(  (($_GET['page']) != $GLOBALS['total_pages'])  &&  (($_GET['page']) < $GLOBALS['total_pages'])  ){
            $next = $_GET['page'] + 1;
?>
        <li id="next"><a href="portfolio.php?page=<?php echo $next; ?>" id="next">&#8250;</a></li>
        <li id="next"><a href="portfolio.php?page=<?php echo $GLOBALS['total_pages']; ?>" id="next">&raquo;</a></li>
<?php
        }
    }else{
?>
        <li id="next"><a href="portfolio.php?page=2" id="next">&#8250;</a></li>
        <li id="next"><a href="portfolio.php?page=<?php echo $GLOBALS['total_pages']; ?>" id="next">&raquo;</a></li>
<?php
    }
}
}
?>
<script>

    var page_number = (new URL(window.location.href)).searchParams;

    if(page_number != ""){
        var page = page_number.get('page');
        var add_class = document.getElementById(page);
        var element = $(add_class).parent();
        $(element).addClass("active");
    }else{
        var add_class = document.getElementById("1");
        var element = $(add_class).parent();
        $(element).addClass("active");
    }

    if(!$(".pagination li").hasClass("active")){
        var add_class = document.getElementById("1");
        var element = $(add_class).parent();
        $(element).addClass("active");
    }

</script>

                            </ul>
                        </div>
				    </div>
				</div> <!--./row-->
			</div> <!--./div-->
		</section>
	</section>
	<!--end wrapper-->
</form>
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
            <div class="col-sm-6">
                <p class="copyright">&copy; Copyright <?php echo date("Y"); ?> Edge | Powered by  <a href="https://www.yahoobaba.net/">Yahoo Baba</a></p>
            </div>

            <div class="col-sm-6 ">
                <div class="footer_social">
                    <ul class="footbot_social">
                        <li><a class="fb" href="#." data-placement="top" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
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

    <script src="js/main.js"></script>

    <!-- Start Style Switcher -->
    <div class="switcher"></div>
    <!-- End Style Switcher -->
</body>
</html>