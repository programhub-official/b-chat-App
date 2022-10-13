<?php
session_start();
include('config/db.php');

if (!isset($_SESSION['user'])) {
  $_SESSION['para'] = $_GET['room-id'];
  header('Location: user2.php');
}

if (isset($_GET['room-id'])) {
    $room_id = mysqli_real_escape_string($conn,$_GET['room-id']);
    $query = "SELECT name,power FROM rooms WHERE room_id='$room_id'";
    $res = mysqli_query($conn,$query);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          $name = $row['name'];
          $power = $row['power'];
        }
      }else {
        header('Location: index.php');
        $_SESSION['status'] = "Room Not Exists";
      }
}


if (isset($_GET['room-id'])) {
  $_SESSION['paraold'] = $_GET['room-id'];
  $_SESSION['name'] = $name;
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
<link rel="stylesheet" href="bootstrap/css/room.css">
<body>
  <h3>Room: <i><?php echo  $name ?> </i></h3>
  <section class="chatbox">
    <section class="chat-window">
      <article class="msg-container msg-remote" id="msg-0">
      </article>
      <div class="container">
        <div class="anyClass">
      <article class="msg-container msg-remote" id="msg-0">
        <h3>Welcome To</h3>
        <h4>B-ChatApp</h4>
      </article>  
        </div>
      </div>
    </section>
    <div class="chat-input">
      <input type="text" autocomplete="on" id="msg" placeholder="Type a message" />
      <button name="btn" id="btn">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="rgba(0,0,0,.38)" d="M17,12L12,17V14H8V10H12V7L17,12M21,16.5C21,16.88 20.79,17.21 20.47,17.38L12.57,21.82C12.41,21.94 12.21,22 12,22C11.79,22 11.59,21.94 11.43,21.82L3.53,17.38C3.21,17.21 3,16.88 3,16.5V7.5C3,7.12 3.21,6.79 3.53,6.62L11.43,2.18C11.59,2.06 11.79,2 12,2C12.21,2 12.41,2.06 12.57,2.18L20.47,6.62C20.79,6.79 21,7.12 21,7.5V16.5M12,4.15L5,8.09V15.91L12,19.85L19,15.91V8.09L12,4.15Z" /></svg>
                </button>
</div>
  </section><br>
  <div class="more">
    <form action="code.php" method="post">
      <button type="submit" name="del" id="del" class="btn btn-danger">Reset Chats</button>
      <?php
      if ($power == 1) {
          $_SESSION['active'] = true;
        if (isset($_SESSION['active'])) {
          ?>
          <button type="submit" name="res" class="btn btn-success">Rest Room</button>
        <?php
        unset($_SESSION['active']);
        }
      }else{
        ?>
        <button type="submit" name="new" class="btn btn-success">New Room</button>
        <?php
        unset($_SESSION['active']);
      }
      ?>
    </form>
</div>
</body>


<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/jquery.js"></script>
<script>
  // Check Message Box Empty OR Not ??
  $('.chat-input input').keyup(function(e) {
    if ($(this).val() == '')
        $(this).removeAttr('good');
    else
      $(this).attr('good', '');
  });
  
    // Get the input field
    var input = document.getElementById("msg");

    // Execute a function when the user presses a key on the keyboard
    input.addEventListener("keypress", function(event) {
      // If the user presses the "Enter" key on the keyboard
      if (event.key === "Enter") {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        document.getElementById("btn").click();
      }
    });

    // Message Send
    $("#btn").click(function(e) {
        const msg = $('#msg').val();
        $.post('postmsg.php',{text:msg, room:'<?php  echo $name?>'},
        function(data,status) {
          }
          );
        $('#msg').val('');
    });

    // Fetch Message From Database
    setInterval(() => {
      $.post('fetchmsg.php',{room:'<?php echo $name ?>'},
      function(data,status) {
        document.getElementsByClassName('anyClass')[0].innerHTML = data;
      }
      );
    }, 600);
</script>
</html>