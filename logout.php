<?php
session_start(); // ✅ Start the session before destroying it
session_unset(); // ✅ Unset all session variables
session_destroy(); // ✅ Destroy the session
setcookie(session_name(), '', time() - 3600, '/'); // ✅ Delete the session cookie (optional but recommended)

header('Location: login.php');
exit();
?>
