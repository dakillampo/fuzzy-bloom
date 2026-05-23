<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}
?>

<?php
include '../config/db.php';

if(isset($_POST['add'])){

    $category = $_POST['category'];

    mysqli_query($conn,
    "INSERT INTO categories(category_name)
    VALUES('$category')");
}
?>

<form method="POST">

<input type="text" name="category">

<button name="add">Add Category</button>

</form>