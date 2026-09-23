<?php
include('./connection.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "
        SELECT b.*, p.name AS patient, h.name AS hospital 
        FROM booking b
        JOIN patient p ON b.patient_id = p.id
        JOIN hospital h ON b.hospital_id = h.id
        WHERE b.id = '$id'
    ");
    $booking = mysqli_fetch_assoc($result);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $update = "UPDATE booking SET type = '$type', date = '$date', status = '$status' WHERE id = '$id'";
    mysqli_query($conn, $update);

    
    header("Location: admin_booking_details.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            margin-top: 10px;
        }

        .btn-secondary {
            margin-top: 10px;
        }
    </style>
</head>
<body id="page-top">

<div id="wrapper">
    <?php include('./sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('./navbar.php'); ?>

            <div class="container form-container">
                <h2>Edit Booking</h2>

                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?= $booking['id'] ?>">

                    <div class="form-group">
                        <label>Patient Name:</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($booking['patient']) ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Hospital Name:</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($booking['hospital']) ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Type:</label>
                        <select name="type" class="form-control" required>
                            <option value="Test" <?= $booking['type'] == 'Test' ? 'selected' : '' ?>>Test</option>
                            <option value="Vaccine" <?= $booking['type'] == 'Vaccine' ? 'selected' : '' ?>>Vaccine</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" name="date" class="form-control" value="<?= $booking['date'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Status:</label>
                        <select name="status" class="form-control" required>
                            <option value="Pending" <?= $booking['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Approved" <?= $booking['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                            <option value="Rejected" <?= $booking['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Booking</button>
                    <a href="booking_edit.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>
<?php include('./footer.php')?>
