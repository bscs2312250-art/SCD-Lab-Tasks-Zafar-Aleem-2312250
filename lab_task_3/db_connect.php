<?php
$host="localhost";
$user="root";
$pass=""; // change if needed
$conn = new mysqli($host,$user,$pass);
if($conn->connect_error) die("Connection error");

$sqls = [];

// create db and use
$sqls[] = "CREATE DATABASE IF NOT EXISTS onlineshop_lab3 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
$sqls[] = "USE onlineshop_lab3";

// tables
$sqls[] = "CREATE TABLE IF NOT EXISTS customers(
  customer_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  phone VARCHAR(30)
) ENGINE=InnoDB";

$sqls[] = "CREATE TABLE IF NOT EXISTS categories(
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(100)
) ENGINE=InnoDB";

$sqls[] = "CREATE TABLE IF NOT EXISTS products(
  product_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  price DECIMAL(10,2),
  category_id INT,
  FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL
) ENGINE=InnoDB";

$sqls[] = "CREATE TABLE IF NOT EXISTS orders_table(
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT,
  order_date DATE,
  FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE
) ENGINE=InnoDB";

$sqls[] = "CREATE TABLE IF NOT EXISTS order_items(
  item_id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  product_id INT,
  quantity INT,
  FOREIGN KEY (order_id) REFERENCES orders_table(order_id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
) ENGINE=InnoDB";

$sqls[] = "CREATE TABLE IF NOT EXISTS suppliers(
  supplier_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  contact VARCHAR(100),
  product_id INT,
  FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE SET NULL
) ENGINE=InnoDB";

// inserts: customers (10)
$sqls[] = "INSERT INTO customers (name,email,phone) VALUES
('Ahmed','ahmed@example.com','0300-1111111'),
('Sara','sara@example.com','0300-2222222'),
('Omar','omar@example.com','0300-3333333'),
('Laila','laila@example.com','0300-4444444'),
('Zain','zain@example.com','0300-5555555'),
('Maya','maya@example.com','0300-6666666'),
('Irfan','irfan@example.com','0300-7777777'),
('Nida','nida@example.com','0300-8888888'),
('Bilal','bilal@example.com','0300-9999999'),
('Ayesha','ayesha@example.com','0310-0000000')";

// categories (5)
$sqls[] = "INSERT INTO categories (category_name) VALUES
('Electronics'),('Clothing'),('Home Appliances'),('Books'),('Sports')";

// products (5) each assigned a category
$sqls[] = "INSERT INTO products (name,price,category_id) VALUES
('Smartphone X',60000.00,1),
('T-Shirt Casual',1200.00,2),
('Microwave Oven',15000.00,3),
('Novel: The Journey',800.00,4),
('Football',1800.00,5)";

// suppliers (5)
$sqls[] = "INSERT INTO suppliers (name,contact,product_id) VALUES
('Tech Distributors','tech@dist.com, 0321-1111111',1),
('Cloth World','cloth@world.com, 0321-2222222',2),
('Home Equip','home@equip.com, 0321-3333333',3),
('Book House','books@house.com, 0321-4444444',4),
('Sports Gear','sports@gear.com, 0321-5555555',5)";

// orders (5)
$sqls[] = "INSERT INTO orders_table (customer_id,order_date) VALUES
(1,'2025-09-01'),
(2,'2025-09-05'),
(3,'2025-09-07'),
(4,'2025-09-10'),
(5,'2025-09-12')";

// order_items (at least one or two items per order)
$sqls[] = "INSERT INTO order_items (order_id,product_id,quantity) VALUES
(1,1,1),(1,5,2),
(2,2,3),
(3,3,1),(3,4,2),
(4,1,1),(4,2,1),
(5,4,5),(5,5,1)";

// run all queries
$ok=true;
foreach($sqls as $q){
  if(!$conn->query($q)){
    echo "Error: ".$conn->error."<br>";
    $ok=false;
  }
}

if($ok) echo "<h2>Database and sample data created successfully.</h2><p>Now open <a href='index.php'>index.php</a></p>";
$conn->close();
?>
