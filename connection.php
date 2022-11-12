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

?>