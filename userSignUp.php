<?php
$username = "";
$userRole = "user";
$password = "";
$email = "";
$date_of_birth = "";
$address = "";

$errors = [];


if (isset($_POST["submit"])) {
    $username = $_POST["txtUserName"];
    $password = $_POST["txtPassword"];
    $email = $_POST["txtEmail"];
    $date_of_birth = $_POST["txtDOB"];
    $address = $_POST["txtAddress"];

    
    if (count($errors) === 0) {
        $db = new mysqli("localhost", "root", "", "pc_store_db");

        if ($db->connect_errno > 0) {
            die(
                "Error number: " . $db->connect_errno . "<br>" .
                "Error message: " . $db->connect_error
            );
        }

        // Ensure the number of placeholders matches the columns
        $sql = "INSERT INTO users (username, userRole, password, email, date_of_birth, address) 
                VALUES(?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $db->error);
        }

        // Bind parameters correctly
        $stmt->bind_param("ssssss", $username, $userRole, $password, $email, $date_of_birth, $address);

        if ($stmt->execute()) {
            $success = "Your registration was successful.";

            $username = "";
            $password = "";
            $email = "";
            $date_of_birth = "";
            $address = "";
        } else {
            die("Execution failed: " . $stmt->error);
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
</head>

<body>
    <form action="" method="post">
        <div class="name">
            <label for="txtUserName">Username</label>
            <input type="text" name="txtUserName" id="txtUserName">
        </div>


        <div class="password">
            <label for="txtPassword">Password</label>
            <input type="text" name="txtPassword" id="txtPassword">
        </div>


        <div class="email">
            <label for="txtEmail">Email</label>
            <input type="text" name="txtEmail" id="txtEmail">
        </div>


        <div class="dob">
            <label for="txtDOB">Date of Birth</label>
            <input type="text" name="txtDOB" id="txtDOB">
        </div>


        <div class="address">
            <label for="txtAddress">Address</label>
            <input type="text" name="txtAddress" id="txtAddress">
        </div>

        <div class="submitRegister">
            <input type="submit" value="Sign Up" name="submit">
        </div>
    </form>
</body>

</html>