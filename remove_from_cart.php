<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = $_POST["product_id"];
    unset($_SESSION["cart"][$product_id]); // Remove product from cart
}
?>
