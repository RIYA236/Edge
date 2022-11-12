<html>
<head>
<script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>

<form>
<input type="text" size="30" onkeyup="showResult(this.value)">
<div id="livesearch">


cdvsffgfg

riya

janak

jeet

jigar

avni

</div>
</form>

</body>
</html>



<!-- <?php

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

$limit = 4;

$query = "SELECT COUNT(*) FROM `portfolio`";  

$result = $connection->prepare($query);  

$row = $result->execute();  

$total_rows = $row;  

$total_pages = ceil($total_rows / $limit); 

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>PHP Pagination AJAX</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

    <div class="container">

        <div class="table-wrapper">

            <div class="table-title">

                <div class="row">

                    <div class="col-sm-12">

                       <h2 align = "center">Pagination in PHP using AJAX</h2>               

                    </div>

                </div>

            </div>

            <div id="target-content">loading...</div>           

            <div class="clearfix">              

                    <ul class="pagination">

                    <?php 

                    if(!empty($total_pages)){

                        for($i=1; $i<=$total_pages; $i++){

                                if($i == 1){

                                    ?>

                                <li class="pageitem active" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i;?>" class="page-link" ><?php echo $i;?></a></li>                                                           

                                <?php 

                                }

                                else{

                                    ?>

                                <li class="pageitem" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i;?>"><?php echo $i;?></a></li>

                                <?php

                                }

                        }

                    }

                                ?>

                    </ul>

               

            </div>

        </div>

    </div>

    <script>

    $(document).ready(function() {

        $("#target-content").load("pagination.php?page=1");

        $(".page-link").click(function(){

            var id = $(this).attr("data-id");

            var select_id = $(this).parent().attr("id");

            $.ajax({

                url: "pagination.php",

                type: "GET",

                data: {

                    page : id

                },

                cache: false,

                success: function(dataResult){

                    $("#target-content").html(dataResult);

                    $(".pageitem").removeClass("active");

                    $("#"+select_id).addClass("active");                  

                }

            });

        });

    });

</script>

</body>

</html> -->
