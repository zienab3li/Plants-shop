<?php
require_once "../shared/header.php";
require_once "../shared/navbar.php";
require_once "../shared/sidebar.php";
require_once "../../app/dbconfig.php";

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = "DELETE FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);
}

$selectQuery = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id";
$result = mysqli_query($conn, $selectQuery);
$select = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<style>
.product-image-container {
    width: 100px;
    height: 100px;
    overflow: hidden;
    border-radius: 8px;
}
.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}
</style>

<main class="col-md-10 content">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Products</h2>
            <a href="add.php" class="btn btn-success">Add New Product</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($select as $index => $pro): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($pro['name']) ?></td>
                        <td><?= htmlspecialchars($pro['category_name'] ?? 'No Category') ?></td>
                        <td>$<?= number_format($pro['price'], 2) ?></td>
                        <td>
                            <div class="product-image-container">
                                <img src="../assets/images/<?= htmlspecialchars($pro['image']); ?>" 
                                     class="product-image" 
                                     alt="<?= htmlspecialchars($pro['name']); ?>">
                            </div>
                        </td>
                        <td><?= $pro['stock'] ?></td>
                        <td>
                            <a href="edit.php?edit=<?= $pro['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?delete=<?= $pro['id']; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require_once "../shared/footer.php"; ?>
    
  
    