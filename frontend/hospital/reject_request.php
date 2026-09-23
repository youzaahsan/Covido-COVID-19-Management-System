<?php
include '../Backend/db_connect.php';

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    $sql = "UPDATE bookings SET status = 'rejected' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();

    header("Location: pending_requests.php");
}
?>
<?php include('./footer.php')?>