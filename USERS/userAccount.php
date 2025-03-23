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


if (isset($_POST["btnLogout"]) ) {
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
    <link rel="stylesheet" href="../CSS Section/userAccount.css">
</head>

<body>

    <section class="profile">

        <?php
        $user = $result->fetch_assoc();
        $id = $user["id"];
        echo "<h1>" . $user["username"] . "</h1>";
        echo "<p>Email: " . $user["email"] . "</p>";
        echo "<p>Date of Birth: " . $user["date_of_birth"] . "</p>";
        $_SESSION["userRole"] = $user["userRole"];
        ?>
        
    </section>

    <form action="" method="post" class="logout-form">
        <input type="submit" value="Logout" name="btnLogout">
    </form>

    <section class="account-actions">
        <?php
        echo "<a class='action-link' href='userUpdate.php?id=$id'>Customize your account</a>";
        echo "<a class='action-link' href='userDelete.php?id=$id'>Delete account</a>";

        $userRole = $_SESSION["userRole"];
        if ($userRole === "admin") {
            echo "<a class='action-link' href='../PRODUCTS/pManage.php'>Manage Product</a>";
        }
        ?>
    </section>
    <div class="back">
        <a class="back-btn" href="index.php">Home</a>
    </div>
</body>

</html>