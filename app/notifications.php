<?php
require_once "dbconfig.php";

function createNotification($type, $message, $link = null) {
    global $conn;
    
    // Get all admin users
    $adminQuery = "SELECT id FROM users WHERE role = 'admin'";
    $adminResult = mysqli_query($conn, $adminQuery);
    
    while ($admin = mysqli_fetch_assoc($adminResult)) {
        $stmt = $conn->prepare("INSERT INTO notifications (type, message, link, admin_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $type, $message, $link, $admin['id']);
        $stmt->execute();
    }
}

function getUnreadNotifications($admin_id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM notifications WHERE admin_id = ? AND is_read = 0 ORDER BY created_at DESC");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);
}

function markNotificationAsRead($notification_id) {
    global $conn;
    
    $stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE id = ?");
    $stmt->bind_param("i", $notification_id);
    $stmt->execute();
}

function getNotificationCount($admin_id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM notifications WHERE admin_id = ? AND is_read = 0");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc()['count'];
}
?> 