<?php
require_once "../shared/header.php";
require_once "../shared/navbar.php";
require_once "../shared/sidebar.php";
require_once "../../app/dbconfig.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('No order selected!'); window.location.href='list.php';</script>";
    exit;
}

$order_id = $_GET['id'];

// Fetch order details
$query = "SELECT orders.id, users.name, orders.total, orders.status, orders.created_at 
          FROM orders 
          JOIN users ON orders.user_id = users.id 
          WHERE orders.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    echo "<script>alert('Order not found!'); window.location.href='list.php';</script>";
    exit;
}

// Fetch order items
$query = "SELECT products.name, order_items.quantity, order_items.price
          FROM order_items 
          JOIN products ON order_items.product_id = products.id
          WHERE order_items.order_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<main class="col-md-10 content p-4">
    <div class="container">
        <h2 class="mb-4">Order Details</h2>
        <p><strong>Order ID:</strong> <?= $order['id']; ?></p>
        <p><strong>User:</strong> <?= htmlspecialchars($order['name']); ?></p>
        <p><strong>Total Price:</strong> $<?= number_format($order['total'], 2); ?></p>
        <p><strong>Status:</strong> <?= ucfirst($order['status']); ?></p>
        <p><strong>Created At:</strong> <?= $order['created_at']; ?></p>

        <h3>Order Items</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_items as $item) : ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']); ?></td>
                        <td><?= $item['quantity']; ?></td>
                        <td>$<?= number_format($item['price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="list.php" class="btn btn-secondary">Back to Orders</a>
    </div>
</main>
<?php
require_once "../shared/footer.php"
?>
