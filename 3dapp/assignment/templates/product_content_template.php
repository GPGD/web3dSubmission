<div class="product-content-inner" style="display: block;">

    <!--Carousel-->
    <div id="<?php echo $carouselId; ?>" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#<?php echo $carouselId; ?>" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#<?php echo $carouselId; ?>" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active card">
                <div class="card-img-overlay">
                    <h2><?php echo $img1Overlay; ?></h2>
                </div>
                <img src="<?php echo $img1Path; ?>" class="d-block w-100" alt="<?php echo $img1AltText; ?>">
            </div>
            <div class="carousel-item card">
                <div class="card-img-overlay">
                    <h2><?php echo $img2Overlay; ?></h2>
                </div>
                <img src="<?php echo $img2Path; ?>" class="d-block w-100" alt="<?php echo $img2AltText; ?>">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo $carouselId; ?>" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#<?php echo $carouselId; ?>" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- 3D Render -->
    <x3d width='500px' height='400px'>
        <scene>
            <inline nameSpaceName="<?php echo $modelName; ?>" url="<?php echo $modelPath; ?>" render="true" ></inline>
        </scene>
    </x3d>
</div>