<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/custom.css">

    <title>Home</title>
</head>
<body>
<?php require 'navbar.php'; ?>

<!-- Branding (won't center???)-->
<div class="container my-4">
    <div class="card text-center bg-dark">
        <div class="card-body d-flex flex-column justify-content-center">
            <div class="logo text-center">
                <a class="navbar-brand text-white text-center" href="#">
                    <h1 style="font-size: 3em;">C</h1>
                    <h1 style="font-size: 3em;">oca</h1>
                    <h2 style="font-size: 2em;">Cola</h2>
                    <h3 style="font-size: 1.5em;">Journey</h3>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="container">
    <div class="carousel-container">
        <!-- carousel inserted here --->
    </div>
</div>

<?php require 'footer.php'; ?>

<!--- load js after components --->
<script src="js/jquery-3.4.1.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/getHomeCarouselImages.js"></script>

</body>
</html>