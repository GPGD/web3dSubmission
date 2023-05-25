<?php
class HomeModel {
    private $dbHandle;

    public function __construct() {
        $dsn = 'sqlite:database/websiteDB.db';
        $this->dbHandle = new PDO($dsn, 'user', 'password');
        $this->dbHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getCarouselImages() {
        $imageQuery = $this->dbHandle->prepare('SELECT * FROM Product_Images WHERE product_ID = ?');
        $imageQuery->execute([0]);
        $imageData = $imageQuery->fetchAll(PDO::FETCH_ASSOC);

        $carouselImages = [];

        foreach ($imageData as $index => $imageDatum) {
            $carouselImages["img" . ($index + 1)] = [
                "imgPath" => $imageDatum['img_path'],
                "imgOverlay" => $imageDatum['img_overlay'],
                "imgAltText" => $imageDatum['img_alt_text']
            ];
        }

        return $carouselImages;
    }
}