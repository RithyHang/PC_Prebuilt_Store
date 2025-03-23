<?php
// connect to databas
$db = mysqli_connect("localhost", "root", '', "pc_store_db");

if ($db->connect_errno > 0) {
    die(
        "Error number: " . $db->connect_errno . "<br>" .
        "Error message: " . $db->connect_error
    );
}

//Select every category
$catSql = "SELECT DISTINCT category FROM products";
$catResult = $db->query($catSql);
if ($db->errno > 0) {
    die(
        "Error number: " . $db->errno . "<br>" .
        "Error message: " . $db->error
    );
}
?>
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Product</title>
    <link rel="stylesheet" href="../CSS section/pManage.css">
    <link rel="stylesheet" href="../CSS Section/index.css">
</head>

<body>
    <h1>Product Management</h1>

    <!-- Buttons for Add and Update -->
    <div class="button-container">
        <a href="pAdd.php" class="action-btn">Add Product</a>
        <a href="pUpdate.php" class="action-btn">Update Product</a>
    </div>

    <a href="../USERS/userAccount.php" class="back-btn">Back</a>

    <div class="container">
        <?php
        // Define the desired category order
        $desiredCategories = ['CPU', 'GPU', 'Motherboard', 'RAM', 'Cooler', 'PC Case', 'Storage', 'PSU'];

        foreach ($desiredCategories as $category) {
            // Fetch products for the current category
            $sql = "SELECT * FROM products WHERE category = '$category'";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                // Display the section only if products exist in the category
                echo "<section id='" . strtolower(str_replace(' ', '-', $category)) . "' class='product-section'>";
                echo "<div class='section-header'>";
                echo "<h2>$category</h2>";
                echo "</div>";
                echo "<div class='productbig'>";

                while ($product = $result->fetch_assoc()) {
                    $id = $product["id"]; // Capture product ID for edit/delete actions
                    echo "<div class='product2'>";
                    echo "<img src='../PRODUCTS/images/" . $product["image"] . "' alt='Product Image'>";
                    echo "<div class='details'>";
                    echo "<div class='col-01'>" . $product["name"] . "</div>";
                    echo "<div class='col-02'><span class='label'>Description:</span> " . $product["description"] . "</div>";
                    echo "<div class='col-03'><span class='label'>Price:</span> $" . $product["price"] . "</div>";
                    echo "<a class='action-link' href='pUpdate.php?id=$id'>Edit</a>";
                    echo "<a class='action-link' href='pDelete.php?id=$id'>Delete</a>";
                    echo "</div>";
                    echo "</div>";
                }

                echo "</div>";
                echo "</section>";
            }
        }
        ?>
    </div>
</body>

</html>