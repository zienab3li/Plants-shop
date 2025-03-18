<?php
require_once "../../app/dbconfig.php";
if (!isset($_SESSION['user']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script> window.location.href='../error.php';</script>";
    exit;
}

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Delete order
    $query = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo "<script>alert('Order deleted successfully!'); window.location.href='list.php';</script>";
    } else {
        echo "<script>alert('Error deleting order.'); window.location.href='list.php';</script>";
    }
}
?>
