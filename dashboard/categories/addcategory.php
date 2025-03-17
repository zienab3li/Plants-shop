<?php
require_once "../shared/header.php";
require_once "../shared/navbar.php";
require_once "../shared/sidebar.php";
require_once "../../app/dbconfig.php";
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $insertQuery="INSERT INTO categories (name) VALUES ('$name')";
    $result = mysqli_query($conn, $insertQuery);
    if($result){
        echo "<script>alert('Category Added Successfully')</script>";
    }
}
?>

<main class="col-md-10 content">
    <div class="container mt-4">
        <h2>Add New Category</h2>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-success" name="submit">Add Category</button>
        </form>
    </div>
</main>

<?php
require_once "../shared/footer.php";
?>
