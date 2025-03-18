<?php
session_start();
require_once "./shared/header.php";
require_once "./shared/navbar.php";
require_once "./app/dbconfig.php"; // Ensure database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch orders for the logged-in user
$query = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">My Orders</h2>

    <?php if (count($orders) > 0): ?>
        <?php foreach ($orders as $order): ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Order #<?php echo $order['id']; ?></h5>
                    <p class="text-muted">Placed on: <?php echo $order['created_at']; ?></p>
                    <p><strong>Status:</strong> <span class="badge bg-<?php echo getStatusColor($order['status']); ?>"><?php echo ucfirst($order['status']); ?></span></p>
                    
                    <!-- Fetch Order Items -->
                    <?php
                    $order_id = $order['id'];
                    $item_query = "SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?";
                    $item_stmt = $conn->prepare($item_query);
                    $item_stmt->bind_param("i", $order_id);
                    $item_stmt->execute();
                    $items_result = $item_stmt->get_result();
                    $items = $items_result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <ul class="list-group mb-3">
                        <?php foreach ($items as $item): ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><?php echo htmlspecialchars($item['name']); ?> (x<?php echo $item['quantity']; ?>)</span>
                                <span>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <h5 class="text-end">Total: $<?php echo number_format($order['total'], 2); ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">You have no past orders.</p>
    <?php endif; ?>
</div>

<?php
require_once "./shared/footer.php";

// Function to determine the badge color for order status
function getStatusColor($status) {
    switch ($status) {
        case 'pending': return 'warning';
        case 'processing': return 'primary';
        case 'shipped': return 'info';
        case 'delivered': return 'success';
        case 'canceled': return 'danger';
        default: return 'secondary';
    }
}
?>
