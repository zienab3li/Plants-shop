<?php
require_once "../shared/header.php";
require_once "../shared/navbar.php";
require_once "../shared/sidebar.php";
require_once "../../app/dbconfig.php";
if (!isset($_SESSION['user']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script> window.location.href='../error.php';</script>";
    exit;
}
?>

<main class="col-md-10 content p-4">
    <div class="container">
        <h2 class="mb-4">Users List</h2>
        
        <?php
        // Fetch all users from the database
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetch all users as an associative array

        if (!empty($users)) {
        ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user['id']; ?></td>
                            <td><?= htmlspecialchars($user['name']); ?></td>
                            <td><?= htmlspecialchars($user['email']); ?></td>
                            <td>
                                <a href="delete.php?id=<?= $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php
        } else {
            echo "<div class='alert alert-warning'>No users found.</div>";
        }
        ?>
    </div>
</main>

        </div>
    </div>
<?php
require_once "../shared/footer.php";
?>
    