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

// Get top selling products
$topProducts = mysqli_query($conn, "
    SELECT 
        p.name,
        p.image,
        SUM(oi.quantity) as total_quantity,
        SUM(oi.quantity * oi.price) as total_revenue
    FROM products p
    JOIN order_items oi ON p.id = oi.product_id
    GROUP BY p.id
    ORDER BY total_quantity DESC
    LIMIT 5
");
$topProductsData = mysqli_fetch_all($topProducts, MYSQLI_ASSOC);

// Prepare data for charts
$productLabels = [];
$productQuantities = [];
$productRevenue = [];
foreach ($topProductsData as $product) {
    $productLabels[] = $product['name'];
    $productQuantities[] = $product['total_quantity'];
    $productRevenue[] = $product['total_revenue'];
}
?>

<!-- Add Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        <!-- Top Products Statistics -->
        <div class="row mb-4">
            <!-- Bar Chart for Top Selling Products -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0"><i class="fas fa-chart-bar me-2"></i>Top Selling Products</h5>
                    </div>
                    <div class="card-body">
                        <div style="height: 300px;">
                            <canvas id="topProductsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Doughnut Chart for Revenue Distribution -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0"><i class="fas fa-chart-pie me-2"></i>Revenue Distribution</h5>
                    </div>
                    <div class="card-body">
                        <div style="height: 300px;">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products List -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0"><i class="fas fa-trophy me-2"></i>Top Performing Products</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($topProductsData as $index => $product): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100" style="max-height: 120px;">
                                <div class="row g-0">
                                    <div class="col-4">
                                        <img src="/Plants-shop/dashboard/assets/images/<?php echo $product['image']; ?>" 
                                             class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($product['name']); ?>"
                                             style="height: 120px; object-fit: cover;">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body py-2">
                                            <h6 class="card-title mb-1" style="font-size: 0.9rem;"><?php echo htmlspecialchars($product['name']); ?></h6>
                                            <p class="card-text mb-0">
                                                <small class="text-muted" style="font-size: 0.8rem;">
                                                    Sold: <?php echo $product['total_quantity']; ?> units<br>
                                                    Revenue: $<?php echo number_format($product['total_revenue'], 2); ?>
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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

<script>
// Initialize Charts
document.addEventListener('DOMContentLoaded', function() {
    // Bar Chart for Top Selling Products
    new Chart(document.getElementById('topProductsChart'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($productLabels); ?>,
            datasets: [{
                label: 'Units Sold',
                data: <?php echo json_encode($productQuantities); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Doughnut Chart for Revenue Distribution
    new Chart(document.getElementById('revenueChart'), {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($productLabels); ?>,
            datasets: [{
                data: <?php echo json_encode($productRevenue); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        font: {
                            size: 11
                        }
                    }
                }
            }
        }
    });
});
</script>

<?php
require_once "./shared/footer.php";
?>
    