/*--------------------------------------------------
Template Name: Volga;
Description: Responsive  Ecommerce Bootstrap Template;
Template URI:;
Author Name:Md Bayazid Hasan;
Author URI:;
Version: 1.0;

NOTE: main.js, All custom script and plugin activation script in this file.
-----------------------------------------------------

    JS INDEX
    ================================================
    1. Newsletter Popup
    2. Mobile Menu Activation
    3. Tooltip Activation
    4.1 Vertical-Menu Activation
    4.2 Category menu Activation
    4.3 Checkout Page Activation
    5. NivoSlider Activation
    6. Hot Deal Product Activation
    7. Brand Banner Activation
    8. Electronics Product Activation
    9. New & Featured Product Activation
    10. Second Hot Deal Product Activation
    11. New Product Tow For Home-2 Activation
    12. New Product Tow For Home-2 Activation
    13. Featured Product Activation For Home-3
    14. New Product Tow For Home-2 Activation
    15. Single Categorie tow Activation
    16. Categorie Slider Product Activation
    17. New Product Tow For Home-2 Activation
    18. New Product Tow For Home-2 Activation
    19. Thumbnail Product activation
    20. Countdown Js Activation
    21. ScrollUp Activation
    22. Sticky-Menu Activation
    23. Nice Select Activation
    24. Price Slider Activation

================================================*/

