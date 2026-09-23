<?php
session_start();
include('./connection.php');

if (!isset($_SESSION['hospital_id'])) {
    header("Location: hospital_login.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['action'])) {
    $booking_id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'approve') {
        $status = 'approved';
    } elseif ($action == 'reject') {
        $status = 'rejected';
    } else {
        die("Invalid action.");
    }

    $query = "UPDATE booking SET status='$status' WHERE id='$booking_id'";
    mysqli_query($conn, $query);
}

header("Location: hospital_booking_list.php");
exit();

