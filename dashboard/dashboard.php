<?php
require_once "./shared/header.php";
require_once "./shared/navbar.php";
require_once "./shared/sidebar.php";
require_once "../app/dbconfig.php";

if (!isset($_SESSION['user']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script> window.location.href='../error.php';</script>";
    exit;
}

// Get statistics
$userCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users"))['count'];
$productCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM products"))['count'];
$orderCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM orders"))['count'];
$categoryCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM categories"))['count'];

// Get recent orders with total amount
$recentOrders = mysqli_query($conn, "SELECT orders.*, users.name as user_name, orders.total as total 
                                    FROM orders 
                                    JOIN users ON orders.user_id = users.id 
                                    ORDER BY orders.created_at DESC LIMIT 5");
?>

<main class="col-md-10 content">
    <div class="container-fluid">
        <!-- Statistics Row -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <h3><i class="fas fa-users me-2"></i>Total Users</h3>
                    <div class="number"><?php echo $userCount; ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3><i class="fas fa-leaf me-2"></i>Total Products</h3>
                    <div class="number"><?php echo $productCount; ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3><i class="fas fa-shopping-cart me-2"></i>Total Orders</h3>
                    <div class="number"><?php echo $orderCount; ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3><i class="fas fa-tags me-2"></i>Categories</h3>
                    <div class="number"><?php echo $categoryCount; ?></div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0"><i class="fas fa-clock me-2"></i>Recent Orders</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($order = mysqli_fetch_assoc($recentOrders)): ?>
                            <tr>
                                <td>#<?php echo $order['id']; ?></td>
                                <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                                <td>$<?php echo number_format($order['total'], 2); ?></td>
                                <td>
                                    <span class="badge bg-<?php 
                                        echo $order['status'] === 'delivered' ? 'success' : 
                                            ($order['status'] === 'pending' ? 'warning' : 
                                            ($order['status'] === 'processing' ? 'info' : 
                                            ($order['status'] === 'shipped' ? 'primary' : 'danger'))); 
                                    ?>">
                                        <?php echo ucfirst($order['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($order['created_at'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once "./shared/footer.php";
?>
    