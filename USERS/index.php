<?php
session_start();

if (!empty($_SESSION["username"])) {
    $linkPath = "userAccount.php";
} else {
    $linkPath = "userLogin.php";
}

$db = mysqli_connect("localhost", "root", '', "pc_store_db");


if ($db->connect_errno > 0) {
    die(
        "Error number: " . $db->connect_errno . "<br>" .
        "Error message: " . $db->connect_error
    );
}

$desiredCategories = ['CPU', 'GPU', 'Motherboard', 'RAM', 'Cooler', 'Case', 'Storage', 'PSU'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../CSS Section/index.css">
    <link rel="stylesheet" href="../CSS Section/header&footer.css">
    <script src="../Java Section/index.js"></script>

    <script src="https://kit.fontawesome.com/6d248d535d.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- -------------------------------------------------------------------------- -->
    <header>
        <nav>
            <ul>
                <li><a href="Index.php" class="logo"><img src="../CSS Section/Material/img/OneStore.png" alt=""></a></li>
                <li><a href="Index.php" class="active">Home</a></li>
                <li><a href="#footer">Contact</a></li>
                <li><a href="#footer">Follow Us</a></li>
                <?php
                echo "<li class='account'><a href='$linkPath'>Account</a></li>";
                ?>
            </ul>
        </nav>
    </header>
    <!-- -------------------------------------------------------------------------- -->
    <div class="category">
        <ul>
            <?php
            foreach ($desiredCategories as $category) {
                $checkSql = "SELECT COUNT(*) AS product_count FROM products WHERE category = '$category'";
                $checkResult = $db->query($checkSql);
                $row = $checkResult->fetch_assoc();
                if ($row['product_count'] > 0) {
                    echo "<li><a href='#" . strtolower(str_replace(' ', '-', $category)) . "'>$category</a></li>";
                }
            }
            ?>
        </ul>
    </div>
    <!-- -------------------------------------------------------------------------- -->
    <div class="container">
        <?php
        foreach ($desiredCategories as $category) {
            // Fetch products for the current category
            $sql = "SELECT * FROM products WHERE category = '$category'";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                // Display the section only if products exist in the category
                echo "<section id='" . strtolower(str_replace(' ', '-', $category)) . "' class='product-section'>";
                echo "<div class='section-header'>";
                echo "<h2>$category</h2>";
                echo "</div>";
                echo "<div class='productbig'>";

                while ($product = $result->fetch_assoc()) {
                    // Display each product
                    echo "<div class='product2'>";
                    echo "<img src='../PRODUCTS/images/" . $product["image"] . "' alt='Product Image'>";
                    echo "<div class='details'>";
                    echo "<div class='col-01'>" . $product["name"] . "</div>";
                    echo "<div class='col-02'><span class='label'>Description:</span> " . $product["description"] . "</div>";
                    echo "<div class='col-03'><span class='label'>Price:</span> $" . $product["price"] . "</div>";
                    echo "<a href='#' class='add-to-cart-btn'>Purchase</a>";
                    echo "</div>";
                    echo "</div>";
                }

                echo "</div>";
                echo "</section>";
            }
        }
        ?>
    </div>
    <!-- -------------------------------------------------------------------------- -->
    <footer>
        <div class="footer_main" id="footer">
            <div class="tag">
                <h1>Contacts</h1>
                <a href="https://g.co/kgs/kGz98hj"><i class="fa-solid fa-house"></i> No. 86A, Street 110,<br> Russian
                    Federation Blvd (110), Phnom Penh</a>
                <a href="#"><i class="fa-solid fa-phone"></i> 023 880 612</a>
                <a href="#"><i class="fa-solid fa-envelope"></i> totallynotarealemail@gmail.com</a>
            </div>
            <div class="tag">
                <h1>Information</h1>
                <a href="#">About</a>
                <a href="#">Blog</a>
                <a href="#">Contact</a>
                <a href="#">Helps & Support</a>
            </div>
            <div class="follow">
                <h1>Follow Us</h1>
                <div class="social">
                    <div class="social_link">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                    <div class="social_text">
                        <a href="#">Facebook</a>
                        <a href="#">Twitter X</a>
                        <a href="#">Instagram</a>
                        <a href="#">Linkedin</a>
                    </div>
                </div>
            </div>
            <div class="instagram">
                <h1 id="members-title">Members</h1>
                <div class="news">
                    <a href="#" class="news1" data-name="Uy Sophea">
                        <img src="../CSS Section/Material/img/phea.jpg" alt="">
                    </a>
                    <a href="#" class="news1" data-name="Hang Rithy">
                        <img src="../CSS Section/Material/img/rithy.jpg" alt="">
                    </a>
                    <a href="#" class="news1" data-name="Sim Hengtry">
                        <img src="../CSS Section/Material/img/sim.jpg" alt="">
                    </a>
                    <a href="#" class="news1" data-name="You Muniraksmey">
                        <img src="../CSS Section/Material/img/smey.jpg" alt="">
                    </a>
                    <a href="#" class="news1" data-name="Ol Mengeim">
                        <img src="../CSS Section/Material/img/eim2.jpg" alt="">
                    </a>
                    <a href="#" class="news1" data-name="Sa Rosmy">
                        <img src="../CSS Section/Material/img/Rosmy.jpg" alt="">
                    </a>
                </div>
                <p>Check our posts</p>
            </div>
        </div>
    </footer>
</body>

</html>