<?php
session_start();
include("db.php");

if (isset($_POST['taskId']) && isset($_POST['taskId1'])) {
    $taskId = $_POST['taskId'];
    $taskId1 = $_POST['taskId1'];
    
    $sql2 = "SELECT * FROM msg WHERE (sender = '$taskId' AND reciever = '$taskId1') OR (sender = '$taskId1' AND reciever = '$taskId') ORDER BY datetime ASC";
    $result2 = $con->query($sql2);

    $usql = "UPDATE `msg` SET `tic`='1' WHERE sender = '$taskId' AND reciever = '$taskId1'";
    $stmt = $con->prepare($usql);
    $stmt->execute();
    $stmt->close();

    $messages = array();
    $sender = array();
    $datetime = array();

    while($row2 = $result2->fetch_assoc()){
        $messages[] = $row2['msg'];
        $sender[] = $row2['sender'];
        $datetime[] = $row2['datetime'];
    }

    $response = array(
        'msg' => $messages,
        'sender' => $sender,
        'datetime' => $datetime
    );

    echo json_encode($response);
}
?>

