<?php
require_once "./shared/header.php";
require_once "./shared/navbar.php";
require_once "./app/dbconfig.php";

$selectQuery = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id";
$result = mysqli_query($conn, $selectQuery);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<style>
.product-card {
    height: 100%;
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 12px;
    overflow: hidden;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.product-image-container {
    position: relative;
    width: 100%;
    padding-top: 100%; /* 1:1 Aspect Ratio */
    overflow: hidden;
}
.product-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}
.card-body {
    padding: 1.25rem;
    background: white;
}
.product-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #2c3e50;
}
.product-description {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 2.8em;
}
.product-price {
    font-size: 1.2rem;
    color: #2ecc71;
    font-weight: 600;
    margin-bottom: 0.5rem;
}
.stock-info {
    color: #7f8c8d;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}
.btn-add-to-cart {
    width: 100%;
    padding: 0.75rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}
.btn-add-to-cart:hover {
    transform: translateY(-2px);
}

/* Toast Notification */
.toast-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}
.toast {
    opacity: 0;
    transform: translateY(100%);
    transition: all 0.3s ease;
}
.toast.show {
    opacity: 1;
    transform: translateY(0);
}
</style>

<!-- Toast Container -->
<div class="toast-container"></div>

<div class="container mt-5">
    <h2 class="text-center mb-4">Our Products</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="./dashboard/assets/images/<?php echo htmlspecialchars($product['image']); ?>" 
                             class="product-image" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                        <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                        <div class="stock-info">
                            Stock: <?php echo $product['stock']; ?> units
                        </div>
                        <div class="mt-auto">
                            <?php if ($product['stock'] > 0): ?>
                                <?php if(isset($_SESSION['user'])): ?>
                                    <button class="btn btn-success btn-add-to-cart" 
                                            data-id="<?php echo $product['id']; ?>" 
                                            data-name="<?php echo htmlspecialchars($product['name']); ?>" 
                                            data-price="<?php echo $product['price']; ?>">
                                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-add-to-cart" disabled>
                                        <i class="fas fa-lock me-2"></i>Please login/signup
                                    </button>
                                <?php endif; ?>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-add-to-cart" disabled>
                                    <i class="fas fa-times-circle me-2"></i>Out of Stock
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function showToast(message, type = 'success') {
    const toastContainer = $('.toast-container');
    const toast = $(`
        <div class="toast align-items-center text-white bg-${type} border-0 mb-2" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `);
    
    toastContainer.append(toast);
    setTimeout(() => toast.addClass('show'), 100);
    
    setTimeout(() => {
        toast.removeClass('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

$(document).ready(function() {
    $(".btn-add-to-cart").click(function() {
        let productId = $(this).data("id");
        let productName = $(this).data("name");
        let productPrice = $(this).data("price");

        $.ajax({
            url: "add-to-cart.php",
            method: "POST",
            data: {
                product_id: productId,
                product_name: productName,
                product_price: productPrice
            },
            success: function(response) {
                $("#cart-count").text(response.cart_count);
                showToast('Product added to cart successfully!', 'success');
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                showToast('Failed to add product to cart. Please try again.', 'danger');
            }
        });
    });
});
</script>

<?php require_once "./shared/footer.php"; ?>
