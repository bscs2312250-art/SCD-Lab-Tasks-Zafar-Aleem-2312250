<?php
// db.php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'student_management';


$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
die('DB connect error: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');


// helper: escape output for HTML
function e($str) {
return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}