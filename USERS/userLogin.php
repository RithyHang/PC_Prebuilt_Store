<?php
$username = "";
$password = "";

$usernameError = "";
$passwordError = "";
$loginError = ""; // New variable for invalid credentials

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
        $db = mysqli_connect("localhost", "root", '', "pc_store_db");

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
            $loginError = "Invalid username or password"; // Assign the error message
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
        <!-- Centralized error message -->
        <?php if (!empty($loginError)): ?>
        <div class="error center"><?php echo $loginError; ?></div>
        <?php endif; ?>

        <div class="name">
            <label for="txtUserName">Username</label>
            <input type="text" name="txtUserName" id="txtUserName" value="<?php echo htmlspecialchars($username); ?>">
            <span class="error"><?php echo $usernameError; ?></span>
        </div>

        <div class="password">
            <label for="txtPassword">Password</label>
            <input type="text" name="txtPassword" id="txtPassword" value="<?php echo htmlspecialchars($password); ?>">
            <span class="error"><?php echo $passwordError; ?></span>
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