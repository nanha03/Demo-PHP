






<h2 class="text-center text-success mb-4">Edit User</h2>
<form action="dashboard.php" method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <input type="text" id="user_name" name="user_name" class="form-control border-dark"
                        value="<?php echo htmlspecialchars($user_name); ?>">
                </div>

                <div class="mb-3">
                    <input type="email" id="user_email" name="user_email" class="form-control border-dark"
                        value="<?php echo htmlspecialchars($user_email); ?>">
                </div>

                <div class="mb-3">
                    <input type="password" id="user_password" name="user_password" class="form-control border-dark"
                        value="<?php echo htmlspecialchars($user_password); ?>">
                </div>


                <div class="mb-3 d-flex align-items-center border border-dark rounded p-2">
                    <label for="user_image" class="border-dark flex-grow-1 me-2 p-2 bg-light text-dark"
                        style="cursor: pointer;">
                        Change Profile Picture
                        <input type="file" id="user_image" name="user_image" class="d-none" onchange="previewImage(this)">
                    </label>
                    <img id="preview" src="<?php echo "./image/".$image;?>" alt="Profile Image" class="img-thumbnail"
                        width="100">
                </div>

                <script>
                    function previewImage(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                document.getElementById('preview').src = e.target.result;
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>


                <div class="mb-3">
                    <input type="text" id="user_address" name="user_address" class="form-control border-dark"
                        value="<?php echo htmlspecialchars($user_address); ?>">
                </div>

                <div class="mb-3">
                    <input type="text" id="user_phone" name="user_phone" class="form-control border-dark"
                        value="<?php echo htmlspecialchars($user_phone); ?>">
                </div>

                <div class="mb-3 text-center">
                    <button type="submit" name="user_edit" class="btn btn-success w-25">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>