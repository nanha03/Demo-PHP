<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header("Location: index.php");
    exit();
}
?>


<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto border border-secondary mt-4 rounded">
            <form action="admin_session.php" method="POST" id="loginForm">
                <div class="mb-3">
                    <h2 class="text-center fw-bold fs-3 text-secondary my-3">Admin Login</h2>
                </div>
                <div class="mb-3">
                    <label for="admin_email" class="form-label">Admin Email:</label>
                    <input type="email" name="admin_email" class="form-control" id="admin_email" placeholder="Admin Email">
                </div>
                <div class="mb-3">
                    <label for="admin_password" class="form-label">Admin Password:</label>
                    <input type="password" name="admin_password" class="form-control" id="admin_password" placeholder="Admin Password">
                </div>
                <button name="login" class="bg-dark fs-4 fw-bold my-3 form-control text-white">Admin Login</button>
            </form>
            <div class="container text-center">
                <h5>New Admin? <a href="?admin_register">Register</a></h5>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('loginForm').onsubmit = (e) => {
        const email = document.getElementById('admin_email').value.trim();
        const password = document.getElementById('admin_password').value.trim();
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert("Invalid email !");
            e.preventDefault();
        }
        if (password.length < 8) {
            alert("password must be at least 8 characters.");
            e.preventDefault();
        }
    };
</script>