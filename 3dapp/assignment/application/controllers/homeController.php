<?php
require_once 'application/model/homeModel.php';

class HomeController {
    private $homeModel;

    public function __construct() {
        $this->homeModel = new HomeModel();
    }

    public function showHome() {
        include 'application/views/home.php';
    }

    public function getHomeCarouselImages() {
        $carouselImages = $this->homeModel->getCarouselImages();

        // Header needed for AJAX response
        header('Content-Type: application/json');

        // Encode images array as JSON and return
        echo json_encode($carouselImages);
    }
}