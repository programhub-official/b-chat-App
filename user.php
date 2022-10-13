<?php

include('config/db.php');

session_start();


if (isset($_SESSION['cmd'])) {
    if (isset($_REQUEST['donebtn'])) {
        $username = mysqli_real_escape_string($conn,$_REQUEST['username']);
        if ($username != '') {
            $_SESSION['user'] = $username;
            header('Location: group.php');
        }
    }
}

if (isset($_REQUEST['donebtn'])) {
    if (isset($_SESSION['name'])) {
        $username = mysqli_real_escape_string($conn,$_REQUEST['username']);
        if ($username != '') {
            $name = $_SESSION['name'];
            $_SESSION['user'] = $username;
            $rand_int = rand(100000000000000,999999999999999);
            $query = "INSERT INTO rooms(name,room_id,username,power)VALUES('$name','$rand_int','$username','1')";
            if (mysqli_query($conn,$query)) {
                echo "<script>";
                echo 'window.location="http://localhost/php/project/chatApp/room.php?room-id='. $rand_int . ' ";';
                echo "</script>";
            }
        }
    }else {
        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.ico" type="image/gif"/>
    <title>B-ChatApp </title>
</head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="bootstrap/css/index.css">
<body>
    <div class="text-center mb-4">
        <img class="mb-4" src="images/logo.ico" alt="" width="100" height="100">
        <h3 class="wh">B-ChatApp</h3>
        <h6 class="wh"><b>Official Developer: Babar</b></h6>
    </div>
    <form action="user.php" class="form-signin" method="post">
        <div class="text-center mb-4">
            <label class="wh" for="inputText"><b>Your Name</b></label>
            <input type="text" id="inputText" class="form-control mb-3" name="username" placeholder="Enter Name" required>
            <button type="submit" class="btn btn-primary btn-block" name="donebtn" >Done</button>
        </div>
    </form>
</body>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/jquery.js"></script>
</html>