<?php

session_start();

include '../config/db.php';

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

if(isset($_POST['add_product'])){

    $name = $_POST['product_name'];

    $description = $_POST['description'];

    $price = $_POST['price'];

    $category = $_POST['category'];

    $image = $_FILES['image']['name'];

    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file(
        $temp,
        "../uploads/".$image
    );

    mysqli_query($conn,

    "INSERT INTO products(

    category_id,
    product_name,
    product_description,
    product_price,
    product_image

    )

    VALUES(

    '$category',
    '$name',
    '$description',
    '$price',
    '$image'

    )");
}

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    mysqli_query($conn,

    "DELETE FROM products
    WHERE product_id='$id'");
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Products</title>

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

        <h1>Products</h1>

    </div>

    <div class="card">

        <h2>Add Product</h2>

        <form method="POST"
        enctype="multipart/form-data">

            <input
            type="text"
            name="product_name"
            placeholder="Product Name">

            <textarea
            name="description"
            placeholder="Description"></textarea>

            <input
            type="number"
            step="0.01"
            name="price"
            placeholder="Price">

            <select name="category">

                <?php

                $cat = mysqli_query($conn,
                "SELECT * FROM categories");

                while($c =
                mysqli_fetch_assoc($cat)){

                ?>

                <option
                value="<?php echo $c['category_id']; ?>">

                <?php echo $c['category_name']; ?>

                </option>

                <?php
                }
                ?>

            </select>

            <input
            type="file"
            name="image">

            <button name="add_product">

                Add Product

            </button>

        </form>

    </div>

    <div class="card">

        <h2>Product List</h2>

        <table class="table">

            <tr>

                <th>Image</th>

                <th>Name</th>

                <th>Category</th>

                <th>Price</th>

                <th>Action</th>

            </tr>

            <?php

            $query = mysqli_query($conn,

            "SELECT products.*,
            categories.category_name

            FROM products

            LEFT JOIN categories
            ON products.category_id =
            categories.category_id");

            while($row =
            mysqli_fetch_assoc($query)){

            ?>

            <tr>

                <td>

                    <img
                    src="../uploads/<?php echo $row['product_image']; ?>">

                </td>

                <td>

                    <?php echo $row['product_name']; ?>

                </td>

                <td>

                    <?php echo $row['category_name']; ?>

                </td>

                <td>

                    AED
                    <?php echo $row['product_price']; ?>

                </td>

                <td>

                    <a
                    class="delete-btn"
                    href="?delete=<?php echo $row['product_id']; ?>">

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