<?php
require_once "../../app/dbconfig.php";
require_once "../../app/notifications.php";
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script> window.location.href='../error.php';</script>";
    exit;
}

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Get order details before deletion
    $orderQuery = "SELECT o.*, u.name as customer_name FROM orders o JOIN users u ON o.user_id = u.id WHERE o.id = ?";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();

    // Delete order
    $query = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        // Create notification for admin
        createNotification(
            'order_deleted',
            "Order #$order_id from " . htmlspecialchars($order['customer_name']) . " has been deleted",
            "/Plants-shop/dashboard/orders/list.php"
        );

        echo "<script>alert('Order deleted successfully!'); window.location.href='list.php';</script>";
    } else {
        echo "<script>alert('Error deleting order.'); window.location.href='list.php';</script>";
    }
}
?>
