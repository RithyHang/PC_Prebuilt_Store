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

<<<<<<< HEAD
// add products
=======
// Add product
>>>>>>> 10f96a8485a6313a3d616f321b04533b3b31a7fa
if (isset($_POST["submit"])) {
    // Connect to the database
    $db = mysqli_connect("localhost", "root", '', "pc_store_db");

    if ($db->connect_errno > 0) {
        die(
            "Error number: " . $db->connect_errno . "<br>" .
            "Error message: " . $db->connect_error
        );
    }

    // Retrieve submitted form data
    $category = $_POST["selectedCategory"]; // Updated to match the hidden input
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
                if ($fileSize <= 2000000) { // 2MB limit
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
    } else {
        $imageError = "Image is required!";
        $errors[] = $imageError;
    }

    $image = $fileNameNew;

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

<<<<<<< HEAD
    //check image
    if (empty($image)) {
        $imageError = "image is reqired!";
        $errors[] = $imageError;
    } elseif (!in_array($fileActualExt, $allowed)) {
        $imageError = "image file is not supported!";
        $errors[] = $imageError;
    }




=======
    // If there are no errors, insert the data into the database
>>>>>>> 10f96a8485a6313a3d616f321b04533b3b31a7fa
    if (count($errors) === 0) {
        $sql = "INSERT INTO products (`category`, `name`, `description`, `price`, `qty`, `image`) 
                VALUES(?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $db->error);
        }

        $stmt->bind_param("sssdis", $category, $name, $description, $price, $qty, $image);
        move_uploaded_file($fileTmpName, $fileDestination);

        if ($stmt->execute()) {
            $success = "Product added successfully!";
        } else {
            $success = "Error adding product!";
        }

        $stmt->close();
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
    <title>Add Products</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
<<<<<<< HEAD
        <div class="categoryId">
            <label for="txtCateogryId">Category</label>
            <input type="radio" name="rdCategory" id="rdCategory" checked value="CPU"> CPU &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="GPU"> GPU &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="Motherboard"> Motherboard &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="RAM"> RAM &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="Cooler"> Cooler &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="Case"> PC Case &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="Storage"> Storage &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="PSU"> PSU &nbsp; &nbsp;
            <input type="radio" name="rdCategory" id="rdCategory" value="Prebuilt"> Pre-built
=======
        <h1>Add Product</h1>
        <div class="categoryId">
            <label>Category</label>
            <div class="grid-container">
                <div class="category-option" data-value="CPU">CPU</div>
                <div class="category-option" data-value="GPU">GPU</div>
                <div class="category-option" data-value="Motherboard">Motherboard</div>
                <div class="category-option" data-value="RAM">RAM</div>
                <div class="category-option" data-value="Cooler">Cooler</div>
                <div class="category-option" data-value="Case">PC Case</div>
                <div class="category-option" data-value="Storage">Storage</div>
                <div class="category-option" data-value="PSU">PSU</div>
            </div>
            <!-- Hidden input to store the selected category -->
            <input type="hidden" name="selectedCategory" id="selectedCategory" value="CPU">
>>>>>>> 10f96a8485a6313a3d616f321b04533b3b31a7fa
        </div>

        <div class="ProductName">
            <label for="txtProductName">Product Name</label>
            <input type="text" name="txtProductName" id="txtProductName">
        </div>

<<<<<<< HEAD
        <div class="ProductName">
            <label for="txtProductName">Product Name</label>
            <input type="text" name="txtProductName" id="txtProductName">
            <span class="error"><?php echo $nameError; ?></span>
=======
        <div class="description">
            <label for="txtDescription">Description</label>
            <input type="text" name="txtDescription" id="txtDescription">
>>>>>>> 10f96a8485a6313a3d616f321b04533b3b31a7fa
        </div>

        <div class="price">
            <label for="txtPrice">Price</label>
            <input type="text" name="txtPrice" id="txtPrice">
        </div>

<<<<<<< HEAD
        <div class="description">
            <label for="txtDescription">Description</label>
            <input type="text" name="txtDescription" id="txtDescription">
            <span class="error"><?php echo $descriptionError; ?></span>
=======
        <div class="quantity">
            <label for="txtQuantity">Quantity</label>
            <input type="text" name="txtQuantity" id="txtQuantity">
>>>>>>> 10f96a8485a6313a3d616f321b04533b3b31a7fa
        </div>

        <div class="image">
            <label for="fImage">Image</label>
            <input type="file" name="fImage" id="fImage">
        </div>

<<<<<<< HEAD
        <div class="price">
            <label for="txtPrice">Price</label>
            <input type="text" name="txtPrice" id="txtPrice">
            <span class="error"><?php echo $priceError; ?></span>
        </div>


        <div class="quantity">
            <label for="txtQuantity">Quantity</label>
            <input type="text" name="txtQuantity" id="txtQuantity">
            <span class="error"><?php echo $qtyError; ?></span>
        </div>


        <div class="image">
            <label for="fImage">Image</label>
            <input type="file" name="fImage" id="fImage">
            <span class="error"><?php echo $imageError; ?></span>
        </div>


        <div class="pSubmit">
            <input type="submit" name="submit" id="submit" value="ADD">
        </div>
        <!-- Success Message -->
        <?= $success == "" ? null : "<div class='success'>$success</div>"; ?>
    </form>

    <a href="pManage.php">back</a>
=======
        <div class="button-row">
            <a href="pManage.php" class="back-btn">Back</a>
            <input type="submit" name="submit" id="submit" value="ADD" class="submit-btn">
        </div>
    </form>

    <script src="script.js"></script>
>>>>>>> 10f96a8485a6313a3d616f321b04533b3b31a7fa
</body>

</html>