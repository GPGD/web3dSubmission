<?php
class ProductsModel {
    private $dbHandle;

    public function __construct() {
        $dsn = 'sqlite:database/websiteDB.db';
        $this->dbHandle = new PDO($dsn, 'user', 'password');
        $this->dbHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getProducts() {
        // Fetch all products
        $productQuery = $this->dbHandle->query('SELECT * FROM Products');
        $productQuery->execute();
        $productsData = $productQuery->fetchAll(PDO::FETCH_ASSOC);

        $products = [];

        // For each product, fetch all related images and thumbnail
        foreach ($productsData as $productData) {
            // Fetch product images
            $imageQuery = $this->dbHandle->prepare('SELECT * FROM Product_Images WHERE product_ID = ?');
            $imageQuery->execute([$productData['product_ID']]);
            $imageData = $imageQuery->fetchAll(PDO::FETCH_ASSOC);

            // Fetch product thumbnail
            $thumbnailQuery = $this->dbHandle->prepare('SELECT img_path FROM Product_Thumbnails WHERE product_ID = ?');
            $thumbnailQuery->execute([$productData['product_ID']]);
            $thumbnailData = $thumbnailQuery->fetch(PDO::FETCH_ASSOC);

            // Combine the product, image, and thumbnail data into array
            $product = $productData;
            foreach ($imageData as $index => $imageDatum) {
                $product["img" . ($index + 1) . "Overlay"] = $imageDatum['img_overlay'];
                $product["img" . ($index + 1) . "Path"] = $imageDatum['img_path'];
                $product["img" . ($index + 1) . "AltText"] = $imageDatum['img_alt_text'];
            }

            // Add the thumbnail path
            $product["thumbnailPath"] = $thumbnailData['img_path'];

            // Add the modelPath value
            $product["modelPath"] = $productData['model_path'];

            // Add the product to list of products
            $products['product' . $productData['product_ID'] . 'Data'] = $product;
        }

        // Return the list of products
        return $products;
    }
}

//for testing
class ProductsTestModel {
    public function getProducts() {
        $json = file_get_contents('application/model/products.json');
        $products = json_decode($json, true);
        return $products;
    }
}