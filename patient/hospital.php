<?php
include("./connection.php");
// Step 2: Form submit hone par data save karna
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Form ke values lena
  $name = $_POST['name'] ?? '';
  $email = $_POST['email'] ?? '';
  $phone = $_POST['phone'] ?? '';
  $address = $_POST['address'] ?? '';
  $registration = $_POST['registration_no'] ?? '';
  $register = $_POST['register'] ?? '';
  $status = $_POST['status'] ?? '';

  // Simple validation: naam aur email hona chahiye
  if ($name && $email) {
    // Prepare statement for security (SQL injection se bachne ke liye)
    $stmt = $conn->prepare("INSERT INTO hospital (name, email, phone, address, registration_no, register_date, status) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $email, $phone, $address, $registration, $register, $status);
$stmt->execute();

    $stmt->bind_param("sssssss", $name, $email, $phone, $address, $registration, $register, $status);
    $stmt->execute();
    $stmt->close();
    $message = "Hospital added successfully!";
  } else {
    $error = "Please enter Hospital Name and Email!";
  }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Hospital Registration Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container mt-5">
  <h2>Hospital Registration</h2>

  <?php if (!empty($message)) : ?>
    <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
  <?php endif; ?>

  <?php if (!empty($error)) : ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <!-- Form start -->
  <form method="POST" action="">
    <div class="mb-3">
      <label for="name" class="form-label">Hospital Name</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
      <label for="phone" class="form-label">Phone No</label>
      <input type="tel" class="form-control" id="phone" name="phone">
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <textarea class="form-control" id="address" name="address"></textarea>
    </div>

    <div class="mb-3">
      <label for="registration" class="form-label">Registration No</label>
      <input type="text" class="form-control" id="registration" name="registration">
    </div>

    <div class="mb-3">
      <label for="register" class="form-label">Register Date</label>
      <input type="date" class="form-control" id="register" name="register">
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <input type="text" class="form-control" id="status" name="status">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <!-- Form end -->

  <hr class="my-5">

  <h3>Hospitals List</h3>
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
      // Hospitals data fetch karna
      $result = $conn->query("SELECT * FROM hospital ORDER BY id DESC");
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          ?>
          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>
                <p><strong>Address:</strong> <?= nl2br(htmlspecialchars($row['address'])) ?></p>
                <p><strong>Registration No:</strong> <?= htmlspecialchars($row['registration_no']) ?></p>
                <p><strong>Register Date:</strong> <?= htmlspecialchars($row['register_date']) ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>
              </div>
            </div>
          </div>
          <?php
        }
      } else {
        echo "<p>No hospitals added yet.</p>";
      }
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
