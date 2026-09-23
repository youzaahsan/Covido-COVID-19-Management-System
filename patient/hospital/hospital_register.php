

<?php
include('../connection.php'); // database connection

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $reg_no = $_POST['registration_no'];
    $password = $_POST['password'];

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM hospital WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "❌ Email already registered.";
    } else {
        // Insert hospital data with default status = Pending
        $insert = mysqli_query($conn, "INSERT INTO hospital (name, email, phone, address, registration_no, register_date, password, status) 
        VALUES ('$name', '$email', '$phone', '$address', '$reg_no', CURDATE(), '$password', 'Pending')");

        if ($insert) {
            $success = "✅ Registered successfully. Wait for admin approval.";
        } else {
            $error = "❌ Something went wrong.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Register</title>
    <style>
        body {
            background: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial;
        }
        .register-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            width: 400px;
        }
        .register-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .register-box input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .register-box button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        .register-box .message {
            margin-top: 10px;
            text-align: center;
            font-weight: bold;
        }
        .register-box .error {
            color: red;
        }
        .register-box .success {
            color: green;
        }
    </style>
</head>
<body>
<div class="register-box">
    <h2>Hospital Register</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Hospital Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="registration_no" placeholder="Registration Number" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <div class="message">
        <?php 
            if ($success) echo "<p class='success'>$success</p>";
            if ($error) echo "<p class='error'>$error</p>";
        ?>
    </div>
</div>
</body>
</html>
