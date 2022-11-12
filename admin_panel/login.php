<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$db_name = "edge";

try{
    $connection = new PDO("mysql:host=$servername; dbname=$db_name", $username , $password);
    $connection -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Connection failed";
}

session_start();

if(isset($_POST['submit'])){
  $name = $_POST['uname'];
  $password = $_POST['password'];
  $message = "";

  $sqlquery = $connection->prepare("Select * from `admin_login` where `admin_name`=:a_name and `admin_password`=:a_password");
  $sqlquery->bindValue( "a_name", $name, PDO::PARAM_STR );
  $sqlquery->bindValue( "a_password", md5($password), PDO::PARAM_STR );
  $sqlquery->execute();
  $data = $sqlquery->rowCount();

    if($data != "0"){
      $_SESSION['uname'] = $name;
      $_SESSION["login_time_stamp"] = time(); 
      header('location:index.php');
    }else{
      $message = "You have entered incorrect username or password";
    }
}

if(isset($_SESSION['uname'])){
  header('location:index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  color: white;
  padding: 14px 10px;
  margin: 8px 0;
  border: none;
  border-radius: 5%;
  cursor: pointer;
  width: 25%;
  background: blue;
  text-transform:uppercase;
  box-shadow: 0 4px 4px blue;
}

button:hover {
  opacity: 0.8;
}

.login_heading{
    color: darkred;
    text-align: center;
}

.admin_form{
    width: 400px;
    border: 1px solid #000000;
    margin-left: auto;
    margin-right: auto;
}

.container {
  padding: 16px;
  margin-left: auto;
  margin-right: auto;
  text-align: center;
}

span.psw {
  float: right;
  padding-top: 16px;
}
.error{
  color: red;
  text-align: center;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
}
</style>
</head>
<body>

  <h2 class="login_heading">Edge</h2>
  <p class="login_heading">Login with your registered account</p>

  <div class="admin_form">
      <form method="POST">
        <div class="container">
            <label for="uname"><b>Username</b></label><br>
            <input type="text" placeholder="Enter Username" name="uname"><br>

            <label for="psw"><b>Password</b></label><br>
            <input type="password" placeholder="Enter Password" name="password"><br>
                
            <button type="submit" name="submit">Login</button>
            <p class="error"><?php if(isset($_POST['submit'])){ echo $message; } ?></p>
        </div>
      </form>
  </div>


</body>
</html>
