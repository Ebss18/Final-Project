<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Inventory</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container inventory-container"> 
        <h2>Recipe Sharing Platform</h2>
        <div class="header-buttons">
            <a href="create_item.html" class="button">Add New Recipe</a>
            <button class="logout-button" onclick="showLogoutConfirmation()">Logout</button>
        </div>
        <table>
            <tr>
                <th>Recipe Name</th>
                <th>Ingredients</th>
                <th>Procedures</th>
                <th>Actions</th>
            </tr>
            <?php
            include('db.php');
            session_start();
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                header("location: log_in.html");
                exit;
            }

            $sql = "SELECT * FROM recipes";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ingredients']) . "</td>";
                echo "<td>" . htmlspecialchars($row['procedures']) . "</td>";
                echo "<td>
                    <a href='update_item.php?id=" . $row['id'] . "'>Edit</a> |
                    <a href='#' onclick='showConfirmation(" . $row['id'] . ")'>Delete</a>
                </td>";
                echo "</tr>";
            }

            mysqli_close($conn);
            ?>
        </table>
    </div>

    <div id="confirmationDialog" class="confirmation-dialog">
        <div class="confirmation-content">
            <p>Are you sure you want to delete this recipe?</p>
            <button onclick="deleteItem()">Yes</button>
            <button onclick="hideConfirmation()">No</button>
        </div>
    </div>

    <div id="logoutConfirmationDialog" class="confirmation-dialog">
        <div class="confirmation-content">
            <p>Are you sure you want to logout?</p>
            <button onclick="logout()">Yes</button>
            <button onclick="hideLogoutConfirmation()">No</button>
        </div>
    </div>

    <script>
        function showConfirmation(id) {
            var dialog = document.getElementById('confirmationDialog');
            dialog.style.display = 'block';
            dialog.dataset.itemId = id;
        }

        function hideConfirmation() {
            document.getElementById('confirmationDialog').style.display = 'none';
        }

        function deleteItem() {
            var id = document.getElementById('confirmationDialog').dataset.itemId;
            window.location.href = 'delete_item.php?id=' + id;
        }

        function showLogoutConfirmation() {
            var logoutDialog = document.getElementById('logoutConfirmationDialog');
            logoutDialog.style.display = 'block';
        }

        function hideLogoutConfirmation() {
            document.getElementById('logoutConfirmationDialog').style.display = 'none';
        }

        function logout() {
            // Perform logout action here, such as redirecting to logout script
            window.location.href = 'log_out.php';
        }
    </script>
</body>
</html>
