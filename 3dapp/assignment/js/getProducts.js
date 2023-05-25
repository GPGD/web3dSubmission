fetch('index.php?action=getProducts')
    .then(response => response.json())
    .then(products => {
        let productHtml = '';
        let navButtonsHtml = '';

        Object.keys(products).forEach((product, index) => {
            let productName = products[product]['product_name'];
            let productNameId = productName.replace(/ /g, "_"); // remove spaces to prevent CSS selector breaking
            let modelName = products[product]['modelName'];
            let modelPath = products[product]['modelPath'];

            // Initialize carousel and carousel indicators html
            let carouselHtml = '';
            let carouselIndicatorsHtml = '';
            let imageIndex = 1;

            // Check if img[x]Overlay, img[x]Path and img[x]AltText exist for the product
            while (products[product][`img${imageIndex}Overlay`] && products[product][`img${imageIndex}Path`] && products[product][`img${imageIndex}AltText`]) {
                let imgOverlay = products[product][`img${imageIndex}Overlay`];
                let imgPath = products[product][`img${imageIndex}Path`];
                let imgAltText = products[product][`img${imageIndex}AltText`];
                let activeClass = imageIndex === 1 ? ' active' : '';
                let ariaCurrent = imageIndex === 1 ? ' aria-current="true"' : '';

                carouselHtml += `<div class="carousel-item${activeClass} card">
                                    <div class="card-img-overlay">
                                        <h2 class="text-with-border">${imgOverlay}</h2>
                                    </div>
                                    <img src="${imgPath}" class="d-block w-100 img-fluid" alt="${imgAltText}">
                                  </div>`;

                carouselIndicatorsHtml += `<button type="button" data-bs-target="#${productNameId}" data-bs-slide-to="${imageIndex - 1}" class="active"${ariaCurrent} aria-label="Slide ${imageIndex}"></button>`;

                imageIndex++;
            }

            // Add nav buttons (w/ thumbnails)
            navButtonsHtml += `<div class="product-button-container">
                        <!-- Normal button w/ thubnail -->
                        <button class="btn btn-dark product-button d-none d-lg-block" data-product-id="product${index + 1}">
                            <img src="${products[product]['thumbnailPath']}" alt="${productName}">
                        </button>
                    
                        <!-- no thumbnail button for smaller screens -->
                        <button class="btn btn-dark product-button d-lg-none" data-product-id="product${index + 1}">${productName}</button>
                    </div>`;

            // Add product content, also inserts the carousel code and carousel indicators
            productHtml += `<div id="product${index + 1}" class="product-content" style="display: none;">
                                <h2>${productName}</h2>
                                <div class="product-content-inner" style="display: block;">
                                    <!--Carousel-->
                                    <div id="${productNameId}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            ${carouselIndicatorsHtml}
                                        </div>
                                        <div class="carousel-inner">
                                            ${carouselHtml}
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#${productNameId}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#${productNameId}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <!-- 3D Render and buttons -->
                                    <div class="card mx-auto" style="width: 500px;"> <!-- change the width according to your 3D model size -->
                                        <x3d class="card-img-top" width='500px' height='400px'>
                                            <scene>
                                                <transform id="modelTransform${index + 1}">
                                                    <inline nameSpaceName="${modelName}" url="${modelPath}" render="true" ></inline>
                                                </transform>
                                            </scene>
                                        </x3d>
                                        <div class="card-body text-center"> <!--- x3d controls --->
                                            <button type="button" class="btn btn-secondary spin-button" data-product-id="${index + 1}">Spin!</button>
                                            <button type="button" class="btn btn-secondary front-camera-button" data-product-id="${index + 1}">Front View</button>
                                            <button type="button" class="btn btn-secondary side-camera-button" data-product-id="${index + 1}">Side View</button>
                                            <button type="button" class="btn btn-secondary high-angle-camera-button" data-product-id="${index + 1}">High Angle View</button>
                                            <button type="button" class="btn btn-secondary lights-button" data-product-id="${index + 1}">Lights on/off</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
        });

        document.querySelector('.btn-group').innerHTML = navButtonsHtml;
        document.querySelector('.product-container').innerHTML = productHtml;
    })
    .then(() => {
        // Show the first product
        $('#product1').show();

        // click handler for product nav bar
        $('.product-button').click(function() {
            var productId = $(this).data('product-id');
            showProduct(productId);
        });

        // listeners for x3d buttons
        $('.rotate-button').click(function() {
            var productId = $(this).data('product-id');
            rotateModel(productId);
        });

        $('.front-camera-button').click(function() {
            var productId = $(this).data('product-id');
            setViewpoint(productId, 'Front_Camera');
        });

        $('.side-camera-button').click(function() {
            var productId = $(this).data('product-id');
            setViewpoint(productId, 'Side_Camera');
        });

        $('.high-angle-camera-button').click(function() {
            var productId = $(this).data('product-id');
            setViewpoint(productId, 'High_Angle_Camera');
        });

        $('.lights-button').click(function() {
            var productId = $(this).data('product-id');
            toggleLights(productId, ['Light_1', 'Light_2']);
        });

        $('.spin-button').click(function() {
            var productId = $(this).data('product-id');
            toggleSpin(productId);
        });
    })
    .catch(error => console.error('Error:', error));

// hide and show products for SPA
function showProduct(id) {
    console.log("Showing product: " + id); // DEBUG: Log product ID
    // Hide all product content
    $('.product-content').hide();
    console.log("All product content hidden");

    // DEBUG:  Show selected product content
    console.log("Showing #" + id);
    $('#' + id).show();
    console.log("Product content #" + id + " shown");
}

//x3d spinning animation
let spinStates = {}; //track spin state for each product

function toggleSpin(id) {
    const timeSensor = document.querySelector(`#product${id} TimeSensor`);
    const isEnabled = timeSensor.getAttribute('enabled') === 'true';
    timeSensor.setAttribute('enabled', isEnabled ? 'false' : 'true');

    // Store state
    spinStates[id] = !isEnabled;
    console.log(spinStates);
}

//jump to view
function setViewpoint(productId, viewpointName) {
    const scene = document.querySelector(`#product${productId} scene`);
    const viewpoint = scene.querySelector(`Viewpoint[DEF=${viewpointName}]`);
    viewpoint.setAttribute('set_bind', 'true');
}

//toggle lights
let lightStates = {}; // track on/off state for each product's lights

function toggleLights(productId, lightNames) {
    lightStates[productId] = !lightStates[productId]; // toggle state

    const scene = document.querySelector(`#product${productId} scene`);
    lightNames.forEach((lightName) => {
        const light = scene.querySelector(`PointLight[DEF=${lightName}]`);
        light.setAttribute('on', lightStates[productId]);
    });
}