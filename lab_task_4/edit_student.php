<?php
session_start();
require 'db.php';
if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }

$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: dashboard.php'); exit; }

$stmt = $mysqli->prepare('SELECT * FROM students WHERE id=? LIMIT 1');
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
$student = $res->fetch_assoc();
if (!$student) { header('Location: dashboard.php'); exit; }

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $roll = trim($_POST['roll_no'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $marks = (int)($_POST['marks'] ?? 0);
    $dept = trim($_POST['department'] ?? '');

    if (!$name) $errors[] = 'Name required.';
    if (!$roll) $errors[] = 'Roll number required.';
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email.';

    if (empty($errors)) {
        $stmt = $mysqli->prepare('UPDATE students SET name=?, roll_no=?, email=?, marks=?, department=? WHERE id=?');
        $stmt->bind_param('sssisi', $name, $roll, $email, $marks, $dept, $id);
        if ($stmt->execute()) {
            header('Location: dashboard.php'); exit;
        } else $errors[] = 'Update failed: '.$mysqli->error;
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Student</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <h1>Edit Student</h1>
  <?php if($errors): ?><div class="errors"><ul><?php foreach($errors as $e) echo "<li>".e($e)."</li>"; ?></ul></div><?php endif; ?>
  <form method="post">
    <label>Name<br><input type="text" name="name" value="<?= e($_POST['name'] ?? $student['name']); ?>"></label>
    <label>Roll No<br><input type="text" name="roll_no" value="<?= e($_POST['roll_no'] ?? $student['roll_no']); ?>"></label>
    <label>Email<br><input type="email" name="email" value="<?= e($_POST['email'] ?? $student['email']); ?>"></label>
    <label>Marks<br><input type="number" name="marks" value="<?= e($_POST['marks'] ?? $student['marks']); ?>"></label>
    <label>Department<br><input type="text" name="department" value="<?= e($_POST['department'] ?? $student['department']); ?>"></label>
    <button type="submit">Update</button>
  </form>
  <p><a href="dashboard.php">⬅ Back to Dashboard</a></p>
</div>
</body>
</html>
