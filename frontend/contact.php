<?php
include('./connection.php');

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Form submission logic
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = mysqli_real_escape_string($conn, $_POST["name"]);
    $phone   = mysqli_real_escape_string($conn, $_POST["phone"]);
    $email   = mysqli_real_escape_string($conn, $_POST["email"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    if (!empty($name) && !empty($phone) && !empty($email) && !empty($message)) {
        $query = "INSERT INTO contact_messages (name, phone, email, message)
                  VALUES ('$name', '$phone', '$email', '$message')";
        if (mysqli_query($conn, $query)) {
            $success = "Thank you, $name. Your message has been sent successfully!";
        } else {
            $error = "Database Error: " . mysqli_error($conn);
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Covido</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/responsive.css">
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link rel="stylesheet" href="css/owl.carousel.min.css"> 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">
   <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
</head>

<body class="main-layout inner_page">
   <!-- loader -->
   <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#"/></div>
   </div>

   <!-- header -->
   <?php include('./navbar.php') ?>

   <!-- contact -->
   <div class="contact">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage text_align_left">
                  <h2>Contact Us</h2>
                  <?php if ($success): ?>
                     <div class="alert alert-success"><?php echo $success; ?></div>
                  <?php elseif ($error): ?>
                     <div class="alert alert-danger"><?php echo $error; ?></div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <form id="request" class="main_form" method="POST" action="">
                  <div class="row">
                     <div class="col-md-12">
                        <input class="contactus" placeholder="Full Name" type="text" name="name" required> 
                     </div>
                     <div class="col-md-12">
                        <input class="contactus" placeholder="Phone" type="text" name="phone" required>                          
                     </div>
                     <div class="col-md-12">
                        <input class="contactus" placeholder="Email" type="email" name="email" required> 
                     </div>
                     <div class="col-md-12">
                        <textarea class="textarea" placeholder="Message" name="message" required></textarea>
                     </div>
                     <div class="col-md-12">
                        <button class="send_btn" type="submit">Send Now</button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-md-6">
               <div class="map-responsive">
                  <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="540" frameborder="0" style="border:0; width: 100%;" allowfullscreen></iframe>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- footer -->
   <?php include('./footer.php') ?>

   <!-- JS -->
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
   <script src="js/owl.carousel.min.js"></script>
   <script src="js/custom.js"></script>
</body>
</html>
