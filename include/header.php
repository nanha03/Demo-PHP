<nav class="navbar navbar-expand-lg bg-secondary position-fixed w-100 shadow-sm py-2" style="z-index: 1030;">
    <div class="container">
        <a class="navbar-brand text-white fw-bold d-flex align-items-center fs-5" href="index.php">
            <i class="fa-solid fa-shirt me-2"></i>ClothCraft
        </a>
        <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars fs-5"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white px-3 small" href="index.php">
                        <i class="fa-solid fa-house me-1"></i>Home
                    </a>
                </li>

                <?php
                $file_name = 'payment_qr.png';
                if (file_exists($file_name)) {
                    unlink($file_name);
                }
                ?>

                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3 small" href="cart.php">
                            <i class="fa-solid fa-cart-shopping me-1"></i>
                            Cart <sup><?php cart_item(); ?></sup>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (!isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3 small" href="register.php">
                            <i class="fa-solid fa-user-plus me-1"></i>User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3 small" href="admin_area/index.php">
                            <i class="fa-solid fa-lock me-1"></i>Admin
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link text-white px-3 small" href="#">
                        <i class="fa-solid fa-phone me-1"></i>Contact
                    </a>
                </li>

                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3 small" href="dashboard.php">
                            <i class="fa-solid fa-gauge-high me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3 small" href="?logout">
                            <i class="fa-solid fa-right-from-bracket me-1"></i>Logout
                        </a>
                    </li>
                    <?php
                    if (isset($_GET['logout'])) {
                        session_unset();
                        session_destroy();
                        header("location: /cloth-store/");
                    }
                    ?>
                <?php endif; ?>
            </ul>

            <form class="d-flex align-items-center" role="search">
                <input class="form-control form-control-sm me-2 rounded-pill px-3" name="search" type="search" placeholder="Search">
                <button class="btn btn-outline-light btn-sm rounded-pill px-3" type="submit">
                    <i class="fa-solid fa-magnifying-glass me-1"></i>
                </button>
            </form>
        </div>
    </div>
</nav>
