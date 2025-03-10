


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
