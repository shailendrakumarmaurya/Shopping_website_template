<?php

include '../template/pages/samples/_dbconnect.php';


$id = $_POST['product_id'];
$sql = "DELETE FROM products WHERE product_id=$id";
$result = mysqli_query($conn, $sql);
if($result){
    $success = "Deleted successfully.";
}
