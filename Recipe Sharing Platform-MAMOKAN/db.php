<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recipe_sharing_platform";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
