<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Contact Edge</title>
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
                                <li>Contact Us</li>
                            </ul>
                        </nav>

                        <div class="page_title">
                            <h2>Contact us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

		<section class="content contact">
			<div class="container">
				<div class="row sub_content">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="maps">
							<div id="page_maps"></div>
						</div>
					</div>
				</div>

				<div class="row sub_content">
					<div class="col-lg-8 col-md-8 col-sm-8">
						<div class="dividerHeading">
							<h4><span>Get in Touch</span></h4>
						</div>
						<p>Vidit nulla errem ea mea. Dolore apeirian insolens mea ut, indoctum consequuntur hasi. No aeque dictas dissenti as tusu, sumo quodsi fuisset mea in. Ea nobis populo interesset cum, ne sit quis elit officiis, min im tempor iracundia sit anet. Facer falli aliquam nec te. In eirmod utamur offendit vis, posidonium instructior sed te.</p>
							
						<div class="alert alert-success hidden alert-dismissable" id="contactSuccess">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <strong>Success!</strong> Your message has been sent to us.
						</div>
						
						<div class="alert alert-error hidden" id="contactError">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <strong>Error!</strong> There was an error sending your message.
						</div>
						
						<form method="POST">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-lg-6 ">
                                        <input type="text" id="name" name="name" class="form-control"placeholder="Your Name" >
                                    </div>
                                    <div class="col-lg-6 ">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Your E-mail" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea id="message" class="form-control" name="message" rows="10" cols="50" maxlength="5000" placeholder="Message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" name="enter_details" value="Send Message">
                                </div>
                            </div>
						</form>
					</div>

<?php
if(isset($connection)){

if (isset($_POST['enter_details'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sqlquery= $connection->prepare("Insert into `contact_us` ( `user_name` , `user_email` , `user_subject` , `user_message` ) values ( :name , :email , :subject , :message ) ");
    $sqlquery->bindValue("name", $name , PDO::PARAM_STR);
    $sqlquery->bindValue("email" , $email , PDO::PARAM_STR);
    $sqlquery->bindValue("subject", $subject, PDO::PARAM_STR);
    $sqlquery->bindValue("message", $message, PDO::PARAM_STR);
    $sqlquery->execute();
}

}
?>

					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="sidebar">
							<div class="widget_info">
								<div class="dividerHeading">
									<h4><span>Contact Info</span></h4>
									</div>
								<p>Lorem ipsum dolor sit amet, consectetur adip, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								<ul class="widget_info_contact">
									<li><i class="fa fa-map-marker"></i> <p><strong>Address</strong>: #2021 Lorem Ipsum</p></li>
									<li><i class="fa fa-user"></i> <p><strong>Phone</strong>: <a href="tel:1234567890">(+91) 12345 67890</a></p></li>
									<li><i class="fa fa-envelope"></i> <p><strong>Email</strong>: <a href="mailto:noreply@edge.com">noreply@edge.com</a></p></li>
									<li><i class="fa fa-globe"></i> <p><strong>Web</strong>: <a href="#" data-placement="bottom" data-toggle="tooltip" title="www.example.com">www.example.com</a></p></li>
								</ul>
								
							</div>
							
						</div>
					</div>
					
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
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/view.contact.js"></script>
    <script type="text/javascript" src="js/jquery.gmap.js"></script>

    <script src="js/main.js"></script>

</body>
</html>
