<?php
session_start();
require 'db.php';


$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';


if (!$name) $errors[] = 'Name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email required.';
if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';
if ($password !== $confirm) $errors[] = 'Passwords do not match.';


if (empty($errors)) {
// check existing
$stmt = $mysqli->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
$errors[] = 'Email already registered.';
} else {
$hash = password_hash($password, PASSWORD_DEFAULT);
$ins = $mysqli->prepare('INSERT INTO users (name,email,password) VALUES (?,?,?)');
$ins->bind_param('sss', $name, $email, $hash);
if ($ins->execute()) {
$_SESSION['user_id'] = $mysqli->insert_id;
$_SESSION['user_name'] = $name;
header('Location: dashboard.php');
exit;
} else {
$errors[] = 'Registration failed: ' . $mysqli->error;
}
}
}
}
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register — Student Management System</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<h1>Register</h1>
<?php if($errors): ?>
<div class="errors">
<ul>
<?php foreach($errors as $err): ?>
<li><?php echo e($err); ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>


<form method="post" novalidate>
<label>Name<br><input type="text" name="name" value="<?php echo e($_POST['name'] ?? '') ?>"></label>
<label>Email<br><input type="email" name="email" value="<?php echo e($_POST['email'] ?? '') ?>"></label>
<label>Password<br><input type="password" name="password"></label>
<label>Confirm Password<br><input type="password" name="confirm_password"></label>
<button type="submit">Register</button>
</form>


<p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>