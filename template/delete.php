<?php

include '../template/pages/samples/_dbconnect.php';

$id = $_POST['category_id'];

$sql = "DELETE FROM category WHERE category_id=$id";
$result = mysqli_query($conn, $sql);
if($result){
    $success = "Deleted successfully.";
}

?>
