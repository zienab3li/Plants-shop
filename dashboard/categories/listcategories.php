<?php
require_once "../shared/header.php";
require_once "../shared/navbar.php";
require_once "../shared/sidebar.php";
require_once "../../app/dbconfig.php";
if (!isset($_SESSION['user']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script> window.location.href='../error.php';</script>";
    exit;
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE id = $id";
    $result = mysqli_query($conn, $query);
}
$selectQuery="SELECT * FROM categories";
$result=mysqli_query($conn,$selectQuery);
$select=mysqli_fetch_all($result,MYSQLI_ASSOC);
?>

<main class="col-md-10 content">
    <div class="container mt-4">
        <h2>Categories</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($select as $index => $cat):?>
                <tr>
                    <td><?= $index+1 ?></td>
                    <td><?= $cat['name']?></td>
                    <td>
                    <a href="editcategory.php?edit=<?= $cat['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?delete=<?= $cat['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach;?>
               
            </tbody>
        </table>
    </div>
</main>

        </div>
    </div>
<?php
require_once "../shared/footer.php";
?>
    
  
    