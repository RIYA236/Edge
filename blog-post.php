<?php include "header.php"; ?>
<?php include "connection.php"; ?>
<?php include "month.php"; ?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php
        if(isset($_GET['blog_id'])) {
            $id = $_GET['blog_id'];
            $sqlquery = $connection->prepare("select * from `blogs` where `blog_id` = :id ");
            $sqlquery->bindValue("id", $id, PDO::PARAM_INT);
            $sqlquery->execute();
            $results = $sqlquery;

            foreach($results as $result){
                // echo $result['blog_title'];
    ?>

    <title><?php echo $result['blog_title']; ?></title>

    <?php
                }
            }
    ?>    
    <meta name="description" content="">

    <!-- CSS FILES -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" data-name="skins">
    <link rel="stylesheet" href="css/layout/wide.css" data-name="layout">

    <link rel="stylesheet" type="text/css" href="css/switcher.css" media="screen" />
    <script src="js/jquery.min.js"></script>
</head>

<body>

    <!--start wrapper-->
    <section class="wrapper">
        <section class="page_head">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <nav id="breadcrumbs">
                            <ul>

                                <li><a href="index.php">Home</a></li>
                                <li><a href="blogs.php">Blogs</a></li>
                                <li>Blog Post</li>
                            </ul>
                        </nav>

                        <div class="page_title">
                            <h2>blog post</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content blog">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="blog_single">
                            <?php
                            if (isset($_GET['blog_id'])) {
                                $blog_id = $_GET['blog_id'];

                                $sqlquery = $connection->prepare("select * from `blogs` where `blog_id`=:blog_id ");
                                $sqlquery->bindValue("blog_id", $blog_id, PDO::PARAM_STR);
                                $sqlquery->execute();

                                $results = $sqlquery;

                                foreach ($results as $result) {
                                    $blog_date = $result['blog_created_date'];
                                    $date = (explode(" ", $blog_date));
                                    $date = (explode("-", $date[0]));

                                    $day = $date[2];
                                    $month = $date[1];
                                    $year = $date[0];
                                }
                            ?>
                                <article class="post">
                                    <figure class="post_img">
                                        <a href="#">
                                            <img src="images/blog/blog_1.png" alt="blog post">
                                        </a>
                                    </figure>
                                    <div class="post_date">
                                        <span class="day"><?php echo $day; ?></span>
                                        <span class="month"><?php monthName($month); ?></span>
                                    </div>
                                    <div class="post_content">
                                        <div class="post_meta">
                                            <h2>
                                                <a href="blog-post.php?blog_id=<?php echo $result['blog_id']; ?>"><?php echo $result['blog_title']; ?></a>
                                            </h2>
                                            <div class="metaInfo">
                                                <span><i class="fa fa-calendar"></i> <a><?php echo monthName($month)  .  " "  .  $day  . ", " . $year; ?></a> </span>
                                                <span><i class="fa fa-user"></i> By <a href="#"><?php echo $result['blog_posted_by']; ?></a> </span>
                                                <span><i class="fa fa-tag"></i> <a href="#"><?php echo $result['blog_category']; ?></a></span>
                                                <span><i class="fa fa-comments"></i> <a href="#">12 Comments</a></span>
                                            </div>
                                        </div>
                                        <span id="blogDescription"><?php echo $result['blog_description']; ?></span>
                                    </div>

                                </article>

                            <?php
                            }
                            ?>
                            
                        </div>

                        <!--News Comments-->
                        <div class="news_comments" id="comments">
                            <div class="dividerHeading">

            <?php
                $sqlquery = $connection->prepare("SELECT MAX(round(`parent_id`,0)) as `total` FROM `blog_comments` WHERE `blog_id`=:id ");
                $sqlquery->bindValue("id", $result['blog_id'], PDO::PARAM_INT);
                $sqlquery->execute();
                $results = $sqlquery;

                foreach($results as $res){
                    if($res['total'] != ""){
            ?>

                <h4><span>Comments (<?php echo $res['total']; ?>)</span></h4>

            <?php
                    }else{
            ?>

                <h4><span>Comments (0)</span></h4>

            <?php
                    }
                }
            ?>

                            </div>
                            <div id="comment">
                                <ul id="comment-list">
