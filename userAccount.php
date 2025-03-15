<?php
$id;
session_start();
$username = $_SESSION["username"];
$password = $_SESSION["password"];

$db = mysqli_connect("localhost", "root", '', "pc_store_db");
if ($db->connect_errno > 0) {
    die(
        "Error number : " . $db->connect_errno . "<br>" .
        "Error message: " . $db->connect_error
    );
}

$sql = "SELECT *
            from users 
            WHERE username = '$username'
            AND password = '$password'";
$result = $db->query($sql);
if ($db->connect_errno > 0) {
    die(
        "Error number : " . $db->connect_errno . "<br>" .
        "Error message: " . $db->connect_error
    );
}


if (isset($_POST["btnLogout"])) {
    session_destroy();
    header("Location: userLogin.php");
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
    <div class="home">
        <a href="index.php">Home</a>
    </div>
    <?php
    $user = $result->fetch_assoc();
        $id = $user["id"];
        echo $user["username"] . "<br>";
        echo $user["email"] . "<br>";
        echo $user["date_of_birth"] . "<br>";
        echo $user["id"];
    ?>

    <form action="" method="post">
        <input type="submit" value="Logout" name="btnLogout">
    </form>

    <?php
        echo "<div class='customAccount'><a href='userUpdate.php?id=$id'>Customize your account</a></div>";
    ?>
    <div class="delAccount">
        <a href="userDelete.php?">!Delete Account</a>
    </div>
</body>

</html>