<?php
include('./database/db.php');



// Get products for home
function getProducts()
{
    global $conn;

    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        $query = $conn->prepare("SELECT * FROM `products` JOIN `brand` ON products.brand_id = brand.brand_id JOIN `category` ON products.category_id = category.category_id WHERE products.category_id = ? ");
        $query->bind_param("i", $category);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $num_row = mysqli_num_rows($result);
        if ($num_row == 0) {
            echo '<h2 class="text-center text-danger">This Category Products Not In Stocks</h2>';
        }
    } else if (isset($_GET['brand'])) {
        $brand = $_GET['brand'];
        $query = $conn->prepare("SELECT * FROM `products` JOIN `brand` ON products.brand_id = brand.brand_id JOIN `category` ON products.category_id = category.category_id WHERE products.brand_id = ? ");
        $query->bind_param("i", $brand);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $num_row = mysqli_num_rows($result);
        if ($num_row == 0) {
            echo '<h2 class="text-center text-danger">This Brand Products Not In Stocks</h2>';
        }
    } else if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $query = $conn->prepare("SELECT * FROM `products` JOIN `brand` ON products.brand_id = brand.brand_id JOIN `category` ON products.category_id = category.category_id WHERE  `product_keyword` LIKE '%$search%' ");
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $num_row = mysqli_num_rows($result);
        if ($num_row == 0) {
            echo '<h2 class="text-center text-danger">No Result Found</h2>';
        }
    } else {
        $query = $conn->prepare("SELECT * FROM `products` JOIN `brand` ON products.brand_id = brand.brand_id JOIN `category` ON products.category_id = category.category_id");
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    }
    $count = 0;
    foreach ($data as $row) {
        $currentUrl = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $product_id = $row['product_id'];
        $brand_name = $row['brand_name'];
        $category_name = $row['category_name'];
        $product_name = $row['product_name'];
        $product_image1 = $row['product_image1'];
        $image_dir = htmlspecialchars("image/" . $product_image1, ENT_QUOTES);
        $product_description = $row['product_description'];
        $product_price = $row['product_price'];
        if ($count % 3 == 0 || $count = 0) {
            echo "<div id='un$count' class='row'>";
        }
        echo "<div class='col-md-3 mb-4 animate__animated animate__zoomInUp '>
    <div class='card border-0 rounded-4'
    style='height: 450px; overflow: hidden; background-color: #f8f9fa;  box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);'>

    <div class='rounded-top' style='height: 300px; overflow: hidden;'>
        <img src='$image_dir' class='card-img-top img-fluid rounded-top'
        style='object-fit: contain; height: 100%; width: 100%; background-color: #ffffff;'>
    </div>
    <div class='card-body d-flex flex-column justify-content-between'>
        <div>
            <h5 class='card-title fw-bold text-dark'
            style='white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>
            $product_name
            </h5>
            <p class='text-danger fw-bold fs-4 mb-0 text-center'>₹$product_price</p>
            <p class='card-text text-muted'
            style='display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;'>
            $product_description
            </p>
        </div>
        <div class='d-flex justify-content-between mt-3'>
            <a href='?add-to-cart=$product_id' class='btn btn-dark w-45 py-2'><i class='fa-solid fa-cart-plus'></i> Add</a>
            <a href='?product-details-page=$product_id' class='btn btn-secondary w-45 py-2'>View More</a>
        </div>
    </div>
    </div>
</div>
";
        $count++;
        if ($count % 4 == 0) {
            echo "</div>";
        }
    }
}

// Get Category for home
function homeCategory()
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM `category`;");
    $query->execute();
    $result = $query->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($data as $row) {
        $category_name = $row['category_name'];
        $category_id = $row['category_id'];
        echo "<li class=' nav-item text-white text-center border border-1'><a class='nav-link decoration-none text-light animate__animated animate__lightSpeedInRight' href='?category=$category_id'>$category_name</a></li>";
    }
}

// Get Brands for home
function homeBrand()
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM `brand`;");
    $query->execute();
    $result = $query->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($data as $row) {
        $brand_name = $row['brand_name'];
        $brand_id = $row['brand_id'];
        echo "<li class='nav-item text-white text-center border border-1'><a class='nav-link decoration-none text-light animate__animated animate__lightSpeedInRight' href='?brand=$brand_id'>$brand_name</a></li>";
    }
}
?>



<?php

function getIpAddress()
{
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
        $ip = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip = 'UNKNOWN';
    }
    return $ip;
}
?>


<?php
function cart()
{
    if (isset($_GET['add-to-cart'])) {
        global $conn;
        if (!isset($_SESSION['user'])) {
            echo "<script>alert('First login');</script>";
            echo "<script>window.location.href = 'register.php';</script>";
            exit();
        } else {
            $currentUrl = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
            $user_id = $_SESSION['user']['user_id'];
            $product_id = intval($_GET['add-to-cart']);
            $get_ip_address = getIpAddress();
            $quantity = 1;

            $query = $conn->prepare("SELECT * FROM `cart_details` WHERE `user_id` = ? AND `product_id` = ?");
            $query->bind_param("ii", $user_id, $product_id);
            $query->execute();
            $result = $query->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0) {
                echo "<script>alert('This Product is Already Available in Cart');</script>";
                echo "<script>window.location.href = 'index.php' ;</script>";
                exit();
            } else {
                $user = $conn->prepare("INSERT INTO `cart_details` (`product_id`, `ip_address`, `quantity`, `user_id`) VALUES (?, ?, ?, ?)");
                $user->bind_param("isii", $product_id, $get_ip_address, $quantity, $user_id);
                $result = $user->execute();

                if ($result) {
                    echo "<script>window.location.href = 'index.php' ;</script>";
                    exit();
                }
            }
        }
    }

}

// function to get cart number
function cart_item()
{
    if (isset($_GET['add-to-cart'])) {
        if (!isset($_SESSION['user'])) {
            echo "<script>alert('First login');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        }
        global $conn;
        $user_id = $_SESSION['user']['user_id'];
        $query = $conn->prepare("SELECT * FROM cart_details WHERE user_id = ? AND product_id != 0");
        $query->bind_param("s", $user_id);
        $query->execute();
        $data = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        $num_row = count($data);
    } else {
        global $conn;
        $user_id = $_SESSION['user']['user_id'];
        $query = $conn->prepare("SELECT * FROM cart_details WHERE user_id = ? AND product_id != 0");
        $query->bind_param("s", $user_id);
        $query->execute();
        $data = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        $num_row = count($data);
    }
    echo $num_row;
}



?>



<!-- get pending order for user -->
 <?php
 function get_user_order(){
    
 }
 
 ?>