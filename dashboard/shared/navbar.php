<?php
require_once __DIR__ . "/../../app/notifications.php";
$unreadCount = getNotificationCount($_SESSION['user_id']);
$notifications = getUnreadNotifications($_SESSION['user_id']);
?>

<header class="header d-flex justify-content-between align-items-center px-4">
    <div class="d-flex align-items-center">
        <button id="sidebarToggle" class="btn btn-link text-dark me-3 d-md-none">
            <i class="fas fa-bars"></i>
        </button>
        <h3 class="mb-0">Admin Dashboard</h3>
    </div>
    <div class="d-flex align-items-center">
        <div class="me-4">
            <div class="dropdown">
                <button class="btn btn-link text-dark position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell fs-5"></i>
                    <?php if ($unreadCount > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo $unreadCount; ?>
                    </span>
                    <?php endif; ?>
                </button>
                <div class="dropdown-menu dropdown-menu-end notification-dropdown p-0" aria-labelledby="notificationDropdown" style="width: 300px; max-height: 400px; overflow-y: auto;">
                    <div class="p-2 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Notifications</h6>
                        <?php if ($unreadCount > 0): ?>
                        <a href="javascript:void(0)" class="text-decoration-none small mark-all-read">Mark all as read</a>
                        <?php endif; ?>
                    </div>
                    <div class="notifications-list">
                        <?php if (count($notifications) > 0): ?>
                            <?php foreach($notifications as $notification): ?>
                            <a href="<?php echo $notification['link']; ?>" class="dropdown-item border-bottom p-2 notification-item" data-id="<?php echo $notification['id']; ?>">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-shopping-cart text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <p class="mb-0"><?php echo htmlspecialchars($notification['message']); ?></p>
                                        <small class="text-muted"><?php echo date('M d, H:i', strtotime($notification['created_at'])); ?></small>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="p-3 text-center text-muted">
                                No new notifications
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-link text-dark dropdown-toggle d-flex align-items-center" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="/Plants-shop/defualt.png" class="rounded-circle me-2" alt="Admin Profile" width="40" height="40">
                <span class="d-none d-md-inline"><?=$_SESSION['user_name']?></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="adminDropdown">
                <li><a class="dropdown-item" href="/Plants-shop/dashboard/profile.php">
                    <i class="fas fa-user me-2"></i>Profile
                </a></li>
                <li><a class="dropdown-item" href="/Plants-shop/dashboard/settings.php">
                    <i class="fas fa-cog me-2"></i>Settings
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="/Plants-shop/logout.php">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a></li>
            </ul>
        </div>
    </div>
</header>

<script>
document.getElementById('sidebarToggle').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('show');
});

// Mark notification as read when clicked
document.querySelectorAll('.notification-item').forEach(item => {
    item.addEventListener('click', function() {
        const notificationId = this.dataset.id;
        fetch('/Plants-shop/app/mark_notification_read.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'notification_id=' + notificationId
        });
    });
});

// Mark all notifications as read
document.querySelector('.mark-all-read')?.addEventListener('click', function() {
    document.querySelectorAll('.notification-item').forEach(item => {
        const notificationId = item.dataset.id;
        fetch('/Plants-shop/app/mark_notification_read.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'notification_id=' + notificationId
        });
    });
    
    // Update UI
    document.querySelector('.badge').remove();
    document.querySelector('.notifications-list').innerHTML = '<div class="p-3 text-center text-muted">No new notifications</div>';
    this.remove();
});
</script>