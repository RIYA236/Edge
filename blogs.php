<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" class="no-js" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Edge Blogs</title>
	<meta name="description" content="">

    <!-- CSS FILES -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" data-name="skins">
    <link rel="stylesheet" href="css/layout/wide.css" data-name="layout">

    <link rel="stylesheet" type="text/css" href="css/switcher.css" media="screen" />
    <script src="js/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php 
include "header.php";
include "connection.php"; 
include "month.php";
?>

	<!--start wrapper-->
	<section class="wrapper">
    <section class="page_head">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <nav id="breadcrumbs">
                        <ul>

                            <li><a href="index.php">Home</a></li>
                            <li>Blogs</li>
                        </ul>
                    </nav>

                    <div class="page_title">
                        <h2>Blogs</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

		<section class="content blog">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="blog_medium">

	<?php
        if(isset($_GET['month']) && isset($_GET['year'])){
            $month = monthName($_GET['month']);
            $year = $_GET['year'];

            $sqlquery =$connection->prepare("SELECT * from `blogs` WHERE month(`blog_created_date`)=:month  and year(`blog_created_date`)=:year ");
            $sqlquery->bindValue("month", $month , PDO::PARAM_INT);
            $sqlquery->bindValue("year" , $year , PDO::PARAM_INT );
            $sqlquery->execute();
            $results = $sqlquery;
            foreach($results as $result){
                // echo $result['blog_id'];
            }
        }

        function month_year($connection){
            if(isset($_GET['month']) && isset($_GET['year'])){
                $month = monthName($_GET['month']);
                $year = $_GET['year'];
            }
    
            $sqlquery =$connection->prepare("SELECT * from `blogs` WHERE month(`blog_created_date`)=:month  and year(`blog_created_date`)=:year ");
            $sqlquery->bindValue("month", $month , PDO::PARAM_INT);
            $sqlquery->bindValue("year" , $year , PDO::PARAM_INT );
            $sqlquery->execute();
    
            $total = $sqlquery->rowCount();
    
            $limit = 5;
            $GLOBALS['total_pages'] = ceil($total / $limit);
    
            if(isset($_GET['page'])){
                $page = $_GET['page'];
                if($page !== ""){
                    $initial_page = ($page - 1) * $limit;
                }else if($page == ""){
                    $initial_page = (1 - 1) * $limit;
                }
            }else{
                $initial_page = (1 - 1) * $limit;
            }
    
            $sqlquery =$connection->prepare("SELECT * from `blogs` WHERE month(`blog_created_date`)=:month  and year(`blog_created_date`)=:year limit $initial_page , $limit");
            $sqlquery->bindValue("month", $month , PDO::PARAM_INT);
            $sqlquery->bindValue("year" , $year , PDO::PARAM_INT );
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
                                <article class="post">
                                    <div class="post_date">
                                        <span class="day"><?php echo $day; ?></span>
                                        <span class="month"><?php monthName($month); ?></span>
                                    </div>
                                    <figure class="post_img">
                                        <a>
                                            <img src="images/blog/blog_medium_1.png" alt="blog post">
                                        </a>
                                    </figure>
                                    <div class="post_content">
                                        <div class="post_meta">
                                            <h2>
                                                <a href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>"><?php echo $result['blog_title']; ?></a>
                                            </h2>
                                            <div class="metaInfo">
                                                <span><i class="fa fa-user"></i> By <a><?php echo $result['blog_posted_by'];?></a> </span>
            <?php
                $sqlquery = $connection->prepare("SELECT MAX(round(`parent_id`,0)) as `total` FROM `blog_comments` WHERE `blog_id`=:id ");
                $sqlquery->bindValue("id", $result['blog_id'], PDO::PARAM_INT);
                $sqlquery->execute();
                $results = $sqlquery;

                foreach($results as $res){
                    if($res['total'] != ""){
            ?>
    				<span><i class="fa fa-comments"></i> <a href="#"><?php echo $res['total']; ?> Comments</a></span>
            <?php
                    }
                }
            ?>
                                            </div>
                                        </div>
                                        <p><?php echo substr($result['blog_description'], 0, 200), "..."; ?></p>
                                        <a class="btn btn-small btn-default" href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>">Read More</a>
                                        
                                    </div>
                                </article>
                            <?php
                                    }
                                } 
                            ?>
            

