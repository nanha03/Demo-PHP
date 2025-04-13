<?php
session_start();
include("../database/db.php");
if (isset($_POST['register'])) {
    $username = $_POST['user_name'];
    $password = $_POST['user_password'];
    // $hash_password = password_hash($password,PASSWORD_DEFAULT);
    $email = $_POST['user_email'];
    $address = $_POST['user_address'];
    $phone = $_POST['user_phone'];

    $image_loc = $_FILES['user_image']['tmp_name'];
    $image_name = $_FILES['user_image']['name'];
    $image_des = "../image/" . $image_name;
    move_uploaded_file($image_loc, $image_des);
    $user_ip = $_SERVER['REMOTE_ADDR'];

    $querry = "SELECT * FROM `user` WHERE user_email ='$email'";
    $result = $conn->query($querry);
    if ($result->num_rows > 0) {
        echo "<script>
        alert('User Already Registered with this email');
        window.location.href = '/cloth-store/register.php?user_register=true';
    </script>";
    
    } else {
        $user = $conn->prepare("INSERT INTO `user`(`user_name`, `user_email`, `user_password`, `user_address`, `user_phone`, `user_image`, `user_ip`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $user->bind_param("sssssss", $username, $email, $password, $address, $phone, $image_name, $user_ip);
        $result = $user->execute();
        $last_id = $conn->insert_id;
        if ($result) {
            $_SESSION["user"] = [
                "username" => $username,
                "email" => $email,
                "user_id" => $last_id
            ];
            header("location: /cloth-store/");
        } else {
            echo "new user not registered";
        }
    }





} else if (isset($_POST['login'])) {
    $user_password = $_POST['user_password'];
    // $verify_password = password_verify($user_password);
    $user_email = $_POST['user_email'];
    $user_name = "";
    $user_id = 0;
    $querry = "SELECT * FROM `user` WHERE user_email='$user_email' and user_password ='$user_password'";
    $result = $conn->query($querry);
    if ($result->num_rows == 1) {
        foreach ($result as $rows) {
            $user_name = $rows['user_name'];
            $user_id = $rows['user_id'];
        }
        $_SESSION["user"] = ["username" => $user_name, "email" => $user_email, "user_id" => $user_id];
        header("location: /cloth-store/");

    } else {
        echo "user not found";
    }
}


?>