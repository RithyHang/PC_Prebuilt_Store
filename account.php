<?php
    session_start();
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];

    $db = mysqli_connect("localhost","root",'',"pc_store_db");
    if($db->connect_errno > 0){
        die(
            "Error number : " . $db->connect_errno . "<br>" .
            "Error message: " . $db->connect_error
        );
    }

    $sql = "SELECT username, role, email, date_of_birth, address 
            from users 
            WHERE username = '$username'
            AND password = '$password'";
    $result = $db->query($sql);
    if($db->connect_errno > 0){
        die(
            "Error number : " . $db->connect_errno . "<br>" .
            "Error message: " . $db->connect_error
        );
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
</head>
<body>
    <?php
        while($user = $result->fetch_assoc()):
            echo $user["username"] . "<br>";
            echo $user["email"] . "<br>";
            echo $user["date_of_birth"] . "<br>";
        endwhile;
    ?>
</body>
</html>