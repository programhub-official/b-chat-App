<?php

include('config/db.php');
session_start();

$room = mysqli_real_escape_string($conn,$_POST['room']);
$query = "SELECT msg,username,created_at FROM chats WHERE room_name='$room'";

$res = '';
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $res = $res . '<article class="msg-container msg-remote" id="msg-0"><div class="msg-box"><div class="flr"><div class="messages"><p class="msg" id="msg-0">';
        $res = $res . $row['msg'];
        $res = $res . '</p></div><span class="timestamp"><span class="username">';
        $res = $res . "<b>". $row['username'] . "</b>";
        $res = $res . '</span>&bull;<span class="posttime">';
        $res = $res . $row['created_at'];
        $res = $res . '</span></span></div></div></article>';
    }
    echo $res;
}
?>