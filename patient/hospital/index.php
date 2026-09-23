<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Hospital Dashboard</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,
    600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<!-- <?php
session_start();
$hospital_id = $_SESSION['hospital_id']; // Ensure this is set during login
?> -->
<?php

if (!isset($_SESSION['hospital_id'])) {
    header("Location: hospital_login.php");
    exit();
}
?>




<?php include('./connection.php'); ?>

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
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="text-center mb-4">Hospital Dashboard</h2>
          </div>

       <div class="row">

  <!-- Approved Requests -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card shadow-lg rounded-4 border-0">
      <div class="card-body d-flex align-items-center">
        <div class="me-3">
          <div class="bg-success text-white rounded-circle p-3">
            <i class="fas fa-check-circle fa-2x"></i>
          </div>
        </div>
        <div>
          <h6 class="text-muted text-uppercase">Approved Requests</h6>
          <h3 class="fw-bold text-dark mb-2">
            <?php
            $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE hospital_id='$hospital_id' AND status='approved'");
            $data = mysqli_fetch_assoc($query);
            echo $data['total'];
            ?>
          </h3>
          <a href="hospital_booking_list.php?filter=approved" class="btn btn-outline-success btn-sm rounded-pill">View</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card shadow-lg rounded-4 border-0">
      <div class="card-body d-flex align-items-center">
        <div class="me-3">
          <div class="bg-warning text-white rounded-circle p-3">
            <i class="fas fa-hourglass-half fa-2x"></i>
          </div>
        </div>
        <div>
          <h6 class="text-muted text-uppercase">Pending Requests</h6>
          <h3 class="fw-bold text-dark mb-2">
            <?php
            $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE hospital_id='$hospital_id' AND status='pending'");
            $data = mysqli_fetch_assoc($query);
            echo $data['total'];
            ?>
          </h3>
          <a href="hospital_booking_list.php?filter=pending" class="btn btn-outline-warning btn-sm rounded-pill">View</a>
        </div>
      </div>
    </div>
  </div>

  <!-- COVID Tests Booked -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card shadow-lg rounded-4 border-0">
      <div class="card-body d-flex align-items-center">
        <div class="me-3">
          <div class="bg-primary text-white rounded-circle p-3">
            <i class="fas fa-vials fa-2x"></i>
          </div>
        </div>
        <div>
          <h6 class="text-muted text-uppercase">COVID Tests Booked</h6>
          <h3 class="fw-bold text-dark mb-2">
            <?php
            $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE hospital_id='$hospital_id' AND type='covid_test'");
            $data = mysqli_fetch_assoc($query);
            echo $data['total'];
            ?>
          </h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Vaccines Booked -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card shadow-lg rounded-4 border-0">
      <div class="card-body d-flex align-items-center">
        <div class="me-3">
          <div class="bg-info text-white rounded-circle p-3">
            <i class="fas fa-syringe fa-2x"></i>
          </div>
        </div>
        <div>
          <h6 class="text-muted text-uppercase">Vaccines Booked</h6>
          <h3 class="fw-bold text-dark mb-2">
            <?php
            $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE hospital_id='$hospital_id' AND type='vaccine'");
            $data = mysqli_fetch_assoc($query);
            echo $data['total'];
            ?>
          </h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Add COVID Report -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card shadow-lg rounded-4 border-0">
      <div class="card-body d-flex align-items-center">
        <div class="me-3">
          <div class="bg-danger text-white rounded-circle p-3">
            <i class="fas fa-file-medical fa-2x"></i>
          </div>
        </div>
        <div>
          <h6 class="text-muted text-uppercase">Add COVID Report</h6>
          <a href="hospital_add_report.php" class="btn btn-outline-danger btn-sm rounded-pill">Add</a>
        </div>
      </div>
    </div>
  </div>

  <!-- View Bookings -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card shadow-lg rounded-4 border-0">
      <div class="card-body d-flex align-items-center">
        <div class="me-3">
          <div class="bg-dark text-white rounded-circle p-3">
            <i class="fas fa-calendar-check fa-2x"></i>
          </div>
        </div>
        <div>
          <h6 class="text-muted text-uppercase">Booking Details</h6>
          <a href="hospital_booking_list.php" class="btn btn-outline-dark btn-sm rounded-pill">View</a>
        </div>
      </div>
    </div>
  </div>

</div>

</body>
</html>
