<?php

include('config/db.php');
session_start();

$query = "SELECT * FROM rooms";

$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $res0 = "<b>Active Rooms: </b>";
        $res = "<b>". strlen($row['power']) + strlen($row['power']) . "</b>";
    }
    echo $res0;
    echo $res;
}
?>