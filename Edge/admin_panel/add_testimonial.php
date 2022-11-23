<?php
include "../connection.php";

if(isset($_POST['submit'])){
  $e_name = $_POST['client_name'];
  $e_designation = $_POST['company_name'];
  $e_info = $_POST['client_review'];
  $message = "";

  $random= rand( 100000 , 999999 );
  $filename = $_FILES["client_image"]["name"];
  $move_img = $_FILES["client_image"]["tmp_name"];
  $filename = $random.$filename;
  $folder_name = "../images/testimonials/".$filename;

  if(move_uploaded_file($move_img , $folder_name)){
    // echo "success";
  }else{
    // echo "fail";
  }

  if( $e_name && $e_designation && $e_info != "" ){

    // for($i=1; $i<=1000; $i++){
      $sqlquery = $connection->prepare("Insert into `testimonial` (`client_img`, `client_name`, `company_name`, `client_review`) values(:client_img, :name, :c_name, :client_review )");
      $sqlquery->bindValue("name" , $e_name , PDO::PARAM_STR );
      $sqlquery->bindValue("c_name" , $e_designation , PDO::PARAM_STR );
      $sqlquery->bindValue("client_review", $e_info, PDO::PARAM_STR);
      $sqlquery->bindValue("client_img", $filename , PDO::PARAM_STR);
      $sqlquery->execute();
    // }

  }else{
    $message = "Please fill the details";
  }

}
include "navbar.php";
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
  $id = $_GET['client_id'];
  $e_name = $_POST['client_name'];
  $e_designation = $_POST['company_name'];
  $e_info = $_POST['client_review'];
  $message = "";

  $random = rand(100000 , 999999);
  $filename = $_FILES["client_image"]["name"];
  $filename = $random.$filename;
  $move_img = $_FILES["client_image"]["tmp_name"];
  $folder_name = "../images/testimonials/". $filename;

  if(move_uploaded_file($move_img , $folder_name)){
    $sqlquery = $connection->prepare("update `testimonial` set `client_img`=:client_img where `client_id`=:id");
    $sqlquery->bindValue("client_img", $filename , PDO::PARAM_STR);
    $sqlquery->bindValue("id", $id , PDO::PARAM_INT);
    $sqlquery->execute();
  }

  if($e_name && $e_designation && $e_info != ""){
    $sqlquery = $connection->prepare("update `testimonial` set `client_name`=:name , `company_name`=:c_name , `client_review`=:info where `client_id`=:id");
    $sqlquery->bindValue("name" , $e_name , PDO::PARAM_STR);
    $sqlquery->bindValue("c_name", $e_designation , PDO::PARAM_STR);
    $sqlquery->bindValue("info", $e_info , PDO::PARAM_STR);
    $sqlquery->bindValue("id", $id , PDO::PARAM_INT);
    $sqlquery->execute();

    header("location:add_testimonial.php?page=$page");

  }else{
    $message = "Please fill details";
  }

}

if( isset($_GET['name'])  &&  isset($_GET['client_id'])){
  $name = $_GET['name'];
    if($name == "testimonial"){
      $id = $_GET['client_id'];

      $sqlquery = $connection->prepare("select * from `testimonial` where `client_id`=:id");
      $sqlquery->bindValue("id", $id , PDO::PARAM_INT);

      $sqlquery->execute();
      $results = $sqlquery;
      foreach($results as $result){

?>

<h3 class="blog_heading">Testimonial</h3>

<div class="admin_form">
    <form method="POST" enctype="multipart/form-data">

    <div class="container">
        <span>Client Name<span class="required">*</span></span><br>
        <input type="text" placeholder="Enter name" name="client_name" value="<?php echo $result['client_name']; ?>"><br>

        <span>Client Image</span><br>
        <input type="file" name="client_image"><br><br>

        <span>Company Name</span><br>
        <input type="text" placeholder="Enter company name" name="company_name" value="<?php echo $result['company_name']; ?>"><br>

        <span>Client Review</span><br>
        <textarea placeholder="client review" name="client_review"><?php echo $result['client_review']; ?></textarea><br>

        <div class="form_field_button">
          <div>
            <button type="submit" name="update">Update Testimonial</button>
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
          
            <a href="add_testimonial.php?page=<?php echo $page; ?>" class="cancel_btn">Cancel</a>
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

<h3 class="blog_heading">Testimonial</h3>

<div class="admin_form">
    <form method="POST" enctype="multipart/form-data">

    <div class="container">
        <span>Client Name<span class="required"> *</span></span><br>
        <input type="text" placeholder="Enter name" name="client_name"><br>

        <span>Client Image</span><br>
        <input type="file" placeholder="Enter image" name="client_image"><br><br>

        <span>Company Name<span class="required"> *</span></span><br>
        <input type="text" placeholder="Enter company name" name="company_name"><br>

        <span>Client Review<span class="required"> *</span></span><br>
        <textarea placeholder="What client say about us?" name="client_review"></textarea><br>

        <button type="submit" name="submit">Add Testimonial</button>
        <p class="error"><?php if(isset($_POST['submit'])){ echo $message; } ?></p>

    </div>

    </form>
</div>

<?php } ?>

<br>
<h3 class="blog_heading">All Testimonial</h3>

<table class="db_table">
  <tr>
    <th>client Image</th>
    <th>client Name</th>
    <th>Company Name</th>
    <th>client Review</th>
    <th colspan="2">Edit / Delete</th>
  </tr>

<?php

  $sqlquery = $connection->prepare("select * from `testimonial` order by `client_id` desc");
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

  $sqlquery = $connection->prepare("select * from `testimonial` order by `client_id` desc limit $initial_page , $limit");
  $sqlquery->execute();
  $results = $sqlquery;
  foreach($results as $result){

?>

  <tr>
    <td><img src="../images/<?php echo $result['client_img']; ?>" class="db_img"/></td>
    <td><?php echo $result['client_name']; ?></td>
    <td><?php echo $result['company_name']; ?></td>
    <td><?php echo $result['client_review']; ?></td>
    <td><a href="add_testimonial.php?page=<?php echo $page;?>&name=testimonial&client_id=<?php echo $result['client_id'];?>">Edit</a></td>
    <td><a href="delete.php?name=testimonial&delete=<?php echo $result['client_id'];?>">Delete</a></td>
  </tr>

<?php 
  }
?>

</table>

                  <div class="pagination_center">
                    <ul class="pagination">
                      <li id="prev"><a href="add_testimonial.php?page=1" id="previous" >&laquo;</a></li>
                      <li id="prev"><a href="add_testimonial.php?page=<?php if($page != 1){ echo $page - 1; }else{ echo $page;}?>" id="previous" >&#8249;</a></li>
                        <?php
                            if(  isset($total_pages)  ){
                                for($i= 1; $i<= $total_pages; $i++){
                                  if($total_pages<=20){
                        ?>
                  <li><a href="add_testimonial.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
                  <li><a href="add_testimonial.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                                }
                              }
                            }
                        ?>

                      <li id="next"><a href="add_testimonial.php?page=<?php if($page != $total_pages){ echo $page + 1; }else{ echo $page;} ?>" id="next">&#8250;</a></li>
                      <li id="next"><a href="add_testimonial.php?page=<?php echo $total_pages; ?>" id="next">&raquo;</a></li>
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