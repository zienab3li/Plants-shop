<?php
session_start();
require_once "./shared/header.php";
require_once "./shared/navbar.php";
require_once "./app/dbconfig.php"; // Ensure database connection is included

// Ensure an order ID is provided
if (!isset($_GET['order_id'])) {
    header("Location: index.php");
    exit;
}

$order_id = $_GET['order_id'];

// Fetch order details
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_result = $stmt->get_result();
$order = $order_result->fetch_assoc();

if (!$order) {
    echo "<p class='text-center text-danger mt-5'>Order not found.</p>";
    exit;
}

// Fetch ordered items
$stmt = $conn->prepare("
    SELECT oi.*, p.name 
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items_result = $stmt->get_result();
?>

<div class="container mt-5">
    <h2 class="text-center text-success mb-4">Order Placed Successfully!</h2>
    <p class="text-center">Your order has been placed successfully. Below are your order details.</p>

    <h4 class="mt-4">Order Summary</h4>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $items_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td>$<?php echo number_format($item['quantity'] * $item['price'], 2); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h4 class="text-end">Total: $<?php echo number_format($order['total'], 2); ?></h4>

    <div class="text-center mt-4 mb-5">
        <a href="index.php" class="btn btn-success">Continue Shopping</a>
        <a href="orders.php" class="btn btn-secondary">View Orders</a>
    </div>
</div>

<?php require_once "./shared/footer.php"; ?>
