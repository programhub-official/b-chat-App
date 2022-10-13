<?php
include('config/db.php');

session_start();

if (isset($_REQUEST['btn'])) {
    $_SESSION['room'] = $_REQUEST['name'];
    $name = mysqli_real_escape_string($conn,$_REQUEST['name']);
    if (strlen($name)> 15 or strlen($name) < 4) {
        header('Location: index.php');
        $_SESSION['status'] = "Please Choose Room Name between 5 to 15 Characters";
        header('Location: index.php');
    }else {
        $query = "SELECT * FROM rooms WHERE name= '$name'";
        $res = mysqli_query($conn,$query);
        if (mysqli_num_rows($res) > 0) {
            $_SESSION['status'] = "Room Already Created. Choose different room name";
            header('Location: index.php');
        }else {
            $_SESSION['name'] = $name;
            header('Location: user.php');
        }
    }
}

?>