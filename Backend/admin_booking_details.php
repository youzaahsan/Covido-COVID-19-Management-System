<?php
include('./connection.php');

if (isset($_GET['id']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];
    $delete = "DELETE FROM booking WHERE id = '$id'";
    mysqli_query($conn, $delete);

    header("Location: admin_booking_details.php");
    exit;
}

$result = mysqli_query($conn, "
    SELECT b.*, p.name AS patient, h.name AS hospital
    FROM booking b
    JOIN patient p ON b.patient_id = p.id
    JOIN hospital h ON b.hospital_id = h.id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Booking Details</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .booking-container {
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin-right: 5px;
        }

        .edit {
            background-color: #17a2b8;
            color: white;
        }

        .delete {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include('./sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include('./navbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid booking-container">
                    <h2 class="text-center">Booking Details</h2>

                    <table>
                        <tr>
                            <th>Patient</th>
                            <th>Hospital</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= htmlspecialchars($row['patient']) ?></td>
                                <td><?= htmlspecialchars($row['hospital']) ?></td>
                                <td><?= htmlspecialchars($row['type']) ?></td>
                                <td><?= htmlspecialchars($row['date']) ?></td>
                                <td><?= htmlspecialchars($row['status']) ?></td>
                                <td>
                                    <a href="booking_edit.php?id=<?= $row['id'] ?>" class="btn edit">Edit</a>
                                    <a href="admin_booking_details.php?id=<?= $row['id'] ?>&action=delete" class="btn delete" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

</body>
</html>
<?php include('./footer.php')?>