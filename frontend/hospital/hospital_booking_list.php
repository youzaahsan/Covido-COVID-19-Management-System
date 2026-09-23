<?php
session_start();
include '../connection.php';

// Check if hospital is logged in
if (!isset($_SESSION['hospital_id'])) {
    header("Location: hospital_login.php");
    exit();
}

$hospital_id = $_SESSION['hospital_id'];

// Get filter value from URL safely
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Base query
$query = "SELECT * FROM booking WHERE hospital_id = '$hospital_id'";
if ($filter == 'pending') {
    $query .= " AND status = 'pending'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pending Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 0 12px rgba(0,0,0,0.08);
            margin-top: 40px;
        }

        h3 {
            color: #0d6efd;
            font-weight: bold;
            border-left: 5px solid #0d6efd;
            padding-left: 10px;
        }

        .table {
            background-color: #ffffff;
        }

        .table thead {
            background-color: #0d6efd;
            color: white;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.4em 0.8em;
            border-radius: 0.6rem;
        }

        .btn-back {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 20px;
            padding: 8px 20px;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #084298;
        }

        @media (max-width: 576px) {
            h3 {
                font-size: 1.3rem;
            }

            .table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h3 class="mb-4">Pending Booking Requests</h3>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Patient Name</th>
                <th>Test/Vaccine</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $count++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['patient_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['booking_date']) . "</td>";

                    $status = $row['status'];
                    $badgeClass = 'secondary';
                    if ($status == 'pending') $badgeClass = 'warning';
                    elseif ($status == 'approved') $badgeClass = 'success';
                    elseif ($status == 'rejected') $badgeClass = 'danger';

                    echo "<td><span class='badge bg-$badgeClass text-uppercase'>" . $status . "</span></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No pending requests found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-back mt-3">← Back to Dashboard</a>
</div>
</body>
</html>
<?php include('./footer.php')?>