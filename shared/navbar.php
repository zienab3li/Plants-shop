<?php
session_start();
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-transparent px-5 fixed-top ">
        <a class="navbar-brand" href="#">Plants 🌿</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="./index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="./products.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="./contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="./aboutus.php">About Us</a></li>
            </ul>
            <?php if(isset($_SESSION['user'])):?>
                <div class="ms-auto">
                    <a href="cart.php" class="btn btn-outline-success position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">
                            <?php echo $cartCount; ?>
                        </span>
                    </a>
                </div>
            <a href="./logout.php" class="btn btn-success ms-3">Log Out</a>
            <a href="./profile.php" class="btn btn-success ms-3"><?=$_SESSION['user_name']?></a>
            <?php else:?>
            <a href="./register.php" class="btn btn-success ms-3">Sign Up</a>
            <a href="./login.php" class="btn btn-success ms-3">Log In</a>
            <?php endif;?>
        </div>
    </nav>