<?php
?>
<?php
session_start();
include("../database/db.php");


if (isset($_POST['login'])) {
    $admin_password = $_POST['admin_password'];
    $admin_email = $_POST['admin_email'];
    $user_name = "";
    $admin_id = 0;
    $querry = "SELECT * FROM `admin` WHERE admin_email='$admin_email' and admin_password ='$admin_password'";
    $result = $conn->query($querry);
    if ($result->num_rows == 1) {
        foreach ($result as $rows) {
            $admin_name = $rows['admin_name'];
            $admin_id = $rows['admin_id'];
        }
        $_SESSION["admin"] = ["admin_name" => $admin_name, "admin_email" => $admin_email, "admin_id" => $admin_id];
        header("location: /cloth-store/admin_area/");

    } else {
        echo "admin not found";
    }
} else if (isset($_POST['register'])) {
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];

    $admin_email = $_POST['admin_email'];
    $admin_address = $_POST['admin_address'];
    $admin_phone = $_POST['admin_phone'];

    $image_loc = $_FILES['admin_image']['tmp_name'];
    $image_name = $_FILES['admin_image']['name'];
    $image_des = "../image/" . $image_name;
    move_uploaded_file($image_loc, $image_des);
    $admin_ip = $_SERVER['REMOTE_ADDR'];

    $querry = "SELECT * FROM `admin` WHERE admin_email ='$admin_email'";
    $result = $conn->query($querry);
    if ($result->num_rows > 0) {
        echo "<script>
        alert('Admin Already Registered with this email');
        window.location.href = '/cloth-store/admin_area/index.php?register';
    </script>";

    } else {
        $admin = $conn->prepare("INSERT INTO `admin`(`admin_name`, `admin_email`, `admin_password`, `admin_address`, `admin_phone`, `admin_image`, `admin_ip`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $admin->bind_param("sssssss", $admin_name, $admin_email, $admin_password, $admin_address, $admin_phone, $image_name, $admin_ip);
        $result = $admin->execute();
        $last_id = $conn->insert_id;
        if ($result) {
            $_SESSION["admin"] = [
                "admin_name" => $admin_name,
                "admin_email" => $admin_email,
                "admin_id" => $last_id
            ];
            header("location: /cloth-store/admin_area/");
        } else {
            echo "new Admin not registered";
        }
    }
}
?>