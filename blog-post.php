<?php include "header.php"; ?>
<?php include "connection.php"; ?>
<?php include "month.php"; ?>

<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" class="no-js" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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

                                    <!-- <ul class="shares">
                                        <li class="shareslabel">
                                            <h3>Share This Story</h3>
                                        </li>
                                        <li><a class="twitter" href="#" data-placement="bottom" data-toggle="tooltip" title="Twitter"></a></li>
                                        <li><a class="facebook" href="#" data-placement="bottom" data-toggle="tooltip" title="Facebook"></a></li>
                                        <li><a class="gplus" href="#" data-placement="bottom" data-toggle="tooltip" title="Google Plus"></a></li>
                                        <li><a class="pinterest" href="#" data-placement="bottom" data-toggle="tooltip" title="Pinterest"></a></li>
                                        <li><a class="yahoo" href="#" data-placement="bottom" data-toggle="tooltip" title="Yahoo"></a></li>
                                        <li><a class="linkedin" href="#" data-placement="bottom" data-toggle="tooltip" title="LinkedIn"></a></li>
                                    </ul> -->
                                </article>

                            <?php
                            }
                            ?>

                            <!-- <div class="about_author">
                                <div class="author_desc">
                                    <img src="images/blog/author.png" alt="about author">
                                    <ul class="author_social">
                                        <li><a class="fb" href="#." data-placement="top" data-toggle="tooltip" title="Facbook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="twtr" href="#." data-placement="top" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="skype" href="#." data-placement="top" data-toggle="tooltip" title="Skype"><i class="fa fa-skype"></i></a></li>
                                    </ul>
                                </div>
                                <div class="author_bio">
                                    <h3 class="author_name"><a href="#">Tom Jobs</a></h3>
                                    <h5>CEO at <a href="#">Yahoo Baba</a></h5>
                                    <p class="author_det">
                                        Lorem ipsum dolor sit amet, consectetur adip, sed do eiusmod tempor incididunt ut aut reiciendise voluptat maiores alias consequaturs aut perferendis doloribus omnis saperet docendi nec, eos ea alii molestiae aliquand.
                                    </p>
                                </div>
                            </div> -->
                            
                        </div>

                        <!--News Comments-->
                        <div class="news_comments">
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
    // echo $result['parent_id'];
    $float = round($result['parent_id']);
