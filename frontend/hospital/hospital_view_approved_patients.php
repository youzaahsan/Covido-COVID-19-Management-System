<?php
include('../connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Approved Patients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e3f2fd;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .patient-card {
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            background-color: white;
        }

        .patient-card .card-header {
            background: linear-gradient(to right, rgba(0, 123, 255, 0.75), #00c6ff);
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-body p {
            margin: 5px 0;
        }

        .badge-success {
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 30px;
        }

        .no-data {
            text-align: center;
            padding: 50px;
            font-style: italic;
            color: gray;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Approved Patients</h2>
    <div class="row">
        <?php
        $query = "SELECT * FROM patient WHERE status = 'Approved'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class='col-md-4'>
                    <div class='card patient-card'>
                        <div class='card-header'>
                            {$row['name']}
                        </div>
                        <div class='card-body'>
                            <p><strong>Email:</strong> {$row['email']}</p>
                            <p><strong>Phone:</strong> {$row['phone']}</p>
                            <p><strong>Address:</strong> {$row['address']}</p>
                            <p><strong>Status:</strong> <span class='badge badge-success'>{$row['status']}</span></p>
                        </div>
                    </div>
                </div>
                ";
            }
        } else {
            echo "<div class='col-12'><div class='no-data'>No approved patients found.</div></div>";
        }
        ?>
    </div>
</div>

</body>
</html>
<?php include('./footer.php')?>