<?php

include '_dbconnect.php';

$id = $_POST['order_id'];
$sql = "DELETE FROM orders WHERE order_id=$id";
$result = mysqli_query($conn, $sql);
if($result){
    $success = "Order cancelled successfully.";
}

?>