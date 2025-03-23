<?php
$category = "";
$name = "";
$description = "";
$price = "";
$qty = "";
$image = "";

// Error messages
$categoryError = "";
$nameError = "";
$descriptionError = "";
$priceError = "";
$qtyError = "";
$imageError = "";
$fileNameNew = "";

$errors = [];
$success = "";


// Connect to the database
$db = mysqli_connect("localhost", "root", '', "pc_store_db");

if ($db->connect_errno > 0) {
    die(
        "Error number: " . $db->connect_errno . "<br>" .
        "Error message: " . $db->connect_error
    );
}


// ----------------------------- Fill Out products Information ---------------------------
{
    // Get user's information
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

  
        $sql = "SELECT * FROM products WHERE id=? LIMIT 1";
        $stmt = $db->prepare($sql );

        if (!$stmt) {  // Check if statement preparation failed
            die("Error in SQL preparation: " . $db->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultSet = $stmt->get_result();

        $product = $resultSet->fetch_assoc();
        $category = $product["category"];
        $name = $product["name"];
        $description = $product["description"];
        $price = $product["price"];
        $qty = $product["qty"];
        $image = $product["image"];
    }
}

// Add product
if (isset($_POST["submit"])) {

    // Retrieve submitted form data
    $category = $_POST["selectedCategory"]; 
    $name = $_POST["txtProductName"];
    $description = $_POST["txtDescription"];
    $price = $_POST["txtPrice"];
    $qty = $_POST["txtQuantity"];

    // Image handling
    $file = $_FILES['fImage'];
    $fileName = $_FILES['fImage']['name'];
    $fileTmpName = $_FILES['fImage']['tmp_name'];
    $fileSize = $_FILES['fImage']['size'];
    $fileError = $_FILES['fImage']['error'];
    $fileType = $_FILES['fImage']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    // Check if file type is allowed
    if (!empty($fileName)) {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize <= 2000000) { 
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = 'images/' . $fileNameNew;
                } else {
                    $imageError = "File size exceeds 2MB limit!";
                    $errors[] = $imageError;
                }
            } else {
                $imageError = "There was an error uploading your file!";
                $errors[] = $imageError;
            }
        } else {
            $imageError = "Only JPG, JPEG, and PNG files are allowed!";
            $errors[] = $imageError;
        }
    }

    // Validate category
    if (empty($category)) {
        $categoryError = "Please choose one category!";
        $errors[] = $categoryError;
    }

    // Validate product name
    if (empty($name)) {
        $nameError = "Product name is required!";
        $errors[] = $nameError;
    } elseif (strlen($name) < 5) {
        $nameError = "Product name must be at least 5 characters!";
        $errors[] = $nameError;
    } elseif (!preg_match("/^[a-zA-Z0-9 \.]+$/", $name)) {
        $nameError = "Invalid product name!";
        $errors[] = $nameError;
    }

    // Validate description
    if (empty($description)) {
        $descriptionError = "Description is required!";
        $errors[] = $descriptionError;
    } elseif (strlen($description) < 10) {
        $descriptionError = "Description must be at least 10 characters!";
        $errors[] = $descriptionError;
    }

    // Validate price
    if (empty($price)) {
        $priceError = "Price is required!";
        $errors[] = $priceError;
    } elseif (!preg_match("/^\d+(\.\d{2})?$/", $price)) {
        $priceError = "Invalid price format!";
        $errors[] = $priceError;
    }

    // Validate quantity
    if (empty($qty)) {
        $qtyError = "Quantity is required!";
        $errors[] = $qtyError;
    } elseif (!preg_match("/^\d+$/", $qty)) {
        $qtyError = "Quantity must be a whole number!";
        $errors[] = $qtyError;
    }





    // If there are no errors, update the data into the database
    if (count($errors) === 0) {
        $updateSQL = "UPDATE products SET category = ?, name = ?, description = ?, price = ?, qty = ?, image = ? WHERE id = ?";

        $stmt = $db->prepare($updateSQL);
        $stmt->bind_param("sssdisi", $category, $name, $description, $price, $qty, $image, $id);

        if ($stmt->execute()) {
            $success = "Your product was successfuly updated.";
            header("Location: ../Products/pManage.php");
        }
        $stmt = null;
        $db->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS section/pAdd.css">
    <script defer src="../Java Section/pAdd.js"></script>
    <title>Update Prodcut</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
        <h1>Edit Product</h1>
        <div class="categoryId">
            <label>Category</label>
            <div class="grid-container">
                <div class='category-option' checked data-value='CPU'>CPU</div>
                <div class="category-option" data-value="GPU">GPU</div>
                <div class="category-option" data-value="Motherboard">Motherboard</div>
                <div class="category-option" data-value="RAM">RAM</div>
                <div class="category-option" data-value="Cooler">Cooler</div>
                <div class="category-option" data-value="Case">PC Case</div>
                <div class="category-option" data-value="Storage">Storage</div>
                <div class="category-option" data-value="PSU">PSU</div>
            </div>

            <input type="hidden" name="selectedCategory" id="selectedCategory" value="CPU">
        </div>

        <div class="ProductName">
            <label for="txtProductName">Product Name</label>
            <input type="text" name="txtProductName" id="txtProductName" value="<?= $name ?>">
        </div>


        <div class="description">
            <label for="txtDescription">Description</label>
            <input type="text" name="txtDescription" id="txtDescription" value="<?= $description ?>">
        </div>

        <div class="price">
            <label for="txtPrice">Price</label>
            <input type="text" name="txtPrice" id="txtPrice" value="<?= $price ?>">
        </div>


        <div class="quantity">
            <label for="txtQuantity">Quantity</label>
            <input type="text" name="txtQuantity" id="txtQuantity" value="<?= $qty ?>">
        </div>


        <div class="image">
            <label for="fImage">Image</label>
            <img src="<?= '../PRODUCTS/images/' . $image ?>">
            <input type="file" name="fImage" id="fImage" value="<?= $image ?>">
        </div>

        <div class="message">
            <?php if (!empty($success)) { ?>
                <p class="success-message"><?php echo $success; ?></p>
            <?php } elseif (!empty($errors)) { ?>
                <p class="error-message"><?php echo implode('<br>', $errors); ?></p>
            <?php }?>
        </div>
        <div class="button-row">
            <a href="pManage.php" class="back-btn">Back</a>
            <input type="submit" name="submit" id="submit" value="Add" class="submit-btn">
        </div>
    </form>
</body>
</html>