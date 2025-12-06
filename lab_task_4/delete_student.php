<?php
session_start();
require 'db.php';
if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }

$id = (int)($_GET['id'] ?? 0);
if ($id) {
    $stmt = $mysqli->prepare('DELETE FROM students WHERE id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
}
header('Location: dashboard.php');
exit;
