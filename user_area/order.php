<?php
include('include/verify.php');
$user_id = $_SESSION['user']['user_id'];
$query = $conn->prepare("SELECT * FROM `cart_details` c JOIN `products` p ON c.product_id = p.product_id WHERE c.user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$data = $query->get_result()->fetch_all(MYSQLI_ASSOC);
$amount = $_POST['total'];
foreach ($data as $row) {
    $status = 'pending';
    $invoice = mt_rand();
    $user_id = $_SESSION['user']['user_id'];
    $quantity = $row['quantity'];
    $product_id = $row['product_id'];
    $mode = 'offline';
    $payment = 'pending';
    $price = $conn->query("SELECT * FROM `cart_details` c JOIN `products` p ON c.product_id = p.product_id WHERE c.user_id = $user_id AND c.product_id = $product_id")->fetch_assoc()['product_price'];
    $product_price = $quantity * $price;
    $conn->query("INSERT INTO `user_orders` (`user_id`, `product_id`, `invoice`, `amount`, `order_status`, `quantity`, `mode`,`payment`) VALUES ('$user_id', '$product_id', '$invoice', '$product_price', '$status', '$quantity','$mode','$payment')");
}
$conn->query("DELETE FROM `cart_details` Where user_id = '$user_id' ");
echo "<script>alert('Order Successfull');
window.location.href = '/cloth-store/index.php?dashboard'</script>";
?>