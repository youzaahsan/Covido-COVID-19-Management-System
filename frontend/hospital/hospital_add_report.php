<?php
session_start();
if (!isset($_SESSION['hospital_id'])) {
    header("Location: ../frontend/login.php");
    exit();
}

include('./connection.php');
$hospital_id = $_SESSION['hospital_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $booking_id = $_POST['booking_id'];
    $report_details = mysqli_real_escape_string($conn, $_POST['report_details']);
    $report_date = date('Y-m-d');

    $query = "INSERT INTO covid_reports (hospital_id, patient_id, booking_id, report_details, report_date)
              VALUES ('$hospital_id', '$patient_id', '$booking_id', '$report_details', '$report_date')";

    if (mysqli_query($conn, $query)) {
        $success = "COVID report added successfully.";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add COVID Report</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #e9f0ff; /* light blue background */
    }
    .card {
      margin-top: 60px;
      border-left: 4px solid #007bff; /* Bootstrap primary blue */
    }
    .btn-primary {
      width: 150px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Add COVID Report</h4>
        </div>
        <div class="card-body">

          <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
          <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

          <form method="POST">
            <div class="form-group">
              <label><strong>Patient ID</strong></label>
              <input type="text" name="patient_id" class="form-control" required>
            </div>

            <div class="form-group">
              <label><strong>Booking ID</strong></label>
              <input type="text" name="booking_id" class="form-control" required>
            </div>

            <div class="form-group">
              <label><strong>Report Details</strong></label>
              <textarea name="report_details" class="form-control" rows="4" required></textarea>
            </div>

            <div class="d-flex justify-content-between">
              <a href="index.php" class="btn btn-secondary">Back</a>
              <button type="submit" class="btn btn-primary">Submit Report</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<?php include('./footer.php')?>