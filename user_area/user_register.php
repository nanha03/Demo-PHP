<div class="container d-flex justify-content-center align-items-center vh-100 mt-3">
    <div class="row w-50">
        <div class="col-md-12 border border-secondary rounded p-3 shadow">
            <form id="signupForm" action="user_area/session.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <h2 class="text-center fw-bold fs-3 text-secondary my-3">User Register</h2>
                </div>
                <div class="mb-3">
                    <label for="user_name" class="form-label">Name:</label>
                    <input type="text" name="user_name" class="form-control" id="user_name" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="user_email" class="form-label">Email:</label>
                    <input type="email" name="user_email" class="form-control" id="user_email" placeholder="Email">
                </div>
                <div class="mb-4">
                    <label for="user_image" class="form-label fw-bold">Profile Image:</label>
                    <input type="file" name="user_image" id="user_image" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="user_password" class="form-label">Password:</label>
                    <input type="password" name="user_password" class="form-control" id="user_password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label for="user_address" class="form-label">Address:</label>
                    <input type="text" name="user_address" class="form-control" id="user_address" placeholder="Address">
                </div>
                <div class="mb-3">
                    <label for="user_phone" class="form-label">Phone:</label>
                    <input type="text" name="user_phone" class="form-control" id="user_phone" placeholder="Phone No.">
                </div>
                <button name="register" class="bg-dark fs-4 fw-bold my-3 form-control text-white">Register</button>
            </form>
            <div class="container text-center">
                <h5>Already Registered? <a href="?user_login=true">Login</a></h5>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("signupForm");
    form.addEventListener("submit", function(event) {
        let messages = [];

        const user_name = document.getElementById("user_name").value.trim();
        const user_email = document.getElementById("user_email").value.trim();
        const user_image = document.getElementById("user_image").value;
        const user_password = document.getElementById("user_password").value;
        const user_address = document.getElementById("user_address").value;
        const user_phone = document.getElementById("user_phone").value.trim();

        if (user_name === "") messages.push("User Name is Empty.");
        if (user_email === "") messages.push("User Email is Empty.");
        if (user_password === "") messages.push("User Password is Empty.");
        if (user_address === "") messages.push("User Address is Empty.");
        if (user_phone === "") messages.push("User Phone is Empty.");
        
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
