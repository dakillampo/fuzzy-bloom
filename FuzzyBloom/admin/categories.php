<?php

session_start();

include '../config/db.php';

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

if(isset($_POST['add'])){

    $category = $_POST['category'];

    mysqli_query($conn,

    "INSERT INTO categories(category_name)

    VALUES('$category')");
}

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    mysqli_query($conn,

    "DELETE FROM categories
    WHERE category_id='$id'");
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Categories</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="sidebar">

    <a href="#" class="logo">
        Fuzzy Bloom
    </a>

    <div class="menu">

        <a href="../dashboard.php">
            Dashboard
        </a>

        <a href="categories.php">
            Categories
        </a>

        <a href="products.php">
            Products
        </a>

        <a href="../logout.php">
            Logout
        </a>

    </div>

</div>

<div class="main">

    <div class="topbar">

        <h1>Categories</h1>

    </div>

    <div class="card">

        <h2>Add Category</h2>

        <form method="POST">

            <input
            type="text"
            name="category"
            placeholder="Category Name">

            <button name="add">

                Add Category

            </button>

        </form>

    </div>

    <div class="card">

        <h2>Category List</h2>

        <table class="table">

            <tr>

                <th>ID</th>

                <th>Category Name</th>

                <th>Action</th>

            </tr>

            <?php

            $query = mysqli_query($conn,
            "SELECT * FROM categories");

            while($row =
            mysqli_fetch_assoc($query)){

            ?>

            <tr>

                <td>
                    <?php echo $row['category_id']; ?>
                </td>

                <td>
                    <?php echo $row['category_name']; ?>
                </td>

                <td>

                    <a
                    class="delete-btn"
                    href="?delete=<?php echo $row['category_id']; ?>">

                    Delete

                    </a>

                </td>

            </tr>

            <?php
            }
            ?>

        </table>

    </div>

</div>

</body>

</html>