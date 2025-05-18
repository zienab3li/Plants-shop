<?php
require_once "./shared/header.php";
require_once "./shared/navbar.php";
?>

<style>
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: url('https://images.unsplash.com/photo-1466781783364-36c955e42a7f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80') no-repeat center center;
    background-size: cover;
    padding: 100px 0;
    color: white;
    text-align: center;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.hero-badge {
    display: inline-block;
    padding: 8px 16px;
    background: rgba(46, 204, 113, 0.2);
    color: #fff;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
    backdrop-filter: blur(5px);
}

.hero-title {
    font-size: 4rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 25px;
    color: white;
    font-family: 'Playfair Display', serif;
}

.hero-description {
    font-size: 1.2rem;
    line-height: 1.8;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 35px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.btn-custom {
    display: inline-block;
    padding: 15px 40px;
    background: rgba(46, 204, 113, 0.9);
    color: white;
    text-decoration: none;
    border-radius: 30px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
    backdrop-filter: blur(5px);
}

.btn-custom:hover {
    transform: translateY(-3px);
    background: rgba(46, 204, 113, 1);
    box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
    color: white;
}

.rating {
    margin-top: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    background: rgba(255, 255, 255, 0.1);
    padding: 15px 25px;
    border-radius: 15px;
    backdrop-filter: blur(5px);
}

.rating-images {
    display: flex;
    margin-right: 15px;
}

.rating img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 3px solid rgba(255, 255, 255, 0.8);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    margin-left: -15px;
}

.rating img:first-child {
    margin-left: 0;
}

.rating-text {
    font-size: 0.95rem;
    color: white;
    display: flex;
    align-items: center;
    gap: 5px;
}

.rating-stars {
    color: #f1c40f;
    margin-right: 5px;
}

/* Features Section */
.features-section {
    padding: 80px 0;
    background: white;
}

.feature-card {
    padding: 30px;
    border-radius: 15px;
    background: white;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: rgba(46, 204, 113, 0.1);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.feature-icon i {
    font-size: 24px;
    color: #2ecc71;
}

.feature-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: #2c3e50;
}

.feature-description {
    color: #666;
    line-height: 1.6;
}
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <span class="hero-badge">Eco-Friendly</span>
        <h1 class="hero-title">Bring Nature Into Your Home</h1>
        <p class="hero-description">Transform your space with our carefully curated collection of plants. Each plant is hand-picked to help purify your air and create a more vibrant, healthy living environment.</p>
        <a href="products.php" class="btn-custom">Explore Collection</a>

        <!-- Rating Section -->
      
    </div>
</div>

<!-- Features Section -->
<div class="features-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="feature-title">Fresh & Healthy</h3>
                    <p class="feature-description">All our plants are carefully nurtured and maintained to ensure they arrive at your doorstep in perfect condition.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3 class="feature-title">Fast Delivery</h3>
                    <p class="feature-description">We ensure quick and safe delivery of your plants with our specialized packaging and shipping methods.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 class="feature-title">Expert Support</h3>
                    <p class="feature-description">Our team of plant experts is always ready to help you with care tips and maintenance advice.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<?php require_once "./shared/footer.php"; ?>