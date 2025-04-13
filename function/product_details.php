<?php
include('./database/db.php');
if (isset($_GET['product-details-page'])) {
    $product_id = $_GET['product-details-page'];
    $querry = $conn->prepare("SELECT * FROM `products` JOIN `brand` ON products.brand_id = brand.brand_id JOIN `category` ON products.category_id = category.category_id WHERE products.product_id = ?");
    $querry->bind_param("i", $product_id);
    $querry->execute();
    $result = $querry->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $brand_name = $row['brand_name'];
        $category_name = $row['category_name'];
        $product_name = $row['product_name'];
        $product_id = $row['product_id'];
        $brand_id = $row['brand_id'];
        $category_id = $row['category_id'];

        $product_image1 = $row['product_image1'];
        $product_image2 = $row['product_image2'];
        $product_image3 = $row['product_image3'];

        $image_dir1 = htmlspecialchars("image/" . $product_image1, ENT_QUOTES);
        $image_dir2 = htmlspecialchars("image/" . $product_image2, ENT_QUOTES);
        $image_dir3 = htmlspecialchars("image/" . $product_image3, ENT_QUOTES);

        $product_description = $row['product_description'];
        $product_price = $row['product_price'];

        // Split description by line breaks or full stops for bullet points
        $description_points = preg_split('/[\r\n\.]+/', $product_description, -1, PREG_SPLIT_NO_EMPTY);

        echo "<div class='container mt-5'>
        <div class='row justify-content-center'>
            <div class='col-12'>
                <div class='card border border-warning shadow-lg p-3'>
                    <div class='row g-0'>
                        <!-- Image Section -->
                        <div class='col-12 col-md-6 d-flex flex-column flex-md-row'>
                            <!-- Thumbnails Section (Responsive) -->
                            <div class='d-flex flex-row flex-md-column align-center align-items-md-start mb-3 mb-md-0' style='gap: 10px;'>
                                <img src='$image_dir1' class='img-thumbnail thumbnail-image' style='width: 100%; max-width: 80px; height: auto; object-fit: cover; cursor: pointer;' onclick='changeImage(this.src)'>
                                <img src='$image_dir2' class='img-thumbnail thumbnail-image' style='width: 100%; max-width: 80px; height: auto; object-fit: cover; cursor: pointer;' onclick='changeImage(this.src)'>
                                <img src='$image_dir3' class='img-thumbnail thumbnail-image' style='width: 100%; max-width: 80px; height: auto; object-fit: cover; cursor: pointer;' onclick='changeImage(this.src)'>
                            </div>
    
                            <!-- Main Image Display -->
                            <div class='d-flex align-items-center justify-content-center' style='flex-grow: 1; padding: 10px;'>
                                <img id='mainImage' src='$image_dir1' class='img-fluid rounded' style='max-height: 100%; width: auto; object-fit: contain;' alt='$product_name'>
                            </div>
                        </div>
    
                        <!-- Product Details Section -->
                        <div class='col-12 col-md-6 d-flex align-items-center'>
                            <div class='card-body text-center w-100'>
                                <h2 class='card-title text-primary fw-bold'>$product_name</h2>
                                <h4 class='text-danger'>₹$product_price</h4>
                                <ul class='card-text text-muted text-start'>";
    
                                foreach ($description_points as $point) {
                                    echo "<li>" . trim($point) . "</li>";
                                }
                                echo "</ul>
                                <p class='card-text text-muted'>
                                    Category: <a href='index.php?category=$category_id' class='text-decoration-none text-warning fw-bold'>$category_name</a>
                                </p>
                                <p class='card-text text-muted'>
                                    Brand: <a href='index.php?brand=$brand_id' class='text-decoration-none text-warning fw-bold'>$brand_name</a>
                                </p>
                                <div class='d-flex justify-content-center mt-4 gap-3 flex-column flex-md-row'>
                                    <a href='?add-to-cart=$product_id' class='btn btn-warning btn-lg px-4 py-2 shadow-sm rounded-pill w-100 w-md-auto'>
                                        🛒 Add to Cart
                                    </a>
                                    <a href='index.php' class='btn btn-dark btn-lg px-4 py-2 shadow-sm rounded-pill w-100 w-md-auto'>
                                        Back Home
                                    </a>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>";
    

    }
}
?>

<!-- JavaScript to handle image changing -->
<script>
    function changeImage(src) {
        document.getElementById('mainImage').src = src;
    }
</script>




<!-- Product suggestion / Related products -->

<?php
if (isset($_GET['product-details-page'])) {
    $product_id = $_GET['product-details-page'];

    // Fetching brand_id from the products table
    $query = "SELECT brand_id FROM products WHERE product_id = $product_id";
    $result = $conn->query($query);
    $brand_id = $result->fetch_assoc()['brand_id'];

    // Fetching related products by the same brand
    $query = "SELECT * FROM products WHERE brand_id = $brand_id AND product_id != $product_id LIMIT 0,4";
    $result = $conn->query($query);
    ?>
    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4"> <!-- Responsive grid -->
            <?php
            if ($result && $result->num_rows > 0) {
                foreach ($result as $row) {
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $product_image1 = $row['product_image1'];
                    $image_dir = htmlspecialchars("image/" . $product_image1, ENT_QUOTES);
                    $product_price = $row['product_price'];
                    ?>
                    <div class='col'>
                        <div class='card shadow-lg border-0 rounded-4 h-100' style='background-color: #f8f9fa;'>
                            <div class='rounded-top' style='height: 200px; overflow: hidden;'>
                                <img src="<?php echo $image_dir; ?>" class='card-img-top img-fluid rounded-top'
                                    style='object-fit: contain; height: 100%; width: 100%; background-color: #ffffff;'>
                            </div>
                            <div class='card-body d-flex flex-column justify-content-between'>
                                <div>
                                    <h5 class='card-title fw-bold text-dark text-truncate' style='max-width: 100%;'>
                                        <?php echo $product_name; ?>
                                    </h5>
                                    <p class='text-danger fw-bold fs-4 mb-0 text-center'>₹<?php echo $product_price; ?></p>
                                </div>
                                <div class='d-flex justify-content-between mt-3'>
                                    <a href='?add-to-cart=<?php echo $product_id; ?>' class='btn btn-dark w-45 py-2'>
                                        <i class='fa-solid fa-cart-plus'></i> Add
                                    </a>
                                    <a href='?product-details-page=<?php echo $product_id; ?>' class='btn btn-secondary w-45 py-2'>
                                        View More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
<?php } ?>

