<?php
require_once "./shared/header.php";
require_once "./shared/navbar.php";
require_once "./app/dbconfig.php";

$selectQuery = "SELECT * FROM products";
$result = mysqli_query($conn, $selectQuery);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Our Products</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="./dashboard/assets/images/<?php echo $product['image']; ?>" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text text-truncate"><?php echo htmlspecialchars($product['description']); ?></p>
                        <h6 class="text-success">$<?php echo number_format($product['price'], 2); ?></h6>
                        <small class="text-muted">Stock: <?php echo $product['stock']; ?></small>
                        <div class="mt-auto">
                        <?php if ($product['stock'] > 0) : ?>
                            <button class="btn btn-success w-100 add-to-cart" data-id="<?php echo $product['id']; ?>" 
                                    data-name="<?php echo htmlspecialchars($product['name']); ?>" 
                                    data-price="<?php echo $product['price']; ?>">
                                Add to Cart
                            </button>
                            <?php if(!isset($_SESSION['user'])) : ?>

                                <button class="btn btn-secondary w-100" disabled>Please login/signup</button>
                                <?php endif; ?>
                            <?php else : ?>
                                <button class="btn btn-secondary w-100" disabled>Out of Stock</button>
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
$(document).ready(function() {
    $(".add-to-cart").click(function() {
        let productId = $(this).data("id");
        let productName = $(this).data("name");
        let productPrice = $(this).data("price");

        $.ajax({
            url: "/projects/MY_SHOP/add-to-cart.php",  // Adjust based on your project structure
    method: "POST",
    data: {
        product_id: productId,
        product_name: productName,
        product_price: productPrice
    },
    success: function(response) {
        console.log(response); // Debug response in browser console
        $("#cart-count").text(response.cart_count); // Update cart count in navbar
    },
    error: function(xhr, status, error) {
        console.error("Error:", error); // Debug errors
    }
});

    });
});

</script>


<?php
require_once "./shared/footer.php";
?>
