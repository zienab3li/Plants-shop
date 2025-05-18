<?php
require_once "notifications.php";
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    exit('Unauthorized');
}

if (isset($_POST['notification_id'])) {
    markNotificationAsRead($_POST['notification_id']);
    echo 'success';
} else {
    http_response_code(400);
    echo 'No notification ID provided';
}
?> 