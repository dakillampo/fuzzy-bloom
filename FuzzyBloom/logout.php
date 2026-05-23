<?php
session_start();

// destroy login session
unset($_SESSION['admin']);
session_destroy();

// redirect to homepage (index interface)
header("Location: index.php");
exit();
?>