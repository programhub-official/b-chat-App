<?php

include('config/db.php');
session_start();

$msg = mysqli_real_escape_string($conn,$_POST['text']);
$room = mysqli_real_escape_string($conn,$_POST['room']);
$user = mysqli_real_escape_string($conn,$_SESSION['user']);
if ($msg != '') {
    $query = "INSERT INTO chats(msg,username,room_name)VALUES('$msg','$user','$room')";
    $res = mysqli_query($conn,$query);
}

?>