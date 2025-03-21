<?php
$username = "";
$userRole = "user";
$password = "";
$email = "";
$date_of_birth = "";
$address = "";

$nameError = "";
$emailError = "";
$passwordError = "";
$DoBError = "";
$addressError = "";

$success = "";
$errors = [];


if (isset($_POST["submit"])) {
    $username = $_POST["txtUserName"];
    $password = $_POST["txtPassword"];
    $email = $_POST["txtEmail"];
    $date_of_birth = $_POST["txtDOB"];
    $address = $_POST["txtAddress"];

    // connect to databas
    $db = new mysqli("localhost", "root", "", "pc_store_db");

    if ($db->connect_errno > 0) {
        die(
            "Error number: " . $db->connect_errno . "<br>" .
            "Error message: " . $db->connect_error
        );
    }

    //Username Error Check
    {
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
    }


    if (count($errors) === 0) {
        // Instert Script
        $sql = "INSERT INTO users (username, userRole, password, email, date_of_birth, address) 
                VALUES(?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $db->error);
        }

        $stmt->bind_param("ssssss", $username, $userRole, $password, $email, $date_of_birth, $address);


        // success execute
        if ($stmt->execute()) {
            $success = "Your registration was successful.";

            $username = "";
            $password = "";
            $email = "";
            $date_of_birth = "";
            $address = "";

        }

        $stmt->close();
        $db->close();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>

    <link rel="stylesheet" href="CSS section/userAdd.css">
</head>

<body>
    
    <form action="" method="post">
    <h1 class="form-title">Register User</h1>
        <!-- Name Field -->
        <div class="name">
            <label for="txtUserName">Username</label>
            <input type="text" name="txtUserName" id="txtUserName">
        </div>

        <!-- Password Field -->
        <div class="password">
            <label for="txtPassword">Password</label>
            <input type="text" name="txtPassword" id="txtPassword">
        </div>

        <!-- Email Field -->
        <div class="email">
            <label for="txtEmail">Email</label>
            <input type="text" name="txtEmail" id="txtEmail">
        </div>

        <!-- Date of Birth Field -->
        <div class="dob">
            <label for="txtDOB">Date of Birth</label>
            <input type="text" name="txtDOB" id="txtDOB">
        </div>

        <!-- Address Field -->
        <div class="address">
            <label for="txtAddress">Address</label>
            <input type="text" name="txtAddress" id="txtAddress">
        </div>

        <!-- Submit Button -->
        <div class="submitRegister">
            <input type="submit" value="Sign Up" name="submit">
        </div>

        <!-- Success Message -->
        <?= $success == "" ? null : "<div class='success'>$success</div><br> <div class='successLogin'><a href='userLogin.php'>go to login</a></div>"; ?>

        <!-- Error Messages -->
        <?php foreach ($errors as $error) {
            echo "<div class='error'>$error</div>";
        } ?>

    </form>
</body>

</html>