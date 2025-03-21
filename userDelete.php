<?php
    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $db = mysqli_connect("localhost","root","","pc_store_db");
        if($db->connect_errno > 0){
            die("Error message: " . $db->connect_error);
        }

        $deleteSQL = "DELETE FROM users WHERE id=? LIMIT 1";
        $stmt = $db->prepare($deleteSQL);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        session_start();
        session_destroy();

        header("Location: userLogin.php?successDelete=1");

        exit();
    }
?>