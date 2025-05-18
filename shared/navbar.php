<?php

$cartCount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
?>


<!-- Navbar -->
<style>
@media (max-width: 991px) {
    .navbar {
        background-color: white !important;
        padding: 10px 15px !important;
    }
    
    .navbar-collapse {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 10px;
    }

    .navbar .btn {
        margin: 5px 0 !important;
        width: 100%;
        text-align: left;
    }

    .navbar-nav {
        margin-bottom: 15px;
    }

    .user-actions {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .cart-button {
        width: 100% !important;
        margin: 5px 0 !important;
    }
}

.navbar {
    transition: background-color 0.3s ease;
}

.navbar.scrolled {
    background-color: white !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
    font-weight: 600;
    font-size: 1.4rem;
}

.nav-link {
    font-weight: 500;
    padding: 8px 16px !important;
}

.nav-link:hover {
    color: #2ecc71 !important;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-transparent px-4 fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Plants 🌿</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="./index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="./products.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="./contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="./aboutus.php">About Us</a></li>
            </ul>
            
            <div class="user-actions">
                <?php if(isset($_SESSION['user'])):?>
                    <a href="/Plants-shop/cart.php" class="btn btn-outline-success position-relative cart-button">
                        <i class="fas fa-shopping-cart"></i> Cart
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">
                            <?php echo $cartCount; ?>
                        </span>
                    </a>
                    <a href="./orders.php" class="btn btn-success">My Orders</a>
                    <a href="./profile.php" class="btn btn-success"><?=$_SESSION['user_name']?></a>
                    <a href="/Plants-shop/logout.php" class="btn btn-outline-danger">Log Out</a>
                <?php else:?>
                    <a href="./register.php" class="btn btn-success">Sign Up</a>
                    <a href="./login.php" class="btn btn-outline-success">Log In</a>
                <?php endif;?>
            </div>
        </div>
    </div>
</nav>

<script>
// Add background color to navbar on scroll
document.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Close mobile menu when clicking a link
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
        const navbarCollapse = document.querySelector('.navbar-collapse');
        if (navbarCollapse.classList.contains('show')) {
            navbarCollapse.classList.remove('show');
        }
    });
});
</script>