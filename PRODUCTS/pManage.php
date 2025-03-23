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
        <!-- PreBuilt Section -->
        <section id="prebuilt" class="product-section">
            <div class="section-header">
                <h2>Pre-Built</h2>
            </div>
            <div class="productbig">
                <?php
                while ($category = $catResult->fetch_assoc()) {
                    $cat = $category["category"];
                    //prebuilt
                    $sql = "SELECT * FROM products where category = '$cat'";
                    $prebuilt = $db->query($sql);
                    if ($db->errno > 0) {
                        die(
                            "Error number: " . $db->errno . "<br>" .
                            "Error message: " . $db->error
                        );
                    }
                    echo "<div class='Categories'>";
                    while ($pc = $prebuilt->fetch_assoc()):
                        $id = $pc["id"];
                        echo "<div class='product2'>";
                        echo "<img src='../PRODUCTS/images/" . $pc["image"] . "' alt='Product Image'>";
                        echo "<div class='details'>";
                        echo "<div class='col-01'>" . $pc["name"] . "</div>";
                        echo "<div class='col-02'><span class='label'>Description:</span> " . $pc["description"] . "</div>";
                        echo "<div class='col-03'><span class='label'>Price:</span> $" . $pc["price"] . "</div>";
                        echo "<a class='action-link' href='../products/pUpdate.php?id=$id'>Edit</a>";
                        echo "<a class='action-link' href='../products/pDelete.php?id=$id'>Delete</a>";
                        echo "</div>";
                        echo "</div>";
                    endwhile;
                    echo "</div>";
                }
                ?>
            </div>
        </section>
    </div>
</body>

</html>