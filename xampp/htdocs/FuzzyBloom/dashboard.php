<?php
session_start();
include 'config/db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}

$productCount =
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM products")
);

$categoryCount =
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM categories")
);
?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard</title>

<link rel="stylesheet"
href="admin/style.css">

</head>

<body>

<div class="sidebar">

    <a href="#" class="logo">
        Fuzzy Bloom
    </a>

    <div class="menu">

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="admin/categories.php">
            Categories
        </a>

        <a href="admin/products.php">
            Products
        </a>

        <a href="logout.php">
            Logout
        </a>
        <a href="logout.php" class="logout-btn">
            Logout
        </a>

    </div>

</div>

<div class="main">

    <div class="topbar">

        <h1>
            Admin Dashboard
        </h1>

        <h3>
            Welcome
            <?php echo $_SESSION['admin']; ?>
        </h3>

    </div>

    <div class="stats">

        <div class="stat-box">

            <h3>Total Products</h3>

            <p>
                <?php echo $productCount; ?>
            </p>

        </div>

        <div class="stat-box">

            <h3>Total Categories</h3>

            <p>
                <?php echo $categoryCount; ?>
            </p>

        </div>

    </div>

    <div class="card">

        <h2>Quick Access</h2>

        <p>

            Manage your flower collections,
            categories, and products easily.

        </p>

    </div>

</div>

</body>

</html>