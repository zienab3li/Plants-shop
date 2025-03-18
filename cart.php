<?php
session_start(); // Ensure session is started
require_once "./shared/header.php";
require_once "./shared/navbar.php";
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Shopping Cart</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalPrice = 0;
                foreach ($_SESSION['cart'] as $product_id => $product): 
                    $subtotal = $product['price'] * $product['quantity'];
                    $totalPrice += $subtotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td>$<?php echo number_format($product['price'], 2); ?></td>
                        <td>
                            <button class="btn btn-sm btn-secondary update-quantity" data-id="<?php echo $product_id; ?>" data-action="decrease">-</button>
                            <span class="mx-2"><?php echo $product['quantity']; ?></span>
                            <button class="btn btn-sm btn-primary update-quantity" data-id="<?php echo $product_id; ?>" data-action="increase">+</button>
                        </td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="<?php echo $product_id; ?>">Remove</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h4 class="text-end">Total: $<?php echo number_format($totalPrice, 2); ?></h4>
         <!-- Centered Checkout Button with Spacing -->
         <div class="text-center mt-4 mb-5">
            <a href="checkout.php" class="btn btn-success btn-lg">Proceed to Checkout</a>
        </div>
    <?php else: ?>
        <p class="text-center">Your cart is empty.</p>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(".update-quantity").click(function() {
        let productId = $(this).data("id");
        let action = $(this).data("action");

        $.ajax({
            url: "update_cart.php",
            method: "POST",
            data: { product_id: productId, action: action },
            success: function(response) {
                location.reload(); // Refresh page to show updated cart
            }
        });
    });

    $(".remove-from-cart").click(function() {
        let productId = $(this).data("id");

        $.ajax({
            url: "remove_from_cart.php",
            method: "POST",
            data: { product_id: productId },
            success: function(response) {
                location.reload(); // Refresh cart page
            }
        });
    });
});
</script>

<?php require_once "./shared/footer.php"; ?>
