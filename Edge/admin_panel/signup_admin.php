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

if(isset($_POST['submit'])){
  $name = $_POST['uname'];
  $password = $_POST['password'];
  $cf_password = $_POST['cf_password'];
  $email = $_POST['email'];

  $message = "";

  if($password == $cf_password){
    $sqlquery = $connection->prepare("Insert into `admin_login` (`admin_name`, `admin_password`) values( :name, :password ) ");
    $sqlquery->bindValue( "name" , $name , PDO::PARAM_STR );
    $sqlquery->bindValue( "password" , md5($password) , PDO::PARAM_STR );
    $sqlquery->execute();

    if( $name != "" || $password != "" || $cf_password != "" || $email != "" ){
        $_SESSION['uname'] = $name;
        $_SESSION["login_time_stamp"] = time();
        header('location:login.php');
    }else{
        $message = "Fill all the details";
    }

  }else{
    $message = "Password and confirm password doesn't match";
  }

}
//echo $message;
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
  width: 50%;
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
  <p class="login_heading">Fill sign up form</p>

  <div class="admin_form">
      <form method="POST">
        <div class="container">
            <label for="uname"><b>Username</b></label><br>
            <input type="text" placeholder="Enter Username" name="uname"><br>

            <label for="psw"><b>Create password</b></label><br>
            <input type="password" placeholder="Enter Password" name="password"><br>

            <label for="psw"><b>Confirm password</b></label><br>
            <input type="password" placeholder="Enter Password" name="cf_password"><br>

            <label for="email"><b>Email ID</b></label><br>
            <input type="email" placeholder="Enter Email ID" name="email"><br>
            
            <button type="submit" name="submit">Login</button>
            <p class="error"><?php if(isset($_POST['submit'])){ echo $message; } ?></p>
        </div>
      </form>
  </div>


</body>
</html>
