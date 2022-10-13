<?php

$host = '127.0.0.1';
$user = 'root';
$passwd = '';
$db_name = 'b-chat';

$conn = mysqli_connect($host,$user,$passwd,$db_name);
if (!$conn) {
    die('Database Connection ERROR 500');
}

?>