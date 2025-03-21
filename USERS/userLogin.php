<?php
$username = "";
$password = "";

$usernameError = "";
$passwordError = "";

$errors = [];


if (isset($_POST["submit"])) {
    $username = $_POST["txtUserName"];
    $password = $_POST["txtPassword"];

    session_start();
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;


    if (empty($username)) {
        $usernameError = "Username is required";
        $errors[] = $usernameError;
    }

    if (empty($password)) {
        $passwordError = "Password is required";
        $errors[] = $passwordError;
    }

    if (count($errors) == 0) {

        // $db888 = mysqli_connect("localhost:8888", "root", '', "pc_store_db");
        $dbLocal = mysqli_connect("localhost", "root", '', "pc_store_db");

        $db = $dbLocal;
        // $db = $db888;


        if ($db->connect_errno > 0) {
            die(
                "Error number : " . $db->connect_errno . "<br>" .
                "Error message: " . $db->connect_error
            );
        }

        $sql = "SELECT * from users where username = '$username' and password = '$password'";
        $result = $db->query($sql);
        if ($db->connect_errno > 0) {
            die(
                "Error number : " . $db->connect_errno . "<br>" .
                "Error message: " . $db->connect_error
            );
        }

        if ($result->num_rows > 0) {
            header("Location: userAccount.php");
        } else {
            echo "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS section/userLogin.css">
</head>

<body>

    <form action="" method="post">
        <h1 class="form-title">Login</h1>
        <div class="name">
            <label for="txtUserName">Username</label>
            <input type="text" name="txtUserName" id="txtUserName">
        </div>

        <div class="password">
            <label for="txtPassword">Password</label>
            <input type="text" name="txtPassword" id="txtPassword">
        </div>

        <div class="login">
            <input type="submit" name="submit" value="Login">
        </div>

        <div class="signUp">
            <p>Don't have an account yet? <a href="userAdd.php">Sign up here</a></p>
            <p>Or <a href="index.php">Continue as guest</a></p>
        </div>
    </form>
</body>

</html>