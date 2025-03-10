<?php
if (isset($_POST["buttonSubmit"])) {

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
</head>

<body>
    <form action="" method="post">
        <div class="name">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>


        <div class="photo">
            <input type="file" multiple name="fileUploading[]" id="fileUploading[]">
            <input type="submit" value="SUBMIT" name="buttonSubmit">
        </div>

        
    </form>
</body>

</html>