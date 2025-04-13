<?php
if (isset($_GET['cancel'])) {
    $order_id = $_GET['cancel'];
    $query = $conn->prepare("SELECT * FROM user_orders Where order_id = ?");
    $query->bind_param("i", $order_id);
    $query->execute();
    $data = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    foreach ($data as $row) {
        $status = 'canceled';
        $user_id = $row['user_id'];
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $conn->query("INSERT INTO `order_history` (`user_id`, `product_id`, `status`, `quantity`, `order_id`) VALUES ('$user_id', '$product_id','$status', '$quantity','$order_id')");
    }
    $conn->query("DELETE FROM `user_orders` Where order_id = '$order_id' ");
    echo "<script>alert('Order Canceled');
window.location.href = '/cloth-store/admin_area/index.php?incomplete_orders'</script>";
}
if (isset($_GET['complete'])) {
    $order_id = $_GET['complete'];
    $query = $conn->prepare("SELECT * FROM user_orders Where order_id = ?");
    $query->bind_param("i", $order_id);
    $query->execute();
    $data = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    foreach ($data as $row) {
        $status = 'completed';
        $user_id = $row['user_id'];
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $conn->query("INSERT INTO `order_history` (`user_id`, `product_id`, `status`, `quantity`, `order_id`) VALUES ('$user_id', '$product_id','$status', '$quantity','$order_id')");
    }
    $conn->query("DELETE FROM `user_orders` Where order_id = '$order_id' ");
    echo "<script>alert('Order completed');
window.location.href = '/cloth-store/admin_area/index.php?incomplete_orders'</script>";
}
?>




<div class="d-flex align-items-center justify-content-center min-vh-50">
    <div class="container">
        <h2 class="text-center text-success fw-bold">Active Order Table</h2>
        <div class="col-md-11 mx-auto">
            <table class="table my-3 border table-bordered table-hover mx-auto">
                <thead>
                    <tr>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Count</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Userid</th>
                        <th class="col-3 text-center bg-dark text-white" scope="col">Product</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Quantity</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Price</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Mode</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Delivery</th>
                        <th class="col-2 text-center bg-dark text-white" scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `user_orders` AS o 
                              JOIN `products` AS p ON o.product_id = p.product_id";
                    $result = $conn->query($query);
                    $count = 1;
                    foreach ($result as $row) {
                        $product_name = $row['product_name'];
                        $user_id = $row['user_id'];
                        $amount = $row['amount'];
                        $quantity = $row['quantity'];
                        $mode = $row['mode'];
                        $delivery = $row['payment'];
                        $date = $row['order_time'];
                        $order_id = $row['order_id'];
                        echo "<tr class='border'>
                        <td class='bg-light text-center text-dark'>$count</td>
                        <td class='bg-light text-center text-dark'>$user_id</td>
                        <td class='bg-light text-center text-dark'>" . (strlen($product_name) > 25 ? substr($product_name, 0, 30) . '...' : $product_name) . "</td>
                        <td class='bg-light text-center text-dark'>$quantity</td>
                        <td class='bg-light text-center text-dark'>$amount</td>
                        <td class='bg-light text-center text-dark'>$mode</td>
                       <td class='bg-light text-center text-dark'>
    <a href='?incomplete_orders&complete=$order_id' 
       class='btn btn-success btn-sm me-1' 
       onclick=\"return confirm('Are you sure you want to mark this order as COMPLETE?');\">
        <i class='fas fa-check-circle'></i>
    </a>
    <a href='?incomplete_orders&cancel=$order_id' 
       class='btn btn-danger btn-sm' 
       onclick=\"return confirm('Are you sure you want to CANCEL this order?');\">
        <i class='fas fa-times-circle'></i>
    </a>
</td>
                        <td class='bg-light text-center text-dark'>$date</td>
                      </tr>";
                        $count++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>