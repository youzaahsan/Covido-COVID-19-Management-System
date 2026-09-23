<?php
include('../connection.php');

$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $type = $_POST['type'];
    mysqli_query($conn, "INSERT INTO hospital_requests (patient_id, request_type, request_status) VALUES ('$patient_id', '$type', 'Pending')");
    $success = " Request Sent Successfully!";
}
?>

<!-- Add Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-lg">
        <h2 class="text-primary mb-4">Send Request (Test or Vaccination)</h2>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label><strong>Patient ID</strong></label>
                <input type="number" name="patient_id" class="form-control" placeholder="Enter Patient ID" required>
            </div>

            <div class="form-group">
                <label><strong>Request Type</strong></label>
                <select name="type" class="form-control">
                    <option value="Test">COVID Test</option>
                    <option value="Vaccination">Vaccination</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success btn-block">Send Request</button>
        </form>
    </div>
</div>
<?php include('./footer.php')?>