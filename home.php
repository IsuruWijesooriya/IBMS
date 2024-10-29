<?php 
   session_start();

   include("db.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
   $id = $_SESSION['id'];
   $result = mysqli_query($con,"SELECT * FROM users WHERE id='$id'") or die("Select Error");
   $row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/stylehome.css">
    <link rel="stylesheet" href="style/stylenav.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="favicon1.ico">
    <title>Home</title>
</head>
<body>
    <nav class="navbar">
      <div class="logo_item">
        
        <img src="logo.jpg">
      <label style="color: var(--white-color);">Dashboard</label>
      </div>
      <a class="navbar_content">
        <i class="bi bi-grid"></i>
        <i class="bx bx-log-out-circle" onclick="window.location.href='logout.php'">Logout</i>
      </a>
    </nav>
    
    <?php
    if($row['privilege'] == 1){
      include 'nav.php';
    }else if($row['privilege'] == 2){
      include 'nav1.php';
    }
     ?>

<script>
        var currentURL = window.location.href;
        if (currentURL.indexOf("home.php") !== -1) {
            var myButton = document.getElementById("home");
            if (myButton) {
              //myButton.style.backgroundColor = "#4070f4";
              myButton.style.backgroundColor = "#FF4900";
              myButton.style.borderRadius = "6px";
            }
        }
</script>

    <nav class="body">
      <div class="container">
        <div class="box" style="min-height: 630px; min-width: 930px; padding: 10px 10px 10px 10px; align-items: right;">
    
        </div>
    </nav>
      </div>

    <!-- JavaScript -->
    <script src="javascript/script.js"></script>
  </div>
</body>
</html>