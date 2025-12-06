<?php include 'db.php'; ?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Suppliers</title><link rel="stylesheet" href="styles.css"></head><body>
<div class="container">
<h1>Suppliers</h1>
<table><tr><th>Supplier Name</th><th>Contact</th><th>Product Supplied</th></tr>
<?php
$sql = "SELECT s.name AS sname,s.contact,p.name AS pname FROM suppliers s LEFT JOIN products p ON s.product_id=p.product_id";
$res=$cn->query($sql);
while($r=$res->fetch_assoc()){
  echo "<tr><td>{$r['sname']}</td><td>{$r['contact']}</td><td>{$r['pname']}</td></tr>";
}
?>
</table>
<div style="text-align:center"><a class="btn btn-info" href="index.php">Back Home</a></div>
</div></body></html>
