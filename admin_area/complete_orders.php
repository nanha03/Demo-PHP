<div class="d-flex align-items-center justify-content-center min-vh-50">
    <div class="container mt-4">
        <h2 class="text-center text-success fw-bold">History Order Table</h2>
        <div class="table-responsive rounded shadow-sm overflow-hidden col-md-9 mx-auto">
            <table class="table table-bordered mb-0">
                <thead class="position-sticky top-0 z-1">
                    <tr>
                        <th class="col-1 text-center bg-dark text-white">Count</th>
                        <th class="col-1 text-center bg-dark text-white">Order ID</th>
                        <th class="col-1 text-center bg-dark text-white">Product ID</th>
                        <th class="col-1 text-center bg-dark text-white">User ID</th>
                        <th class="col-1 text-center bg-dark text-white">Quantity</th>
                        <th class="col-1 text-center bg-dark text-white">Status</th>
                        <th class="col-2 text-center bg-dark text-white">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `order_history`";
                    $result = $conn->query($query);
                    $count = 1;
                    foreach ($result as $row) {
                        $product_id = $row['product_id'];
                        $user_id = $row['user_id'];
                        $order_id = $row['order_id'];
                        $quantity = $row['quantity'];
                        $status = $row['status'];
                        $date = $row['DATE'];
                    
                        // Add dim style if status is canceled
                        $row_class = ($status === 'canceled') ? 'opacity-50' : '';
                    
                        echo "<tr class='border $row_class'>
                            <td class='bg-light text-center text-dark'>$count</td>
                            <td class='bg-light text-center text-dark'>$order_id</td>
                            <td class='bg-light text-center text-dark'>$product_id</td>
                            <td class='bg-light text-center text-dark'>$user_id</td>
                            <td class='bg-light text-center text-dark'>$quantity</td>
                            <td class='bg-light text-center text-dark text-capitalize'>$status</td>
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
