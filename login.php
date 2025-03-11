<?php
    $username = "";
    $password = "";

    $usernameError = "";
    $passwordError = "";

    $errors = [];


    if(isset($_POST["submit"])){
        $username = $_POST["txtUserName"];
        $password = $_POST["txtPassword"];


        if(empty($username)){
            $usernameError = "Username is required";
            $errors[] = $usernameError;
        }

        if(empty($password)){
            $passwordError = "Password is required";
            $errors[] = $passwordError;
        }

        if(count($errors) == 0){
            $db = mysqli_connect("localhost","root",'',"pc_store_db");
            if($db->connect_errno > 0){
                die(
                    "Error number : " . $db->connect_errno . "<br>" .
                    "Error message: " . $db->connect_error
                );
            }

            $sql = "SELECT * from users where username = '$username' and password = '$password'";
            $result = $db->query($sql);
            if($db->connect_errno > 0){
                die(
                    "Error number : " . $db->connect_errno . "<br>" .
                    "Error message: " . $db->connect_error
                );
            }

            if($result->num_rows > 0){
                header("Location: account.php");
            }else{
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
        
        <div class="login">
            <input type="submit" name='submit' value="Login">
        </div>

        <div class="signUp">
            <p>don't have an account yet? <a href="#">Sign up here</a></p>
        </div>
    </form>
</body>
</html>