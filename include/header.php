<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navbar-brand">Cinetech</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse  justify-content-between" id="navbarNavAltMarkup">
                <div class="navbar-nav ">
                    <?php
                    if (!isset($_SESSION['user']['id'])) { ?>
                        <a href="index.php" class="nav-link">Home</a>
                        <a href="signup.php" class="nav-link">Sign up</a>
                        <a href="login.php" class="nav-link">Login</a>
                        <a href="movie.php" class="nav-link">Movie</a>
                        <a href="serie.php" class="nav-link">Serie</a>

                    <?php } else { ?>
                        <a href="index.php" class="nav-link">Home</a>
                        <a href="movie.php" class="nav-link">Movie</a>
                        <a href="serie.php" class="nav-link">Serie</a>
                        <a href="profil.php" class="nav-link">Profil</a>

                        <?php
                        if (isset($_SESSION["user"])) { ?>
                            <a href="profil.php" id="username" class="nav-link"><i class="fa-solid fa-user"></i><?= $_SESSION['user']['username'] ?></a>
                        <?php
                        }
                        ?>

                        <?php if ($_SESSION['user']['role'] > 0) { ?>
                            <!--ADMIN -->
                        <?php } ?>
                        <a href="./include/disconnect.php" class="nav-link">Logout</a>
                    <?php
                    }
                    ?>
                </div>
                <!-- SEARCH BAR -->
                <form class="d-flex" role="search">
                    <input class="form-control me-2" id="search-bar" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
                    <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                    <div id="result"></div>
                </form>
            </div>
        </div>
    </nav>
</header>