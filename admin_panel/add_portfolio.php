<?php
include "../connection.php";
include "navbar.php";

$user = $_SESSION['uname'];

if(isset($_POST['submit'])){
  $company_name = $_POST['company_name'];
  $client_name = $_POST['client_name'];
  $project_category = $_POST['project_category'];
  $portfolio_category = $_POST['portfolio_category'];
  $date = $_POST['portfolio_date'];
  $project_url = $_POST['project_url'];
  $portfolio_description = $_POST['project_description'];
  $message = "";

  $random= rand( 100000 , 999999 );
  $filename = $_FILES["portfolio_image"]["name"];
  $move_img = $_FILES["portfolio_image"]["tmp_name"];
  $filename = $random.$filename;
  $folder_name = "../images/portfolio/".$filename;

  if(move_uploaded_file($move_img , $folder_name)){
    // echo "success";
  }else{
    // echo "fail";
  }

  if( $company_name && $client_name && $project_category && $portfolio_category && $project_url && $portfolio_description != "" ){

    for($i=1; $i<=1000; $i++){
      $sqlquery = $connection->prepare("Insert into `portfolio` ( `portfolio_category`, `client`, `company` , `project_category`, `project_date`, `project_url`, `project_description`, `portfolio_img` ) values(:portfolio_category, :client_name, :company_name , :project_category, :date, :url, :portfolio_description, :img )");
      $sqlquery->bindValue("company_name" , $company_name , PDO::PARAM_STR );
      $sqlquery->bindValue("client_name" , $client_name , PDO::PARAM_STR );
      $sqlquery->bindValue("project_category", $project_category, PDO::PARAM_STR);
      $sqlquery->bindValue("portfolio_category", $portfolio_category , PDO::PARAM_STR);
      $sqlquery->bindValue("date", $date , PDO::PARAM_STR);
      $sqlquery->bindValue("url", $project_url , PDO::PARAM_STR);
      $sqlquery->bindValue("portfolio_description", $portfolio_description , PDO::PARAM_STR);
      $sqlquery->bindValue("img", $filename , PDO::PARAM_STR);
      $sqlquery->execute();
    }

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
  $id = $_GET['portfolio_id'];
  $company_name = $_POST['company_name'];
  $client_name = $_POST['client_name'];
  $project_category = $_POST['project_category'];
  $portfolio_category = $_POST['portfolio_category'];
  $date = $_POST['portfolio_date'];
  $project_url = $_POST['project_url'];
  $portfolio_description = $_POST['project_description'];
  $message = "";

  $random = rand(100000 , 999999);
  $filename = $_FILES["portfolio_image"]["name"];
  $filename = $random.$filename;
  $move_img = $_FILES["portfolio_image"]["tmp_name"];
  $folder_name = "../images/portfolio/". $filename;

  if(move_uploaded_file($move_img , $folder_name)){
    $sqlquery = $connection->prepare("update `portfolio` set `portfolio_img`=:p_img where `portfolio_id`=:id");
    $sqlquery->bindValue("p_img", $filename , PDO::PARAM_STR);
    $sqlquery->bindValue("id", $id , PDO::PARAM_INT);
    $sqlquery->execute();
  }

  if( $company_name && $client_name && $project_category && $portfolio_category && $project_url && $portfolio_description != "" ){
    $sqlquery = $connection->prepare("update `portfolio` set `portfolio_category`=:portfolio_category , `client`=:client_name , `company`=:company_name , `project_category`=:project_category , `project_date`=:date , `project_url`=:url , `project_description`=:portfolio_description  where `portfolio_id`=:id");
    $sqlquery->bindValue("company_name" , $company_name , PDO::PARAM_STR );
    $sqlquery->bindValue("client_name" , $client_name , PDO::PARAM_STR );
    $sqlquery->bindValue("project_category", $project_category, PDO::PARAM_STR);
    $sqlquery->bindValue("portfolio_category", $portfolio_category , PDO::PARAM_STR);
    $sqlquery->bindValue("date", $date , PDO::PARAM_STR);
    $sqlquery->bindValue("url", $project_url , PDO::PARAM_STR);
    $sqlquery->bindValue("portfolio_description", $portfolio_description , PDO::PARAM_STR);
    $sqlquery->bindValue( "id", $id , PDO::PARAM_STR) ;
    $sqlquery->execute();

    header("location:add_portfolio.php?page=$page");
  }else{
    $message = "Please fill details";
  }

}

if( isset($_GET['name'])  &&  isset($_GET['portfolio_id'])){
  $name = $_GET['name'];
    if($name == "blog"){
      $id = $_GET['portfolio_id'];

      $sqlquery = $connection->prepare("select * from `portfolio` where `portfolio_id`=:id");
      $sqlquery->bindValue("id", $id , PDO::PARAM_INT);

      $sqlquery->execute();
      $results = $sqlquery;
      foreach($results as $result){

?>

<h3 class="blog_heading">Portfolio</h3>

<div class="admin_form">
    <form method="POST" enctype="multipart/form-data">

    <div class="container">
      <div class="form_field">
        <div>
          <span>Company Name<span class="required">*</span></span><br>
          <input type="text" placeholder="Enter blog title" name="company_name" value="<?php echo $result['company']; ?>"><br>
        </div>

        <div>
          <span>Client Name<span class="required">*</span></span><br>
          <input type="text" placeholder="Enter blog title" name="client_name" value="<?php echo $result['client']; ?>"><br>
        </div>
      </div>

      <div class="form_field">
        <div>
          <span>Project Category<span class="required">*</span></span><br>
          <input type="text" placeholder="Enter blog image" name="project_category" value="<?php echo $result['project_category']; ?>"><br><br>
        </div>

        <div>
          <span>Portfolio Category<span class="required">*</span></span><br>
          <input type="text" placeholder="Enter blog title" name="portfolio_category" value="<?php echo $result['portfolio_category']; ?>"><br>
        </div>
      </div>

      <div class="form_field">
        <div>
          <span>Project Date</span><br>
          <input type="date" placeholder="Enter blog category" name="portfolio_date"><br>
        </div>

        <div>
          <span>Portfolio Image</span>
          <input type="file" name="portfolio_image"><br><br>
        </div>
      </div>

        <span>Project URL<span class="required">*</span></span><br>
        <input type="text" placeholder="Enter blog description" name="project_url" value="<?php echo $result['project_url']; ?>"><br>

        <span>Project Description<span class="required">*</span></span><br>
        <textarea placeholder="Enter description" name="project_description"><?php echo $result['project_description']; ?></textarea><br>

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
          
            <a href="add_portfolio.php?page=<?php echo $page; ?>" class="cancel_btn">Cancel</a>
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

<h3 class="blog_heading">Portfolio</h3>

<div class="admin_form">
    <form method="POST" enctype="multipart/form-data">

    <div class="container">
      <div class="form_field">
        <div>
          <span>Company Name<span class="required">*</span></span><br>
          <input type="text" placeholder="Enter blog title" name="company_name"><br>
        </div>

        <div>
          <span>Client Name<span class="required">*</span></span><br>
          <input type="text" placeholder="Enter blog title" name="client_name"><br>
        </div>
      </div>

      <div class="form_field">
        <div>
          <span>Project Category<span class="required">*</span></span><br>
          <input type="text" placeholder="Enter blog image" name="project_category"><br><br>
        </div>

        <div>
          <span>Portfolio Category<span class="required">*</span></span><br>
          <input type="text" placeholder="Enter blog title" name="portfolio_category"><br>
        </div>
      </div>

      <div class="form_field">
        <div>
          <span>Project Date</span><br>
          <input type="date" placeholder="Enter blog category" name="portfolio_date"><br>
        </div>

        <div>
          <span>Portfolio Image</span>
          <input type="file" name="portfolio_image"><br><br>
        </div>
      </div>

        <span>Project URL<span class="required">*</span></span><br>
        <input type="text" placeholder="Enter blog description" name="project_url"><br>

        <span>Project Description<span class="required">*</span></span><br>
        <textarea placeholder="Enter description" name="project_description"></textarea><br>

        <button type="submit" name="submit">Add Portfolio</button>
        <p class="error"><?php if(isset($_POST['submit'])){ echo $message; } ?></p>

    </div>

    </form>
</div>


<?php } ?>

<br>
<h3 class="blog_heading">All Portfolio</h3>

<table class="db_table">
  <tr>
    <th>Portfolio Image</th>
    <th>Portfolio Category</th>
    <th>Client</th>
    <th>Company</th>
    <th>Project Category</th>
    <th>Date</th>
    <th>Project URL</th>
    <th>Portfolio Description</th>
    <th colspan="2">Edit / Delete</th>
  </tr>

<?php

  $sqlquery = $connection->prepare("select * from `portfolio` order by `portfolio_id` desc");
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
    $initial_page = ( 1 - 1 ) * $limit;
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

  $sqlquery = $connection->prepare("select * from `portfolio` order by `portfolio_id` desc limit $initial_page , $limit");
  $sqlquery->execute();
  $results = $sqlquery;
  foreach($results as $result){

?>

  <tr>
    <td><img src="../images/<?php echo $result['portfolio_img']; ?>" class="db_img"/></td>
    <td><?php echo $result['portfolio_category']; ?></td>
    <td><?php echo $result['client']; ?></td>
    <td><?php echo $result['company']; ?></td>
    <td><?php echo $result['project_category']; ?></td>
    <td><?php echo $result['project_date']; ?></td>
    <td><?php echo $result['project_url']; ?></td>
    <td><?php echo $result['project_description']; ?></td>
    <td><a href="add_portfolio.php?page=<?php echo $page;?>&name=blog&portfolio_id=<?php echo $result['portfolio_id'];?>">Edit</a></td>
    <td><a href="delete.php?name=portfolio&delete=<?php echo $result['portfolio_id'];?>">Delete</a></td>
  </tr>

<?php 
  }
?>

</table>

                  <div class="pagination_center">
                    <ul class="pagination">
                      <li id="prev"><a href="add_portfolio.php?page=1" id="previous" >&laquo;</a></li>
                      <li id="prev"><a href="add_portfolio.php?page=<?php if($page != 1){ echo $page - 1; }else{ echo $page;}?>" id="previous" >&#8249;</a></li>
                        <?php
                            if(  isset($total_pages)  ){
                                for($i= 1; $i<= $total_pages; $i++){
                                  if($total_pages<=20){
                        ?>
                  <li><a href="add_portfolio.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
                  <li><a href="add_portfolio.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                                }
                              }
                            }
                        ?>

                      <li id="next"><a href="add_portfolio.php?page=<?php if($page != $total_pages){ echo $page + 1; }else{ echo $page;} ?>" id="next">&#8250;</a></li>
                      <li id="next"><a href="add_portfolio.php?page=<?php echo $total_pages; ?>" id="next">&raquo;</a></li>
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