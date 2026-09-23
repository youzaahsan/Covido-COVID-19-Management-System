<!DOCTYPE html>
<html lang="en">


<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php"); 
    exit();
}
?>


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

  <title>Admin Dashboard</title>


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<?php include('./connection.php')?>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('./sidebar.php')?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

              <?php include('./navbar.php')?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="text-center mb-4">Admin Dashboard</h2>
                     
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                     <!-- All Patients -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">All Patient Details</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="admin_viewpatients.php">View</a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

                            <!-- Covid Reports -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Covid Test/Vaccine Reports</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="admin_covid_report.php">View</a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-file-medical fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

                       <!-- Vaccine List -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Vaccine Availability</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="admin_vaccine_list.php">View</a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-syringe fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

                       <!-- Approve Hospitals -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Approve Hospital Login</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="admin_approve_hospitals.php">Manage</a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-hospital-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
     <!-- Hospital List -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">List of Hospitals</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="admin_hospital_view.php">View</a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clinic-medical fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Booking Details -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Booking Details</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="admin_booking_details.php">View</a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

                    <div class="row">

    <!-- Total Registered Patients -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Registered Patients</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                            include('./connection.php');
                            $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM patient");
                            $data = mysqli_fetch_assoc($query);
                            echo $data['total'];
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approved Hospitals -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Approved Hospitals</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                            $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM hospital WHERE status='approved'");
                            $data = mysqli_fetch_assoc($query);
                            echo $data['total'];
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hospital fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Hospital Requests -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Hospital Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                            $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM hospital WHERE status='pending'");
                            $data = mysqli_fetch_assoc($query);
                            echo $data['total'];
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Completed Vaccinations -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Completed Vaccinations</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                            $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE status='completed' AND type='vaccine'");
                            $data = mysqli_fetch_assoc($query);
                            echo $data['total'];
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-syringe fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include('./footer.php');?>