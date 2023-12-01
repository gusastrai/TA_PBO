<?php
include("include/class.user.php");
session_start();

if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
}   

$user->user_logout();
header('location:login.php');
?>