<?php
$username = "";
$password = "";
$email = "";
$date_of_birth = "";
$address = "";


$nameError ;
$passwordError;
$emailError;
$DoBError;
$addressError;

$success = "";
$errors = [];

// Connect to DB
$db = mysqli_connect("localhost", "root", '', "pc_store_db");
if ($db->connect_errno > 0) {
    die(
        "Error number : " . $db->connect_errno . "<br>" .
        "Error message: " . $db->connect_error
    );
}

// ----------------------------- Fill Out User Information ---------------------------
{
    // Get user's information
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

  
        $sql = "SELECT * FROM users WHERE id=? LIMIT 1";
        $stmt = $db->prepare($sql );

        if (!$stmt) {  // Check if statement preparation failed
            die("Error in SQL preparation: " . $db->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultSet = $stmt->get_result();

        $user = $resultSet->fetch_assoc();
        $username = $user["username"];
        $password = $user["password"];
        $email = $user["email"];
        $date_of_birth = $user["date_of_birth"];
        $address = $user["address"];
    }
}


// ------------------------------ Update The User --------------------------------
if (isset($_POST["btnUpdate"])) {

    $username = $_POST["txtName"];
    $password = $_POST["txtPassword"];
    $email = $_POST["txtEmail"];
    $date_of_birth = $_POST["txtDoB"];
    $address = $_POST["txtAddress"];
    // --------------- Error Check --------------
    // Username Error Check
    if (empty($username)) {
        $nameError = "username is required!";
        $errors[] = $nameError;
    } else {
        if (strlen($username) == 1) {
            $nameError = "username must be more than one character!";
            $errors[] = $nameError;
        } elseif (!preg_match("/^[a-zA-Z0-9 \.]+$/", $username)) {
            $nameError = "Invalid username!";
            $errors[] = $nameError;
        }
    }

    //Password Error Check
    if (empty($password)) {
        $passwordError = "password is required!";
        $errors[] = $passwordError;
    } else {
        if (strlen($password) < 8) {
            $passwordError = "password must be at lease 8 character!";
            $errors[] = $passwordError;
        } elseif (!preg_match("/(?=.{8,30})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[^0-9a-zA-Z])(?!.*[\s])/", $password)) {
            $passwordError = "Invalid password!";
            $errors[] = $passwordError;
        }
    }

    //Email Error Check
    if (empty($email)) {
        $emailError = "email is required!";
        $errors[] = $emailError;
    } elseif (!preg_match("/.+@.+\..{2,8}/", $email)) {
        $emailError = "Invalid email address!";
        $errors[] = $emailError;
    }

    //Date of Birth Error Check
    if ($date_of_birth == "") {
        $DoBError = "Date of birth is required.";
        $errors[] = $DoBError;
    } elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date_of_birth)) {
        $DoBError = "Invalid format(ex: yyyy-mm-dd).";
        $errors[] = $DoBError;
    }

    //Address Error Check
    if (empty($address)) {
        $addressError = "address is required!";
        $errors[] = $addressError;
    } else {
        if (strlen($address) == 1) {
            $addressError = "address must be more than one character!";
            $errors[] = $address;
        } elseif (!preg_match("/^[a-zA-Z0-9 \.]+$/", $address)) {
            $addressError = "Invalid address!";
            $errors[] = $addressError;
        }
    }

    // Save Update
    if (count($errors) === 0) {
        $updateSQL = "UPDATE USERS SET username = ?, password = ?, email = ?, date_of_birth = ?, address = ? WHERE id = ?";

        $stmt = $db->prepare($updateSQL);
        $stmt->bind_param("sssssi", $username, $password, $email, $date_of_birth, $address, $id);

        if ($stmt->execute()) {
            $success = "Your registration was successful.";
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
    <title>Customize Account</title>
</head>

<body>
    <form action="" method="post">
        <!-- Name Field -->
        <div class="name">
            <label for="txtName">Name</label>
            <input type="text" name="txtName" id="txtName" value="<?= $username ?>">
        </div>

        <!-- Email Field -->
        <div class="emai">
            <label for="txtEmail">Email</label>
            <input type="text" name="txtEmail" id="txtEmail" value="<?= $email ?>">
        </div>

        <!-- DoB Field -->
        <div class="DoB">
            <label for="txtDoB">Date of Birth</label>
            <input type="text" name="txtDoB" id="txtDoB" value="<?= $date_of_birth ?>">
        </div>

        <!-- Address Field -->
        <div class="address">
            <label for="txtAddress">Address</label>
            <input type="text" name="txtAddress" id="txtAddress" value="<?= $address ?>">
        </div>

        <!-- Password Field -->
        <div class="password">
            <label for="txtPassword">Password</label>
            <input type="password" name="txtPassword" id="txtPassword" value="<?= $password ?>">
        </div>

        <!-- Submit Button -->
        <div class="updateButton">
            <input type="submit" name="btnUpdate" id="btnUpdate" value="Save">
            <input type="reset" name="btnReset" id="btnReset">
        </div>
    </form>

    <div class="back">
        <a href="userAccount.php">Back</a>
    </div>
    <!-- success message -->
    <?=
        $success == "" ? null : "<div class='success'>$success</div>";
    ?>
    <!-- Error Messages -->
    <?php
    foreach ($errors as $error) {
        echo "<div class='error'>$error</div>";
    }
    ?>
</body>

</html>