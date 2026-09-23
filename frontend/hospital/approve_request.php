<?php
session_start();
if (!isset($_SESSION['hospital_id'])) {
    header("Location: hospital_login.php");
    exit();
}
$hospital_id = $_SESSION['hospital_id'];
include('./connection.php');

// Handle Approve/Reject
if (isset($_GET['action']) && isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'approve') {
        $status = 'approved';
    } elseif ($action == 'reject') {
        $status = 'rejected';
    }

    $update = "UPDATE booking SET status='$status' WHERE id='$booking_id' AND hospital_id='$hospital_id'";
    mysqli_query($conn, $update);
    header("Location: approve_request.php"); // Redirect after update
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Approve Requests</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">

<div id="wrapper">
    <?php include('./sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('./navbar.php'); ?>

            <div class="container-fluid py-4">
                <h3 class="mb-4 text-primary text-center font-weight-bold">Pending Booking Requests</h3>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-primary">
                        <h6 class="m-0 font-weight-bold text-white">Booking Requests</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Patient ID</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM booking WHERE hospital_id='$hospital_id' AND status='pending'";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['patient_id']}</td>
                                            <td class='text-capitalize'>{$row['type']}</td>
                                            <td><span class='badge badge-warning'>{$row['status']}</span></td>
                                            <td>
                                                <a href='approve_request.php?action=approve&id={$row['id']}' class='btn btn-sm btn-success'><i class='fas fa-check'></i> Approve</a>
                                                <a href='approve_request.php?action=reject&id={$row['id']}' class='btn btn-sm btn-danger'><i class='fas fa-times'></i> Reject</a>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center text-muted'>No pending requests</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div> <!-- content -->
    </div> <!-- content-wrapper -->
</div> <!-- wrapper -->

</body>
</html>
<?php include('./footer.php')?>