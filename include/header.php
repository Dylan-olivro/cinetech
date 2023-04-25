<header>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navbar-brand text-white">BigJob</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                <div class="navbar-nav ">
                    <?php
                    if (!isset($_SESSION['id'])) { ?>
                        <a href="index.php" class="nav-link">Home</a>
                        <a href="test.php" class="nav-link">Carousel</a>
                        <a href="carouselTest.php" class="nav-link">Carousel 5.3</a>
                        <a href="signup.php" class="nav-link">Sign up</a>
                        <a href="login.php" class="nav-link">Login</a>
                    <?php } else { ?>
                        <a href="index.php" class="nav-link">Home</a>
                        <a href="test.php" class="nav-link">Carousel</a>
                        <a href="carouselTest.php" class="nav-link">Carousel 5.3</a>
                        <!-- <a href="calendar.php" class="nav-link">Calendar</a>
                        <a href="history.php" class="nav-link">History</a> -->
                        <?php if ($_SESSION['role'] > 0) { ?>
                            <!-- <a href="checking.php" class="nav-link">Checking</a>
                            <a href="admin.php" class="nav-link">Admin</a> -->
                        <?php } ?>
                        <a href="./include/disconnect.php" class="nav-link">Logout</a>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
</header>