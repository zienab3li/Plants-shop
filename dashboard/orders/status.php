<?php
require_once "../../app/dbconfig.php";
require_once "../../app/notifications.php";
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script> window.location.href='../error.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Get the order details to include in notification
    $orderQuery = "SELECT o.*, u.email FROM orders o JOIN users u ON o.user_id = u.id WHERE o.id = ?";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();

    // Update order status
    $query = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        // Create notification for admin
        createNotification(
            'status_change',
            "Order #$order_id status has been updated to " . ucfirst($status),
            "/Plants-shop/dashboard/orders/details.php?id=$order_id"
        );

        echo "<script>window.location.href='list.php';</script>";
    } else {
        echo "<script>alert('Failed to update order status.'); window.location.href='list.php';</script>";
    }
}
?>
