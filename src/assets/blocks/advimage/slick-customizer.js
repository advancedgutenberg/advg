jQuery(document).ready(function ($) {
    document.addEventListener("DOMSubtreeModified", function(){
        $(".advgb-images-slider-block .advgb-images-slider:not(.slick-initialized)").slick({
            dots: true,
            adaptiveHeight: true,
        });
    });
});
