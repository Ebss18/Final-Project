<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $procedures = $_POST['procedures'];

    $sql = "INSERT INTO recipes (name, ingredients, procedures) VALUES ('$name', '$ingredients', '$procedures')";
    
    if (mysqli_query($conn, $sql)) {
        // Redirect to the inventory page after successful addition
        header("Location: inventory.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