<?php

    if( isset($_GET['blog_id']) && $_GET['blog_id'] != "" ){
        $id = $_GET['blog_id'];

    $sqlquery = $connection->prepare("select * from `blog_comments` where `blog_id`=:id GROUP by round(`parent_id`) order by `parent_id` ");
    $sqlquery->bindValue( "id", $id , PDO::PARAM_INT );
    $sqlquery->execute();

    $results = $sqlquery;
    foreach($results as $result){
        $float = ($result['parent_id']);
?>
        <li class="comment">
            <div class="avatar"><img alt="" src="images/blog/avatar_1.png" class="avatar"></div>
            <div class="comment-container" id="comment-container-<?php echo $result['parent_id']; ?>">
                <h4 class="comment-author"><a href="#"><?php echo $result['comment_name']; ?></a></span></h4>
                <div class="comment-meta"><a href="#" class="comment-date"><?php echo $result['comment_date']; ?></a><a class="comment-reply-link" id="reply-<?php echo $result['parent_id']; ?>">Reply &raquo;</a></div>

                <div class="comment-body">
                    <p><?php echo $result['comment_message']; ?></p>
                </div>
                
            </div>
        </li>
        <div class="comment_box" id="comment-box-<?php echo $result['parent_id']; ?>"></div>

<?php
$sqlquery = $connection->prepare("select * from `blog_comments` where `blog_id`=:id and `parent_id` like '$float.%' order by `parent_id`");
$sqlquery->bindValue( "id", $id , PDO::PARAM_INT );
$sqlquery->execute();
$results = $sqlquery;
foreach($results as $result){
    $float = round($result['parent_id']);
?>
            <ul class="children">
                <li class="comment">
                    <div class="avatar"><img alt="" src="images/blog/avatar_3.png" class="avatar"></div>
                    <div class="comment-container" id="comment-container-<?php echo $float;?>">
                        <h4 class="comment-author"><a href="#"><?php echo $result['comment_name']; ?></a></span></h4>
                        <div class="comment-meta"><a href="#" class="comment-date"><?php echo $result['comment_date']; ?></a></div>
                        <div class="comment-body">
                            <p><?php echo $result['comment_message']; ?></p>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="comment_box" id="comment-box-<?php echo $result['parent_id']; ?>"></div>
<?php
    }
?>
<?php
    }
}

?>

<script type="text/javascript">
function js_function() {
    return ("<div class='dividerHeading'><h4><span>Leave a comment</span></h4></div><form method='POST' name='commentInsert'><div class='comment_form'><div class='row'><div class='col-sm-4'><input class='col-lg-4 col-md-4 form-control' name='cm_name' type='text' id='comments_name' size='30' placeholder='Name'/></div><div class='col-sm-4'><input class='col-lg-4 col-md-4 form-control' name='email' type='text' id='comments_email' size='30' placeholder='E-mail'/></div><div class='col-sm-4'><input class='col-lg-4 col-md-4 form-control' name='url' type='text' id='comments_url' size='30' placeholder='Url'/></div></div></div><div class='comment-box row'><div class='col-sm-12'><p><textarea name='comments' class='form-control' rows='6' cols='40' id='comments_comments' placeholder='Message'></textarea></p></div></div><div onclick='data();' name='comment' class='child_comment'>Submit</div></form><br>");
}
function close_comment(){
    var comment = document.getElementsByClassName("comment_box");
    $(comment).html("");
}

var reply = document.getElementsByClassName("comment-reply-link");

$(reply).click(function() {

    var id = $(this).attr("id"); // output = reply-1

    console.log(id);
    send_id = id.split("-")[1]; // output = [0]= reply , [1]= 1 or 2 or ...

    close_comment();

    var comment = document.getElementById("comment-box-" + send_id);
    $(comment).html(js_function());
});

function data(){

    var url = (new URL(window.location.href)).searchParams;
    var blog_id = url.get("blog_id");
    console.log("blog_id");
    console.log(blog_id);

    console.log("send id");
    send_id = send_id + ".1";
    console.log(send_id);

    var name = document.getElementById("comments_name").value;
    var email = document.getElementById("comments_email").value;
    var url = document.getElementById("comments_url").value;
    var message = document.getElementById("comments_comments").value;

        var data = { 'parent_id':send_id, 'name' : name, 'email' : email, 'url' : url, 'message' : message, 'blog_id' : blog_id }
        comment_data = JSON.stringify(data);
        console.log(comment_data);

        var data_insert = fetch('insertData.php', {
            method : 'POST',
            body : comment_data,
            headers : {
                'Content-type' : 'application/json',
            }
        });
        // data_insert.then( (response) => response.json() )
        data_insert.then( (result) => {
            console.log("success");
            console.log(result);
            location.reload();
        })
        data_insert.catch( (error) => {
            console.log("error");
        });
}