(function ($) {
    "use Strict";
    /*--------------------------
    1. Newsletter Popup
    ---------------------------*/
    setTimeout(function () {
        $(".popup_wrapper").css({
            opacity: "1",
            visibility: "visible",
        });
        $(".popup_off").on("click", function () {
            $(".popup_wrapper").fadeOut(500);
        });
    }, 2500);

    /*----------------------------
    2. Mobile Menu Activation
    -----------------------------*/
    jQuery(".mobile-menu nav").meanmenu({
        meanScreenWidth: "991",
    });

    /*----------------------------
    3. Tooltip Activation
    ------------------------------ */
    // $('.pro-actions a').tooltip({
    //     animated: 'fade',
    //     placement: 'top',
    //     container: 'body'
    // });

    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    /*----------------------------
    4.1 Vertical-Menu Activation
    -----------------------------*/
    $(".categorie-title,.mobile-categorei-menu").on("click", function () {
        $(".vertical-menu-list,.mobile-categorei-menu-list").slideToggle();
    });

    /*------------------------------
	 4.2 Category menu Activation
	------------------------------*/
    $(
        "#cate-toggle li.has-sub>a,#cate-mobile-toggle li.has-sub>a,#shop-cate-toggle li.has-sub>a"
    ).on("click", function () {
        $(this).removeAttr("href");
        var element = $(this).parent("li");
        if (element.hasClass("open")) {
            element.removeClass("open");
            element.find("li").removeClass("open");
            element.find("ul").slideUp();
        } else {
            element.addClass("open");
            element.children("ul").slideDown();
            element.siblings("li").children("ul").slideUp();
            element.siblings("li").removeClass("open");
            element.siblings("li").find("li").removeClass("open");
            element.siblings("li").find("ul").slideUp();
        }
    });
    $("#cate-toggle>ul>li.has-sub>a").append('<span class="holder"></span>');

    /*----------------------------
    4.3 Checkout Page Activation
    -----------------------------*/
    $("#showlogin").on("click", function () {
        $("#checkout-login").slideToggle();
    });
    $("#showcoupon").on("click", function () {
        $("#checkout_coupon").slideToggle();
    });
    $("#cbox").on("click", function () {
        $("#cbox_info").slideToggle();
    });
    $("#ship-box").on("click", function () {
        $("#ship-box-info").slideToggle();
    });

    /*----------------------------
    5. NivoSlider Activation
    -----------------------------*/
    $("#slider").nivoSlider({
        effect: "random",
        animSpeed: 300,
        pauseTime: 5000,
        directionNav: true,
        manualAdvance: false,
        controlNavThumbs: false,
        pauseOnHover: true,
        controlNav: true,
        prevText: "<i class='fa fa-angle-left'></i>",
        nextText: "<i class='fa fa-angle-right'></i>",
    });

    /*----------------------------------------------------
    6. Hot Deal Product Activation
    -----------------------------------------------------*/
    $(".hot-deal-active").owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        margin: 20,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500,
            },
            480: {
                items: 2,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
            1200: {
                items: 4,
            },
        },
    });

    /*----------------------------------------------------
    7. Brand Banner Activation
    -----------------------------------------------------*/
    $(".brand-banner").owlCarousel({
        loop: true,
        nav: true,
        autoplay: true,
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        smartSpeed: 1200,
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500,
            },
            380: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1000: {
                items: 5,
            },
        },
    });

    /*----------------------------------------------------
    8. Electronics Product Activation
    -----------------------------------------------------*/
    $(".electronics-pro-active")
        .on("changed.owl.carousel initialized.owl.carousel", function (event) {
            $(event.target)
                .find(".owl-item")
                .removeClass("last")
                .eq(event.item.index + event.page.size - 1)
                .addClass("last");
        })
        .owlCarousel({
            loop: false,
            nav: true,
            dots: false,
            smartSpeed: 1000,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>",
            ],
            margin: 0,
            responsive: {
                0: {
                    items: 1,
                    autoplay: true,
                    smartSpeed: 500,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 2,
                },
                1200: {
                    items: 2,
                },
            },
        });

    /*----------------------------------------------------
    9. New & Featured Product Activation
    -----------------------------------------------------*/
    $(".new-products-active").owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500,
            },
            450: {
                items: 2,
            },
            768: {
                items: 2,
            },
            1000: {
                items: 2,
            },
        },
    });

    /*----------------------------------------------------
    10. Second Hot Deal Product Activation
    -----------------------------------------------------*/
    $(".second-hot-deal-active")
        .on("changed.owl.carousel initialized.owl.carousel", function (event) {
            $(event.target)
                .find(".owl-item")
                .removeClass("last")
                .eq(event.item.index + event.page.size - 1)
                .addClass("last");
        })
        .owlCarousel({
            loop: false,
            nav: true,
            dots: false,
            smartSpeed: 1500,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>",
            ],
            margin: 0,
            responsive: {
                0: {
                    items: 1,
                    autoplay: true,
                    smartSpeed: 500,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 2,
                },
                1200: {
                    items: 2,
                },
            },
        });

    /*----------------------------------------------------
    11. New Product Tow For Home-2 Activation
    -----------------------------------------------------*/
    $(".new-pro-two-active").owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500,
            },
            495: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1200: {
                items: 4,
            },
        },
    });

    /*----------------------------------------------------
    12. New Product Tow For Home-2 Activation
    -----------------------------------------------------*/
    $(".hot-deal-three-active").owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500,
            },
            490: {
                items: 2,
            },
            768: {
                items: 3,
            },
            992: {
                items: 1,
            },
            1200: {
                items: 1,
            },
        },
    });

    /*----------------------------------------------------
    13. Featured Product Activation For Home-3
    -----------------------------------------------------*/
    $(".featured-pro-active").owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500,
            },
            490: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1200: {
                items: 5,
            },
        },
    });

    /*----------------------------------------------------
    14. New Product Tow For Home-2 Activation
    -----------------------------------------------------*/
    $(".single-cat-pro-active").owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500,
            },
            450: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1200: {
                items: 1,
            },
        },
    });

    /*----------------------------------------------------
    15. Single Categorie tow Activation
    -----------------------------------------------------*/
    $(".single-cat-pro-two-active").owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500,
            },
            490: {
                items: 2,
            },
            768: {
                items: 1,
            },
            1200: {
                items: 1,
            },
        },
    });

    /*----------------------------------------------------
    16. Categorie Slider Product Activation
    -----------------------------------------------------*/
    $(".categore-slider-active").owlCarousel({
        loop: false,
        nav: false,
        dots: false,
        smartSpeed: 1500,
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
            1200: {
                items: 4,
            },
        },
    });

    /*----------------------------------------------------
    17. New Product Tow For Home-2 Activation
    -----------------------------------------------------*/
    $(".more-fearured-pro-active").owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500,
            },
            490: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1200: {
                items: 4,
            },
        },
    });

    /*----------------------------------------------------
    18. New Product Tow For Home-2 Activation
    -----------------------------------------------------*/
    $(".latest-blog-active").owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        margin: 20,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500,
            },
            450: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
            1200: {
                items: 3,
            },
        },
    });

    /*-------------------------------------
    19. Thumbnail Product activation
    --------------------------------------*/
    $(".thumb-menu").owlCarousel({
        loop: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        margin: 15,
        smartSpeed: 1000,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 3,
                autoplay: true,
                smartSpeed: 500,
            },
            768: {
                items: 3,
            },
            1000: {
                items: 3,
            },
        },
    });
    $(".thumb-menu a").on("click", function () {
        $(".thumb-menu a").removeClass("active");
    });

    /*----------------------------
    20. Countdown Js Activation
    -----------------------------*/
    $("[data-countdown]").each(function () {
        var $this = $(this),
            finalDate = $(this).data("countdown");
        $this.countdown(finalDate, function (event) {
            $this.html(
                event.strftime(
                    '<div class="count"><p>%D</p> <span>Ngày</span></div><div class="count"><p>%H</p> <span>Giờ</span></div><div class="count"><p>%M</p> <span>Phút</span></div><div class="count"> <p>%S</p> <span>Giây</span></div>'
                )
            );
        });
    });

    /*----------------------------
    21. ScrollUp Activation
    -----------------------------*/
    $.scrollUp({
        scrollName: "scrollUp", // Element ID
        topDistance: "550", // Distance from top before showing element (px)
        topSpeed: 1000, // Speed back to top (ms)
        animation: "fade", // Fade, slide, none
        scrollSpeed: 400,
        animationInSpeed: 1000, // Animation in speed (ms)
        animationOutSpeed: 1000, // Animation out speed (ms)
        scrollText: '<i class="fa fa-angle-double-up" aria-hidden="true"></i>', // Text for element
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    });

    /*----------------------------
    22. Sticky-Menu Activation
    ------------------------------ */
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".header-sticky").addClass("sticky");
        } else {
            $(".header-sticky").removeClass("sticky");
        }
    });

    /*----------------------------
    23. Nice Select Activation
    ------------------------------ */
    $("select").niceSelect();

    /*----------------------------
    24. Price Slider Activation
    -----------------------------*/
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 100,
        values: [0, 85],
        slide: function (event, ui) {
            $("#amount").val("$" + ui.values[0] + "  $" + ui.values[1]);
        },
    });
    $("#amount").val(
        "$" +
            $("#slider-range").slider("values", 0) +
            "  $" +
            $("#slider-range").slider("values", 1)
    );
})(jQuery);
