<div class="bg-secondary-50 ">
        <nav class="container  navbar navbar-expand-lg bg-secondary-50 ">
            <ul class="navbar-nav me-auto px-2 m-auto">
                <?php if (isset($_SESSION['user'])) {
                    ?>
                    <li class="nav-item">
                        <a href="" class="nav-link">Welcome <?php echo $_SESSION['user']['username'] ?></a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a href="./register.php" class="nav-link">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>