<?php
include('db.php');
session_start();

$id = $_GET['id'];
$sql = "SELECT * FROM recipes WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $procedures = $_POST['procedures'];

    $update_sql = "UPDATE recipes SET name='$name', ingredients='$ingredients', procedures='$procedures' WHERE id='$id'";

    if (mysqli_query($conn, $update_sql)) {
        header("location: inventory.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Recipe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Update Recipe</h2>
        <form action="update_item.php?id=<?php echo $id; ?>" method="post">
            <label for="name">Recipe Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
            <label for="ingredients">Ingredients:</label>
            <textarea id="ingredients" name="ingredients" required><?php echo $row['ingredients']; ?></textarea>
            <label for="procedures">Procedures:</label>
            <textarea id="procedures" name="procedures" required><?php echo $row['procedures']; ?></textarea>
            <button type="submit">Update Recipe</button>
        </form>
    </div>
</body>
</html>
