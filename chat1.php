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
    <link rel="stylesheet" href="style/chat.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="favicon1.ico">
    <title>Chat</title>
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
        if (currentURL.indexOf("chat1.php") !== -1) {
            var myButton = document.getElementById("chat");
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
        <form action="" enctype="multipart/form-data" method="POST">  
        <br>
        <b>Hi.....</b> 
        <br>
        <input type="text" name="user" id="user" style="width: 200px;" readonly>
          <?php 
          $name=$row['fullname'];
          echo '<script>';
          echo 'document.getElementById("user").value = "' . $name . '";';
          echo '</script>';
          ?>
          <br>
          <br>
          <b>To</b> 
          <br>
          <select name="admin" id="admin" style="width: 200px;" required>
            <option></option>
            <?php 
            $sql = "SELECT * FROM users WHERE privilege=1";
            $result1 = $con->query($sql);
            while ($row1 = $result1->fetch_assoc()) {
                $fullname = $row1['fullname'];
            ?>
            <option>
            <?php
                echo"$fullname\n";
            ?>
            </option>
            <?php
            }
            ?>
          </select>
          <br>
          <br>
          <textarea name="msg" id="msg" style="width: 800px; height: 300px;"></textarea>
          <br>
          <button type="submit" name="send" class="btn">Send</button>
        </form>
        </div>
        &emsp;
        <button type="button" name="register" class="btn" onclick="window.location.href='chat/index.php'">Live Chat</button>
    </nav>
      </div>

    <?php
    if(isset($_POST['send'])){
        $u=trim($_POST['user']);
        $a=trim($_POST['admin']);
        $m=trim($_POST['msg']);

        $isValid = true;

        $sql1="SELECT COUNT(id) as count FROM msg";
        $result3 = $con->query($sql1);
        $row3 = $result3->fetch_assoc();
        $id3 = $row3['id'];
        $id1 = $id3 +1;
 
    if($isValid){
      $insertSQL = "INSERT INTO `msg`(`id`, `sender`, `reciever`, `msg`) VALUES (?,?,?,?)";
      $stmt = $con->prepare($insertSQL);
      $stmt->bind_param("ssss",$id1,$u,$a,$m);
      $stmt->execute();
      $stmt->close();
      echo '<script>alert("Message send successfully.")</script>';
    }
    }
    ?>

    <!-- JavaScript -->
    <script src="javascript/script.js"></script>
  </div>
</body>
</html>