<?php
require_once "../../app/dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $query = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        echo "<script>window.location.href='list.php';</script>";
    } else {
        echo "<script>alert('Failed to update order status.'); window.location.href='list.php';</script>";
    }
}
?>
