<div class="d-flex align-items-center justify-content-center min-vh-50">
    <div class="container mt-4">
        <h2 class="text-center text-success fw-bold">User details Table</h2>
        <div class="col-md-11 mx-auto">
            <table class="table my-3 border table-bordered table-hover mx-auto">
                <thead>
                    <tr>
                        <th class="col-1 text-center bg-dark text-white" scope="col">count</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">id</th>
                        <th class="col-2 text-center bg-dark text-white" scope="col">name</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">email</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">address</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">phone</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">ip</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `user`";
                    $result = $conn->query($query);
                    $count = 1;
                    foreach ($result as $row) {
                        $user_name = $row['user_name'];
                        $user_id = $row['user_id'];
                        $user_email = $row['user_email'];
                        $user_address = $row['user_address'];
                        $user_phone = $row['user_phone'];
                        $user_ip = $row['user_ip'];
                        echo "<tr class='border'>
                        <td class='bg-light text-center text-dark'>$count</td>
                        <td class='bg-light text-center text-dark'>$user_id</td>
                        <td class='bg-light text-center text-dark'>$user_name</td>
                        <td class='bg-light text-center text-dark'>$user_email</td>
                        <td class='bg-light text-center text-dark'>$user_address</td>
                        <td class='bg-light text-center text-dark'>$user_phone</td>          
                        <td class='bg-light text-center text-dark'>$user_ip</td>
                        <td class='bg-light text-center text-dark'>
                            <a href='?delete=$user_id' class='btn btn-danger btn-sm'>
                                <i class='fas fa-times-circle'></i>
                            </a>
                        </td>
                      </tr>";
                        $count++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>