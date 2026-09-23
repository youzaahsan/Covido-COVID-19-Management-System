<?php
include('./connection.php');

// Approve or Reject Logic
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = ($_GET['action'] == 'approve') ? 'Approved' : 'Rejected';
    mysqli_query($conn, "UPDATE hospital SET status='$status' WHERE id=$id");
}

// Get pending hospitals
$result = mysqli_query($conn, "SELECT * FROM hospital WHERE status='Pending'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard - Hospital Approvals</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,900" rel="stylesheet">
    <style>
        .table-container {
            background-color: #f8f9fc;
            padding: 20px;
            border-radius: 10px;
        }
        h2 {
            color: #2c3e50;
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
        .btn-approve {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }
        .btn-reject {
            background-color: #dc3545;
            color: white;
            font-weight: bold;
        }
        .btn-approve:hover, .btn-reject:hover {
            opacity: 0.85;
        }
        img.rounded-circle {
            object-fit: cover;
        }
    </style>
</head>
<body id="page-top">
<div id="wrapper">
    <?php include('./sidebar.php'); ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('./navbar.php'); ?>
            <div class="container-fluid">
                <div class="table-container">
                    <h2 class="text-center">Pending Hospital Approvals</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Hospital Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Reg. Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td>
                                    <?php if (!empty($row['hospital_img'])) { ?>
                                        <img src="uploads/<?= $row['hospital_img'] ?>" width="50" height="50" class="rounded-circle">
                                    <?php } else { echo 'N/A'; } ?>
                                </td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['phone']) ?></td>
                                <td><?= htmlspecialchars($row['address']) ?></td>
                                <td><?= htmlspecialchars($row['register_date']) ?></td>
                                <td>
                                    <a href="admin_approve_hospitals.php?action=approve&id=<?= $row['id'] ?>" class="btn btn-sm btn-approve">✅ Approve</a>
                                    <a href="admin_approve_hospitals.php?action=reject&id=<?= $row['id'] ?>" class="btn btn-sm btn-reject">❌ Reject</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include('./footer.php'); ?>
    </div>
</div>
</body>
</html>
