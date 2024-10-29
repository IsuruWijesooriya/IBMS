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
    <link rel="stylesheet" href="style/ai.css">
    <link rel="stylesheet" href="style/stylenav.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="favicon1.ico">
    <title>Ai</title>
</head>

<style>
        .chat-container {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
        }

        .user-message, .bot-message {
            max-width: 80%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .user-message {
            background-color: #007bff;
            color: #fff;
            align-self: flex-end;
        }

        .bot-message {
            background-color: #eee;
            color: #333;
            align-self: flex-start;
        }

        .input-container {
            display: flex;
            margin-top: 20px;
        }

        #userInput {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        #sendButton {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
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
        if (currentURL.indexOf("ai.php") !== -1) {
            var myButton = document.getElementById("ai");
            if (myButton) {
              //myButton.style.backgroundColor = "#4070f4";
              myButton.style.backgroundColor = "#FF4900";
              myButton.style.borderRadius = "6px";
            }
        }
</script>

<nav class="body">
  <div class="container1">
    <div class="box" style="height: 630px; width: 1130px; padding: 10px; align-items: right;">
      <div class="chat-container" id="chatContainer"></div>
      <div class="input-container">
        <input type="text" id="userInput" placeholder="Type a message...">
        <button id="sendButton">Send</button>
      </div>
    </div>
  </div>
</nav>

<script>
  function sendMessage() {
    const userInput = document.getElementById("userInput").value;
    displayMessage(userInput, true);

    const apiEndpoint = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    const apiKey = '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';
    const organizationId = 'org-bcCz8MCmIvfQopRwpBy5JxGz';

    fetch(apiEndpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + apiKey,
        'OpenAI-Organization': organizationId,
      },
      body: JSON.stringify({ prompt: userInput, max_tokens: 50 }),
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      if (data.choices && data.choices.length > 0) {
        displayMessage(data.choices[0].text, false);
      } else {
        throw new Error('Unexpected API response format');
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }

  function displayMessage(message, isUser) {
    const chatContainer = document.getElementById("chatContainer");
    const messageElement = document.createElement("div");
    messageElement.className = isUser ? "user-message" : "bot-message";
    messageElement.textContent = message;
    chatContainer.appendChild(messageElement);
    chatContainer.scrollTop = chatContainer.scrollHeight;
  }

  document.getElementById("sendButton").addEventListener("click", sendMessage);
</script>
</body>
</html>