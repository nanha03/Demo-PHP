<?php
ob_start();
session_start();
include('database/db.php');
include('function/common_function.php');
if (isset($_SESSION['admin'])) {
    header("Location: admin_area/");
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Navbar</title>
    <script src="https://kit.fontawesome.com/c297269878.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- main navbar -->
    <?php
    include('include/header.php');
    ?>


    <!-- Add padding-top to avoid overlapping -->
    <div style="padding-top: 50px;"></div>

    <!-- third navbar -->
    <?php
    include('include/secondnav.php');
    if (isset($_GET['dashboard'])) {
        header("location: dashboard.php");
    } else {


        ?>



        <!-- below navbar products and side bar -->
        <div class="container-fluid  mb-0 pb-0">
            <div class="row">
                <!-- side nav -->
                <div class="col-md-2 bg-secondary p-0 mt-1">
                    <button class="btn btn-dark w-100 mb-2 d-md-none" type="button" data-bs-toggle="collapse"
                        data-bs-target="#sidebarMenu" aria-expanded="false" aria-controls="sidebarMenu">
                        Toggle Menu
                    </button>
                    <div class="collapse d-md-block" id="sidebarMenu">
                        <ul class="navbar-nav me-auto">
                            <div>
                                <li class="nav-item bg-dark text-white text-center border border-1">
                                    <a class="nav-link decoration-none text-light" href="#">
                                        <h4>Category</h4>
                                    </a>
                                </li>
                                <?php
                                homeCategory();
                                ?>
                            </div>
                            <div>
                                <li class="nav-item bg-dark text-white text-center border border-1">
                                    <a class="nav-link decoration-none text-light" href="">
                                        <h4>Brand</h4>
                                    </a>
                                </li>
                                <?php
                                homeBrand();
                                ?>
                            </div>
                        </ul>
                    </div>
                </div>
                <!-- products -->
                <div class="col-md-10 bg-light">
                    <?php
                    if (isset($_GET['product-details-page'])) {
                        $product_id = $_GET['product-details-page'];
                        include('function/product_details.php');
                    } else {
                        ?>
                        <div class="t">
                            <h3 class="text-center mt-2">Clothes</h3>
                            <p class="text-center">clothes of all types & all season</p>
                        </div>
                        <?php
                        getProducts();
                        cart();
                    }
                    ?>
                </div>
            </div>

            <?php
    }
    include('include/footer.php')
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>

</html>