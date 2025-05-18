<header class="header d-flex justify-content-between align-items-center px-4">
    <div class="d-flex align-items-center">
        <button id="sidebarToggle" class="btn btn-link text-dark me-3 d-md-none">
            <i class="fas fa-bars"></i>
        </button>
        <h3 class="mb-0">Admin Dashboard</h3>
    </div>
    <div class="d-flex align-items-center">
        <div class="me-4 position-relative">
            <a href="#" class="text-dark text-decoration-none">
                <i class="fas fa-bell fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                </span>
            </a>
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
</script>