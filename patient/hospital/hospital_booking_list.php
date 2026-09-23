<?php
session_start();
include('./connection.php');

// Check session
if (!isset($_SESSION['hospital_id'])) {
    header("Location: hospital_login.php");
    exit();
}
$hospital_id = $_SESSION['hospital_id'];

// SQL query
$sql = "SELECT b.*, p.name AS patient_name, p.email 
        FROM booking b 
        JOIN patient p ON b.patient_id = p.id 
        WHERE b.hospital_id = '$hospital_id'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Bookings</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            margin-top: 30px;
        }
        th, td {
            padding: 10px;
        }
        .btn-sm {
            font-size: 14px;
        }
    </style>
</head>
<body class="p-4">

<h2>Hospital Bookings</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Patient Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($row['patient_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= ucfirst($row['type']) ?></td>
            <td>
                <?php if ($row['status'] == 'pending') { ?>
                    <span class="badge bg-warning text-dark">Pending</span>
                <?php } elseif ($row['status'] == 'approved') { ?>
                    <span class="badge bg-success">Approved</span>
                <?php } elseif ($row['status'] == 'rejected') { ?>
                    <span class="badge bg-danger">Rejected</span>
                <?php } ?>
            </td>
            <td>
                <?php if ($row['status'] == 'pending') { ?>
                    <a href="hospital_booking_action.php?id=<?= $row['id'] ?>&action=approve" class="btn btn-success btn-sm">Approve</a>
                    <a href="hospital_booking_action.php?id=<?= $row['id'] ?>&action=reject" class="btn btn-danger btn-sm">Reject</a>
                <?php } else { ?>
                    <i>No action</i>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

</body>
</html>
