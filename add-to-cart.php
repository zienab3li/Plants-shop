<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $product_id = $_POST['product_id'] ?? null;
    $product_name = $_POST['product_name'] ?? null;
    $product_price = $_POST['product_price'] ?? null;

    // Debugging: Check if data is received
    if (!$product_id || !$product_name || !$product_price) {
        echo json_encode(["error" => "Missing product data"]);
        exit;
    }

    // Initialize cart session if not set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Debugging: Check session before update
    error_log("Before update: " . print_r($_SESSION['cart'], true));

    // If product exists, increase quantity; otherwise, add new product
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1
        ];
    }

    // Debugging: Check session after update
    error_log("After update: " . print_r($_SESSION['cart'], true));

    // Return updated cart count
    echo json_encode(["cart_count" => array_sum(array_column($_SESSION['cart'], 'quantity'))]);
    exit;
}
?>
