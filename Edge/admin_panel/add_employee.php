<?php
include "../connection.php";

if(isset($_POST['submit'])){
  $e_name = $_POST['employee_name'];
  $e_designation = $_POST['employee_desgination'];
  $e_info = $_POST['employee_info'];
  $message = "";

  $random= rand( 100000 , 999999 );
  $filename = $_FILES["employee_image"]["name"];
  $move_img = $_FILES["employee_image"]["tmp_name"];
  $filename = $random.$filename;
  $folder_name = "../images/employee/".$filename;

  if(move_uploaded_file($move_img , $folder_name)){
    // echo "success";
  }else{
    // echo "fail";
  }

  if( $e_name && $e_designation && $e_info != "" ){

    // for($i=1; $i<=1000; $i++){
      $sqlquery = $connection->prepare("Insert into `employee_team` (`img`, `employee_name`, `employee_position`, `employee_info`) values(:employee_img, :name, :designation, :employee_info )");
      $sqlquery->bindValue("name" , $e_name , PDO::PARAM_STR );
      $sqlquery->bindValue("designation" , $e_designation , PDO::PARAM_STR );
      $sqlquery->bindValue("employee_info", $e_info, PDO::PARAM_STR);
      $sqlquery->bindValue("employee_img", $filename , PDO::PARAM_STR);
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
  $id = $_GET['employee_id'];
  $e_name = $_POST['employee_name'];
  $e_designation = $_POST['employee_desgination'];
  $e_info = $_POST['employee_info'];
  $message = "";

  $random = rand(100000 , 999999);
  $filename = $_FILES["employee_image"]["name"];
  $filename = $random.$filename;
  $move_img = $_FILES["employee_image"]["tmp_name"];
  $folder_name = "../images/employee/". $filename;

  if(move_uploaded_file($move_img , $folder_name)){
    $sqlquery = $connection->prepare("update `employee_team` set `img`=:img where `employee_id`=:id");
    $sqlquery->bindValue("img", $filename , PDO::PARAM_STR);
    $sqlquery->bindValue("id", $id , PDO::PARAM_INT);
    $sqlquery->execute();
  }

  if($e_name && $e_designation && $e_info != ""){
    $sqlquery = $connection->prepare("update `employee_team` set `employee_name`=:name , `employee_position`=:designation , `employee_info`=:info where `employee_id`=:id");
    $sqlquery->bindValue("name" , $e_name , PDO::PARAM_STR);
    $sqlquery->bindValue("designation", $e_designation , PDO::PARAM_STR);
    $sqlquery->bindValue("info", $e_info , PDO::PARAM_STR);
    $sqlquery->bindValue("id", $id , PDO::PARAM_INT);
    $sqlquery->execute();

    header("location:add_employee.php?page=$page");

  }else{
    $message = "Please fill details";
  }

}

if( isset($_GET['name'])  &&  isset($_GET['employee_id'])){
  $name = $_GET['name'];
    if($name == "employee"){
      $id = $_GET['employee_id'];

      $sqlquery = $connection->prepare("select * from `employee_team` where `employee_id`=:id");
      $sqlquery->bindValue("id", $id , PDO::PARAM_INT);

      $sqlquery->execute();
      $results = $sqlquery;
      foreach($results as $result){

?>

<h3 class="blog_heading">Team Member</h3>

<div class="admin_form">
    <form method="POST" enctype="multipart/form-data">

    <div class="container">
        <span>Employee Name<span class="required">*</span></span><br>
        <input type="text" placeholder="Enter name" name="employee_name" value="<?php echo $result['employee_name']; ?>"><br>

        <span>Employee Image</span><br>
        <input type="file" placeholder="Enter image" name="employee_image"><br><br>

        <span>Employee Designation</span><br>
        <input type="text" placeholder="Enter position" name="employee_desgination" value="<?php echo $result['employee_position']; ?>"><br>

        <span>About Employee</span><br>
        <textarea placeholder="About the Employee" name="employee_info"><?php echo $result['employee_info']; ?></textarea><br>

        <div class="form_field_button">
          <div>
            <button type="submit" name="update">Update Employee</button>
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
          
            <a href="add_employee.php?page=<?php echo $page; ?>" class="cancel_btn">Cancel</a>
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

<h3 class="blog_heading">Team Member</h3>

<div class="admin_form">
    <form method="POST" enctype="multipart/form-data">

    <div class="container">
        <span>Employee Name<span class="required"> *</span></span><br>
        <input type="text" placeholder="Enter name" name="employee_name"><br>

        <span>Employee Image</span><br>
        <input type="file" placeholder="Enter image" name="employee_image"><br><br>

        <span>Employee Designation<span class="required"> *</span></span><br>
        <input type="text" placeholder="Employee designation" name="employee_desgination"><br>

        <span>About Employee<span class="required"> *</span></span><br>
        <textarea placeholder="About the Employee" name="employee_info"></textarea><br>

        <button type="submit" name="submit">Add Employee</button>
        <p class="error"><?php if(isset($_POST['submit'])){ echo $message; } ?></p>

    </div>

    </form>
</div>

<?php } ?>

<br>
<h3 class="blog_heading">Meet the Team</h3>

<table class="db_table">
  <tr>
    <th>Employee Image</th>
    <th>Employee Name</th>
    <th>Employee Desgination</th>
    <th>About Employee</th>
    <th colspan="2">Edit / Delete</th>
  </tr>

<?php

  $sqlquery = $connection->prepare("select * from `employee_team` order by `employee_id` desc");
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

  $sqlquery = $connection->prepare("select * from `employee_team` order by `employee_id` desc limit $initial_page , $limit");
  $sqlquery->execute();
  $results = $sqlquery;
  foreach($results as $result){

?>

  <tr>
    <td><img src="../images/<?php echo $result['img']; ?>" class="db_img"/></td>
    <td><?php echo $result['employee_name']; ?></td>
    <td><?php echo $result['employee_position']; ?></td>
    <td><?php echo $result['employee_info']; ?></td>
    <td><a href="add_employee.php?page=<?php echo $page;?>&name=employee&employee_id=<?php echo $result['employee_id'];?>">Edit</a></td>
    <td><a href="delete.php?name=employee&delete=<?php echo $result['employee_id'];?>">Delete</a></td>
  </tr>

<?php 
  }
?>

</table>

                  <div class="pagination_center">
                    <ul class="pagination">
                      <li id="prev"><a href="add_employee.php?page=1" id="previous" >&laquo;</a></li>
                      <li id="prev"><a href="add_employee.php?page=<?php if($page != 1){ echo $page - 1; }else{ echo $page;}?>" id="previous" >&#8249;</a></li>
                        <?php
                            if(  isset($total_pages)  ){
                                for($i= 1; $i<= $total_pages; $i++){
                                  if($total_pages<=20){
                        ?>
                  <li><a href="add_employee.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
                  <li><a href="add_employee.php?page=<?php echo $i; ?>" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                                }
                              }
                            }
                        ?>

                      <li id="next"><a href="add_employee.php?page=<?php if($page != $total_pages){ echo $page + 1; }else{ echo $page;} ?>" id="next">&#8250;</a></li>
                      <li id="next"><a href="add_employee.php?page=<?php echo $total_pages; ?>" id="next">&raquo;</a></li>
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