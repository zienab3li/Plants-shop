<style>
    /* Sidebar container */
.sidebar {
    background: linear-gradient(180deg,rgb(44, 80, 79) 0%,hsl(137, 28.80%, 14.30%) 100%); /* Dark gradient background */
    min-height: 100vh;
    padding: 1.5rem;
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    font-family: 'Inter', sans-serif; /* Modern font */
}

/* Sidebar nav items */
.nav-item {
    margin-bottom: 0.5rem;
}

/* Dropdown toggle link */
.nav-link.dropdown-toggle {
    color: #ecf0f1; /* Light text for contrast */
    font-weight: 500;
    font-size: 0.95rem;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
    display: flex;
    align-items: center;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.nav-link.dropdown-toggle:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    transform: translateX(5px); /* Slight slide effect on hover */
}

/* Dropdown arrow */
.nav-link.dropdown-toggle::after {
    border: none;
    content: '\f107'; /* Font Awesome chevron-down */
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    margin-left: auto;
    transition: transform 0.3s ease;
}

.nav-link.dropdown-toggle.show::after {
    transform: rotate(180deg); /* Rotate arrow when dropdown is open */
}

/* Dropdown menu */
.dropdown-menu {
    background: #ffffff; /* White background for dropdown */
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    margin-top: 0.5rem;
    padding: 0.5rem 0;
    min-width: 200px;
    animation: slideDown 0.3s ease-out; /* Smooth slide-down animation */
}

/* Dropdown menu animation */


/* Dropdown item */
.dropdown-item {
    color: #2c3e50; /* Dark text for readability */
    font-size: 0.9rem;
    padding: 0.5rem 1.5rem;
    transition: all 0.2s ease;
    border-left: 3px solid transparent;
}

.dropdown-item:hover {
    background: #f1f3f5; /* Light gray hover background */
    color: #1abc9c; /* Vibrant hover color */
    border-left: 3px solid #1abc9c; /* Colored border on hover */
    transform: translateX(3px); /* Slight slide effect */
}

/* Active dropdown item */
.dropdown-item:active {
    background: #1abc9c;
    color: #ffffff;
}

/* Ensure dropdown menu aligns properly */
.dropdown-menu {
    position: absolute;
    left: 100%; /* Position dropdown to the right of the sidebar */
    top: 0;
    margin-left: 0.5rem;
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
    .sidebar {
        min-height: auto;
        padding: 1rem;
    }
    .dropdown-menu {
        left: 0;
        margin-left: 0;
        width: 100%;
    }
}
</style>
<div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 sidebar p-3">
                <div class="nav flex-column">
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dashboard
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/Plants-shop/dashboard/dashboard.php">Analytics</a></li>
                           
                        </ul>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/Plants-shop/dashboard/products/add.php">Add Product</a></li>
                            <li><a class="dropdown-item" href="/Plants-shop/dashboard/products/list.php">List Products</a></li>
                        </ul>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Orders
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/Plants-shop/dashboard/orders/list.php">All Orders</a></li>
                        </ul>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Users
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/Plants-shop/dashboard/users/list.php">All Users</a></li>
                        </ul>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/Plants-shop/dashboard/categories/listcategories.php">All Categories</a></li>
                            <li><a class="dropdown-item" href="/Plants-shop/dashboard/categories/addcategory.php">Add Category</a></li>
                        </ul>
                    </div>
                    
                </div>
            </nav>
            