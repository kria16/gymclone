<?php
session_start();

// Simulated product list
$store = [
    ['img' => 'shirt.jpeg', 'name' => 'Gym T-Shirt', 'price' => 500],
    ['img' => 'bottlee.jpeg', 'name' => 'Water Bottle', 'price' => 450],
    ['img' => 'hoddie.jpg', 'name' => 'Hoodie', 'price' => 800],
    ['img' => 'towel.jpeg', 'name' => 'Towel', 'price' => 600],
    ['img' => 'band.jpeg', 'name' => 'Resistance Bands', 'price' => 100]
];

// If the form is submitted, add the product to the cart
if (isset($_POST['add_to_cart'])) {
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    // Find the product in the product list to get the image
    foreach ($products as $product) {
        if ($product['name'] === $productName) {
            $productImage = $product['img'];
            break;
        }
    }

    // Prepare cart item array
    $cartItem = [
        'name' => $productName,
        'price' => $productPrice,
        'quantity' => 1, // Default quantity is 1 for now
        'image' => $productImage // Add the image URL to the cart item
    ];

    // Check if cart already exists in the session
    if (isset($_SESSION['cart'])) {
        // Check if the product already exists in the cart
        $exists = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['name'] === $productName) {
                $item['quantity'] += 1; // Increment quantity if it already exists
                $exists = true;
                break;
            }
        }
        if (!$exists) {
            $_SESSION['cart'][] = $cartItem; // Add new item to cart
        }
    } else {
        // If cart doesn't exist, create a new cart with the first item
        $_SESSION['cart'] = [$cartItem];
    }

    // Redirect to the cart page
    header("Location: cart.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <title>Gym Merchandise</title>
    <style>
        header {
            text-align: center;
            padding: 10px;
            color: #B5BBC9;
        }
        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            color: #B5BBC9;
        }
        .product img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #f90;
            border: none;
            color: #B5BBC9;
            cursor: pointer;
        }
        button:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>
    <!--header-->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand">
            <img class="media-imlocation rounded-circle" src="LOGO.jpg" alt="logo" height="70" width="70">
            <h5 style="color: black;">GYM<span style="color: orangered;">SHINE</span></h5>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="branch.php">Branch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="membership.php">Membership</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="merchandise.php">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
            <ul>
                <li class="nav-item">
                    <a href="cart.php"><img src="cart.png" width="30px" ></a>
                </li>
                <li class="nav-item">
                    <a href="userprofile.php"><img src="user 2.png" width="30px" ></a>
                </li>
            </ul>
        </div>
    </nav>
    <!--main-->
    <header>
        <h1>Merchandise</h1>
    </header>

    <!--product-->
    <div class="product-container">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
                <h2><?php echo $product['name']; ?></h2>
                <p>$<?php echo number_format($product['price'], 2); ?></p>
                
                <!-- Add to Cart form -->
                <form method="post" action="">
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <!--footer-->
    <footer class="bg-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-test">
                        <p>Contact Us</p>
                        <ul class="mt-4">
                            <li><a href="tel:7096004208"><i class="fas fa-phone-alt"></i> +91 7096646378</a></li>
                            <li><a href="mailto:gymshine234@gmail.com"><i class="fas fa-envelope"></i> gymshine111@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="footer-test">
                        <p>Pages</p>
                        <ul class="mt-4">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="branch.php">Branch</a></li>
                            <li><a href="membership.php">Membership</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                            <li><a href="franchise.php">Franchise</a></li>
                            <li><a href="careers.php">Careers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="footer-test">
                        <p>Our Branches</p>
                        <ul class="mt-4">
                            <li><a href="#ourBranch">Vesu</a></li>
                            <li><a href="#ourBranch">Ghod Dod</a></li>
                            <li><a href="#ourBranch">Adajan</a></li>
                            <li><a href="#ourBranch">Vip Road</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 p-0">
                    <div class="footer-test">
                        <p>Follow Us</p>
                        <div class="social_icon">
                            <img src="instagram.png" width="10%" height="10%">
                            <img src="whatsapp.png" width="10%" height="10%">
                            <img src="facebook.png" width="10%" height="10%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="footer-copyright">
            <p style="color: black;">© 2024-2025 All Rights Reserved</p>
        </div>
    </footer>
</body>
</html>