<?php        
    function all_data($connection){
        $sqlquery = $connection->prepare("select * from `blogs`");
        $sqlquery->execute();

        $total = $sqlquery->rowCount();

		$limit = 5;
        $GLOBALS['total_pages'] = ceil($total / $limit);

        if(isset($_GET['page'])){
            $page = $_GET['page'];
            if($page !== ""){
                $initial_page = ($page - 1) * $limit;
            }else if($page == ""){
                $initial_page = (1 - 1) * $limit;
            }
        }else{
            $initial_page = (1 - 1) * $limit;
        }

		$sqlquery = $connection->prepare("select * from `blogs` limit :initial_page , :limit");
		$sqlquery->bindValue("initial_page", $initial_page , PDO::PARAM_INT);
		$sqlquery->bindValue("limit", $limit , PDO::PARAM_INT);
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
							<article class="post">
								<div class="post_date">
									<span class="day"><?php echo $day; ?></span>
									<span class="month"><?php monthName($month); ?></span>
								</div>
								<figure class="post_img">
									<a>

                                    <?php
                                        if($result['blog_img'] != ""){
                                    ?>

										<img src="images/blog/<?php echo $result['blog_img']; ?>" alt="blog post">

                                    <?php
                                        }else{
                                    ?>

										<img src="images/blog/blog_medium_1.png" alt="blog post">

                                    <?php
                                        }
                                    ?>

									</a>
								</figure>
								<div class="post_content">
									<div class="post_meta">
										<h2>
											<a href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>"><?php echo $result['blog_title']; ?></a>
										</h2>
										<div class="metaInfo">
											<span><i class="fa fa-user"></i> By <a><?php echo $result['blog_posted_by'];?></a> </span>
            <?php
                $sqlquery = $connection->prepare("SELECT MAX(round(`parent_id`,0)) as `total` FROM `blog_comments` WHERE `blog_id`=:id ");
                $sqlquery->bindValue("id", $result['blog_id'], PDO::PARAM_INT);
                $sqlquery->execute();
                $results = $sqlquery;

                foreach($results as $res){
                    if($res['total'] != ""){
            ?>
    				<span><i class="fa fa-comments"></i> <a href="#"><?php echo $res['total']; ?> Comments</a></span>
            <?php
                    }
                }
            ?>
                                            </div>
									</div>
									<p><?php echo substr($result['blog_description'], 0, 200), "..."; ?></p>
									<a class="btn btn-small btn-default" href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>">Read More</a>
								</div>
							</article>
                        <?php
                                }
                            } 
                        ?>

