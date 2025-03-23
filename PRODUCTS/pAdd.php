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
    <title>Add Product</title>
</head>

<body>
    <form action="" method="post">
        <div class="categoryId">
            <label for="txtCateogryId">Category</label>
            <input type="radio" name="rdCategory" id="rdCategory" value="CPU"> CPU &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="GPU"> GPU &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="Motherboard"> Motherboard &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="RAM"> RAM &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="Cooler"> Cooler &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="Case"> PC Case &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="Storage"> Storage &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="PSU"> PSU &nbsp; &nbsp;
        </div>


        <div class="ProductName">
            <label for="txtProductName">Product Name</label>
            <input type="text" name="txtProductName" id="txtProductName">
        </div>


        <div class="description">
            <label for="txtDescription">Description</label>
            <input type="text" name="txtDescription" id="txtDescription">
        </div>


        <div class="price">
            <label for="txtPrice">Price</label>
            <input type="text" name="txtPrice" id="txtPrice">
        </div>


        <div class="quantity">
            <label for="txtQuantity">Quantity</label>
            <input type="text" name="txtQuantity" id="txtQuantity">
        </div>


        <div class="image">
            <label for="txtImage">Image</label>
            <input type="text" name="txtImage" id="txtImage">
        </div>


        <div class="pSubmit">
            <input type="submit" name="submit" id="submit" value="sub">
        </div>
    </form>
    <a href="../USERS/index.php">Home</a>
</body>

</html>