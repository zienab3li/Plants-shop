<?php
require_once "../shared/header.php";
require_once "../shared/navbar.php";
require_once "../shared/sidebar.php";
require_once "../../app/dbconfig.php";
$selectQuery="SELECT * FROM categories";
$result=mysqli_query($conn,$selectQuery);
$select=mysqli_fetch_all($result,MYSQLI_ASSOC);

if(isset($_POST['submit'])){
    $name=$_POST['product_name'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $category_id=$_POST['category_id'];
    $stock=$_POST['stock_quantity'];
    $image=$_FILES['product_image'];

    if($image['error']===0){
        $image_name=$image['name'];
        $image_tmp=$image['tmp_name'];
        $image_size=$image['size'];
        $imageExt=strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
        $imageExtArray=['jpg','jpeg','png'];
        if(in_array($imageExt,$imageExtArray)){
            $newImageName = uniqid("product_", true) . "." . $imageExt;
            $path="./assets/images". $newImageName;
            if(move_uploaded_file($image_tmp,$path)){
                $insertQuery = "INSERT INTO products (name, price, description, category_id, stock, image) 
                                VALUES ('$name', '$price', '$description', '$category_id', '$stock', '$newImageName')";

            }

        }
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
