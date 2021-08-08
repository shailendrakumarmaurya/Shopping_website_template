<?php

include '../template/pages/samples/_dbconnect.php';

$id = $_GET['product_id'];
$sql = "SELECT * FROM products WHERE product_id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {
    if ($row['status'] == 0) {
        $status = 1;
    } else {
        $status = 0;
    }
}
$sql1 = "UPDATE products SET status = '$status' WHERE product_id=$id";
$result1 = mysqli_query($conn, $sql1);
if ($result1) {
    $success = "Status Changed Successfully.";
    header('location: products_list.php');
}
