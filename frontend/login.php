<?php
session_start();
include('./connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Covido - Login</title>

   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/responsive.css">
</head>

<body class="main-layout">

<!-- Loader -->
<div class="loader_bg">
   <div class="loader"><img src="images/loading.gif" alt="#" /></div>
</div>

<!-- Navbar -->
<?php include('./navbar.php'); ?>

<!-- Login Form -->
<div class="container d-flex justify-content-center align-items-center min-vh-100 mt-5 mb-5">
   <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-4">Login</h3>
      <form method="POST" action="">
         <div class="mb-3">
            <label for="user_name" class="form-label">User Name:</label>
            <input name="user_name" type="text" id="user_name" class="form-control" required>
         </div>
         <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
         </div>
         <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Login</button>
         </div>
         <div class="text-center">
            <span>New user? <a href="signup.php">Register</a></span>
         </div>
      </form>
   </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $username = mysqli_real_escape_string($conn, $_POST['user_name']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);

   $sql = "SELECT * FROM user_credentials WHERE username = '$username'";
   $result = mysqli_query($conn, $sql);

   if ($result && mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);

      if ($user['password'] === $password) {
         $_SESSION['username'] = $username;
         $role_id = $user['role_id'];
        $user_id = $user['user_id']; // ✅ sahi


         if ($role_id == 1) {
            // Admin
            echo "<script>window.location.href='http://localhost/covid_webite/Backend/index.php';</script>";

         } else if ($role_id == 2) {
            // Hospital
            $hos_sql = "SELECT id FROM hospital WHERE user_id = '$user_id' LIMIT 1";
            $hos_result = mysqli_query($conn, $hos_sql);

            if ($hos_result && mysqli_num_rows($hos_result) > 0) {
               $hos_data = mysqli_fetch_assoc($hos_result);
               $_SESSION['hospital_id'] = $hos_data['id'];

               echo "<script>window.location.href='http://localhost/covid_webite/frontend/hospital/index.php';</script>";
            } else {
               echo "<script>alert('Hospital profile not found. Please contact admin.');</script>";
            }

         } else if ($role_id == 3) {
            // Patient
            $pat_sql = "SELECT id FROM patient WHERE user_id = '$user_id' LIMIT 1";
            $pat_result = mysqli_query($conn, $pat_sql);

            if ($pat_result && mysqli_num_rows($pat_result) > 0) {
               $pat_data = mysqli_fetch_assoc($pat_result);
               $_SESSION['patient_id'] = $pat_data['id'];

               echo "<script>window.location.href='http://localhost/covid_webite/patient/index.php';</script>";
            } else {
               echo "<script>alert('Patient profile not found.');</script>";
            }
         }

      } else {
         echo "<script>alert('Incorrect password.');</script>";
      }
   } else {
      echo "<script>alert('User not found.');</script>";
   }
}
?>

<!-- Footer -->
<?php include('./footer.php'); ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
