<?php
require_once './app/dbconfig.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Secure query
    $sql = $conn->prepare("SELECT id FROM users WHERE verification_token = ?");
    $sql->bind_param("s", $token);
    $sql->execute();
    $result = $sql->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $update = $conn->prepare("UPDATE users SET is_verified = 1, verification_token = NULL WHERE id = ?");
        $update->bind_param("i", $user['id']);
        $update->execute();
        echo "<h2>Email verification successful! You can now <a href='login.php'>log in</a>.</h2>";
    } else {
        echo "<h2>Invalid verification token.</h2>";
    }
}
?>
