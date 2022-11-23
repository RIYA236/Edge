<?php
include "../connection.php";

if(isset($_GET['name']) && isset($_GET['delete'])){
    $name = $_GET['name'];
    $id = $_GET['delete'];

    if($name == "employee"){
        if(is_numeric($id)){

            $sqlquery = $connection->prepare("delete from `employee_team` where `employee_id`=:id");
            $sqlquery->bindValue("id", $id , PDO::PARAM_INT);
            $sqlquery->execute();

            header("location:add_employee.php");
        }
    }else if($name == "testimonial"){
        if(is_numeric($id)){

            $sqlquery = $connection->prepare("delete from `testimonial` where `customer_id`=:id");
            $sqlquery->bindValue("id", $id , PDO::PARAM_INT);
            $sqlquery->execute();

            header("location:add_testimonial.php");
        }
    }else if($name == "blog"){
        if(is_numeric($id)){

            $sqlquery = $connection->prepare("delete from `blogs` where `blog_id`=:id");
            $sqlquery->bindValue("id", $id , PDO::PARAM_INT);
            $sqlquery->execute();

            header("location:add_blog.php");
        }
    }else if($name == "portfolio"){
        if(is_numeric($id)){

            $sqlquery = $connection->prepare("delete from `portfolio` where `portfolio_id`=:id");
            $sqlquery->bindValue("id", $id , PDO::PARAM_INT);
            $sqlquery->execute();
            
            header("location:add_portfolio.php");
        }
    }
}

?>