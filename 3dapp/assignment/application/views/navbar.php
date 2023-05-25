<!-- Navbar -->
<link rel="stylesheet" href="css/navbar.css">
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <!--Brand-->
            <div class="logo">
                <a class="navbar-brand" href="#">
                    <h1>C</h1>
                    <h1>oca</h1>
                    <h2>Cola</h2>
                    <h3>Journey</h3>
                </a>
            </div></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'home') ? 'active' : ''; ?>" href="<?php echo "index.php?page=home"; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'products') ? 'active' : ''; ?>" href="<?php echo "index.php?page=products"; ?>">Products</a>
                </li>
            </ul>
        </div>
    </div>
</nav>