<div class="d-flex align-items-center justify-content-center min-vh-50 mt-3">
    <div class="container">
        <h2 class="text-center text-success fw-bold">Category Table</h2>
        <div class="col-md-8 mx-auto">
            <table class="table my-3 border table-bordered table-hover mx-auto">
                <thead>
                    <tr>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Id</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Brand</th>
                        <th class="col-2 text-center bg-dark text-white" scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../database/db.php');
                    $query = ("SELECT * FROM `brand` ");
                    $result = $conn->query($query);
                    foreach ($result as $row) {
                        $brand_name = $row['brand_name'];
                        $brand_id = $row['brand_id'];
                        echo "<tr class='border'>
                        <td class='bg-light text-center text-dark'>$brand_id</td>
                        <td class='bg-light text-center text-dark'>$brand_name</td>
                        <td>
                            <div class='d-flex justify-content-center'>
                                <a class='btn btn-success text-white m-1' name='product_edit' href='?view_brand&edit_brand=$brand_id'>edit</a>
                                <a class='btn btn-danger text-white m-1' name='delete' href='?view_brand&delete_brand=$brand_id'>Delete</a>
                            </div>
                        </td>
                      </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>