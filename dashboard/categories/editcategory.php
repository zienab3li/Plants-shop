<?php
require_once "../shared/header.php";
require_once "../shared/navbar.php";
require_once "../shared/sidebar.php";
require_once "../../app/dbconfig.php";
if (!isset($_SESSION['user']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script> window.location.href='../error.php';</script>";
    exit;
}
$name="";
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $sql = "SELECT * FROM categories WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];  
}
if(isset($_POST['submit'])){
    $newname = $_POST['name'];
    $updateQuery="UPDATE categories SET name='$newname' WHERE id=$id";
    $updateResult = mysqli_query($conn, $updateQuery);
    if($updateResult){
        echo " Category updated successfully";

    }
    


}
?>

<main class="col-md-10 content">
    <div class="container mt-4">
        <h2>Edit Category</h2>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Category New Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?=$name?>">
            </div>
            <button type="submit" class="btn btn-success" name="submit">Update Category</button>
        </form>
    </div>
</main>

<?php
require_once "../shared/footer.php";
?>
