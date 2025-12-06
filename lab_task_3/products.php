<?php include 'db.php'; ?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Products</title><link rel="stylesheet" href="styles.css"></head><body>
<div class="container">
<h1>Products</h1>
<table><tr><th>Product ID</th><th>Product Name</th><th>Category</th><th>Price (PKR)</th></tr>
<?php
$sql = "SELECT p.product_id,p.name AS pname,p.price,c.category_name FROM products p LEFT JOIN categories c ON p.category_id=c.category_id";
$res=$cn->query($sql);
while($r=$res->fetch_assoc()){
  echo "<tr><td>{$r['product_id']}</td><td>{$r['pname']}</td><td>{$r['category_name']}</td><td>".number_format($r['price'],2)."</td></tr>";
}
?>
</table>
<div style="text-align:center"><a class="btn btn-info" href="index.php">Back Home</a></div>
</div></body></html>
