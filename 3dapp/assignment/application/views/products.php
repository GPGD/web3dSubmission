<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/carouselCSS.css">
    <link rel="stylesheet" href="css/products.css">

    <!--FontAwsome file links (add others as used)-->
    <link href="assets/fontawsome/css/fontawesome.css" rel="stylesheet">
    <link href="assets/fontawsome/css/brands.css" rel="stylesheet">

    <script src='https://www.x3dom.org/download/x3dom.js'> </script>
    <link rel='stylesheet' type='text/css' href='https://www.x3dom.org/download/x3dom.css'></link>

    <title>Products</title>
</head>
<body>

<?php require 'navbar.php'; ?>

<!-- Main content -->
<div class="container">
    <!-- Product navigation -->
    <div class="row">
        <div class="col">
            <div class="btn-group" role="group" aria-label="Product navigation">
                <!-- product nav buttons inserted here -->
            </div>
        </div>
    </div>

    <!-- Product content -->
    <div class="row">
        <div class="col product-container">
            <!-- product contents inserted here -->
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>

<!--- load js after componants --->
<script src="js/jquery-3.4.1.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/getProducts.js"></script>

</body>
</html>