<?php

session_start(); 

if(isset($_SESSION["uname"]))  
{ 
    if(time()-$_SESSION["login_time_stamp"] >10800)
    { 
        session_unset(); 
        session_destroy(); 
        header("Location:login.php"); 
    } 
} 
else
{ 
    header("Location:login.php"); 
} 

?>
