<?php
session_start();
include('database/db.php');
include('function/common_function.php');
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Update Successfull');
window.location.href = '/cloth-store/dashboard.php?edit_account'</script>";
}

?>
<?php
$user_id = $_SESSION['user']['user_id'];
$user_data = $conn->query("SELECT * FROM `user` WHERE user_id = $user_id")->fetch_assoc();
$image = $user_data['user_image'];
$user_name = $user_data['user_name'];
$user_email = $user_data['user_email'];
$user_password = $user_data['user_password'];
$user_address = $user_data['user_address'];
$user_phone = $user_data['user_phone'];
if (isset($_POST['user_edit'])) {
    $user_id = $_SESSION['user']['user_id'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $image = $user_data['user_image'];
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == 0) {
        $image_loc = $_FILES['user_image']['tmp_name'];
        $image = $_FILES['user_image']['name'];
        $image_des = "image/" . $image;
        move_uploaded_file($image_loc, $image_des);
    }
    $user_address = $_POST['user_address'];
    $user_phone = $_POST['user_phone'];
    $stmt = $conn->prepare("UPDATE `user` SET user_name = ?, user_image = ?, user_email = ?, user_address = ?, user_phone = ?, user_password = ? WHERE user_id = ?");
    $stmt->bind_param("ssssssi", $user_name, $image, $user_email, $user_address, $user_phone, $user_password, $user_id);
    $stmt->execute();
    $_SESSION['user']['username'] = $user_name;
    $_SESSION['user']['email'] = $user_email;
    echo "<script>window.location.href = '/cloth-store/dashboard.php?edit_account'</script>";
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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include('include/header.php');
    if (!isset($_SESSION['user'])) {
        header("location: index.php ");
    }
    ?>
    <div style="padding-top: 50px;"></div>
    <?php
    include('include/secondnav.php');
    $user_id = $_SESSION['user']['user_id'];
    $user_nam = ucfirst($_SESSION['user']['username']);
    $image = $conn->query("SELECT * FROM `user` WHERE user_id = $user_id")->fetch_assoc()['user_image'];
    $image_location = './image/' . $image;

    ?>
    <div class=" d-flex container-fluid p-0 mt-3">
        <div class="col-md-2 bg-secondary p-0 m-0 mt-1 position-relative  my-4">
            <button class="btn btn-dark w-100 d-md-none mb-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-expanded="false" aria-controls="sidebarMenu">
                Menu
            </button>
            <div class="collapse d-md-block " id="sidebarMenu">
                <ul class="navbar-nav me-auto">
                    <div>
                        <li class="nav-item bg-dark text-white text-center border border-1">
                            <a class="nav-link decoration-none text-light" href="#">
                                <div class="d-flex flex-column align-items-center">
                                    <img src="<?php echo $image_location; ?>" class="img-fluid"
                                        style="height: 200px;  object-fit: cover; margin-bottom: 5px;">
                                </div>
                                <h4 class="mb-0"><?php echo $user_nam; ?></h4>
                            </a>
                        </li>
                    </div>

                    <li class="nav-item text-white text-center border border-1">
                        <a class="nav-link decoration-none text-light" href="?pending_orders">Pending Orders</a>
                    </li>
                    <li class="nav-item text-white text-center border border-1">
                        <a class="nav-link decoration-none text-light" href="?">Order History</a>
                    </li>
                    <li class="nav-item text-white text-center border border-1">
                        <a class="nav-link decoration-none text-light" href="?edit_account">Edit Account</a>
                    </li>
                    <li class="nav-item text-white text-center border border-1">
                        <a class="nav-link decoration-none text-light" href="?delete_account">Delete Account</a>
                    </li>
                    <li class="nav-item text-white text-center border border-1">
                        <a class="nav-link decoration-none text-light" href="index.php?logout">Logout</a>
                    </li>

                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <?php
            if (isset($_GET['pending_orders'])) {
                include('user_area/pending_table.php');
            } elseif (isset($_GET['edit_account'])) {
                include('user_area/user_edit.php');

            } elseif (isset($_GET['delete_account'])) {
                ?>
                <div class="text-center">
                    <h3 class="text-danger">Do You Want To Delete Your Account?</h3>
                    <div>
                        <a href="?delete_account_user" class="btn btn-dark">Yes</a>
                        <a href="dashboard.php" class="btn btn-secondary">No</a>
                    </div>
                </div>
                <?php
            } elseif (isset($_GET['delete_account_user'])) {
                session_unset();
                session_destroy();
                $conn->query("DELETE FROM `user` WHERE user_id = $user_id ");
                echo "<script>alert('Delete Successfull');
                window.location.href = '/cloth-store/index.php'</script>";

            } else {
                $pending_count = $conn->query("SELECT COUNT(*) as total FROM `user_orders` WHERE user_id = $user_id ")->fetch_assoc()['total'];
                ?>
                <div class="">
                    <h3 class="text-center text-danger">You Have <span
                            class="text-success"><?php echo $pending_count; ?></span> Incomplete Orders</h3>
                </div>
                <?php
            }
            ?>

        </div>
    </div>






















    <?php include('include/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>