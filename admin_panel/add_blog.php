<?php
include "../connection.php";
include "navbar.php";

$user = $_SESSION['uname'];

if(isset($_POST['submit'])){
  $e_name = $_POST['blog_title'];
  $e_designation = $_POST['blog_category'];
  $e_info = $_POST['blog_description'];
  $message = "";

  $random= rand( 100000 , 999999 );
  $filename = $_FILES["blog_image"]["name"];
  $move_img = $_FILES["blog_image"]["tmp_name"];
  $filename = $random.$filename;
  $folder_name = "../images/blog/".$filename;

  if(move_uploaded_file($move_img , $folder_name)){
    // echo "success";
  }else{
    // echo "fail";
  }

  if( $e_name && $e_designation && $e_info != "" ){

    // for($i=1; $i<=1000; $i++){
      // $sqlquery = $connection->prepare("");
      // $sqlquery->execute();
      
      $sqlquery = $connection->prepare("Insert into `blogs` (`blog_img`, `blog_title`, `blog_posted_by` , `blog_category`, `blog_description`) values(:blog_img, :blog_title, :name , :category, :blog_description )");
      $sqlquery->bindValue("blog_title" , $e_name , PDO::PARAM_STR );
      $sqlquery->bindValue("category" , $e_designation , PDO::PARAM_STR );
      $sqlquery->bindValue("blog_description", $e_info, PDO::PARAM_STR);
      $sqlquery->bindValue("blog_img", $filename , PDO::PARAM_STR);
      $sqlquery->bindValue("name", $user , PDO::PARAM_STR);
      $sqlquery->execute();
    // }

  }else{
    $message = "Please fill the details";
  }

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type = "text/javascript" src = "../js/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/admin-style.css" />
</head>
<body>

<?php

if(isset($_POST['update'])){

  $page = $_GET['page'];
  $id = $_GET['blog_id'];
  $e_name = $_POST['blog_title'];
  $e_designation = $_POST['blog_category'];
  $e_info = $_POST['blog_description'];
  $message = "";

  $random = rand(100000 , 999999);
  $filename = $_FILES["blog_image"]["name"];
  $filename = $random.$filename;
  $move_img = $_FILES["blog_image"]["tmp_name"];
  $folder_name = "../images/blog/". $filename;

  if(move_uploaded_file($move_img , $folder_name)){
    $sqlquery = $connection->prepare("update `blogs` set `blog_img`=:blog_img where `blog_id`=:id");
    $sqlquery->bindValue("blog_img", $filename , PDO::PARAM_STR);
    $sqlquery->bindValue("id", $id , PDO::PARAM_INT);
    $sqlquery->execute();
  }

  if($e_name && $e_designation && $e_info != ""){
    $sqlquery = $connection->prepare("update `blogs` set `blog_title`=:name , `blog_category`=:designation , `blog_description`=:info where `blog_id`=:id");
    $sqlquery->bindValue("name" , $e_name , PDO::PARAM_STR);
    $sqlquery->bindValue("designation", $e_designation , PDO::PARAM_STR);
    $sqlquery->bindValue("info", $e_info , PDO::PARAM_STR);
    $sqlquery->bindValue("id", $id , PDO::PARAM_INT);
    $sqlquery->execute();

    header("location:add_blog.php?page=$page");
  }else{
    $message = "Please fill details";
  }

}

if( isset($_GET['name'])  &&  isset($_GET['blog_id'])){
  $name = $_GET['name'];
    if($name == "blog"){
      $id = $_GET['blog_id'];

      $sqlquery = $connection->prepare("select * from `blogs` where `blog_id`=:id");
      $sqlquery->bindValue("id", $id , PDO::PARAM_INT);

      $sqlquery->execute();
      $results = $sqlquery;
      foreach($results as $result){

?>

<h3 class="blog_heading">blog</h3>

<div class="admin_form">
    <form method="POST" enctype="multipart/form-data">

    <div class="container">
        <span>Blog Title<span class="required">*</span></span><br>
        <input type="text" placeholder="Enter name" name="blog_title" value="<?php echo $result['blog_title']; ?>"><br>

        <span>Blog Image</span><br>
        <input type="file" name="blog_image"><br><br>

        <span>Blog Category<span class="required">*</span></span><br>
        <input type="text" placeholder="Enter company name" name="blog_category" value="<?php echo $result['blog_category']; ?>"><br>

        <span>Blog Description<span class="required">*</span></span><br>
        <textarea placeholder="blog review" name="blog_description"><?php echo $result['blog_description']; ?></textarea><br>

        <div class="form_field_button">
          <div>
            <button type="submit" name="update">Update Blog</button>
          </div>
          <div>
<?php
if(isset($_GET['page']))
{
  if( $_GET['page'] == "" ){
    $page = 1;
  }
  else{
    $page = $_GET['page'];
  }
}else{
  $page = 1;
}
?>
          
            <a href="add_blog.php?page=<?php echo $page; ?>" class="cancel_btn">Cancel</a>
          </div>
        </div>

        <p class="error"><?php if(isset($_POST['submit'])){ echo $message; } ?></p>

    </div>

    </form>
</div>

<?php
      }
    }
  }else{

?>

<h3 class="blog_heading">Blog</h3>

<div class="admin_form">
    <form method="POST" enctype="multipart/form-data">

    <div class="container">
        <span>Blog Title<span class="required">*</span></span><br>
        <input type="text" placeholder="Enter blog title" name="blog_title"><br>

        <span>Blog Image</span><br><br>
        <input type="file" placeholder="Enter blog image" name="blog_image"><br><br>

        <span>Blog Category<span class="required">*</span></span><br>
        <input type="text" placeholder="Enter blog category" name="blog_category"><br>

        <span>Blog Description<span class="required">*</span></span><br>
        <textarea placeholder="Enter blog description" name="blog_description"></textarea><br>

        <button type="submit" name="submit">Add Blog</button>
        <p class="error"><?php if(isset($_POST['submit'])){ echo $message; } ?></p>

    </div>

    </form>
</div>


<?php } ?>

<br>
<h3 class="blog_heading">All blog</h3>

<table class="db_table">
  <tr>
    <th>Blog Image</th>
    <th>Blog Title</th>
    <th>Blog Author</th>
    <th>Blog Category</th>
    <th>Blog Description</th>
    <th colspan="2">Edit / Delete</th>
  </tr>

<?php

  $sqlquery = $connection->prepare("select * from `blogs` order by `blog_id` desc");
  $sqlquery->execute();
  $total = $sqlquery->rowCount();
  $limit = 50;

  $total_pages = ceil($total / $limit);

if(isset($_GET['page']))
{
  $page = $_GET['page'];
  if($page == ""  ){
    $initial_page = ( 1 - 1 ) * $limit;
  }
  else if($page <= $total_pages){
    $initial_page = ( $page - 1 ) * $limit;
  }else{
    $initial_page = ( 1 - 1 ) * $limit;
  }
}else{
  $initial_page = (1-1) * $limit;
}

if(isset($_GET['page'])){
  if( $_GET['page'] == "" ){
    $page = 1;
  }else if( $_GET['page'] <= $total_pages ){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }  
}else{
  $page = 1;
}

  $sqlquery = $connection->prepare("select * from `blogs` order by `blog_id` desc limit $initial_page , $limit");
  $sqlquery->execute();
  $results = $sqlquery;
  foreach($results as $result){

?>

  <tr>
    <td><img src="../images/blog/<?php echo $result['blog_img']; ?>" class="db_img"/></td>
    <td><?php echo $result['blog_title']; ?></td>
    <td><?php echo $result['blog_posted_by']; ?></td>
    <td><?php echo $result['blog_category']; ?></td>
    <td><?php echo $result['blog_description']; ?></td>
    <td><a href="add_blog.php?page=<?php echo $page;?>&name=blog&blog_id=<?php echo $result['blog_id'];?>">Edit</a></td>
    <td><a href="delete.php?name=blog&delete=<?php echo $result['blog_id'];?>">Delete</a></td>
  </tr>

<?php 
  }
?>

</table>

                  <div class="pagination_center">
                    <ul class="pagination">
                      <li id="prev"><a href="add_blog.php?page=1" id="previous" >&laquo;</a></li>
                      <li id="prev"><a href="add_blog.php?page=<?php if($page != 1){ echo $page - 1; }else{ echo $page;}?>" id="previous" >&#8249;</a></li>
                        <?php
                            if(  isset($total_pages)  ){
                                for($i= 1; $i<= $total_pages; $i++){
                                  if($total_pages<=20){
                        ?>
                  <li><a href="add_blog.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php 
                                }
                              }
                            }
                        ?>

                        <?php
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

                          if( isset($total_pages) ){
                                for($i= ($page - 10) ; $i< ( $page + 10 ) && $i<= $total_pages; $i++){
                                  if( $total_pages>20 && ($i>0) ){
                        ?>
                  <li><a href="add_blog.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                                }
                              }
                            }
                        ?>

                      <li id="next"><a href="add_blog.php?page=<?php if($page != $total_pages){ echo $page + 1; }else{ echo $page;} ?>" id="next">&#8250;</a></li>
                      <li id="next"><a href="add_blog.php?page=<?php echo $total_pages; ?>" id="next">&raquo;</a></li>
                    </ul>
                  </div>

<script>

  var url = new URL(window.location.href).searchParams;

    var page = url.get('page');

    if(page != ""){
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

</body>
</html>
<?php
  include "footer.php";
?>