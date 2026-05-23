<?php
session_start();
include 'config/db.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,
    "SELECT * FROM admins
    WHERE username='$username'
    AND password='$password'");

    if(mysqli_num_rows($query) > 0){

        $_SESSION['admin'] = $username;

        header("Location: dashboard.php");

    }else{
        echo "Invalid Login";
    }
}
?>

<h2>Fuzzy Bloom Login</h2>

<form method="POST">

    Username<br>
    <input type="text" name="username"><br><br>

    Password<br>
    <input type="password" name="password"><br><br>

    <button name="login">Login</button>

</form>