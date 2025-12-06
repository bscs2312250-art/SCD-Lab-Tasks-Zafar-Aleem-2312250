<?php
session_start();
require 'db.php';
if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }

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
        $stmt = $mysqli->prepare('INSERT INTO students (name,roll_no,email,marks,department) VALUES (?,?,?,?,?)');
        $stmt->bind_param('sssis', $name, $roll, $email, $marks, $dept);
        if ($stmt->execute()) {
            header('Location: dashboard.php'); exit;
        } else $errors[] = 'Insert failed: '.$mysqli->error;
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Student</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <h1>Add Student</h1>
  <?php if($errors): ?><div class="errors"><ul><?php foreach($errors as $e) echo "<li>".e($e)."</li>"; ?></ul></div><?php endif; ?>
  <form method="post">
    <label>Name<br><input type="text" name="name" value="<?= e($_POST['name'] ?? '') ?>"></label>
    <label>Roll No<br><input type="text" name="roll_no" value="<?= e($_POST['roll_no'] ?? '') ?>"></label>
    <label>Email<br><input type="email" name="email" value="<?= e($_POST['email'] ?? '') ?>"></label>
    <label>Marks<br><input type="number" name="marks" value="<?= e($_POST['marks'] ?? 0) ?>"></label>
    <label>Department<br><input type="text" name="department" value="<?= e($_POST['department'] ?? '') ?>"></label>
    <button type="submit">Add</button>
  </form>
  <p><a href="dashboard.php">⬅ Back to Dashboard</a></p>
</div>
</body>
</html>
