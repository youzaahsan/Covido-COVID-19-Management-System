<?php
include('./connection.php');

if (isset($_POST['submit'])) {
    $vaccine_name = $_POST['vaccine_name'];
    $availability = $_POST['availability'];
    $dose_required = $_POST['dose_required'];

    $query = "INSERT INTO vaccine (vaccine_name, availability, dose_required, created_at)
              VALUES ('$vaccine_name', '$availability', '$dose_required', NOW())";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Vaccine added successfully'); window.location.href='admin_vaccine_list.php';</script>";
    } else {
        echo "<script>alert('Error adding vaccine');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Add Vaccine</title>

    <!-- Custom fonts and styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('./sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('./navbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800 text-center">Add New Vaccine</h1>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label for="vaccine_name">Vaccine Name</label>
                                            <input type="text" name="vaccine_name" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="availability">Availability</label>
                                            <select name="availability" class="form-control" required>
                                                <option value="Available">Available</option>
                                                <option value="Unavailable">Unavailable</option>
                                                <option value="Pending">Pending</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="dose_required">Doses Required</label>
                                            <input type="number" name="dose_required" class="form-control" min="1" value="2" required>
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-primary btn-block">
                                            <i class="fas fa-plus-circle"></i> Add Vaccine
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
<?php include('./footer.php')?>