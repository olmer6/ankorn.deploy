$(document).ready(function(){
    $('.product-slider').slick({
        arrows: true,
        dots: false,
        infinite: true, // бесконечная прокрутка слайдов
        variableWidth: true,
        slidesToShow: 4,
        prevArrow:'<button type="button" class="slick-prev"></button>',
        nextArrow:'<button type="button" class="slick-next"></button>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
});