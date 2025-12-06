<?php include 'db.php'; ?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Orders</title><link rel="stylesheet" href="styles.css"></head><body>
<div class="container">
<h1>All Orders</h1>
<table><tr><th>Order ID</th><th>Customer Name</th><th>Order Date</th><th>Total Quantity</th></tr>
<?php
$sql = "SELECT o.order_id,c.name AS customer,o.order_date,IFNULL(SUM(oi.quantity),0) AS total_qty
FROM orders_table o
LEFT JOIN customers c ON o.customer_id=c.customer_id
LEFT JOIN order_items oi ON o.order_id=oi.order_id
GROUP BY o.order_id
ORDER BY o.order_id";
$res=$cn->query($sql);
while($r=$res->fetch_assoc()){
  echo "<tr><td>{$r['order_id']}</td><td>{$r['customer']}</td><td>{$r['order_date']}</td><td>{$r['total_qty']}</td></tr>";
}
?>
</table>
<div style="text-align:center"><a class="btn btn-info" href="index.php">Back Home</a></div>
</div></body></html>
