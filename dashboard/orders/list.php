<?php
require_once "../shared/header.php";
require_once "../shared/navbar.php";
require_once "../shared/sidebar.php";
require_once "../../app/dbconfig.php";

$query = "SELECT orders.id, users.name, orders.total, orders.status, orders.created_at 
                  FROM orders 
                  JOIN users ON orders.user_id = users.id 
                  ORDER BY orders.created_at DESC";
        $result = mysqli_query($conn, $query);
        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

       
        ?>

<main class="col-md-10 content p-4">
    <div class="container">
        <h2 class="mb-4">Manage Orders</h2>

        <?php

        if (!empty($orders)) {
        ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?= $order['id']; ?></td>
                            <td><?= htmlspecialchars($order['name']); ?></td>
                            <td>$<?= number_format($order['total'], 2); ?></td>
                            <td>
                                <form method="POST" action="status.php">
                                    <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="processing" <?= $order['status'] == 'processing' ? 'selected' : ''; ?>>Processing</option>
                                        <option value="shipped" <?= $order['status'] == 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                                        <option value="delivered" <?= $order['status'] == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                        <option value="canceled" <?= $order['status'] == 'canceled' ? 'selected' : ''; ?>>Canceled</option>
                                    </select>
                                </form>
                            </td>
                            <td><?= $order['created_at']; ?></td>
                            <td>
                                <a href="details.php?id=<?= $order['id']; ?>" class="btn btn-info btn-sm">View</a>
                                <a href="delete.php?id=<?= $order['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this order?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php
        } else {
            echo "<div class='alert alert-warning'>No orders found.</div>";
        }
        ?>
    </div>
</main>


        </div>
    </div>
<?php
require_once "../shared/footer.php";
?>
    