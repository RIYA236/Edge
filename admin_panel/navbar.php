<?php 
  include "session.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #ddd;
}

.topnav a {
  float: left;
  color: #000000;
  text-align: center;
  padding: 20px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #85929E;
  color: #ffffff;
}

.topnav a.active {
  background-color: #282A43;
  color: white;
}

.topnav a.right{
    float: right;
}
</style>
</head>
<body>

  <div class="topnav">
    <form method="POST">
      <a class="active" href="index.php">Home</a>
      <a href="add_blog.php">Blog</a>
      <a href="add_portfolio.php">Portfolio</a>
      <a href="add_employee.php">Employee</a>
      <a href="add_testimonial.php">Testmonial</a>
      <a class="right" id="logout" href="logout.php"><?php echo $_SESSION['uname'];?></a>
    </form>
  </div>

</body>
</html>