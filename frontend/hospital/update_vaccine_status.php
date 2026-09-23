<?php
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE patient SET vaccine_status = '$status' WHERE id = $patient_id");
    header("Location: " . $_SERVER['PHP_SELF']); // Prevent form resubmission on refresh
    exit;
}
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #e3f2fd;
        font-family: 'Segoe UI', sans-serif;
    }
    .container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        margin-top: 60px;
        max-width: 500px;
        box-shadow: 0 0 15px rgba(33, 150, 243, 0.2);
    }
    h2 {
        color: #1565c0;
        font-weight: bold;
        text-align: center;
        margin-bottom: 25px;
    }
    .form-control {
        border-radius: 6px;
    }
    .btn-primary {
        background-color: #1e88e5;
        border-color: #1e88e5;
        width: 100%;
        border-radius: 6px;
    }
</style>

<div class="container">
    <h2>Update Vaccination Status</h2>
    <form method="post">
        <div class="form-group">
            <label for="patient_id">Patient ID</label>
            <input type="number" name="patient_id" id="patient_id" class="form-control" placeholder="Enter Patient ID" required>
        </div>
        <div class="form-group">
            <label for="status">Vaccination Status</label>
            <select name="status" id="status" class="form-control">
                <option value="Not Vaccinated">Not Vaccinated</option>
                <option value="Partially Vaccinated">Partially Vaccinated</option>
                <option value="Fully Vaccinated">Fully Vaccinated</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>
