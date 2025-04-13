<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto border border-secondary mt-4 rounded">
            <form action="user_area/session.php" method="POST" id="loginForm">
                <div class="mb-3">
                    <h2 class="text-center fw-bold fs-3 text-secondary my-3">User Login</h2>
                </div>
                <div class="mb-3">
                    <label for="user_email" class="form-label">Email:</label>
                    <input type="email" name="user_email" class="form-control" id="user_email" placeholder="User Email">
                </div>
                <div class="mb-3">
                    <label for="user_password" class="form-label">Password:</label>
                    <input type="password" name="user_password" class="form-control" id="user_password" placeholder="User Password">
                </div>
                <button name="login" class="bg-dark fs-4 fw-bold my-3 form-control text-white">Login</button>
            </form>
            <div class="container text-center">
                <h5>New User? <a href="?user_register=true">Register</a></h5>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('loginForm').onsubmit = (e) => {
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
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