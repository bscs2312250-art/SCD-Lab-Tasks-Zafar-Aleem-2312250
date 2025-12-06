<?php
session_start();
require 'db.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter a valid email.';
if (!$password) $errors[] = 'Enter password.';


if (empty($errors)) {
$stmt = $mysqli->prepare('SELECT id, name, password FROM users WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 1) {
$stmt->bind_result($id, $name, $hash);
$stmt->fetch();
if (password_verify($password, $hash)) {
session_regenerate_id(true);
$_SESSION['user_id'] = $id;
$_SESSION['user_name'] = $name;
header('Location: dashboard.php');
exit;
} else {
$errors[] = 'Incorrect password.';
}
} else {
$errors[] = 'No user found with that email.';
}
}
}
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login — Student Management System</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<h1>Login</h1>
<?php if($errors): ?>
<div class="errors"><ul><?php foreach($errors as $err) echo '<li>'.e($err).'</li>'; ?></ul></div>
<?php endif; ?>
<form method="post" novalidate>
<label>Email<br><input type="email" name="email" value="<?php echo e($_POST['email'] ?? '') ?>"></label>
<label>Password<br><input type="password" name="password"></label>
<button type="submit">Login</button>
</form>
<p>Don't have account? <a href="register.php">Register</a></p>
</div>
</body>
</html>