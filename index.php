<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plants - Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/YOUR_FONT_AWESOME_KIT.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(to right, #f5fbea, #f7f7f7);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
        }
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .hero-text h1 {
            font-weight: bold;
        }
        .btn-custom {
            background-color: #2c6e49;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-custom:hover {
            background-color: #1f5134;
        }
        .rating {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .rating img {
            width: 30px;
            border-radius: 50%;
            margin-right: 5px;
        }
        .rating span {
            font-weight: bold;
            margin-left: 10px;
        }
        /* Footer Styles */
        .footer {
            background:rgb(59, 126, 88);
            color: white;
            padding: 30px 0;
            text-align: center;
        }
        .footer a {
            color: black;
            font-size: 24px; /* Make icons bigger */
            margin: 0 15px; /* Add space between icons */
            display: inline-block;
            transition: color 0.3s ease-in-out, transform 0.2s;
        }
        .footer a:hover {
            color: #b0e57c; /* Light green hover effect */
            transform: scale(1.2); /* Slight zoom effect */
        }
        .footer p {
            font-size: 16px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent px-5">
        <a class="navbar-brand" href="#">Plants 🌿</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
            </ul>
            <a href="./register.php" class="btn btn-success ms-3">Sign Up</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container hero-section">
        <div class="row align-items-center">
            <div class="col-md-6 hero-text">
                <p class="text-uppercase text-muted">Safe Earth</p>
                <h1>We love helping you to safe the life.</h1>
                <p>Plants help improve air quality by reducing carbon dioxide levels, increasing humidity, and lowering levels of pollutants like benzene and nitrogen.</p>
                <a href="products.php" class="btn-custom">Buy Now</a>

                <!-- Rating Section -->
                <div class="rating">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User 1">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User 2">
                    <img src="https://randomuser.me/api/portraits/men/53.jpg" alt="User 3">
                    <span>⭐ 5.9 (110,778 Ratings)</span>
                </div>
            </div>

            <!-- Plant Image -->
            <div class="col-md-6 text-center">
                <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6" 
                    class="img-fluid" 
                    alt="Plant" 
                    style="max-width: 80%; height: 600px; border-radius: 10px; object-fit: cover;">
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>Contact Us: <i class="fas fa-envelope"></i> support@plantshop.com | <i class="fas fa-phone"></i> +123 456 7890</p>
            <div>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
            <p>&copy; 2025 Plants Shop. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
