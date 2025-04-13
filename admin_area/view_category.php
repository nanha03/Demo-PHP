<div class="d-flex align-items-center justify-content-center min-vh-50 mt-3">
    <div class="container">
        <h2 class="text-center text-success fw-bold">Category Table</h2>
        <div class="col-md-8 mx-auto">
            <table class="table my-3 border table-bordered table-hover mx-auto">
                <thead>
                    <tr>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Id</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Category</th>
                        <th class="col-2 text-center bg-dark text-white" scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../database/db.php');
                    $query = ("SELECT * FROM `category` ");
                    $result = $conn->query($query);
                    foreach ($result as $row) {
                        $category_name = $row['category_name'];
                        $category_id = $row['category_id'];
                        echo "<tr class='border'>
                        <td class='bg-light text-center text-dark'>$category_id</td>
                        <td class='bg-light text-center text-dark'>$category_name</td>
                        <td>
                            <div class='d-flex justify-content-center'>
                                <a class='btn btn-success text-white m-1' name='product_edit' href='?view_category&edit_category=$category_id'>edit</a>
                                <a class='btn btn-danger text-white m-1' name='delete' href='?view_category&delete_category=$category_id'>Delete</a>
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