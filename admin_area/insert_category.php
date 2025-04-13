

<?php
include('../database/db.php');
if (isset($_POST['insert_category'])) {
    $category_name = $_POST['category_title'];
    $query = $conn->prepare("SELECT * FROM `category` WHERE category_name = '$category_name';");
    $query->execute();
    $result = $query->get_result();
    $number = $result->num_rows;
    if ($number > 0) {
        echo '<script>
        alert("Category already exists!");
        window.location.href = "./index.php?insert_category";
        </script>';
        exit;
    }
    $user = $conn->prepare("INSERT INTO `category` (`category_name`) VALUES (?)");
    $user->bind_param("s", $category_name);
    $result = $user->execute();
    if ($result) {
        echo '<script>
            alert("Category inserted successfully!");
            window.location.href = "./index.php?insert_category";
        </script>';
        exit;
    }
}
?>

<h2 class="text-center mt-3">Insert Categories</h2>
<div class="container mt-4">
    <form action="insert_category.php" method="POST" class="row gx-2 px-3 align-items-center">

        <div class="col-12 col-md-10 mb-2">
            <div class="input-group" style="height: 100%;">
                <span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
                <div class="form-floating flex-grow-1">
                    <input type="text" class="form-control" name="category_title" placeholder="Add Category">
                    <label for="floatingInputGroup1">Add Category</label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2 mb-2">
            <button name="insert_category" class="btn btn-dark w-100 py-3">Insert Category</button>
        </div>
    </form>
</div>