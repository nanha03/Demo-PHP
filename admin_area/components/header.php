<!-- admin navbar -->
<nav class="navbar navbar-expand-lg bg-secondary shadow-sm">
    <div class="container">
        <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="index.php?admin_login">
            <i class="fa-solid fa-shirt me-2 fs-4"></i> ClothCraft
        </a>

        <?php if (isset($_SESSION['admin'])): ?>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3 hover-bg" href="#">Admin-Home</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3" href="#">
                        <i class="fa-solid fa-user me-1"></i>Welcome <?php echo $_SESSION['admin']['admin_name']; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3" href="?logout">
                        <i class="fa-solid fa-right-from-bracket me-1"></i>Logout
                    </a>
                </li>
            </ul>
        <?php else: ?>
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3" href="../">
                        <i class="fa-solid fa-house-user me-1"></i>User Area
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3" href="?admin_login">
                        <i class="fa-solid fa-lock me-1"></i>Login/Register
                    </a>
                </li>
            </ul>
            <?php
                if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
                    header("Location: index.php");
                    exit();
                }
            ?>
        <?php endif; ?>
    </div>
</nav>
