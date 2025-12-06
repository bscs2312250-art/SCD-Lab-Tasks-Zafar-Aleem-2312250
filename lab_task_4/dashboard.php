<?php
session_start();
require 'db.php';
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Search & Sort
$q = trim($_GET['q'] ?? '');
$sort = $_GET['sort'] ?? 'name_asc';
$valid_sorts = ['name_asc', 'name_desc', 'marks_asc', 'marks_desc'];
if (!in_array($sort, $valid_sorts)) $sort = 'name_asc';

$order_sql = match($sort) {
    'name_desc' => 'name DESC',
    'marks_asc' => 'marks ASC',
    'marks_desc' => 'marks DESC',
    default => 'name ASC'
};

$sql = 'SELECT * FROM students';
$params = [];

if ($q !== '') {
    $sql .= ' WHERE name LIKE ? OR roll_no LIKE ?';
    $like = "%$q%";
    $params = [$like, $like];
}

$sql .= " ORDER BY $order_sql";
$stmt = $mysqli->prepare($sql);
if ($params) $stmt->bind_param('ss', $params[0], $params[1]);
$stmt->execute();
$result = $stmt->get_result();
$students = $result->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <header class="top">
    <h1>Dashboard</h1>
    <div>Welcome, <?= e($_SESSION['user_name']); ?> | <a href="logout.php">Logout</a></div>
  </header>

  <nav class="actions">
    <a class="btn" href="add_student.php">➕ Add Student</a>
    <form method="get" class="searchform">
      <input type="text" name="q" placeholder="Search name or roll" value="<?= e($q); ?>">
      <select name="sort">
        <option value="name_asc" <?= $sort==='name_asc'?'selected':''; ?>>Name ↑</option>
        <option value="name_desc" <?= $sort==='name_desc'?'selected':''; ?>>Name ↓</option>
        <option value="marks_asc" <?= $sort==='marks_asc'?'selected':''; ?>>Marks ↑</option>
        <option value="marks_desc" <?= $sort==='marks_desc'?'selected':''; ?>>Marks ↓</option>
      </select>
      <button type="submit">Search</button>
    </form>
  </nav>

  <table class="list">
    <thead>
      <tr><th>ID</th><th>Name</th><th>Roll No</th><th>Email</th><th>Marks</th><th>Department</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php if (!$students): ?>
        <tr><td colspan="7">No students found.</td></tr>
      <?php else: foreach($students as $s): ?>
        <tr>
          <td><?= e($s['id']); ?></td>
          <td><?= e($s['name']); ?></td>
          <td><?= e($s['roll_no']); ?></td>
          <td><?= e($s['email']); ?></td>
          <td><?= e($s['marks']); ?></td>
          <td><?= e($s['department']); ?></td>
          <td>
            <a href="edit_student.php?id=<?= e($s['id']); ?>">Edit</a> |
            <a href="delete_student.php?id=<?= e($s['id']); ?>" onclick="return confirm('Delete this student?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>
