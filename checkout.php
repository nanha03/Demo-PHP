<?php
ob_start();
session_start();
include('database/db.php');
include('function/common_function.php');
include('include/verify.php');
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
    include('include/header.php');
    ?>


    <!-- Add padding-top to avoid overlapping -->
    <div style="padding-top: 50px;"></div>

    <!-- third navbar -->
    <?php
    include('include/secondnav.php')
        ?>





    <?php
    if (isset($_POST['upi'])) {
        include('user_area/payment.php');
    } else if (isset($_POST['offline'])) {
        include('user_area/order.php');
    }
    ?>

    <?php
    if (!isset($_SESSION['user']['username'])) {
        header("Location: register.php");
    } else if (isset($_POST['checkout'])) {
        $amount = $_POST['payment'];
        ?>
            <div class="container d-flex justify-content-center align-items-center mt-3" style="height: 50vh;">
                <div class="border border-dark d-flex justify-content-center align-items-center p-3 flex-fill">
                    <form action="checkout.php" method="POST">
                        <input type="hidden" name="total" value="<?php echo $amount ?>">
                        <button name="upi" class="btn btn-warning"
                            style="padding: 15px 40px; font-size: 1.5rem; width: 100%;">UPI</button>
                    </form>
                </div>
                <div class="border border-dark d-flex justify-content-center align-items-center p-3 flex-fill">
                    <form action="checkout.php" method="POST">
                        <input type="hidden" name="total" value="<?php echo $amount ?>">
                        <button name="offline" class="btn btn-warning"
                            style="padding: 15px 40px; font-size: 1.5rem; width: 100%;">Offline</button>
                    </form>
                </div>
            </div>
        <?php
    }
    ?>










    <?php include('include/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>