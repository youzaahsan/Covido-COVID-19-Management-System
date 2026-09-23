<?php
session_start();
if (!isset($_SESSION['hospital_id'])) {
    header("Location: http://localhost/covid_webite/frontend/login.php");
    exit();
}

// Include database connection
include('./connection.php');

// Get hospital_id from session
$hospital_id = $_SESSION['hospital_id'];

// Fetch dashboard counts
$approved = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE hospital_id='$hospital_id' AND status='approved'"))['total'];
$pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE hospital_id='$hospital_id' AND status='pending'"))['total'];
$covid_tests = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE hospital_id='$hospital_id' AND type='covid_test'"))['total'];
$vaccines = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE hospital_id='$hospital_id' AND type='vaccine'"))['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Hospital Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Font Awesome -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <style>
    .dashboard-card .card-body {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .dashboard-card .icon-circle {
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
    }

    .dashboard-card h6 {
      font-size: 14px;
      text-transform: uppercase;
      margin-bottom: 5px;
      color: #6c757d;
    }

    .dashboard-card h3 {
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
</head>

<body id="page-top">

  <div id="wrapper">
    <?php include('./sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include('./navbar.php'); ?>

        <div class="container-fluid py-4">
          <div class="text-center mb-5">
            <h1 class="h3 text-gray-800">Hospital Dashboard</h1>
          </div>

          <div class="row">

            <!-- Approved Requests -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card shadow-sm dashboard-card border-left-success">
                <div class="card-body">
                  <div class="icon-circle bg-success text-white">
                    <i class="fas fa-check-circle fa-lg"></i>
                  </div>
                  <div>
                    <h6>Approved Requests</h6>
                    <h3><?= $approved ?></h3>
                    <a href="approve_request.php?filter=approved" class="btn btn-sm btn-outline-success rounded-pill">View</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card shadow-sm dashboard-card border-left-warning">
                <div class="card-body">
                  <div class="icon-circle bg-warning text-white">
                    <i class="fas fa-hourglass-half fa-lg"></i>
                  </div>
                  <div>
                    <h6>Pending Requests</h6>
                    <h3><?= $pending ?></h3>
                    <a href="hospital_booking_list.php?filter=pending" class="btn btn-sm btn-outline-warning rounded-pill">View</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- COVID Tests Booked -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card shadow-sm dashboard-card border-left-primary">
                <div class="card-body">
                  <div class="icon-circle bg-primary text-white">
                    <i class="fas fa-vials fa-lg"></i>
                  </div>
                  <div>
                    <h6>COVID Tests Booked</h6>
                    <h3><?= $covid_tests ?></h3>
                  </div>
                </div>
              </div>
            </div>

            <!-- Vaccines Booked -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card shadow-sm dashboard-card border-left-info">
                <div class="card-body">
                  <div class="icon-circle bg-info text-white">
                    <i class="fas fa-syringe fa-lg"></i>
                  </div>
                  <div>
                    <h6>Vaccines Booked</h6>
                    <h3><?= $vaccines ?></h3>
                  </div>
                </div>
              </div>
            </div>

            <!-- Add COVID Report -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card shadow-sm dashboard-card border-left-danger">
                <div class="card-body">
                  <div class="icon-circle bg-danger text-white">
                    <i class="fas fa-file-medical fa-lg"></i>
                  </div>
                  <div>
                    <h6>Add COVID Report</h6>
                    <a href="hospital_add_report.php" class="btn btn-sm btn-outline-danger rounded-pill">Add Report</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Booking Details -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card shadow-sm dashboard-card border-left-dark">
                <div class="card-body">
                  <div class="icon-circle bg-dark text-white">
                    <i class="fas fa-calendar-check fa-lg"></i>
                  </div>
                  <div>
                    <h6>Booking Details</h6>
                    <a href="hospital_booking_list.php" class="btn btn-sm btn-outline-dark rounded-pill">See All</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

</body>
</html>
<?php include('./footer.php')?>