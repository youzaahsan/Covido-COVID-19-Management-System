<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /covid_webite/frontend/login.php");
    exit();
}
?>