<?php
if(isset($connection)){

if(isset($_GET['category'])){

    $category = $_GET['category'];

    if($category != ""){
        category_data($connection);
    }else if($category == "all"){
        all_data($connection);
    }
}else if(isset($_GET['month']) && isset($_GET['year'])){
    $month = $_GET['month'];
    $year = $_GET['year'];
    if($month != "" && $year != ""){
        month_year($connection);
    }else{
        all_data($connection);
    }
}else if( !isset($_GET['category']) && !isset($_GET['month']) && !isset($_GET['year']) ){
    all_data($connection);
}

}
?>

	<?php
        function category_data($connection){
            $category = $_GET['category'];

        $sqlquery = $connection->prepare("select * from `blogs` where `blog_category`='$category' order by `blog_id` desc");
        $sqlquery->execute();

            $total = $sqlquery->rowCount();

            $limit = 5;
            $GLOBALS['total_pages'] = ceil($total / $limit);

            if(isset($_GET['page'])){
                $page = $_GET['page'];
                if($page !== ""){
                    $initial_page = ($page - 1) * $limit;
                }else if($page == "" && $page != 1){
                    $initial_page = (1 - 1) * $limit;
                }
            }else{
                $initial_page = (1 - 1) * $limit;
            }
            $category = $_GET['category'];

            $sqlquery = $connection->prepare("select * from `blogs` where `blog_category`=:category limit :initial_page , :limit");
            $sqlquery->bindValue("initial_page", $initial_page , PDO::PARAM_INT);
            $sqlquery->bindValue("limit", $limit , PDO::PARAM_INT);
            $sqlquery->bindValue("category", $category , PDO::PARAM_STR);
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
                                <article class="post">
                                    <div class="post_date">
                                        <span class="day"><?php echo $day; ?></span>
                                        <span class="month"><?php monthName($month); ?></span>
                                    </div>
								<figure class="post_img">
									<a>
										<img src="images/blog/blog_medium_1.png" alt="blog post">
									</a>
								</figure>
								<div class="post_content">
									<div class="post_meta">
										<h2>
											<a href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>"><?php echo $result['blog_title']; ?></a>
										</h2>
										<div class="metaInfo">
											<span><i class="fa fa-user"></i> By <a><?php echo $result['blog_posted_by'];?></a> </span>
            <?php
                $sqlquery = $connection->prepare("SELECT MAX(round(`parent_id`,0)) as `total` FROM `blog_comments` WHERE `blog_id`=:id ");
                $sqlquery->bindValue("id", $result['blog_id'], PDO::PARAM_INT);
                $sqlquery->execute();
                $results = $sqlquery;

                foreach($results as $res){
                    if($res['total'] != ""){
            ?>
    				<span><i class="fa fa-comments"></i> <a href="#"><?php echo $res['total']; ?> Comments</a></span>
            <?php
                    }
                }
            ?>
										</div>
									</div>
									<p><?php echo substr($result['blog_description'], 0, 200), "..."; ?></p>
									<a class="btn btn-small btn-default" href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>">Read More</a>
									
								</div>
							</article>
        <?php
                }
            } 
        ?>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12">
							<ul class="pagination pull-left mrgt-0">

<?php
if(isset($_GET['category'])){

    $category = $_GET['category'];

    if($category == "all"){
        $GLOBALS['total_pages'] = $GLOBALS['total_pages'];
    }else{
        $GLOBALS['total_pages'] = $GLOBALS['total_pages'];
    }
}else if( isset($_GET['month']) && isset($_GET['year']) ){

    $month = $_GET['month'];
    $year = $_GET['year'];

    if($month != "" && $year != ""){
        $GLOBALS['total_pages'] = $GLOBALS['total_pages'];
    }else{
        $GLOBALS['total_pages'] = $GLOBALS['total_pages'];
    }
}

?>
                    <?php
                    if(isset($_GET['category']) && isset($_GET['page'])  && isset($_GET['total_pages'])  ){
                            if(($_GET['page']) != 1 && ($_GET['page'] <= $GLOBALS['total_pages']) ){
                            $previous = ($_GET['page'] - 1); 
                    ?>

                    <li id="prev"><a href="blogs.php?category=<?php echo $_GET['category']; ?>&page=1" id="previous" >&laquo;</a></li>
                    <li id="prev"><a href="blogs.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $previous ?>" id="previous" >&#8249;</a></li>

                    <?php
                                }
                            }else if(isset($_GET['month']) && isset($_GET['year']) && isset($_GET['page'])  ){
                        if(($_GET['page']) != 1 && ($_GET['page'] <= $GLOBALS['total_pages']) ){
                        $previous = ($_GET['page'] - 1); 
                    ?>

                    <li id="prev"><a href="blogs.php?month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>&page=1" id="previous" >&laquo;</a></li>
                    <li id="prev"><a href="blogs.php?month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>&page=<?php echo $previous ?>" id="previous" >&#8249;</a></li>

                    <?php
                                }
                            }else{
                            if(isset($_GET['page'])){
                                if( ($_GET['page']) != "" && ($_GET['page']) != 1 && ($_GET['page'] <= $GLOBALS['total_pages'])){
                                $previous = ($_GET['page'] - 1); 
                    ?>

                    <li id="prev"><a href="blogs.php?page=1" id="previous" >&laquo;</a></li>
                    <li id="prev"><a href="blogs.php?page=<?php echo $previous; ?>" id="previous" >&#8249;</a></li>

                    <?php
                            }
                        }
                    }

