<?php
require_once "./shared/header.php";
require_once "./shared/navbar.php";
require_once "./shared/sidebar.php";
if (!isset($_SESSION['user']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script> window.location.href='../error.php';</script>";
    exit;
}
?>

<main class="col-md-10 content">
               
            </main>
        </div>
    </div>
<?php
require_once "./shared/footer.php";
?>
    