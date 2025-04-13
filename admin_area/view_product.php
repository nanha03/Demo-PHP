<?php
?>
<div class="d-flex align-items-center justify-content-center min-vh-50 mt-3">
    <div class="container">
        <h2 class="text-center text-success fw-bold">Product Table</h2>
        <div class="col-md-11 mx-auto">
            <table class="table my-3 border table-bordered table-hover mx-auto">
                <thead>
                    <tr>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Id</th>
                        <th class="col-3 text-center bg-dark text-white" scope="col">Name</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Image</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Category</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Brand</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Price</th>
                        <th class="col-1 text-center bg-dark text-white" scope="col">Status</th>
                        <th class="col-2 text-center bg-dark text-white" scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../database/db.php');
                    $query = ("SELECT * FROM `products` JOIN `brand` ON products.brand_id = brand.brand_id JOIN `category` ON products.category_id = category.category_id");
                    $result = $conn->query($query);
                    foreach ($result as $row) {
                        $product_name = $row['product_name'];
                        $product_id = $row['product_id'];
                        $product_price = $row['product_price'];
                        $product_status = $row['status'];
                        $product_dec1 = $row['product_image1'];
                        $product_dec2 = $row['product_image2'];
                        $product_dec3 = $row['product_image3'];
                        $product_image1 =  htmlspecialchars("../image/".$product_dec1, ENT_QUOTES);
                        $product_image2 =  htmlspecialchars("../image/".$product_dec2, ENT_QUOTES);
                        $product_image3 =  htmlspecialchars("../image/".$product_dec3, ENT_QUOTES);
                        $brand_name = $row['brand_name'];
                        $category_name = $row['category_name'];
                        echo "<tr class='border'>
                        <td class='bg-light text-center text-dark'>$product_id</td>
                        <td class='bg-light text-center text-dark'>" . (strlen($product_name) > 25 ? substr($product_name, 0, 30) . '...' : $product_name) . "</td>
                        <td class='bg-light text-center text-dark d-flex'>
                            <img height='80px' class='rounded' src='$product_image1'>
                            <img height='80px' class='rounded' src='$product_image2'>
                            <img height='80px' class='rounded' src='$product_image3'>
                        </td>
                        <td class='bg-light text-center text-dark'>$category_name</td>
                        <td class='bg-light text-center text-dark'>$brand_name</td>
                        <td class='bg-light text-center text-dark'>$product_price</td>
                        <td class='bg-light text-center text-dark'>$product_status</td>
                        <td>
                            <div class='d-flex justify-content-center'>
                                <a class='btn btn-success text-white m-1' name='product_edit' href='?edit_product=$product_id'>edit</a>
                                <a class='btn btn-danger text-white m-1' name='delete' href='?view_product&remove_product=$product_id'>Delete</a>
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