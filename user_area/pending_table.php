<div class="d-flex align-items-center justify-content-center min-vh-50">
    <div class="container">
        <h2 class="text-center text-success fw-bold">Active Order Table</h2>
        <div class="col-md-8 mx-auto">
            <table class="table my-3 border table-bordered table-hover mx-auto">
                <thead>
                    <tr>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Index</th>
                        <th class="col-3 text-center bg-dark text-white" scope="col">Name</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Quantity</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Price</th>
                        <th class="col-2 text-center bg-dark text-white" scope="col">Mode</th>
                        <th class="col-2 text-center bg-dark text-white" scope="col">Delivery</th>
                        <th class="col-2 text-center bg-dark text-white" scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user_id = $_SESSION['user']['user_id'];
                    $query = "SELECT * FROM `user_orders` AS o 
                              JOIN `products` AS p ON o.product_id = p.product_id 
                              WHERE user_id='$user_id'";
                    $result = $conn->query($query);
                    $count = 1;
                    foreach ($result as $row) {
                        $product_name = $row['product_name'];
                        $amount = $row['amount'];
                        $quantity = $row['quantity'];
                        $mode = $row['mode'];
                        $payment = $row['payment'];
                        $date = $row['order_time'];
                        echo "<tr class='border animate__animated animate__fadeInBottomRight'>
                        <td class='bg-light text-center text-dark'>$count</td>
                        <td class='bg-light text-center text-dark'>" . (strlen($product_name) > 25 ? substr($product_name, 0, 30) . '...' : $product_name) . "</td>
                        <td class='bg-light text-center text-dark'>$quantity</td>
                        <td class='bg-light text-center text-dark'>$amount</td>
                        <td class='bg-light text-center text-dark'>$mode</td>
                        <td class='bg-light text-center text-dark'>$payment</td>
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