<?php
    $db = mysqli_connect("localhost","roott","","pc_store_db");
    if($db->connect_errno > 0){
        die(
            "Error number : " . $db->connect_errno . "<br>" .
            "Error message: " . $db->connect_error
        );
    }

    $sql = "SELECT first_name, last_name, role, email, date_of_birth, addresss";
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
            echo $user["last_name"] . "<br>";
            echo $user["first_name"] . "<br>";
            echo $user["email"] . "<br>";
            echo $user["date_of_birth"] . "<br>";
        endwhile;
    ?>
</body>
</html>