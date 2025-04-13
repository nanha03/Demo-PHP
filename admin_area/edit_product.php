<?php
if (!isset($_SESSION['admin'])) {
    header("location: index.php ");
}
include('../database/db.php');
if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_status = true;
    
    $stmt = $conn->prepare("SELECT product_image1, product_image2, product_image3 FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $existing = $stmt->get_result()->fetch_assoc();
    
    $image_name1 = $existing['product_image1'];
    $image_name2 = $existing['product_image2'];
    $image_name3 = $existing['product_image3'];
    
    // Image 1
    if (!empty($_FILES['product_image1']['name'])) {
        unlink("../image/" . $image_name1);
        $image_loc1 = $_FILES['product_image1']['tmp_name'];
        $image_name1 = $_FILES['product_image1']['name'];
        $image_des1 = "../image/" . $image_name1;
        move_uploaded_file($image_loc1, $image_des1);
    }
    
    // Image 2
    if (!empty($_FILES['product_image2']['name'])) {
        unlink("../image/" . $image_name2);
        $image_loc2 = $_FILES['product_image2']['tmp_name'];
        $image_name2 = $_FILES['product_image2']['name'];
        $image_des2 = "../image/" . $image_name2;
        move_uploaded_file($image_loc2, $image_des2);
    }
    
    // Image 3
    if (!empty($_FILES['product_image3']['name'])) {
        unlink("../image/" . $image_name3);
        $image_loc3 = $_FILES['product_image3']['tmp_name'];
        $image_name3 = $_FILES['product_image3']['name'];
        $image_des3 = "../image/" . $image_name3;
        move_uploaded_file($image_loc3, $image_des3);
    }
    
    // Update product
    $update = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_keyword=?, category_id=?, brand_id=?, product_image1=?, product_image2=?, product_image3=?, product_price=?, status=? WHERE product_id=?");
    $update->bind_param("sssiisssssi", $product_name, $product_description, $product_keyword, $product_category, $product_brand, $image_name1, $image_name2, $image_name3, $product_price, $product_status, $product_id);
    $update->execute();
    
    $msg = $update->affected_rows > 0 ? "Product updated successfully!" : "Error updating product!";
    echo "<script>alert('$msg'); window.location.href = 'index.php?view_product';</script>";
    
    
}
if (isset($_GET['edit_product'])) {
    $product_id = $_GET['edit_product'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if ($row) {
        $product_name = $row['product_name'];
        $product_description = $row['product_description'];
        $product_keyword = $row['product_keyword'];
        $product_price = $row['product_price'];

        $category_result = $conn->query("SELECT category_name FROM category WHERE category_id = {$row['category_id']}");
        foreach ($category_result as $cat)
            $category_name = $cat['category_name'];

        $brand_result = $conn->query("SELECT brand_name FROM brand WHERE brand_id = {$row['brand_id']}");
        foreach ($brand_result as $br)
            $brand_name = $br['brand_name'];

        $product_price = $row['product_price'];
        $product_image1 = $row['product_image1'];
        $product_image2 = $row['product_image2'];
        $product_image3 = $row['product_image3'];

        $image_des1 = "../image/" . $product_image1;
        $image_des2 = "../image/" . $product_image2;
        $image_des3 = "../image/" . $product_image3;

        $selected_category_id = $row['category_id'];
        $selected_brand_id = $row['brand_id'];
    }
    ?>




    <div class="container my-5 bg-light">
        <div class="row">
            <div class="col-md-6 m-auto p-3 border border-1 rounded shadow-lg bg-light" style="max-width: 90%;">
                <h1 class="text-center text-dark mb-3 fw-bold" style="font-size: 1.5rem;">Edit Product</h1>
                <!-- start form -->
                <form action="index.php?edit_product" method="POST" enctype="multipart/form-data">
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="product_title" class="form-label fw-bold" style="font-size: 0.9rem;">Product
                            Name:</label>
                        <input value="<?php echo htmlspecialchars($product_name); ?>" type="text" name="product_name"
                            id="product_title" class="form-control" placeholder="Product Title Here" autocomplete="off"
                            required style="font-size: 0.9rem; padding: 0.5rem;">
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="product_description" class="form-label fw-bold" style="font-size: 0.9rem;">Product
                            Description:</label>
                        <textarea name="product_description" id="product_description" class="form-control"
                            placeholder="Description Here" rows="2" required
                            style="font-size: 0.9rem; padding: 0.5rem;"><?php echo htmlspecialchars($product_description); ?></textarea>
                    </div>

                    <!-- Keyword -->
                    <div class="mb-3">
                        <label for="product_keyword" class="form-label fw-bold" style="font-size: 0.9rem;">Product
                            Keyword:</label>
                        <input value="<?php echo htmlspecialchars($product_keyword); ?>" type="text" name="product_keyword"
                            id="product_keyword" class="form-control" placeholder="Keyword Here" required
                            style="font-size: 0.9rem; padding: 0.5rem;">
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="product_category" class="form-label fw-bold" style="font-size: 0.9rem;">Product
                            Category:</label>
                        <select class="form-control" name="product_category" id="product_category"
                            style="font-size: 0.9rem;">
                            <?php
                            $query = $conn->prepare("SELECT * FROM `category`;");
                            $query->execute();
                            $result = $query->get_result();
                            $data = $result->fetch_all(MYSQLI_ASSOC);
                            foreach ($data as $cat) {
                                $selected = ($cat['category_id'] == $selected_category_id) ? 'selected' : '';
                                echo "<option value='{$cat['category_id']}' $selected>{$cat['category_name']}</option>";
                            }
                            ?>
                        </select>

                    </div>

                    <!-- Brand -->
                    <div class="mb-3">
                        <label for="product_brand" class="form-label fw-bold" style="font-size: 0.9rem;">Product
                            Brand:</label>
                        <select class="form-control" name="product_brand" id="product_brand" style="font-size: 0.9rem;">

                            <?php
                            $query = $conn->prepare("SELECT * FROM `brand`;");
                            $query->execute();
                            $result = $query->get_result();
                            $data = $result->fetch_all(MYSQLI_ASSOC);
                            foreach ($data as $brand) {
                                $selected = ($brand['brand_id'] == $selected_brand_id) ? 'selected' : '';
                                echo "<option value='{$brand['brand_id']}' $selected>{$brand['brand_name']}</option>";
                            }
                            ?>
                        </select>

                    </div>

                    <!-- Images -->
                    <!-- Image 1 -->
                    <div class="mb-3 d-flex align-items-center border border-dark rounded p-2">
                        <label for="product_image1" class="border-dark flex-grow-1 me-2 p-2 bg-light text-dark"
                            style="cursor: pointer;">
                            Add Different Image 1
                            <input type="file" id="product_image1" name="product_image1" class="d-none" accept="image/*">
                        </label>
                        <img id="preview1" src="<?php echo "../image/" . $product_image1; ?>" class="img-thumbnail"
                            width="100">
                    </div>

                    <!-- Image 2 -->
                    <div class="mb-3 d-flex align-items-center border border-dark rounded p-2">
                        <label for="product_image2" class="border-dark flex-grow-1 me-2 p-2 bg-light text-dark"
                            style="cursor: pointer;">
                            Add Different Image 2
                            <input type="file" id="product_image2" name="product_image2" class="d-none" accept="image/*">
                        </label>
                        <img id="preview2" src="<?php echo "../image/" . $product_image2; ?>" class="img-thumbnail"
                            width="100">
                    </div>

                    <!-- Image 3 -->
                    <div class="mb-3 d-flex align-items-center border border-dark rounded p-2">
                        <label for="product_image3" class="border-dark flex-grow-1 me-2 p-2 bg-light text-dark"
                            style="cursor: pointer;">
                            Add Different Image 3
                            <input type="file" id="product_image3" name="product_image3" class="d-none" accept="image/*">
                        </label>
                        <img id="preview3" src="<?php echo "../image/" . $product_image3; ?>" class="img-thumbnail"
                            width="100">
                    </div>


                    <!-- Price -->
                    <div class="mb-3">
                        <label for="product_price" class="form-label fw-bold" style="font-size: 0.9rem;">Product
                            Price:</label>
                        <input type="text" value="<?php echo htmlspecialchars($product_price); ?>" name="product_price" id="product_price" class="form-control"
                            placeholder="Product Price Here" autocomplete="off" required
                            style="font-size: 0.9rem; padding: 0.5rem;">
                    </div>

                    <!-- passing id -->
                     <input type="hidden" value="<?php echo $product_id; ?>" name="product_id">

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button name="update" class="btn btn-dark w-50 fw-bold py-2"
                            style="font-size: 1rem;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    const imageInputs = [
        { inputId: 'product_image1', previewId: 'preview1' },
        { inputId: 'product_image2', previewId: 'preview2' },
        { inputId: 'product_image3', previewId: 'preview3' }
    ];

    imageInputs.forEach(({ inputId, previewId }) => {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result; // update image src to new one
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>