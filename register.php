<?php
ob_start();
session_start();
include('database/db.php');
include('function/common_function.php');
include('function/product_details.php');
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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- main navbar -->
    <?php
     include ('include/header.php');
     ?>

    <!-- Add padding-top to avoid overlapping -->
    <div style="padding-top: 50px;"></div>

    <!-- third navbar -->
    <?php
    include('include/secondnav.php')
    ?>

    <?php
    if(isset($_GET['user_login']) && !isset($_SESSION['user']) ) {
        include('user_area/user_login.php');
    }else if(isset($_GET['user_register']) && !isset($_SESSION['user'])) {
        include('user_area/user_register.php');
    }else if(!isset($_SESSION['user'])){
        include('user_area/user_login.php');
    }else{
        header("Location: index.php");
    }
    ?>









    <?php include('include/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>