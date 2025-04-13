<?php
if (!isset($_SESSION['admin'])) {
    header("location: index.php ");
}
include('../database/db.php');
if (isset($_POST['insert_Product'])) {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_status = true;

    $image_loc1 = $_FILES['product_image1']['tmp_name'];
    $image_name1 = $_FILES['product_image1']['name'];
    $image_des1 = "../image/" . $image_name1;
    move_uploaded_file($image_loc1, $image_des1);

    $image_loc2 = $_FILES['product_image2']['tmp_name'];
    $image_name2 = $_FILES['product_image2']['name'];
    $image_des2 = "../image/" . $image_name2;
    move_uploaded_file($image_loc2, $image_des2);

    $image_loc3 = $_FILES['product_image3']['tmp_name'];
    $image_name3 = $_FILES['product_image3']['name'];
    $image_des3 = "../image/" . $image_name3;
    move_uploaded_file($image_loc3, $image_des3);


    $user = $conn->prepare("INSERT INTO `products` (`product_name`,`product_description`, `product_keyword`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`,`status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
    $user->bind_param("sssiisssss", $product_name, $product_description, $product_keyword, $product_category, $product_brand, $image_name1, $image_name2, $image_name3, $product_price, $product_status);
    $result = $user->execute();
    if ($result) {
        echo '<script>
            alert("Product inserted successfully!");
            window.location.href = "./index.php";
        </script>';

    }
}
?>

<div class="container my-5 bg-light">
    <div class="row">
        <div class="col-md-6 m-auto p-3 border border-1 rounded shadow-lg bg-light" style="max-width: 90%;">
            <h1 class="text-center text-dark mb-3 fw-bold" style="font-size: 1.5rem;">Insert Product</h1>
            <!-- start form -->
            <form action="insert_product.php" method="POST" enctype="multipart/form-data">
                <!-- Title -->
                <div class="mb-3">
                    <label for="product_title" class="form-label fw-bold" style="font-size: 0.9rem;">Product Name:</label>
                    <input type="text" name="product_name" id="product_title" class="form-control"
                        placeholder="Product Title Here" autocomplete="off" required style="font-size: 0.9rem; padding: 0.5rem;">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="product_description" class="form-label fw-bold" style="font-size: 0.9rem;">Product Description:</label>
                    <textarea name="product_description" id="product_description" class="form-control"
                        placeholder="Description Here" rows="2" autocomplete="off" required style="font-size: 0.9rem; padding: 0.5rem;"></textarea>
                </div>

                <!-- Keyword -->
                <div class="mb-3">
                    <label for="product_keyword" class="form-label fw-bold" style="font-size: 0.9rem;">Product Keyword:</label>
                    <input type="text" name="product_keyword" id="product_keyword" class="form-control"
                        placeholder="Keyword Here" autocomplete="off" required style="font-size: 0.9rem; padding: 0.5rem;">
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="product_category" class="form-label fw-bold" style="font-size: 0.9rem;">Product Category:</label>
                    <select class="form-control" name="product_category" id="product_category" style="font-size: 0.9rem;">
                        <option value="">Select Category</option>
                        <?php
                        $query = $conn->prepare("SELECT * FROM `category`;");
                        $query->execute();
                        $result = $query->get_result();
                        $data = $result->fetch_all(MYSQLI_ASSOC);
                        foreach ($data as $row) {
                            echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Brand -->
                <div class="mb-3">
                    <label for="product_brand" class="form-label fw-bold" style="font-size: 0.9rem;">Product Brand:</label>
                    <select class="form-control" name="product_brand" id="product_brand" style="font-size: 0.9rem;">
                        <option value="">Select Brand</option>
                        <?php
                        $query = $conn->prepare("SELECT * FROM `brand`;");
                        $query->execute();
                        $result = $query->get_result();
                        $data = $result->fetch_all(MYSQLI_ASSOC);
                        foreach ($data as $row) {
                            echo "<option value='{$row['brand_id']}'>{$row['brand_name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Images -->
                <div class="mb-3">
                    <label for="product_image1" class="form-label fw-bold" style="font-size: 0.9rem;">Product Image 1:</label>
                    <input type="file" name="product_image1" id="product_image1" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="product_image2" class="form-label fw-bold" style="font-size: 0.9rem;">Product Image 2:</label>
                    <input type="file" name="product_image2" id="product_image2" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="product_image3" class="form-label fw-bold" style="font-size: 0.9rem;">Product Image 3:</label>
                    <input type="file" name="product_image3" id="product_image3" class="form-control" accept="image/*">
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="product_price" class="form-label fw-bold" style="font-size: 0.9rem;">Product Price:</label>
                    <input type="text" name="product_price" id="product_price" class="form-control"
                        placeholder="Product Price Here" autocomplete="off" required style="font-size: 0.9rem; padding: 0.5rem;">
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button name="insert_Product" class="btn btn-dark w-50 fw-bold py-2" style="font-size: 1rem;">Insert Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        form.addEventListener("submit", function (event) {
            let isValid = true;
            let messages = [];

            // Get form inputs
            const productName = document.getElementById("product_title").value.trim();
            const productDescription = document.getElementById("product_description").value.trim();
            const productKeyword = document.getElementById("product_keyword").value.trim();
            const productCategory = document.getElementById("product_category").value;
            const productBrand = document.getElementById("product_brand").value;
            const productPrice = document.getElementById("product_price").value.trim();
            const productImage1 = document.getElementById("product_image1").value;
            const productImage2 = document.getElementById("product_image2").value;
            const productImage3 = document.getElementById("product_image3").value;

            // Check for empty fields
            if (productName === "") messages.push("Product Name is required.");
            if (productDescription === "") messages.push("Product Description is required.");
            if (productKeyword === "") messages.push("Product Keyword is required.");
            if (productCategory === "") messages.push("Please select a Product Category.");
            if (productBrand === "") messages.push("Please select a Product Brand.");
            if (productPrice === "") messages.push("Product Price is required.");

            // Check if price is a valid number
            if (isNaN(productPrice) || parseFloat(productPrice) <= 0) {
                messages.push("Enter a valid price greater than 0.");
            }

            // Check if at least one image is uploaded
            if (productImage1 === "" && productImage2 === "" && productImage3 === "") {
                messages.push("Please upload at least one product image.");
            }

            // Show alert if validation fails
            if (messages.length > 0) {
                event.preventDefault();
                alert(messages.join("\n"));
            }
        });
    });
</script>