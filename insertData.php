<?php
    include 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input = file_get_contents('php://input');
    $decode = json_decode(($input) , true);
    // print_r($decode);
    print_r($decode);

    $blog_id = $decode["blog_id"];
    $parent_id = $decode["parent_id"];
    $name = $decode["name"];
    $email = $decode["email"];
    $url = $decode["url"];
    $message = $decode["message"];
    

    $sqlquery = $connection->prepare("Insert into `blog_comments`( `blog_id`, `parent_id` ,`comment_name`, `comment_email`, `comment_url`, `comment_message`) 
    values ( :id , :parent_id , :name , :email , :url , :message ) ");
    $sqlquery->bindValue("id", $blog_id , PDO::PARAM_STR);
    $sqlquery->bindValue("parent_id", $parent_id , PDO::PARAM_STR);
    $sqlquery->bindValue("name", $name , PDO::PARAM_STR);
    $sqlquery->bindValue("email", $email , PDO::PARAM_STR);
    $sqlquery->bindValue("url", $url , PDO::PARAM_STR);
    $sqlquery->bindValue("message", $message , PDO::PARAM_STR);
    $sqlquery->execute();
}

?>