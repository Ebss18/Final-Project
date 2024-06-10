<?php
include('db.php');
session_start();

$id = $_GET['id'];
$sql = "DELETE FROM recipes WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    header("location: inventory.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
