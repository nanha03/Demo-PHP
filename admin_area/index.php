<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <script src="https://kit.fontawesome.com/c297269878.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    ob_start();
    session_start();
    if (isset($_SESSION['user'])) {
        header("Location: ../");
        exit();
    }
    include('components/header.php');
    include('../database/db.php');

    if (isset($_GET['admin_register']) && !isset($_SESSION['admin'])) {
        include('admin_register.php');
    } else if (isset($_GET['admin_login']) && !isset($_SESSION['admin'])) {
        include('admin_login.php');
    } else if (!isset($_SESSION['admin'])) {
        header("Location: index.php?admin_login");
        exit();
    } else if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("location: /cloth-store/");
    } else if (isset($_SESSION['admin'])) {
        $admin_id = $_SESSION['admin']['admin_id'];
        $admin_name = $_SESSION['admin']['admin_name'];
        $image = $conn->query("SELECT admin_image FROM `admin` WHERE admin_id = $admin_id")->fetch_assoc()['admin_image'];
        $admin_image = '../image/' . $image;


        ?>

                        <!-- sidebar for admin page -->
                        <div class="d-flex container-fluid p-0 m-0">
                            <div class="col-md-2 bg-secondary p-0 m-0 mt-1 position-relative">
                                <button class="btn btn-dark w-100 d-md-none mb-2" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#sidebarMenu" aria-expanded="false" aria-controls="sidebarMenu">
                                    Menu
                                </button>
                                <div class="collapse d-md-block" id="sidebarMenu">
                                    <ul class="navbar-nav me-auto">
                                        <div>
                                            <li class="nav-item bg-dark text-white text-center border border-1">
                                                <a class="nav-link decoration-none text-light" href="#">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <img src="<?php echo $admin_image; ?>" class="img-fluid"
                                                            style="height: 200px;  object-fit: cover; margin-bottom: 5px;">
                                                    </div>
                                                    <h4 class="mb-0"><?php echo $admin_name; ?></h4>
                                                </a>
                                            </li>
                                        </div>
                                        <li class="nav-item text-white text-center border border-1">
                                            <a class="nav-link decoration-none text-light" href="?insert_product">Insert product</a>
                                        </li>
                                        <li class="nav-item text-white text-center border border-1">
                                            <a class="nav-link decoration-none text-light" href="?view_product">View Products</a>
                                        </li>
                                        <li class="nav-item text-white text-center border border-1">
                                            <a class="nav-link decoration-none text-light" href="index.php?insert_category">Insert
                                                Category</a>
                                        </li>
                                        <li class="nav-item text-white text-center border border-1">
                                            <a class="nav-link decoration-none text-light" href="index.php?view_category">View
                                                Categories</a>
                                        </li>
                                        <li class="nav-item text-white text-center border border-1">
                                            <a class="nav-link decoration-none text-light" href="index.php?insert_brand">Insert Brand</a>
                                        </li>
                                        <li class="nav-item text-white text-center border border-1">
                                            <a class="nav-link decoration-none text-light" href="?view_brand">View Brands</a>
                                        </li>
                                        <li class="nav-item text-white text-center border border-1">
                                            <a class="nav-link decoration-none text-light" href="?incomplete_orders">Incomplete Orders</a>
                                        </li>
                                        <li class="nav-item text-white text-center border border-1">
                                            <a class="nav-link decoration-none text-light" href="?complete_orders">Complete Orders</a>
                                        </li>
                                        <li class="nav-item text-white text-center border border-1">
                                            <a class="nav-link decoration-none text-light" href="?user_list">User List</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>



                            <div class="col-md-10">
                                <div class="container">
                        <?php
                        if (isset($_GET['insert_category'])) {
                            include('insert_category.php');
                        } else if (isset($_GET['insert_brand'])) {
                            include('insert_brand.php');
                        } else if (isset($_GET['remove_product'])) {
                            include('remove_product.php');
                        } else if (isset($_GET['view_category'])) {
                            include('view_category.php');
                        } else if (isset($_GET['insert_product'])) {
                            include('insert_product.php');
                        } else if (isset($_GET['view_product'])) {
                            include('view_product.php');
                        } else if (isset($_GET['view_brand'])) {
                            include('view_brand.php');
                        } else if (isset($_GET['edit_product'])) {
                            include('edit_product.php');
                        } else if (isset($_GET['incomplete_orders'])) {
                            include('incomplete_orders.php');
                        } else if (isset($_GET['user_list'])) {
                            include('user_list.php');
                        } else if (isset($_GET['complete_orders'])) {
                            include('complete_orders.php');
                        }
                        ?>
                                </div>

                            </div>
                        </div>

        <?php
    }

    ?>
    <div class="bg-secondary text-white p-4 text-center shadow-lg rounded-3 mt-5 footer">
        <p class="fw-bold mb-0">© All rights reserved. Created by Me</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>