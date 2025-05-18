<?php
session_start();
require_once "./shared/header.php";
require_once "./shared/navbar.php";
require_once "./app/dbconfig.php"; // Make sure you have a database connection file
require_once "./app/notifications.php"; // Add notifications support

// Redirect if cart is empty
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Calculate total price
$totalPrice = 0;
foreach ($_SESSION['cart'] as $product) {
    $totalPrice += $product['price'] * $product['quantity'];
}

// Process order submission
if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
    $user_id = $_SESSION['user_id']; // Ensure user is logged in and has an ID
    $payment_method = $_POST['payment_method'];

    $conn->begin_transaction();
    try {
        // Insert into orders table
        $stmt = $conn->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
        $stmt->bind_param("id", $user_id, $totalPrice);
        $stmt->execute();
        $order_id = $stmt->insert_id; // Get the last inserted order ID

        // Insert order items
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $stmt->bind_param("iiid", $order_id, $product_id, $product['quantity'], $product['price']);
            $stmt->execute();
        }

        // Insert payment record
        $stmt = $conn->prepare("INSERT INTO payments (order_id, user_id, amount, payment_method) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iids", $order_id, $user_id, $totalPrice, $payment_method);
        $stmt->execute();

        // Create notification for admin
        createNotification(
            'new_order',
            "New order #$order_id has been placed for $" . number_format($totalPrice, 2),
            "/Plants-shop/dashboard/orders/details.php?id=$order_id"
        );

        // Commit the transaction
        $conn->commit();

        // Clear the cart
        unset($_SESSION['cart']);

        // Redirect to success page
        header("Location: succes.php?order_id=" . $order_id);
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error placing order: " . $e->getMessage();
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Checkout</h2>
    
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td>$<?php echo number_format($product['price'], 2); ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td>$<?php echo number_format($product['price'] * $product['quantity'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="text-end">Total: $<?php echo number_format($totalPrice, 2); ?></h4>

    <form method="POST" class="mt-4">
        <h5>Select Payment Method:</h5>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" value="credit_card" required>
            <label class="form-check-label">Credit Card</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" value="paypal">
            <label class="form-check-label">PayPal</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" value="cash_on_delivery">
            <label class="form-check-label">Cash on Delivery</label>
        </div>

        <div class="text-center mt-4 mb-5">
            <button type="submit" class="btn btn-success btn-lg">Place Order</button>
        </div>
    </form>
</div>

<?php require_once "./shared/footer.php"; ?>
