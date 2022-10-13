<?php

include('config/db.php');
session_start();

// Reset Room
if (isset($_REQUEST['res'])) {
    $room_name = mysqli_real_escape_string($conn,$_SESSION['name']);
    echo $room_name;
    $query = "DELETE FROM rooms WHERE name='$room_name'";
    mysqli_query($conn,$query);
    header('Location: index.php');
}

// Rest All Chattings
if (isset($_REQUEST['del'])) {
    $room_name = mysqli_real_escape_string($conn,$_SESSION['name']);
    $query = "DELETE FROM chats WHERE room_name='$room_name' ";
    mysqli_query($conn,$query);
    $room_id = $_SESSION['paraold'];
    echo "<script>";
    echo 'window.location="http://localhost/php/project/chatApp/room.php?room-id='. $room_id . ' ";';
    echo "</script>";
}

// Redirect New Room
if (isset($_REQUEST['new'])) {
    header('Location: index.php');
}


// Enter Old Room
if (isset($_REQUEST['donebtn'])) {
    $username = mysqli_real_escape_string($conn,$_REQUEST['username']);
    $name = $_SESSION['name'];
    $rand_int = $_SESSION['para'];
    if ($username != '') {
        $_SESSION['user'] = $username;
        $query = "INSERT INTO rooms(name,room_id,username)VALUES('$name','$rand_int','$username')";
        mysqli_query($conn,$query);
        echo "<script>";
        echo 'window.location="http://localhost/php/project/chatApp/room.php?room-id='. $rand_int . ' ";';
        echo "</script>";
    }
    unset($_SESSION['cmd']);
    unset($_SESSION['para']);
}

// Room Password
if (isset($_REQUEST['pas'])) {
    $_SESSION['password'] = $_REQUEST['password'];
    header('Location: user.php');
}
?>