</script>

                                </ul>
                            </div>
                            <!-- /#comments -->
            <form method="POST">

                            <div class="dividerHeading">
                                <h4><span>Leave a comment</span></h4>
                            </div>

                            <div class="comment_form">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input class="col-lg-4 col-md-4 form-control" name="c_name" type="text" id="name" size="30" placeholder="Name">
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="col-lg-4 col-md-4 form-control" name="c_email" type="text" id="email" size="30" placeholder="E-mail">
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="col-lg-4 col-md-4 form-control" name="c_url" type="text" id="url" size="30" placeholder="Url">
                                    </div>
                                </div>
                            </div>
                            <div class="comment-box row">
                                <div class="col-sm-12">
                                    <p>
                                        <textarea name="c_comments" class="form-control" rows="6" cols="40" id="comments" placeholder="Message"></textarea>
                                    </p>
                                </div>
                            </div>

                        <input type="submit" name="new_commentAdd" class="submit_comment" value="POST COMMENT"/>
                </form>
                        </div>
                    </div>


                    <?php

if(isset($_POST['new_commentAdd'])){

    $name = $_POST['c_name'];
    $email = $_POST['c_email'];
    $url = $_POST['c_url'];
    $new_comment = $_POST['c_comments'];

    if(isset($_GET['blog_id'])){
        if( $_GET['blog_id'] != "" ){
            $blog_id = $_GET['blog_id'];
        }
    }

    $sqlquery = $connection->prepare("SELECT round(MAX(`parent_id`)) as parentId FROM `blog_comments` where `blog_id`=:id");
    $sqlquery->bindValue("id" , $blog_id , PDO::PARAM_INT);
    $sqlquery->execute();
    $results = $sqlquery;

    foreach($results as $result){
        if($result['parentId'] ==  "0"){
            $p_id = "1";
        }else{
            $p_id = $result['parentId'];
        }
        $p_id = $p_id + 1;
        echo $p_id;
    }

    $sqlquery = $connection->prepare("Insert into `blog_comments` ( `blog_id` , `parent_id` , `comment_name` , `comment_email` , `comment_url` , `comment_message` ) values( :id, :parent_id, :name, :email, :url, :message ) ");

    $sqlquery->bindValue("id" , $blog_id , PDO::PARAM_INT);
    $sqlquery->bindValue("parent_id", $p_id , PDO::PARAM_INT);
    $sqlquery->bindValue("name" , $name , PDO::PARAM_STR);
    $sqlquery->bindValue("email" , $email , PDO::PARAM_STR);
    $sqlquery->bindValue("url" , $url , PDO::PARAM_STR);
    $sqlquery->bindValue("message" , $new_comment , PDO::PARAM_STR);
    $sqlquery->execute();
}
?>
                    <!--Sidebar Widget-->
                    <div class="col-xs-12 col-md-4 col-lg-4 col-sm-4">

                            <div class="widget widget_categories">
                                <div class="widget_title">
                                    <h4><span>Categories</span></h4>
                                </div>
                                <ul class="arrows_list list_style">
                                    <?php
                                        $sqlquery = $connection->prepare("SELECT `blog_category`, COUNT(`blog_id`)as total FROM `blogs` GROUP by `blog_category`");
                                        $sqlquery->execute();
                                        $results = $sqlquery;
                                        foreach ($results as $result) {
                                    ?>
                                        <li><a href="blogs.php?category=<?php echo $result['blog_category']; ?>"> <?php echo $result['blog_category']; ?> (<?php echo $result['total']; ?>)</a></li>
                                    <?php
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
                                <ul class="archives_list list_style ">
                                    <?php
                                    $sqlquery = $connection->prepare("SELECT month(`blog_created_date`) as month, year(`blog_created_date`) as year FROM `blogs` GROUP by month(`blog_created_date`) , year(`blog_created_date`) ORDER by year(`blog_created_date`), month(`blog_created_date`)");
                                    $sqlquery->execute();
                                    $results = $sqlquery;

                                    foreach ($results as $result) {
                                        $month = $result['month'];
                                    ?>
                                        <li><a href="blogs.php?month=<?php monthName($month); ?>&year=<?php echo $result['year']; ?>"> <?php monthName($month); ?> <?php echo $result['year']; ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.row-->
            </div>
            <!--/.container-->
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