<?php

include '../template/pages/samples/_dbconnect.php';

$id = $_POST['sub_category_id'];
$sql = "DELETE FROM sub_category WHERE sub_category_id=$id";
$result = mysqli_query($conn, $sql);
if($result){
    $success = "Deleted successfully.";
}

?>
