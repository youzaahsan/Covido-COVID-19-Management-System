<?php

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'hospital') {
    header("Location: login.php");
    exit();
}
?>

<h1>this is hospital dashboard</h1>