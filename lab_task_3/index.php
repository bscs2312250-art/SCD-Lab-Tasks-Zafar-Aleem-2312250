<?php include 'db.php'; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Online Shop - Home</title>
<link rel="stylesheet" href="styles.css"></head><body>
<div class="container">
<h1>Welcome to Online Shopping Management System</h1>
<?php
$res = $cn->query("SELECT * FROM customers");
echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th></tr>";
while($r=$res->fetch_assoc()){
  echo "<tr><td>{$r['customer_id']}</td><td>{$r['name']}</td><td>{$r['email']}</td><td>{$r['phone']}</td></tr>";
}
echo "</table>";
?>
<div class="btns">
  <a class="btn btn-info" href="orders.php">View Orders</a>
  <a class="btn btn-primary" href="products.php">View Products</a>
  <a class="btn btn-warning" href="suppliers.php">View Suppliers</a>
</div>
</div>
</body></html>
