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
    <link rel="stylesheet" href="style/msg.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="favicon1.ico">
    <title>Chat</title>
</head>

<style>
.bttn{
    min-height: 40px;
    min-width: 160px;
    background: #FF4900;
    border-radius: 5px;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    transition: all .3s;
    margin-top: 10px;
    padding: 0px 10px;
}
</style>

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
        if (currentURL.indexOf("chat.php") !== -1) {
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
        <br>
        <form action="" enctype="multipart/form-data" method="POST">  
        <div class="user-notification-container">
        <b class="use" id="user">Hi.. <?php echo $row['fullname']; ?></b>
        <b for="userSelect" class="use">To:
          <select id="userSelect" name="userSelect" onchange="showm('<?php echo $row['fullname']; ?>')">
            <option></option>
            <?php 
            $sql1 = "SELECT * FROM users WHERE fullname != '" . $row['fullname'] . "';";
            $result1 = $con->query($sql1);
            while ($row1 = $result1->fetch_assoc()) {
              $name1 = $row1['fullname'];
            ?>
            <option>
            <?php
              echo"$name1\n";
            ?>
            </option>
            <?php
            }
            ?>
        </select></b>
        <div class="notification-icon" onclick="showPopup()">
        <i class="fas fa-bell"></i>
        </div>
        </div>
        <div id="chat-container">
        <div id="message-box" class="message-box"></div>
        <div id="input-box">
        <input type="text" id="message-input" name="message-input" placeholder="Type your message..." autocomplete="off" required>
        <button type="submit" id="send-button" name="send-button" onclick="showMessage()">Send</button>
        </div>
        </div>
        </form>
        </div>
        &emsp;
        <button type="button" name="register" class="btn" onclick="window.location.href='chat/index.php'">Live Chat</button>
      </div>
      </nav>

    <!-- JavaScript -->
    <script src="javascript/script.js"></script>
  </div>
</body>
</html>

<div class="popup-container" id="popupContainer">
    <div class="popup-content">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <br>
        <?php
        $n = $row['fullname'];
        $sql0 = "SELECT * FROM msg WHERE reciever = '$n' AND tic = '0'";
        $result0 = $con->query($sql0);
        while($row0 = $result0->fetch_assoc()){
          $m = $row0['msg'];
          $s = $row0['sender'];
          ?>
          <label><?php echo $s; ?></label>
          <br>
          <button class="bttn"><?php echo $m; ?></button>
          <br>
          <br>
          <?php
        }
        ?>
    </div>
</div>

<script>
function showPopup() {
    var popupContainer = document.getElementById("popupContainer");
    popupContainer.classList.add("active");
}

function closePopup() {
    var popupContainer = document.getElementById("popupContainer");
    popupContainer.classList.remove("active");
}
</script>

<?php 
if(isset($_POST['send-button'])){
  $n = $row['fullname'];
  $trns = 0;
  $tic = 0;
  $messageinput = trim($_POST['message-input']);
  $userSelect = trim($_POST['userSelect']);
  $isValid = true;
  if($isValid){
    $insertSQL = "INSERT INTO `msg`(`sender`, `reciever`, `msg` , `transmission`, `tic`) values(?,?,?,?,?)";
    $stmt = $con->prepare($insertSQL);
    $stmt->bind_param("sssss",$n,$userSelect,$messageinput,$trns,$tic);
    $stmt->execute();
    $stmt->close();
    echo '<script>
    
    alert(showMessage());
    
    </script>';
    sleep(2);
  }
}
?>

<script>
  function showMessage() {
    var popup = document.createElement('div');
    
    popup.style.position = 'fixed';
    popup.style.top = '50%';
    popup.style.left = '50%';
    popup.style.transform = 'translate(-50%, -50%)';
    popup.style.padding = '20px';
    popup.style.background = '#333';
    popup.style.color = 'white';
    popup.style.borderRadius = '5px';
    popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
    
    var tickIcon = document.createElement('span');
    tickIcon.innerHTML = '✅';
    
    var messageText = document.createElement('p');
    messageText.textContent = 'Message Sent.';
    
    popup.appendChild(tickIcon);
    popup.appendChild(messageText);
    
    document.body.appendChild(popup);
  
    setTimeout(function() {
      document.body.removeChild(popup);
    }, 2000);

  }
</script>

<script>
    function showm(name) {
    var id = document.getElementById("userSelect").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "showm.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var responseText = xhr.responseText;
            var jsonResponse = JSON.parse(responseText);
            var messages1 = jsonResponse.msg;
            var sender1 = jsonResponse.sender;
            var datetime1 = jsonResponse.datetime;
            var messageBox = document.getElementById("message-box");

            messageBox.innerHTML = "";

            for (var i = 0; i < messages1.length; i++) {
                var message = messages1[i];
                var sender = sender1[i];
                var datetime = datetime1[i];
                var messageElement = document.createElement("div");
                messageElement.classList.add("message");
                var messageElement1 = document.createElement("div");
                messageElement1.classList.add("message-time");

                if (sender === id) {
                    messageElement.classList.add("received-message");
                    messageElement1.classList.add("vv");
                } else {
                    messageElement.classList.add("sent-message");
                    messageElement1.classList.add("vv");
                }

                messageElement.innerHTML = message;
                messageElement1.innerHTML = datetime;
                messageBox.appendChild(messageElement1);
                messageBox.appendChild(messageElement);
            }
            messageBox.scrollTop = messageBox.scrollHeight;
        }
    };
    xhr.send("taskId=" + id + "&taskId1=" + name);
}

</script>