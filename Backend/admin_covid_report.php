<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Dashboard</title>

    <!-- Fonts & Styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<?php include('./connection.php'); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('./sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Navbar -->
                <?php include('./navbar.php'); ?>

                <!-- Page Content -->
                <div class="container-fluid">

                    <!-- Report Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">COVID-19 Booking Report by Date</h4>
                        </div>
                        <div class="card-body">

                            <!-- Filter Form -->
                            <form method="post" class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label for="from" class="form-label">From:</label>
                                    <input type="date" name="from" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="to" class="form-label">To:</label>
                                    <input type="date" name="to" class="form-control" required>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">Search</button>
                                </div>
                            </form>

                            <!-- Export Button -->
                            <a href="export_covid_report.php" class="btn btn-success mb-3">
                                📥 Export to Excel
                            </a>

                            <!-- PHP Data Fetch -->
                            <?php
                            $results = [];

                            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                                $from = $_POST['from'] ?? '';
                                $to = $_POST['to'] ?? '';

                                if ($from && $to) {
                                    $stmt = $conn->prepare("
                                        SELECT b.*, p.name AS patient_name, h.name AS hospital_name
                                        FROM booking b
                                        JOIN patient p ON b.patient_id = p.id
                                        JOIN hospital h ON b.hospital_id = h.id
                                        WHERE b.date BETWEEN ? AND ?
                                    ");
                                    $stmt->bind_param("ss", $from, $to);
                                    $stmt->execute();
                                    $results = $stmt->get_result();
                                }
                            }
                            ?>

                            <!-- Display Results -->
                            <?php if (!empty($results) && $results->num_rows > 0): ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Patient Name</th>
                                                <th>Hospital Name</th>
                                                <th>Test Type</th>
                                                <th>Booking Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $results->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($row['patient_name']) ?></td>
                                                    <td><?= htmlspecialchars($row['hospital_name']) ?></td>
                                                    <td><?= htmlspecialchars($row['type']) ?></td>
                                                    <td><?= htmlspecialchars($row['date']) ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
                                <div class="alert alert-warning">No bookings found for the selected date range.</div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
                <!-- End Container -->

            </div>
            <!-- End Main Content -->

            <!-- Footer -->
            <?php include('./footer.php'); ?>
        </div>
        <!-- End Content Wrapper -->
    </div>
    <!-- End Page Wrapper -->

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
<?php include('./footer.php')?>