<?php

include('connection.php');

$limit = 5;  

if (isset($_GET["page"])) { $page_number  = $_GET["page"]; } else { $page_number=1; };  

$initial_page = ($page_number-1) * $limit;  

$sql = "SELECT * FROM items LIMIT $initial_page, $limit";  

$result = $connection->prepare($sql);  

?>

<table class="table table-bordered table-striped">  

<thead>  

<tr>  

<th>ID</th>  

<th>Name</th>  

<th>Category</th>  

<th>Price</th>  

</tr>  

</thead>  

<tbody>  

<?php  

foreach($result as $row) {  

?>  

            <tr>  

            <td><?php echo $row["ID"]; ?></td>  

            <td><?php echo $row["Name"]; ?></td>

            <td><?php echo $row["Category"]; ?></td>

            <td><?php echo $row["Price"]; ?></td>

            </tr>  

<?php  

};  

?>  

</tbody>  

</table>