<?php
session_start();
require_once "../shared/header.php";
require_once "../shared/navbar.php";
require_once "../shared/sidebar.php";
require_once "../../app/dbconfig.php";

// Enable Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if product ID is set
if (!isset($_GET['edit']) || empty($_GET['edit'])) {
    echo "<script>window.location.href='list.php';</script>";
    exit;
    
}

$product_id = $_GET['edit'];

// Fetch product details
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "<div class='alert alert-danger text-center mt-5'>Product not found.</div>";
    exit;
}

// Fetch categories
$selectQuery = "SELECT * FROM categories";
$result = mysqli_query($conn, $selectQuery);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle form submission
// Handle form submission
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = $_POST['price'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : 'NULL';
    $stock = $_POST['stock_quantity'];
    $image = $_FILES['product_image'];

    $image_name = $product['image']; // Keep old image by default

    // Debugging: Check if file is received
    echo "<pre>";
    var_dump($_FILES['product_image']);
    echo "</pre>";

    // If a new image is uploaded
    if ($image['error'] === 0) {
        $imageExt = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png'];

        if (in_array($imageExt, $allowedExts)) {
            $newImageName = uniqid("product_", true) . "." . $imageExt;
            $uploadPath = "/var/www/html/projects/MY_SHOP/dashboard/assets/images/" . $newImageName; // ✅ Fixed Path

            // Debugging: Check if upload path is correct
            echo "Upload Path: $uploadPath<br>";

            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                // Delete old image if it exists
                if (!empty($product['image'])) {
                    $oldImagePath = "/var/www/html/projects/MY_SHOP/dashboard/assets/images/" . $product['image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $image_name = $newImageName; // ✅ Update with new image
            } else {
                echo "<div class='alert alert-danger'>❌ Failed to upload new image.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>❌ Invalid file type. Only JPG, JPEG, PNG are allowed.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>⚠️ No new image uploaded.</div>";
    }

    // Debugging: Check final image name before updating
    echo "Final Image Name: $image_name<br>";

    // Update product details
    $updateQuery = "UPDATE products SET name = ?, description = ?, price = ?, category_id = ?, stock = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssdissi", $name, $description, $price, $category_id, $stock, $image_name, $product_id);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>✅ Product updated successfully!</div>";
        echo "<script>window.location.href='list.php';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>❌ Database Error: " . mysqli_error($conn) . "</div>";
    }
}


?>

<main class="col-md-10 content p-4">
    <div class="container">
        <h2 class="mb-4">Edit Product</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Product Name -->
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="product_name" value="<?= htmlspecialchars($product['name']); ?>" required>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="productPrice" class="form-label">Price ($)</label>
                <input type="number" class="form-control" id="productPrice" name="price" step="0.01" value="<?= $product['price']; ?>" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="productDescription" class="form-label">Description</label>
                <textarea class="form-control" id="productDescription" name="description" rows="3" required><?= htmlspecialchars($product['description']); ?></textarea>
            </div>

            <!-- Category -->
            <div class="mb-3">
                <label for="productCategory" class="form-label">Category</label>
                <select class="form-control" id="productCategory" name="category_id" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id']; ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Stock Quantity -->
            <div class="mb-3">
                <label for="stockQuantity" class="form-label">Stock Quantity</label>
                <input type="number" class="form-control" id="stockQuantity" name="stock_quantity" value="<?= $product['stock']; ?>" required>
            </div>

            <!-- Product Image -->
            <div class="mb-3">
                <label for="productImage" class="form-label">Upload Product Image</label>
                <input type="file" class="form-control" id="productImage" name="product_image">
                <p class="mt-2">Current Image:</p>
                <img src="../assets/images/<?= htmlspecialchars($product['image']); ?>" width="150" alt="Product Image">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success w-100" name="update">Update Product</button>
        </form>
    </div>
</main>

<?php require_once "../shared/footer.php"; ?>
