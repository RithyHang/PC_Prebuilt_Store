<?php
$category = "";
$pName = "";
$description = "";
$price = "";
$qty = "";
if (isset($_POST["submit"])) {



    // connect to databas
    $db = mysqli_connect("localhost", "root", '', "pc_store_db");

    if ($db->connect_errno > 0) {
        die(
            "Error number: " . $db->connect_errno . "<br>" .
            "Error message: " . $db->connect_error
        );
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Product</title>
    <link rel="stylesheet" href="../CSS section/pManage.css">
    <script defer src="../Java Section/pManage.js"></script>
</head>
<body>
    <h1>Manage Product</h1>
    <!-- Buttons for Add and Update -->
    <div class="button-container">
        <button class="menu-toggle">Add Product</button>
        <button class="update-btn">Update Product</button>
    </div>

    <!-- Sliding and Fading Add Product Form -->
    <div class="fade-menu">
        <button class="back-btn">Back</button>
        <form action="" method="post">
            <div class="categoryId">
                <label for="txtCateogryId">Category</label>
                <input type="radio" name="rdCategory" value="CPU"> CPU
                <input type="radio" name="rdCategory" value="GPU"> GPU
                <input type="radio" name="rdCategory" value="Motherboard"> Motherboard
                <input type="radio" name="rdCategory" value="RAM"> RAM
                <input type="radio" name="rdCategory" value="Cooler"> Cooler
                <input type="radio" name="rdCategory" value="Case"> PC Case
                <input type="radio" name="rdCategory" value="Storage"> Storage
                <input type="radio" name="rdCategory" value="PSU"> PSU
            </div>

            <div class="ProductName">
                <label for="txtProductName">Product Name</label>
                <input type="text" name="txtProductName">
            </div>

            <div class="description">
                <label for="txtDescription">Description</label>
                <input type="text" name="txtDescription">
            </div>

            <div class="price">
                <label for="txtPrice">Price</label>
                <input type="text" name="txtPrice">
            </div>

            <div class="quantity">
                <label for="txtQuantity">Quantity</label>
                <input type="text" name="txtQuantity">
            </div>

            <div class="pSubmit">
                <input type="submit" name="submit" id="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>