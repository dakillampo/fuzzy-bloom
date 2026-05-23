<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "fuzzybloomdb"
);

if(!$conn){
    die("Connection Failed");
}

?>