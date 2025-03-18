<header class="header d-flex justify-content-between align-items-center px-4">
        <h3>Admin Dashboard</h3>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="http://192.168.1.14/projects/MY_SHOP/defualt.png" class="rounded-circle" alt="Admin Profile" width="50px" height="50px"> <?=$_SESSION['user_name']?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                <li><a class="dropdown-item text-danger" href="../../logout.php" >Logout</a></li>
            </ul>
        </div>
    </header>