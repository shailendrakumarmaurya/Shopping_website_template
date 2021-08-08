<?php

include '../template/pages/samples/_dbconnect.php';


$id = $_POST['banner_id'];
$sql = "DELETE FROM banners WHERE banner_id=$id";
$result = mysqli_query($conn, $sql);
if($result){
    $success = "Deleted successfully.";
}

?>