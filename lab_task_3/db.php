<?php
$host="localhost"; $user="root"; $pass=""; $db="onlineshop_lab3";
$cn = new mysqli($host,$user,$pass,$db);
if($cn->connect_error) die("DB Conn Error");
$cn->set_charset("utf8mb4");
?>