?>
            <?php
            if(  isset($GLOBALS['total_pages'])  ){
                for($i= 1; $i<= $GLOBALS['total_pages']; $i++){
                    if($total_pages<=10){
                            if(isset($_GET['category'])){
                                if(isset($_GET['page'])){
                                    if($_GET['page'] <= $GLOBALS['total_pages']){
                            ?>
                    <li><a href="blogs.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                    }
                                }else{
                            ?>
                    <li><a href="blogs.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                }
                            }else                             if(isset($_GET['month']) && isset($_GET['year'])){
                                if(isset($_GET['page'])){
                                    if($_GET['page'] <= $GLOBALS['total_pages']){
                            ?>
                    <li><a href="blogs.php?month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                    }
                                }else{
                            ?>
                    <li><a href="blogs.php?month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                }
                            }else{
                                if(isset($_GET['page'])){
                                    if($_GET['page'] <= $GLOBALS['total_pages']){
                            ?>
                    <li><a href="blogs.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                                }
                            }else{
                    ?>
                    <li><a href="blogs.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
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

                    for($i= ($page - 5 ) ; $i< ( $page + 5 ) && $i<= $total_pages; $i++){
                            if( $total_pages>10 && $i>0 ){
                                    if(isset($_GET['category'])){
                                        if(isset($_GET['page'])){
                                            if($_GET['page'] <= $GLOBALS['total_pages']){
                                    ?>
                            <li><a href="blogs.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                            }
                                        }else{
                                    ?>
                            <li><a href="blogs.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                        }
                                    }else if(  isset($_GET['month']) && isset($_GET['year'])   ){
                                        if(isset($_GET['page'])){
                                            if($_GET['page'] <= $GLOBALS['total_pages']){
                                    ?>
                            <li><a href="blogs.php?month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                            }
                                        }else{
                                    ?>
                            <li><a href="blogs.php?month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>&page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                        }
                                    }else{
                                        if(isset($_GET['page'])){
                                            if($_GET['page'] <= $GLOBALS['total_pages']){
                                    ?>
                            <li><a href="blogs.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                        }
                                    }else{
                            ?>
                            <li><a href="blogs.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
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

    <li id="next"><a href="blogs.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $next; ?>" id="next">&#8250;</a></li>
    <li id="next"><a href="blogs.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $GLOBALS['total_pages']; ?>" id="next">&raquo;</a></li>

<?php
        }
    }else{
?>
        <li id="next"><a href="blogs.php?category=<?php echo $_GET['category']; ?>&page=2" id="next">&#8250;</a></li>
        <li id="next"><a href="blogs.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $GLOBALS['total_pages']; ?>" id="next">&raquo;</a></li>
<?php
    }
}else if(isset($_GET['month']) && isset($_GET['year'])){
    if(isset($_GET['page'])){
            if( ($_GET['page']) != "" &&  (($_GET['page']) != $GLOBALS['total_pages'])  &&  (($_GET['page']) < $GLOBALS['total_pages'])   ){
                $next = $_GET['page'] + 1 ;
?>

    <li id="next"><a href="blogs.php?month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>&page=<?php echo $next; ?>" id="next">&#8250;</a></li>
    <li id="next"><a href="blogs.php?month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>&page=<?php echo $GLOBALS['total_pages']; ?>" id="next">&raquo;</a></li>

<?php
        }
    }else{
?>
        <li id="next"><a href="blogs.php?month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>&page=2" id="next">&#8250;</a></li>
        <li id="next"><a href="blogs.php?month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>&page=<?php echo $GLOBALS['total_pages']; ?>" id="next">&raquo;</a></li>
<?php
    }
}

else{
    if(isset($_GET['page'])){
        if(  (($_GET['page']) != $GLOBALS['total_pages'])  &&  (($_GET['page']) < $GLOBALS['total_pages'])  ){
            $next = $_GET['page'] + 1;
?>
        <li id="next"><a href="blogs.php?page=<?php echo $next; ?>" id="next">&#8250;</a></li>
        <li id="next"><a href="blogs.php?page=<?php echo $GLOBALS['total_pages']; ?>" id="next">&raquo;</a></li>
<?php
        }
    }else{
?>
        <li id="next"><a href="blogs.php?page=2" id="next">&#8250;</a></li>
        <li id="next"><a href="blogs.php?page=<?php echo $GLOBALS['total_pages']; ?>" id="next">&raquo;</a></li>
<?php
    }
}
}
?>

							</ul>
						</div>
						
					</div>

        <script>

        var url = (new URL(window.location.href)).searchParams;
        var page = url.get('page');

        if(page != "")
        {
            var element = document.getElementById(page);
            var parent = $(element).parent();
            $(parent).addClass("active");
        }else{
            var element = document.getElementById("1");
            var parent = $(element).parent();
            $(parent).addClass("active");
        }

        if(!$(".pagination li").hasClass("active")){
            var element = document.getElementById("1");
            var parent = $(element).parent();
            $(parent).addClass("active");
        }
        </script>
					<!--Sidebar Widget-->
					<div class="col-xs-12 col-md-4 col-lg-4 col-sm-4">
						<div class="sidebar">
							<div class="widget widget_search">
								<div class="site-search-area">
                                    <div id="search">
                                        <input  type="text" class="input-text" name="search" id="searchsubmit" placeholder="Enter Search keywords..." />
                                        <img src="images/search-icon.png" />
                                    </div>
								</div><!-- end site search -->
							</div>
<script>
$(document).ready(function(){
 $('#searchsubmit').keyup(function(){
 
  var text = $(this).val().toLowerCase();
 
  $('.post').hide();

  $('.post .post_meta').each(function(){
 
        if($(this).text().toLowerCase().indexOf(""+text+"") != -1 ){
            $(this).closest('.post').show();
        }
    });
  });
});

</script>                            
							
							<div class="widget widget_categories">
								<div class="widget_title">
									<h4><span>Categories</span></h4>
									</div>
                        <ul class="arrows_list list_style">
    <?php
    if(isset($connection)){

        $sqlquery = $connection->prepare("SELECT `blog_category`, COUNT(`blog_id`)as total FROM `blogs` GROUP by `blog_category`");
        $sqlquery->execute();
        $results = $sqlquery;
        foreach($results as $result){
    ?>
                                    
            <li><a href="blogs.php?category=<?php echo $result['blog_category']; ?>"> <?php echo $result['blog_category']; ?> (<?php echo $result['total']; ?>)</a></li>
    <?php
        }
    }
    ?>
                </ul>
    				</div>
							
							<div class="widget widget_about">
								<div class="widget_title">
									<h4><span>Basic Text Widget</span></h4>
									</div>
								<p>Lorem ipsum dolor sit amet, consectetur adip, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							</div>

                        <div class="edge-tab sidebar-tab">
							<div class="widget widget_archives">
								<div class="widget_title">
									<h4><span>Archives</span></h4>
								</div>
								<ul class="archives_list list_style">
        <?php
        if(isset($connection)){
            $sqlquery = $connection->prepare("SELECT month(`blog_created_date`) as month, year(`blog_created_date`) as year FROM `blogs` GROUP by month(`blog_created_date`) , year(`blog_created_date`) ORDER by year(`blog_created_date`), month(`blog_created_date`)");
            $sqlquery->execute();
            $results = $sqlquery;

            foreach($results as $result){
                $month = $result['month'];
            ?>                                    
    								<li><a href="blogs.php?month=<?php monthName($month); ?>&year=<?php echo $result['year'];?>"> <?php monthName($month); ?> <?php echo $result['year'];?></a></li>
        <?php 
            }
        }
        ?>
								</ul>
							</div>

						</div>
					</div>
				</div><!--/.row-->
			</div> <!--/.container-->
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
