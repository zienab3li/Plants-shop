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
                            <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="btn btn-success w-100">Add to Cart</a>
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

<?php
require_once "./shared/footer.php";
?>
