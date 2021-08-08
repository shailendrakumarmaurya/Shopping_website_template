<?php

$server = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'skydash';

$conn = mysqli_connect($server, $user, $pass, $dbname);
if (!$conn) {
    die("Connection Error!");
}
