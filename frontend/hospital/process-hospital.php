<?php
include('./ connection.php'); 



$id = $_GET['id'];
$action = $_GET['action'];

if ($action == 'approve') {
    $query = "UPDATE hospital SET status = 'Approved' WHERE id = $id";
} elseif ($action == 'reject') {
    $query = "UPDATE hospital SET status = 'Rejected' WHERE id = $id";
}

mysqli_query($conn, $query);

// Redirect back to approve-hospitals
header("Location: approve-hospitals.php");
exit();
?>

<?php include('./footer.php')?>