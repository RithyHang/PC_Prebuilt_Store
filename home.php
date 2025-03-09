<?php
$db = new mysqli("localhost", "root", "", "pc_store_db");
if ($db->connect_errno > 0) {
    die(
        "Error number: " . $db->connect_errno . "<br>" .
        "Error message: " . $db->connect_error
    );
}

$sql = "select id, name, image from brands";
$result = $db->query($sql);
if ($db->errno > 0) {
    die(
        "Error number: " . $db->errno . "<br>" .
        "Error message: " . $db->error
    );
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        while($brand = $result->fetch_assoc()):
            $image = base64_encode($brand["image"]);
            echo "<img src='data:image/jpeg;base64," . $image . "'>";
        endwhile;
    ?>

    
</body>
</html>
