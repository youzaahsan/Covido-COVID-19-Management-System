<?php
include('./connection.php');
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if ($role == "hospital") {
        $query = "INSERT INTO hospitals (name, email, phone, address, created_at, status)
                  VALUES ('$name', '$email', '$phone', '$address', NOW(), 'pending')";
        if (mysqli_query($conn, $query)) {
            $msg = "✅ Hospital registered successfully!";
        } else {
            $msg = "❌ Error: " . mysqli_error($conn);
        }
    } elseif ($role == "patient") {
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $query = "INSERT INTO patients (name, email, phone, dob, gender, address, created_at, approved_test)
                  VALUES ('$name', '$email', '$phone', '$dob', '$gender', '$address', NOW(), 'pending')";
        if (mysqli_query($conn, $query)) {
            $msg = "✅ Patient registered successfully!";
        } else {
            $msg = "❌ Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Combined Registration</title>
    <style>
        body {
            font-family: Arial;
            max-width: 700px;
            margin: 30px auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 12px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        label, select, input {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 8px;
        }
        button {
            background: #28a745;
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        #patient-fields {
            display: none;
        }
        .msg {
            text-align: center;
            padding: 10px;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
    <script>
        function toggleFields(role) {
            var patientFields = document.getElementById("patient-fields");
            if (role === "patient") {
                patientFields.style.display = "block";
            } else {
                patientFields.style.display = "none";
            }
        }
    </script>
</head>
<body>

<h2>Register as Hospital or Patient</h2>

<?php if ($msg != "") echo "<div class='msg'>$msg</div>"; ?>

<form method="POST" action="">
    <label>Register As:</label>
    <select name="role" onchange="toggleFields(this.value)" required>
        <option value="">Select</option>
        <option value="hospital">Hospital</option>
        <option value="patient">Patient</option>
    </select>

    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Phone:</label>
    <input type="text" name="phone" required>

    <label>Address:</label>
    <input type="text" name="address" required>

    <div id="patient-fields">
        <label>Date of Birth:</label>
        <input type="date" name="dob">

        <label>Gender:</label>
        <select name="gender">
            <option value="">Select Gender</option>
            <option>Male</option>
            <option>Female</option>
        </select>
    </div>

    <button type="submit">Register</button>
</form>

</body>
</html>
