<?php
include('./connection.php');
session_start();
?>



<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial;
            max-width: 500px;
            margin: 40px auto;
            background: #f2f2f2;
            padding: 25px;
            border-radius: 10px;
        }
        label, select, input {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
        }
        button {
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
        }
        .msg {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Login</h1>


    <form method="POST" action="">
      

        <label>User Name:</label>
        <input name="user_name" type="text"  required>

        <label>Password:</label>
        <input  type="password" name="password" required>

        

        <button type="submit" >Login</button>
        <br><br>
        <span>Go on register page <a href="register.php">Go</a></span>
    </form>
    <?php
include('./connection.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST["user_name"];
    $password = $_POST["password"];
   

    $sql ="SELECT * FROM `user_credentials` WHERE username='$username'";
    $query = mysqli_query($conn,$sql);
    if($query){
        echo "
        <script>
        alert('Account Created Successfully')
        window.location.href='http://localhost:82/COVID/frontend/login.php'
        </script>
        ";
    }
}
?>
</body>
</html>
