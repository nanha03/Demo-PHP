
<?php
include('../database/db.php');
if (isset($_POST['insert_brand'])) {
    $brand_name = $_POST['brand_title'];
    $query = $conn->prepare("SELECT * FROM `brand` WHERE brand_name = ?;");
    $query->bind_param("s", $brand_name);
    $query->execute();
    $result = $query->get_result();
    $number = $result->num_rows;
    if ($number > 0) {
        echo '<script>
        alert("Brand already exists!");
        window.location.href = "./index.php?insert_brand";
        </script>';
        exit;
    }
    $querry = $conn->prepare("INSERT INTO `brand` (`brand_name`) VALUES (?)");
    $querry->bind_param("s", $brand_name);
    $result = $querry->execute();
    if ($result) {
        echo '<script>
            alert("Brand inserted successfully!");
            window.location.href = "./index.php?insert_brand";
        </script>';
        exit;
    }
}

?>




















<h2 class="text-center mt-3">Insert Brands</h2>
<div class="container mt-4">
    <form action="insert_brand.php" method="POST" class="row gx-2 px-3 align-items-center">

        <div class="col-12 col-md-10 mb-2">
            <div class="input-group" style="height: 100%;">
                <span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
                <div class="form-floating flex-grow-1">
                    <input type="text" class="form-control" id="brandname" name="brand_title" placeholder="Add Brand">
                    <label for="brandname">Add Brand</label>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-2 mb-2">
            <button type="submit" name="insert_brand" class="btn btn-dark w-100 py-3">Insert Brand</button>
        </div>
    </form>
</div>