<?php
// /application/controllers/ProductsController.php
require_once 'application/model/productsModel.php';

class ProductsController {
    public function showProducts() {
        $productsModel = new ProductsModel();
        $products = $productsModel->getProducts();
        require 'application/views/products.php';
    }

    public function getProducts() {
        header('Content-Type: application/json'); //just to be sure
        $productsModel = new ProductsModel();
        $products = $productsModel->getProducts();
        echo json_encode($products);
    }
}