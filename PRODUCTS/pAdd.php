<?php
$category = "";
$name = "";
$description = "";
$price = "";
$qty = "";
$price = "";
$image = "";

//errors
$categoryError = "";
$nameError = "";
$descriptionError = "";
$priceError = "";
$qtyError = "";
$imageError = "";
$fileNameNew = "";

$errors = [];


// add products
if (isset($_POST["submit"])) {
    // connect to databas
    $db = mysqli_connect("localhost", "root", '', "pc_store_db");

    if ($db->connect_errno > 0) {
        die(
            "Error number: " . $db->connect_errno . "<br>" .
            "Error message: " . $db->connect_error
        );
    }



    $category = $_POST["rdCategory"];
    $name = $_POST["txtProductName"];
    $description = $_POST["txtDescription"];
    $price = $_POST["txtPrice"];

    //image
    $file = $_FILES['fImage'];
    $fileName = $_FILES['fImage']['name'];
    $fileTmpName = $_FILES['fImage']['tmp_name'];
    $fileSize = $_FILES['fImage']['size'];
    $fileError = $_FILES['fImage']['error'];
    $fileType = $_FILES['fImage']['type'];


    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = 'images/' . $fileNameNew;
        }
    }
    $image = $fileNameNew;




    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    //check category validation
    if (empty($category)) {
        $categoryError = "Please choose one category!";
        $errors[] = $categoryError;
    }


    //check name validation
    if (empty($name)) {
        $nameError = "Product name is required!";
        $errors[] = $nameError;
    } else {
        if (strlen($name) < 5) {
            $nameError = "Product name must be at least 5 characters!";
            $errors[] = $nameError;
        } elseif (!preg_match("/^[a-zA-Z0-9 \.]+$/", $name)) {
            $nameError = "Invalid product name!";
            $errors[] = $nameError;
        }
    }


    //check description
    if (empty($description)) {
        $descriptionError = "Description is required!";
        $errors[] = $descriptionError;
    } else {
        if (strlen($description) < 10) {
            $descriptionError = "Description must be at least 10 characters!";
            $errors[] = $descriptionError;
        } elseif (!preg_match("/^[a-zA-Z0-9 \.]+$/", $description)) {
            $descriptionError = "Description is invalid!";
            $errors[] = $descriptionError;
        }
    }


    //check price
    if (empty($price)) {
        $priceError = "price is required!";
        $errors[] = $priceError;
    } elseif (!preg_match("/^\d+(\.\d{2})?$/", $price)) {
        $priceError = "price is invalid!";
        $errors[] = $priceError;
    }


    //check QTY
    if (empty($qty)) {
        $qtyError = "QTY is required!";
        $errors[] = $qtyError;
    } elseif (!preg_match("/^\d*$/", $price)) {
        $priceError = "price is invalid!";
        $errors[] = $priceError;
    }

    //check image
    if (empty($image)) {
        $imageError = "image is reqired!";
        $errors[] = $imageError;
    } elseif(!in_array($fileActualExt, $allowed)) {
        $imageError = "image file is not supported!";
        $errors[] = $imageError;
    }




    if (count($errors) === 0) {
        // Instert Script
        $sql = "INSERT INTO products (`category`, `name`, `description`, `price`, `qty`, `image`) 
                VALUES(?,?,?,?,?,?)";

        $stmt = $db->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $db->error);
        }

        $stmt->bind_param("sssdis", $category, $name, $description, $price, $qty, $image);
        move_uploaded_file($fileTmpName, $fileDestination);
        // success execute
        if ($stmt->execute()) {
            $success = "Your registration was successful.";
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
    <link rel="stylesheet" href="../CSS section/pManage.css">
    <title>Add Products</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
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
            </div>


            <div class="ProductName">
                <label for="txtProductName">Product Name</label>
                <input type="text" name="txtProductName" id="txtProductName">
                <span class="error"><?php echo $nameError; ?></span>
            </div>


            <div class="description">
                <label for="txtDescription">Description</label>
                <input type="text" name="txtDescription" id="txtDescription">
                <span class="error"><?php echo $descriptionError; ?></span>
            </div>


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
        </form>

        <a href="pManage.php">back</a>
</body>
</html>