<?php
session_start();

if (!empty($_SESSION["username"])) {
    $linkPath = "userAccount.php";
} else {
    $linkPath = "userLogin.php";
}


// connect to databas
$db = mysqli_connect("localhost", "root", '', "pc_store_db");

if ($db->connect_errno > 0) {
    die(
        "Error number: " . $db->connect_errno . "<br>" .
        "Error message: " . $db->connect_error
    );
}

//Select every category
$catSql = "SELECT DISTINCT category FROM products";
$catResult = $db->query($catSql);
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
                <li><a href="Index.php" class="logo"><img src="../CSS Section/Material/img/OneStore.png" alt=""></a>
                </li>
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
            <li><a href="#prebuilt">Pre-Built</a></li>
            <li><a href="#cpu">CPU</a></li>
            <li><a href="#gpu">GPU</a></li>
            <li><a href="#motherboard">Motherboard</a></li>
            <li><a href="#accessory">Accessory</a></li>
        </ul>
    </div>
    <!-- -------------------------------------------------------------------------- -->
    <div class="container">
        <!-- PreBuilt Section -->
        <section id="prebuilt" class="product-section">
            <div class="section-header">
                <h2>Pre-Built</h2>
            </div>
            <div class="productbig">
                <?php





                while ($category = $catResult->fetch_assoc()) {
                    $cat = $category["category"];
                    //prebuilt
                    $sql = "SELECT * FROM products where category = '$cat'";
                    $prebuilt = $db->query($sql);
                    if ($db->errno > 0) {
                        die(
                            "Error number: " . $db->errno . "<br>" .
                            "Error message: " . $db->error
                        );
                    }
                    echo "<div class='Categories'>";
                    while ($pc = $prebuilt->fetch_assoc()):
                        echo "<div class='product2'>";
                        echo "<img src='../PRODUCTS/images/" . $pc["image"] . "' alt='Product Image'>";
                        echo "<div class='details'>";
                        echo "<div class='col-01'>" . $pc["name"] . "</div>";
                        echo "<div class='col-02'><span class='label'>Description:</span> " . $pc["description"] . "</div>";
                        echo "<div class='col-03'><span class='label'>Price:</span> $" . $pc["price"] . "</div>";
                        echo "<a href='#' class='add-to-cart-btn'>Purchase</a>";
                        echo "</div>";
                        echo "</div>";
                    endwhile;
                    echo "</div>";
                }
                ?>
            </div>
        </section>


        <!-- CPU Section -->
        <section id="cpu" class="product-section">
            <div class="section-header">
                <h2>CPU</h2>
            </div>
            <div class="product">
                <div class="product1">
                    <img src="../CSS Section/Material/img/Ryzen.png" alt="">
                    <h1>Intel Core i9-10900K</h1>
                    <p>Price: $499.99</p>
                    <a href="#">Add to Cart</a>
                </div>

            </div>
        </section>

        <!-- GPU Section -->
        <section id="gpu" class="product-section">
            <div class="section-header">
                <h2>GPU</h2>
            </div>
            <div class="product">
                <div class="product1">
                    <img src="../CSS Section/Material/img/Ryzen.png" alt="">
                    <h1>Intel Core i9-10900K</h1>
                    <p>Price: $499.99</p>
                    <a href="#">Add to Cart</a>
                </div>

            </div>
        </section>

        <!-- Motherboard Section -->
        <section id="motherboard" class="product-section">
            <div class="section-header">
                <h2>Motherboard</h2>
            </div>
            <div class="product">
                <div class="product1">
                    <img src="../CSS Section/Material/img/Ryzen.png" alt="">
                    <h1>Intel Core i9-10900K</h1>
                    <p>Price: $499.99</p>
                    <a href="#">Add to Cart</a>
                </div>

            </div>
        </section>

        <!-- Accessory Section -->
        <section id="accessory" class="product-section">
            <div class="section-header">
                <h2>Accessory</h2>
            </div>
            <div class="product">
                <div class="product1">
                    <img src="../CSS Section/Material/img/Ryzen.png" alt="">
                    <h1>Intel Core i9-10900K</h1>
                    <p>Price: $499.99</p>
                    <a href="#">Add to Cart</a>
                </div>

            </div>
        </section>
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