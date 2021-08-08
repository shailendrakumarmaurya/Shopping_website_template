<?php

session_start();
unset($_SESSION['email']);
if (session_destroy()) {
    header('location: index.php');
}
