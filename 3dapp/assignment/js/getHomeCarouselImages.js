fetch('index.php?action=getHomeCarouselImages')
    .then(response => response.json())
    .then(images => {
        console.log(images);
        let carouselHtml = '';
        let carouselIndicatorsHtml = '';
        let index = 0;

        for(let imageKey in images){
            let image = images[imageKey];
            let activeClass = index === 0 ? ' active' : '';
            let ariaCurrent = index === 0 ? ' aria-current="true"' : '';

            carouselHtml += `<div class="carousel-item${activeClass}">
                                <img class="d-block w-100 img-fluid" src="${image.imgPath}" alt="${image.imgAltText}">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>${image.imgOverlay}</h5>
                                </div>
                            </div>`;

            carouselIndicatorsHtml += `<button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="${index}" class="active"${ariaCurrent} aria-label="Slide ${index + 1}"></button>`;
            index++;
        }

        let carouselFullHtml = `<div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        ${carouselIndicatorsHtml}
                                    </div>
                                    <div class="carousel-inner">
                                        ${carouselHtml}
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>`;

        document.querySelector('.carousel-container').innerHTML = carouselFullHtml;
    })
    .catch(error => console.error('Error:', error));