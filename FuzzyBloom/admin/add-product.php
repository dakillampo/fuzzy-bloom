<h2>Add Product</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Product Name</label><br>
    <input type="text" name="product_name"><br><br>

    <label>Description</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Price</label><br>
    <input type="number" step="0.01" name="price"><br><br>

    <label>Category</label><br>

    <select name="category">

        <?php

        $catQuery = mysqli_query($conn,
        "SELECT * FROM categories");

        while($cat = mysqli_fetch_assoc($catQuery)){

            ?>

            <option value="<?php echo $cat['category_id']; ?>">

                <?php echo $cat['category_name']; ?>

            </option>

            <?php
        }

        ?>

    </select>

    <br><br>

    <label>Product Image</label><br>
    <input type="file" name="image"><br><br>

    <button name="add_product">
        Add Product
    </button>

</form>

<?php

if(isset($_POST['add_product'])){

    $name = $_POST['product_name'];

    $description = $_POST['description'];

    $price = $_POST['price'];

    $category = $_POST['category'];

    // IMAGE

    $image = $_FILES['image']['name'];

    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file(
        $temp,
        "../uploads/".$image
    );

    // INSERT DATABASE

    $query = "INSERT INTO products(

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

    )";

    mysqli_query($conn, $query);

    echo "Product Added Successfully";
}
?>