?>
            <ul class="children">
                <li class="comment">
                    <div class="avatar"><img alt="" src="images/blog/avatar_3.png" class="avatar"></div>
                    <div class="comment-container" id="comment-container-<?php echo $float;?>">
                        <h4 class="comment-author"><a href="#"><?php echo $result['comment_name']; ?></a></span></h4>
                        <div class="comment-meta"><a href="#" class="comment-date"><?php echo $result['comment_date']; ?></a></div>
                        <!-- <div class="comment-meta"><a href="#" class="comment-date"><?php echo $result['comment_date']; ?></a><a class="comment-reply-link" id="reply-<?php echo $result['parent_id']; ?>">Reply &raquo;</a></div> -->
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
    for($i=1 ; $i<=5 ;$i++){
// echo <<<STR
//     <li class="comment">
//     <div class="avatar"><img alt="" src="images/blog/avatar_1.png" class="avatar"></div>
//     <div class="comment-container">
//         <h4 class="comment-author"><a href="#">John Smith</a></span></h4>
//         <div class="comment-meta"><a href="#" class="comment-date">February 22, 2015</a><a class="comment-reply-link" id="reply-$i">Reply &raquo;</a></div>
//         <div class="comment-body">
//             <p>Ne omnis saperet docendi nec, eos ea alii molestiae aliquand. Latine fuisset mele, mandamus atrioque eu mea, wi forensib argumentum vim an. Te viderer conceptam sed, mea et delenit fabellas probat.</p>
//         </div>
//     </div>
//     </li>
//     <div class="comment_box" id="comment-box-$i"></div>
// STR;
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

// var reply = document.getElementsByClassName("comment-reply-link");

// $(reply).click(function() {

//     var id = $(this).attr("id"); // output = reply-1
//     console.log(id);
//     id = id.split("-")[1]; // output = [0]= reply , [1]= 1 or 2 or ...

//     close_comment();

//     var comment = document.getElementById("comment-box-"+id);
//     $(comment).html(js_function());
// });

</script>

                                    <!-- <li class="comment">
                                        <div class="avatar"><img alt="" src="images/blog/avatar_1.png" class="avatar"></div>
                                        <div class="comment-container">
                                            <h4 class="comment-author"><a href="#">John Smith</a></span></h4>
                                            <div class="comment-meta"><a href="#" class="comment-date">February 22, 2015</a><a class="comment-reply-link" id="reply">Reply &raquo;</a></div>
                                            <div class="comment-body">
                                                <p>Ne omnis saperet docendi nec, eos ea alii molestiae aliquand. Latine fuisset mele, mandamus atrioque eu mea, wi forensib argumentum vim an. Te viderer conceptam sed, mea et delenit fabellas probat.</p>
                                            </div>
                                        </div>
                                        <div class="comment_box"></div>
                                    </li>


                                    <li class="comment">
                                        <div class="avatar"><img alt="" src="images/blog/avatar_2.png" class="avatar"></div>
                                        <div class="comment-container">
                                            <h4 class="comment-author"><a href="#">Eva Smith</a></span></h4>
                                            <div class="comment-meta"><a href="#" class="comment-date">February 13, 2015</a><a class="comment-reply-link" id="reply">Reply &raquo;</a></div>
                                            <div class="comment-body">
                                                <p>Vidit nulla errem ea mea. Dolore apeirian insolens mea ut, indoctum consequuntur hasi. No aeque dictas dissenti as tusu, sumo quodsi fuisset mea in. Ea nobis populo interesset cum, ne sit quis elit officiis, min im tempor iracundia sit anet. Facer falli aliquam nec te. In eirmod utamur offendit vis, posidonium instructior sed te.</p>
                                            </div>
                                        </div>
                                        <div class="comment_box"></div>

                                        <ul class="children">
                                            <li class="comment">
                                                <div class="avatar"><img alt="" src="images/blog/avatar_3.png" class="avatar"></div>
                                                <div class="comment-container">
                                                    <h4 class="comment-author"><a href="#">Thomas Smith</a></span></h4>
                                                    <div class="comment-meta"><a href="#" class="comment-date">February 14, 2015</a><a class="comment-reply-link">Reply &raquo;</a></div>
                                                    <div class="comment-body">
                                                        <p>Labores pertinax theophrastus vim an. Error ditas in sea, per no omnis iisque nonumes. Est an dicam option, ad quis iriure saperet nec, ignota causae inciderint ex vix. Iisque qualisque imp duo eu, pro reque consequ untur. No vero laudem legere pri, error denique vis ne, duo iusto bonorum.</p>
                                                    </div>
                                                </div>
                                                <ul class="children">
                                                    <li class="comment">
                                                        <div class="avatar"><img alt="" src="images/blog/avatar_2.png" class="avatar"></div>
                                                        <div class="comment-container">
                                                            <h4 class="comment-author"><a href="#">Eva Smith</a></span></h4>
                                                            <div class="comment-meta"><a href="#" class="comment-date">February 14, 2015</a><a class="comment-reply-link">Reply &raquo;</a></div>
                                                            <div class="comment-body">
                                                                <p>Dico animal vis cu, sed no aliquam appellantur, et exerci eleifend eos. Vixese eros tiloi novum adtam, mazim inimicus maiestatis ad vim. Ex his unum fuisset reformidans, has iriure ornatus atomorum ut, ad tation feugiat impedit per.</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <div class="comment_box"></div>

                                    <li class="comment">
                                        <div class="avatar"><img alt="" src="images/blog/avatar_1.png" class="avatar"></div>
                                        <div class="comment-container">
                                            <h4 class="comment-author"><a href="#">John Smith</a></span></h4>
                                            <div class="comment-meta"><a href="#" class="comment-date">February 07, 2015</a><a class="comment-reply-link" id="reply">Reply &raquo;</a></div>
                                            <div class="comment-body">
                                                <p>Eu mea harum soleat albucius. At duo nihil saperet inimicus. Ne quo dicit offendit eloquenam. Ut intellegam inn theophras tus mea. Vide ceteros mediocritatem est in, utamur gubergren contentiones.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <div class="comment_box"></div> -->

<!-- <li class="comment">
    <div class="avatar"><img alt="" src="images/blog/avatar_3.png" class="avatar"></div>
    <div class="comment-container">
        <h4 class="comment-author"><a href="#">Thomas Smith</a></span></h4>
        <div class="comment-meta"><a href="#" class="comment-date">February 02, 2015</a><a class="comment-reply-link" id="reply">Reply &raquo;</a></div>
        <div class="comment-body">
            <p>Quodsi eirmod salutandi usu ei, ei mazim facete mel. Deleniti interesset at sed, sea ei malis expetenda. Ei efficiat integebat mel, vis alii insoles te. Vis ex bonorum contentiones. An cum possit reformidans. Est at eripuit theophrastus. Scripta imper diet ad nec, everti contentiones id eam, an eum causae officiis.</p>
        </div>
    </div>
    <div class="comment_box"></div>

</li>
 -->

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

                            <!-- <a class="btn btn-lg btn-default" href="#">Post Comment</a> -->
                        <!-- <input type="submit" name="new_commentAdd" class="btn btn-lg btn-default" value="POST COMMENT"/> -->
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
                        <!-- <div class="sidebar">
                            <div class="widget widget_search">
                                <div class="site-search-area">
                                    <form method="get" id="site-searchform" action="#">
                                        <div>
                                            <input class="input-text" name="s" id="s" placeholder="Enter Search keywords..." type="text" />
                                            <input id="searchsubmit" value="Search" type="submit" />
                                        </div>
                                    </form>
                                </div> end site search
                            </div> -->

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
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#Popular" data-toggle="tab">Popular</a></li>
                                    <li class=""><a href="#Recent" data-toggle="tab">Recent</a></li>
                                    <li class="last-tab"><a href="#Comment" data-toggle="tab"><i class="fa fa-comments-o"></i></a></li>
                                </ul>

                                <div class="tab-content clearfix">
                                    <div class="tab-pane fade active in" id="Popular">
                                        <ul class="recent_tab_list">
                                            <li>
                                                <span><a href="#"><img src="images/content/recent_1.png" alt="" /></a></span>
                                                <a href="#">Publishing packag esanse web page editos</a>
                                                <i>October 09, 2015</i>
                                            </li>
                                            <li>
                                                <span><a href="#"><img src="images/content/recent_2.png" alt="" /></a></span>
                                                <a href="#">Sublishing packag esanse web page editos</a>
                                                <i>October 08, 2015</i>
                                            </li>
                                            <li class="last-tab">
                                                <span><a href="#"><img src="images/content/recent_3.png" alt="" /></a></span>
                                                <a href="#">Mublishing packag esanse web page editos</a>
                                                <i>October 07, 2015</i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="Recent">
                                        <ul class="recent_tab_list">
                                            <li>
                                                <span><a href="#"><img src="images/content/recent_4.png" alt="" /></a></span>
                                                <a href="#">Various versions has evolved over the years</a>
                                                <i>October 18, 2015</i>
                                            </li>
                                            <li>
                                                <span><a href="#"><img src="images/content/recent_5.png" alt="" /></a></span>
                                                <a href="#">Rarious versions has evolve over the years</a>
                                                <i>October 17, 2015</i>
                                            </li>
                                            <li class="last-tab">
                                                <span><a href="#"><img src="images/content/recent_6.png" alt="" /></a></span>
                                                <a href="#">Marious versions has evolven over the years</a>
                                                <i>October 16, 2015</i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade">
                                        <ul class="comments">
                                            <li class="comments_list clearfix">
                                                <a class="post-thumbnail" href="#"><img width="60" height="60" src="images/content/recent_3.png" alt="#"></a>
                                                <p><strong><a href="#">Prambose</a> <i>says: </i> </strong> Morbi augue velit, tempus mattis dignissim nec, porta sed risus. Donec eget magna eu lorem tristique pellentesque eget eu dui. Fusce lacinia tempor malesuada.</p>
                                            </li>
                                            <li class="comments_list clearfix">
                                                <a class="post-thumbnail" href="#"><img width="60" height="60" src="images/content/recent_1.png" alt="#"></a>
                                                <p><strong><a href="#">Makaroni</a> <i>says: </i> </strong> Tempus mattis dignissim nec, porta sed risus. Donec eget magna eu lorem tristique pellentesque eget eu dui. Fusce lacinia tempor malesuada.</p>
                                            </li>
                                            <li class="comments_list clearfix">
                                                <a class="post-thumbnail" href="#"><img width="60" height="60" src="images/content/recent_2.png" alt="#"></a>
                                                <p><strong><a href="#">Prambanan</a> <i>says: </i> </strong> Donec convallis, metus nec tempus aliquet, nunc metus adipiscing leo, a lobortis nisi dui ut odio. Nullam ultrices, eros accumsan vulputate faucibus, turpis tortor.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget_tags">
                                <div class="widget_title">
                                    <h4><span>Tags Widget</span></h4>
                                </div>
                                <ul class="tags">
                                    <li><a href="#"><b>business</b></a></li>
                                    <li><a href="#">corporate</a></li>
                                    <li><a href="#">css3</a></li>
                                    <li><a href="#"><b>html5</b></a></li>
                                    <li><a href="#">javascript</a></li>
                                    <li><a href="#"><b>jquery</b></a></li>
                                    <li><a href="#">multipurpose</a></li>
                                    <li><a href="#"><b>mysql</b></a></li>
                                    <li><a href="#">portfolio</a></li>
                                    <li><a href="#">premium</a></li>
                                    <li><a href="#">responsive</a></li>
                                    <li><a href="#"><b>theme</b></a></li>
                                    <li><a href="#"><b>Yahoo Baba</b></a></li>
                                </ul>
                            </div>

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
                            <li><i class="fa fa-map-marker"></i>
                                <p><strong>Address</strong>: #2021 Lorem Ipsum</p>
                            </li>
                            <li><i class="fa fa-user"></i>
                                <p><strong>Phone</strong>:(+91) 9000-12345</p>
                            </li>
                            <li><i class="fa fa-envelope"></i>
                                <p><strong>Email</strong>: <a href="#">mail@example.com</a></p>
                            </li>
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
                    <p class="copyright">&copy; Copyright 2020 Edge | Powered by <a href="https://www.yahoobaba.net/">Yahoo Baba</a></p>
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
    <!-- <script type="text/javascript" src="js/styleswitch.js"></script> Style Colors Switcher -->
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
    <!-- <div class="switcher"></div> -->
    <!-- End Style Switcher -->
</body>

</html>