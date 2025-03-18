<?php
require_once "../shared/header.php";
require_once "../shared/navbar.php";
require_once "../shared/sidebar.php";
require_once "../../app/dbconfig.php";
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = "DELETE FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);
}
$selectQuery="SELECT * FROM products";
$result=mysqli_query($conn,$selectQuery);
$select=mysqli_fetch_all($result,MYSQLI_ASSOC);
?>

<main class="col-md-10 content">
    <div class="container mt-4">
        <h2>Products</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Quantity</th>
                   
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($select as $index => $pro):?>
                <tr>
                    <td><?= $index+1 ?></td>
                    <td><?= $pro['name']?></td>
                    <td><?= $pro['category_id']?></td>
                    <td><?= $pro['price']?></td>
                    <td><img src="../assets/images/<?= htmlspecialchars($pro['image']); ?>" alt="" width="50"></td>
                    <td><?= $pro['stock']?></td>
                   <td>
                    <a href="edit.php?edit=<?= $pro['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?delete=<?= $pro['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this proegory?')">Delete</a>
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
    
  
    