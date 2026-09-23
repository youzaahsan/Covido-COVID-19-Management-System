<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .form-container {background: white; padding: 25px; max-width: 500px; margin: auto; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);}
        h2 {margin-bottom: 20px; color: #2c3e50;}
        label {display: block; margin-bottom: 6px; font-weight: bold;}
        input[type="text"], input[type="number"], select {width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc;}
        button {background-color: #4a90e2; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;}
        button:hover {background-color: #357ABD;}
    </style>
</head>
<?php include('./connection.php') ?>
<body id="page-top">
<div id="wrapper">
    <?php include('./sidebar.php') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('./navbar.php') ?>
            <div class="container-fluid">
<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid or missing ID."; exit();
}
$id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['vaccine_name'];
    $availability = $_POST['availability'];
    $dose = $_POST['dose_required'];
    mysqli_query($conn, "UPDATE vaccine SET vaccine_name='$name', availability='$availability', dose_required='$dose' WHERE id=$id");
    echo "<script>alert('Vaccine updated successfully'); window.location.href='view-vaccine.php';</script>";
    exit();
}
$result = mysqli_query($conn, "SELECT * FROM vaccine WHERE id=$id");
$row = mysqli_fetch_assoc($result);
if (!$row) {
    echo "Vaccine record not found."; exit();
}
?>
<div class="form-container">
    <h2>Edit Vaccine</h2>
    <form method="POST">
        <label>Vaccine Name:</label>
        <input type="text" name="vaccine_name" value="<?= $row['vaccine_name'] ?>" required>
        <label>Availability:</label>
        <select name="availability" required>
            <option value="Available" <?= $row['availability'] == 'Available' ? 'selected' : '' ?>>Available</option>
            <option value="Unavailable" <?= $row['availability'] == 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
            <option value="Pending" <?= $row['availability'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
        </select>
        <label>Doses Required:</label>
        <input type="number" name="dose_required" value="<?= $row['dose_required'] ?>" required>
        <button type="submit">Update Vaccine</button>
    </form>
</div>
            </div>
        </div>
        <?php include('./footer.php') ?>
    </div>
</div>
</body>
</html>
