<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];


    // $db888 = mysqli_connect("localhost:8888", "root", '', "pc_store_db");
    $dbLocal = mysqli_connect("localhost", "root", '', "pc_store_db");

    $db = $dbLocal;
    // $db = $db888;
    if ($db->connect_errno > 0) {
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