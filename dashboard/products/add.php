<?php
session_start();
require_once "../shared/header.php";
require_once "../shared/navbar.php";
require_once "../shared/sidebar.php";
require_once "../../app/dbconfig.php";

// Enable Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch categories
$selectQuery = "SELECT * FROM categories";
$result = mysqli_query($conn, $selectQuery);
$select = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = $_POST['price'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : 'NULL';
    $stock = $_POST['stock_quantity'];
    $image = $_FILES['product_image'];

    if ($image['error'] === 0) {
        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $image_size = $image['size'];
        $imageExt = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png'];

        if (in_array($imageExt, $allowedExts)) {
            $newImageName = uniqid("product_", true) . "." . $imageExt;
            $path = "/var/www/html/projects/MY_SHOP/dashboard/assets/images/" . $newImageName; // Fixed path

            if (move_uploaded_file($image_tmp, $path)) {
                $insertQuery = "INSERT INTO products (name, description, price, category_id, stock, image) 
                                VALUES ('$name', '$description', $price, $category_id, $stock, '$newImageName')";

                if (mysqli_query($conn, $insertQuery)) {
                    echo "<div class='alert alert-success'>Product added successfully!</div>";
                    header("Location: list.php");
                } else {
                    echo "<div class='alert alert-danger'>Database Error: " . mysqli_error($conn) . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Failed to upload image.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Invalid file type. Only JPG, JPEG, PNG are allowed.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Please select an image.</div>";
    }
}
?>



<main class="col-md-10 content p-4">
    <div class="container">
        <h2 class="mb-4">Add New Product</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Product Name -->
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="product_name" required>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="productPrice" class="form-label">Price ($)</label>
                <input type="number" class="form-control" id="productPrice" name="price" step="0.01" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="productDescription" class="form-label">Description</label>
                <textarea class="form-control" id="productDescription" name="description" rows="3" required></textarea>
            </div>

            <!-- Category -->
            <div class="mb-3">
                <label for="productCategory" class="form-label">Category</label>
                <select class="form-control" id="productCategory" name="category_id" required>
                    <option value="">Select Category</option>
                   <?php foreach($select as $category): ?>
                   <option value="<?php echo $category['id'] ?>" ><?php echo $category['name']?></option>
                   <?php endforeach;?>
                </select>
            </div>

            <!-- Stock Quantity -->
            <div class="mb-3">
                <label for="stockQuantity" class="form-label">Stock Quantity</label>
                <input type="number" class="form-control" id="stockQuantity" name="stock_quantity" required>
            </div>

            <!-- Product Image -->
            <div class="mb-3">
                <label for="productImage" class="form-label">Upload Product Image</label>
                <input type="file" class="form-control" id="productImage" name="product_image" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success w-100" name="submit">Add Product</button>
        </form>
    </div>
</main>


<?php
require_once "../shared/footer.php";
?>
