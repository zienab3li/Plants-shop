
<?php
require_once "./shared/header.php";
require_once "./shared/navbar.php";
?>
    

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

   
<?php
require_once "./shared/footer.php";
?>