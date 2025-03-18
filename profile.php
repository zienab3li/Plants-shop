<?php
session_start();
require_once "./shared/header.php";
require_once "./shared/navbar.php";
require_once "./app/dbconfig.php"; // Ensure database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<p class='text-center text-danger mt-5'>User not found.</p>";
    exit;
}
?>

<div class="container mt-5 mb-5"> <!-- Added mb-5 for bottom margin -->
    <h2 class="text-center mb-4">My Profile</h2>

    <div class="card mx-auto" style="max-width: 400px; margin-bottom: 50px;"> <!-- Added margin-bottom -->
        <div class="card-body">
            <p class="card-title"><strong>Name:</strong><?php echo htmlspecialchars($user['name']); ?></p>
            <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <a href="./edit_profile.php" class="btn btn-success w-100 mt-3">Edit Profile</a>
        </div>
    </div>
</div>


<?php require_once "./shared/footer.php"; ?>
