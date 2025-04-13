<?php
ob_start();
session_start();
include('database/db.php');
include('function/common_function.php');
include('function/product_details.php');
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Log in to use cart');</script>";
    echo "<script>window.location.href = 'register.php';</script>";
}else{
    ?>
<!doctype html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Navbar</title>
        <script src="https://kit.fontawesome.com/c297269878.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        <!-- main navbar -->
        <?php
    include('include/header.php');
    ?>

    <!-- Add padding-top to avoid overlapping -->
    <div style="padding-top: 70px;"></div>
    
    <!-- third navbar -->
    <?php
    include('include/secondnav.php')
    ?>

<?php global $conn;
    $get_ip_address = getIpAddress();
    $query = $conn->prepare("SELECT * FROM `cart_details` WHERE  `ip_address` = ? ;");
    $query->bind_param("s", $get_ip_address);
    $query->execute();
    $data = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    $num_row = count($data);
    if ($num_row < 1) {
        echo '<h2 class="text-center text-danger">No Item In Cart</h2>';
        echo '<div class="container"> <a class="btn btn-dark btn-lg me-3" href="index.php">🛒 Continue Shopping</a></div>';
    } else {
        ?>

<div class="container mt-3">
    <div class="col-md-8 m-auto">
        
        <table class="table table-bordered table-hover text-center align-middle mt-4">
            <thead class="table-dark">
                <tr>
                    <th class="col-3">Name</th>
                    <th class="col-2">Image</th>
                    <th class="col-2">Quantity</th>
                    <th class="col-2">Price</th>
                    
                    <th class="col-2">Update</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                        include('database/db.php');
                        $user_id = $_SESSION['user']['user_id'];
                        $querry = "SELECT * FROM `products` JOIN `cart_details` ON products.product_id = cart_details.product_id WHERE user_id = '$user_id';";
                        $result = $conn->query($querry);
                        $sub_total = 0;
                        foreach ($result as $row) {
                            $total_price = 0;
                            $product_id = $row['product_id'];
                            $ProductName = $row['product_name'];
                            $ProductImage = $row['product_image1'];
                            $image_dir = htmlspecialchars("image/" . $ProductImage, ENT_QUOTES);
                            $quantity = $row['quantity'];
                            $product_price = $row['product_price'];
                            $total_price = $quantity * $product_price;
                            if (isset($_POST['cart_update']) && $_POST['product_id'] == $product_id) {
                                $get_ip_address = getIpAddress();
                                $quantity = $_POST['update_quantity'];
                                $query = $conn->prepare('UPDATE `cart_details` SET quantity =  ? WHERE ip_address = ? and product_id = ? ');
                                $query->bind_param('isi', $quantity, $get_ip_address, $product_id);
                                $query->execute();
                                $total_price = $quantity * $product_price;
                            }
                            if (isset($_POST['cart_delete']) && $_POST['product_id'] == $product_id) {
                                $get_ip_address = getIpAddress();
                                $quantity = $_POST['update_quantity'];
                                $query = $conn->prepare('DELETE FROM `cart_details` WHERE ip_address = ? and product_id = ? ');
                                $query->bind_param('si', $get_ip_address, $product_id);
                                $query->execute();
                                header("Location: cart.php");
                                exit();
                            }
                            $sub_total += $total_price;
                            echo "<form method='POST'><tr class='animate__animated animate__fadeIn'>
                            <td>$ProductName</td>
                            <td><img height='80px' class='rounded' src='$image_dir'></td>
                            <td class='align-middle'>
                            <div>
                            </div>
                            <div>
                            <input name='update_quantity' type='number' class='w-50 rounded form-input' min='1' value='$quantity' oninput='this.value = Math.abs(Math.floor(this.value)) || 0'>
                            <input type='hidden' name='product_id' value='$product_id'>
                            </div>
                            </td>";
                            ?>
                            <?php
                            ?>
                            <?php
                            echo "<td>₹$total_price</td>
                            
                            <td>
                            <div class='d-flex justify-content-center'>
                            <button class='btn btn-success text-white m-1' name='cart_update'>Update</button>
                            <button class='btn btn-danger text-white m-1' name='cart_delete'>Delete</button>
                            </div>
                            </td>
                            </tr></form>";
                            
                        }
                        
                        ?>
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-between align-items-center mt-4 p-3 border rounded bg-light shadow">
                    <div>
                        <h4 class="m-0">Subtotal: <strong class="text-danger">₹<?php echo $sub_total; ?></strong></h4>
                    </div>
                    <div class="d-flex">
                        <form action="checkout.php" method="POST">
                        <a class="btn btn-dark btn-lg me-3" href="index.php">🛒 Continue Shopping</a>
                            <input type="hidden" name="payment" value="<?php echo $sub_total; ?>">
                            <button type="submit" class="btn btn-secondary btn-lg" name="checkout" >✓ Checkout</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
        
        <?php
    }
    ?>












<?php } ?>

<?php include('include/footer.php') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous"></script>
</body>

</html>