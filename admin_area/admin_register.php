<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header("Location: index.php");
    exit();
}
?>



<div class="container d-flex justify-content-center align-items-center vh-70  my-4">
    <div class="row w-50">
        <div class="col-md-12 border border-secondary rounded p-3 shadow">
            <form id="signupForm" action="admin_session.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <h2 class="text-center fw-bold fs-4 text-secondary my-1">Admin Register</h2>
                </div>
                <div class="mb-3">
                    <label for="admin_name" class="form-label">Name:</label>
                    <input type="text" name="admin_name" class="form-control" id="admin_name" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="admin_email" class="form-label">Email:</label>
                    <input type="email" name="admin_email" class="form-control" id="admin_email" placeholder="Email">
                </div>
                <div class="mb-4">
                    <label for="admin_image" class="form-label">Profile Image:</label>
                    <input type="file" name="admin_image" id="admin_image" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="admin_password" class="form-label">Password:</label>
                    <input type="password" name="admin_password" class="form-control" id="admin_password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label for="admin_address" class="form-label">Address:</label>
                    <input type="text" name="admin_address" class="form-control" id="admin_address" placeholder="Address">
                </div>
                <div class="mb-3">
                    <label for="admin_phone" class="form-label">Phone:</label>
                    <input type="text" name="admin_phone" class="form-control" id="admin_phone" placeholder="Phone No.">
                </div>
                <button name="register" class="bg-dark fs-4 fw-bold my-3 form-control text-white">Register</button>
            </form>
            <div class="container text-center">
                <h5>Already Registered? <a href="?admin_login">Login</a></h5>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("signupForm");
    form.addEventListener("submit", function(event) {
        let messages = [];

        const admin_name = document.getElementById("admin_name").value.trim();
        const admin_email = document.getElementById("admin_email").value.trim();
        const admin_image = document.getElementById("admin_image").value;
        const admin_password = document.getElementById("admin_password").value;
        const admin_address = document.getElementById("admin_address").value;
        const admin_phone = document.getElementById("admin_phone").value.trim();

        if (admin_name === "") messages.push("Name is Empty.");
        if (admin_email === "") messages.push("Email is Empty.");
        if (admin_password === "") messages.push("Password is Empty.");
        if (admin_address === "") messages.push("Address is Empty.");
        if (admin_phone === "") messages.push("Phone is Empty.");
        
        // Improved phone validation
        if (!/^\d{10}$/.test(user_phone)) {
            messages.push("Enter a Valid 10-Digit Phone Number.");
        }

        if (user_image === "") {
            messages.push("Please upload a profile image.");
        }
        
        if (messages.length > 0) {
            event.preventDefault();
            alert(messages.join("\n"));
        }
    });
});

</script>
