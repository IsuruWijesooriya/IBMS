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
    <title>Users</title>
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
        if (currentURL.indexOf("users.php") !== -1) {
            var myButton = document.getElementById("users");
            if (myButton) {
              //myButton.style.backgroundColor = "#4070f4";
              myButton.style.backgroundColor = "#FF4900";
              myButton.style.borderRadius = "6px";
            }
        }
</script>

<style>
    body {
      font-family: Arial, sans-serif;
    }

    table {
      background-color: white;
      border-collapse: collapse;
      margin: 20px;
    }

    th, td {
      padding: 10px;
      border: 3px solid black;
    }

    th {
      background-color: #f2f2f2;
    }

    td {
      text-align: center;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #ddd;
    }
  </style>

<style>
        .popup {
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            display: none;
        }
        .popup-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            font-size: 15px;
            border: 3px solid black;
            border-radius: 20px;
            width: 30%;
            font-weight: bolder;
        }
        .popup-content button {
            display: block;
            margin: 0 auto;
        }
        .show {
            display: block;
        }
        .btn{
            height: 40px;
            background: #FF4900;
            border-radius: 5px;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            transition: all .3s;
            margin-top: 10px;
            padding: 0px 10px;
        }
        .block-display button{
            margin-bottom:5px;
            display:block;
        }
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 5px;
        }
        input[type=text], input[type=password], input[type=date], input[type=email] {
            width: 100%;
            padding: 5px;
            margin: 5px 0 22px 0;
            font-size: 13px;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }
        input[type=text]:focus, input[type=password]:focus, input[type=date]:focus, input[type=email]:focus {
            background-color: #ddd;
            outline: none;
        }
    </style>

    <nav class="body">
      <div class="container">
        <div class="box" style="min-height: 630px; min-width: 930px; padding: 10px 10px 10px 10px; align-items: right;">
        <table style="">
    <tr>
      <th></th>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Privilege</th>
    </tr>
    <?php
    $sql = "SELECT * FROM users";
    $x=1;
    if ($result1 = $con->query($sql)) {
      while ($row1 = $result1->fetch_assoc()) {
    $id = $row1['id'];
    $fname = $row1['firstname'];
    $lname = $row1['lastname'];
    $email = $row1['email'];
    $privilege = $row1['privilege'];
    if($privilege == 1){
      $p = "Admin";
    }else if($privilege == 2){
      $p = "Employee";
    }
      echo "<tr>";
      echo "<td>$x</td>";
      echo "<td>$id</td>";
      echo "<td>$fname $lname</td>";
      echo "<td>$email</td>";
      echo "<td>$p</td>";
      echo "</tr>";
      $x++;
    }
  }
    ?>
  </table>
        </div>
        <pre>        </pre>
          <div class = "block-display">
            <button type="button" class = "btn" style="min-width: 160px;" id ="adduser"><pre> Add User </pre></button>
            <button type="button" class = "btn" style="min-width: 160px;" id ="deluser"><pre> Delete User </pre></button>
            <button type="button" class = "btn" style="min-width: 160px;" onclick="window.location.href='users.php'" id ="refresh"><pre> Refresh </pre></button>
          </div>
          <pre>         </pre>

          <form method='post' action=''>
          <div id="add" class="popup">
            <div class="popup-content">
              <div style="padding: 0px 0px 0px 310px">
                  <button id="closePopup" class="btn" type="button">
                    <pre> Back </pre>
                  </button>
              </div>
              <h1 style="color:black;">
                  <center><b>Add User</b></center>
              </h1>
              <hr>
                <label for="id"><b>ID Number</b></label>
                <input type="text" placeholder="Enter ID" name="id" id="id" required>
                <label for="fname"><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" name="fname" id="fname" required>
                <label for="lname"><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" name="lname" id="lname" required>
                <label for="fullname"><b>Full Name</b></label>
                <input type="text" placeholder="Full Name" name="fullname" id="fullname" required>
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="email" id="email" required>
                <label for="dob"><b>Date Of Birth</b></label>
                <input type="date" name="dob" id="dob" required>
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" id="username" required>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
                <label for="addrs"><b>Address</b></label>
                <input type="text" placeholder="Enter Address" name="addrs" id="addrs" required>
                <label for="pr"><b>Privilege</b></label>
                <input type="text" placeholder="Enter Privilege" name="pr" id="pr" required>
              <hr>
              <button type="submit" name="register" class="btn">Register</button>
            </div>
          </div>
          </form>

          <?php 
            if(isset($_POST['register'])){
              $id = trim($_POST['id']);
              $fname = trim($_POST['fname']);
              $lname = trim($_POST['lname']);
              $fullname = trim($_POST['fullname']);
              $email = trim($_POST['email']);
              $dob = trim($_POST['dob']);
              $username = trim($_POST['username']);
              $psw = sha1(trim($_POST['psw']));
              $addrs = trim($_POST['addrs']);
              $pr = trim($_POST['pr']);
           
              $isValid = true;
           
              if($id == '' || $fname == '' || $lname == '' || $fullname == '' || $email == '' || $dob == '' || $username == '' || $psw == '' || $addrs == '' || $pr == ''){
                $isValid = false;
                echo '<script>alert("Please fill all fields.")</script>';
              }
           
              if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $isValid = false;
                echo '<script>alert("Invalid Email-ID.")</script>';
              }
           
              if($isValid){
           
                $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                if($result->num_rows > 0){
                  $isValid = false;
                  echo '<script>alert("User is already existed.")</script>';
                }
           
              }
           
              if($isValid){
                $insertSQL = "INSERT INTO `users`(`id`, `firstname`, `lastname`, `fullname` , `email`, `dob`, `username`, `password`, `address`, `privilege`) values(?,?,?,?,?,?,?,?,?,?)";
                $stmt = $con->prepare($insertSQL);
                $stmt->bind_param("ssssssssss",$id,$fname,$lname,$fullname,$email,$dob,$username,$psw,$addrs,$pr);
                $stmt->execute();
                $stmt->close();
                echo '<script>alert("User Addedd successfully.")</script>';
              }
           }
          ?>
 
    <script>
        adduser.addEventListener("click", function () {
            add.classList.add("show");
        });
        closePopup.addEventListener("click", function () {
            add.classList.remove("show");
        });
        window.addEventListener("click", function (event) {
            if (event.target == add) {
                add.classList.remove("show");
            }
        });
    </script>

