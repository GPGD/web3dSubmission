<?php
// /index.php acts a main MVC controller
require_once 'application/controllers/productsController.php';
require_once 'application/controllers/homeController.php';

$productController = new ProductsController();
$homeController = new HomeController();

$action = isset($_GET['action']) ? $_GET['action'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

if ($action) {
    switch ($action) {
        case 'getProducts':
            $productController->getProducts();
            break;
        case 'getHomeCarouselImages':
            $homeController->getHomeCarouselImages();
            break;
        default:
            // TODO: handle unknown action
            break;
    }
} else {
    switch ($page) {
        case 'products':
            $productController->showProducts();
            break;
        case 'home':
        default:
            $homeController->showHome();
            break;
    }
}