<?php
include('./connection.php');
$result = mysqli_query($conn, "SELECT * FROM vaccine");
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard - Vaccine List</title>

    <!-- Custom fonts and styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .vaccine-table-container {
            background-color: #f8f9fc;
            padding: 20px;
            border-radius: 10px;
        }

        .vaccine-table h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .add-button {
            background-color: #4a90e2;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4a90e2;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e6f2ff;
        }

        .status-available {
            color: #28a745;
            font-weight: bold;
        }

        .status-unavailable {
            color: #dc3545;
            font-weight: bold;
        }

        .status-pending {
            color: #ffc107;
            font-weight: bold;
        }

        .edit-link {
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }

        .delete-link {
            color: #dc3545;
            font-weight: bold;
            text-decoration: none;
            margin-left: 10px;
        }

        .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <?php include('./sidebar.php') ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include('./navbar.php') ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

              
                <!-- Vaccine Table Section -->
                <div class="vaccine-table-container">
                    <div class="vaccine-table">
                        <h2>Vaccine List</h2>
                        <a href="add-vaccine.php" class="add-button">+ Add Vaccine</a>

                        <table>
                            <tr>
                                <th>Vaccine Name</th>
                                <th>Availability</th>
                                <th>Doses Required</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>

                            <?php while($row = mysqli_fetch_assoc($result)) {
                                $availability = strtolower($row['availability']);
                                $statusClass = "status-$availability";
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row['vaccine_name']) ?></td>
                                <td class="<?= $statusClass ?>"><?= htmlspecialchars($row['availability']) ?></td>
                                <td><?= htmlspecialchars($row['dose_required']) ?></td>
                                <td><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <a href="edit-vaccine.php?id=<?= $row['id'] ?>" class="edit-link">Edit</a>
                                    <a href="delete-vaccine.php?id=<?= $row['id'] ?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this vaccine?');">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>

            </div>
            <!-- End Page Content -->

        </div>
        <!-- End Main Content -->

    </div>
    <!-- End Content Wrapper -->

</div>
<!-- End Page Wrapper -->

</body>
</html>
<?php include('./footer.php')?>