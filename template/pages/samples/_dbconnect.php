<?php

$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'skydash';


$conn = mysqli_connect($server, $username, $password, $dbname);

if(!$conn){
    die("Error occurred");
}



?>