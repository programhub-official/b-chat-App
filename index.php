<?php
session_start();

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
    <div class="text-center mb-3">
        <img class="mb-4" src="images/logo.ico" alt="" width="100" height="100">
        <h3 class="wh">B-ChatApp</h3>
        <h6 class="wh"><b>Official Developer: Babar</b></h6>
    </div>
    <form action="auth-room.php" class="form-signin" method="post">
        <div class="text-center mb-4">
            <label class="wh" for="inputText"><b>Create Room To Chat</b></label>
            <input type="text" id="inputText" class="form-control mb-3" name="name" placeholder="Room Name" required>
            <?php
            if (isset($_SESSION['status'])) {
                echo "<b class='wh' >". $_SESSION['status'] . "</b><br>";
                unset($_SESSION['status']);
            }
            ?>
            <button type="submit" class="btn btn-primary btn-block" name="btn" >Start Chat</button>
        </div>
    </form>
    <footer class="wh">
        <div class="container">
            <div class="anyClass">
            </div>
        </div>
    </footer>
</body>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/jquery.js"></script>

<script>
     setInterval(() => {
      $.post('active_rooms.php',
      function(data,status) {
        document.getElementsByClassName('anyClass')[0].innerHTML = data;
      }
      );
    }, 1000);

</script>
</html>