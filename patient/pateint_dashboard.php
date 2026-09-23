<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'patient') {
    header("Location: login.php");
    exit();
}
?>
<h1>this is patient dashboard</h1>