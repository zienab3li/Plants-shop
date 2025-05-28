<?php
require_once "./shared/header.php";
require_once "./shared/navbar.php";
require_once "./app/dbconfig.php";

// Get the search query
$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';

// Database connection


// Search in products table
$sql = "SELECT * FROM products WHERE 
        name LIKE ? OR 
        description LIKE ? ";
$searchTerm = "%$searchQuery%";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <div class="row">
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="./dashboard/assets/images/<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                            <p class="card-text"><strong>Price: $<?php echo htmlspecialchars($product['price']); ?></strong></p>
                            <button class="btn btn-success btn-add-to-cart" 
                                            data-id="<?php echo $product['id']; ?>" 
                                            data-name="<?php echo htmlspecialchars($product['name']); ?>" 
                                            data-price="<?php echo $product['price']; ?>">
                                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                    </button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            No products found matching your search criteria.
        </div>
    <?php endif; ?>
</div>

<?php require_once "./shared/footer.php"; ?> 