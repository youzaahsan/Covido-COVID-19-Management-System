<?php
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $result = $_POST['result'];
    mysqli_query($conn, "UPDATE covid_report SET result = '$result' WHERE patient_id = $patient_id");
}
?>
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
<div class="container mt-4">
    <h2>Update COVID Test Result</h2>
    <form method="post">
        <input type="number" name="patient_id" placeholder="Patient ID" class="form-control" required>
        <select name="result" class="form-control mt-2">
            <option value="Pending">Pending</option>
            <option value="Negative">Negative</option>
            <option value="Positive">Positive</option>
        </select>
        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>

<?php include('./footer.php')?>