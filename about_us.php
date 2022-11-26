<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>About Edge</title>
	<meta name="description" content="">

    <!-- CSS FILES -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" data-name="skins">
    <link rel="stylesheet" href="css/layout/wide.css" data-name="layout">

    <link rel="stylesheet" type="text/css" href="css/switcher.css" media="screen" />
</head>
<body>
	
<?php include "header.php"; ?>
<?php include "connection.php"; ?>
<?php include "month.php"; ?>

<!--start wrapper-->
	<section class="wrapper">
    <section class="page_head">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li>About Us</li>
                        </ul>
                    </nav>

                    <div class="page_title">
                        <h2>About Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
		
		<section class="content about">
			<div class="container">
				<div class="row sub_content">
					<div class="who">
						<div class="col-lg-8 col-md-8 col-sm-8">
							<div class="dividerHeading">
								<h4><span>Who we are?</span></h4>
							</div>
								<img class="left_img img-thumbnail" src="images/about_1.png" alt="about img">
                            <p>Veos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum. </p>
							<p>Donec rutrum erat non arcu gravida porttitor. Nunc et magna nisi. Lore aliquam at erat in lorem purus aliquet mollis. Fusce elementum velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque posuere vel vitae nibh eros scelerisque. </p>
							<p>Fusce lacinia tempor malesuada. Ut lacus sapien, placerat a ornare nec, elementum sit amet felis. Maecenas pretium lorem hendrerit eros sagittis fermentum. Donec in ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo ad gravida. Cras suscipit, quam vitae adipiscing faucibus, risus nibh laoreet odio, a porttitor metus.</p>
							
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-4">
							<div class="dividerHeading">
								<h4><span>Our Skills</span></h4>
							</div>
							<p>Nunc et magna nisi. lore Aliquam at erat in lorem purus aliquet mollis. Fusce elementum velit vel dolor iaculis. </p>
							<ul class="progress-skill-bar">
								<li>
									<span class="lable">70%</span>
									<div class="progress_skill">
										<div class="bar" data-value="70" role="progressbar" data-height="100">
											HTML
										</div>
									</div>
								</li>
								<li>
									<span class="lable">80%</span>
									<div class="progress_skill">
										<div class="bar" data-value="80" role="progressbar" data-height="100">
											CSS
										</div>
									</div>
								</li>
								<li>
									<span class="lable">90%</span>
									<div class="progress_skill">
										<div class="bar" data-value="90" role="progressbar" data-height="100">
											JavaScript
										</div>
									</div>
								</li>
								<li>
									<span class="lable">80%</span>
									<div class="progress_skill">
										<div class="bar" data-value="80" role="progressbar" data-height="100">
											MySQL
										</div>
									</div>
								</li>
								<li>
									<span class="lable">70%</span>
									<div class="progress_skill">
										<div class="bar" data-value="70" role="progressbar" data-height="100">
											PHP
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				
				<div class="row sub_content">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="dividerHeading">
							<h4><span>Why Choose Us?</span></h4>

						</div>
						<ul class="list_style circle">
							<li><a href="#"> Donec convallis, metus nec tempus aliquet</a></li>
							<li><a href="#"> Aenean commodo ligula eget dolor</a></li>
							<li><a href="#"> Cum sociis natoque penatibus mag dis parturient</a></li>
							<li><a href="#"> Lorem ipsum dolor sit amet cons adipiscing</a></li>
							<li><a href="#"> Accumsan vulputate faucibus turpis tortor dictum</a></li>
							<li><a href="#"> Nullam ultrices eros accumsan vulputate faucibus</a></li>
							<li><a href="#"> Nunc aliquet tincidunt metus sit amet</a></li>
						</ul>
					</div>
					
					<!-- TESTIMONIALS -->
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="dividerHeading">
							<h4><span>What Client's Say</span></h4>

						</div>
						<div id="testimonial-carousel" class="testimonial carousel slide">
							<div class="carousel-inner">

<?php
if(isset($connection)){
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

}
?>
<?php
if(isset($connection)){

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

}
?>
								
							</div>
							<div class="testimonial-buttons"><a href="#testimonial-carousel" data-slide="prev"><i class="fa fa-chevron-left"></i></a>&#32;
							<a href="#testimonial-carousel" data-slide="next"><i class="fa fa-chevron-right"></i></a></div>
						</div>
					</div><!-- TESTIMONIALS END -->
				</div>
			
                <div class="row  sub_content">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="dividerHeading">
                            <h4><span>Meet the Team</span></h4>

                        </div>
                    </div>

        <?php
        if(isset($connection)){

            try{
                $sqlquery = $connection->prepare("select * from `employee_team`");
                $sqlquery->execute();

                $results = $sqlquery->fetchAll();

                foreach($results as $result){
        ?>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="our-team">
                            <div class="pic">
        <?php
            if($result['img'] != ""){
        ?>
            <img src="images/<?php echo $result['img']; ?>" alt="profile img" height="216"/>
        <?php
            }else{
        ?>
            <img src="images/teams/profile_photo.png" alt="profile img">
        <?php
            }
        ?>

                            </div>
                            <div class="team_prof">
                                <h3 class="names"><?php echo $result['employee_name']; ?><small><?php echo $result['employee_position']; ?></small></h3>
                                <p class="description"><?php echo $result['employee_info']; ?></p>
                            </div>
                        </div>
                    </div>

<?php
}
    }catch(PDOException $e){
        echo "Connection failed";
    }
    $connection = null;

}
?>

                </div>
			</div>
		</section>
	</section>
	<!--end wrapper-->

	<!--start footer-->
    <?php
        include "footer.php";
    ?>
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

    <script src="js/main.js"></script>

</body>
</html>