<form method='post' action=''>
<div id="del" class="popup">
            <div class="popup-content">
              <div style="padding: 0px 0px 0px 310px">
                  <button id="closePopupd" type="button" class="btn">
                    <pre> Back </pre>
                  </button>
              </div>
              <h1 style="color:black;">
                  <center><b>Delete User</b></center>
              </h1>
              <hr>
                <label for="idd"><b>ID Number</b></label>
                <input type="text" placeholder="Enter ID" name="idd" id="idd" required>
              <hr>
              <button type="submit" name="delete" class="btn">Delete</button>
            </div>
          </div>
</form>

<?php 
            if(isset($_POST['delete'])){
              $id = trim($_POST['idd']);
           
              $isValid = true;
           
              if($id == ''){
                $isValid = false;
                echo '<script>alert("Please fill ID.")</script>';
              }
           
              if($isValid){
           
                $stmt = $con->prepare("SELECT * FROM users WHERE id = '$id'");
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                if($result->num_rows > 0){
                  $isValid = true;
                }else{
                  echo '<script>alert("User is not existed.")</script>';
                  $isValid = false;
                }
           
              }
           
              if($isValid){
                $insertSQL = "DELETE FROM `users` WHERE id = '$id'";
                $stmt = $con->prepare($insertSQL);
                $stmt->execute();
                $stmt->close();
                echo '<script>alert("User Deleted successfully.")</script>';
              }
           }
          ?>
 
    <script>
        deluser.addEventListener("click", function () {
            del.classList.add("show");
        });
        closePopupd.addEventListener("click", function () {
            del.classList.remove("show");
        });
        window.addEventListener("click", function (event) {
            if (event.target == del) {
                del.classList.remove("show");
            }
        });
      </script>

      </div>
    </nav>

    <!-- JavaScript -->
    <script src="javascript/script.js"></script>
  </div>
</body>
</html>