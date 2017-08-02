$(document).ready(function() {

    /*   navigation menu  */

    // var plash = $('.dark-overlay');
    // var speedOverlay = 600;
    //
    // $('.icon-block').on('click', function () {
    //     $('#mySidenav').css('left','0');
    //     plash.fadeIn(speedOverlay);
    // });
    //
    // function closeMenu() {
    //     $('#mySidenav').css('left','-250px');
    //     plash.fadeOut(speedOverlay);
    // }
    //
    // plash.mousedown(function(e) {
    //     var clicked = $(e.target); // get the element clicked
    //     if (clicked.is('#mySidenav') || clicked.parents().is('#mySidenav')) {
    //         return; // click happened within the dialog, do nothing here
    //     } else { // click was outside the dialog, so close it
    //         closeMenu();
    //     }
    // });
    //
    // $('.main-navigation-menu li a').click(closeMenu);
    //
    // $('.closebtn').on('click', closeMenu);

    /* navigation links toggling */

    $('.main-menu ul li a').on('click', function() {
       var $this = $(this);
        $('.main-menu ul li a').removeClass('active');
        $this.toggleClass('active');
    });


    /* pagination */

    $('.pagination ul li a').on('click', function() {
        var $this = $(this);
        $('.pagination ul li a').removeClass('active');
        $this.toggleClass('active');
    });


    /*  new collection carousel  */

    $('.top-carousel').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1
    });

    $(".members-carousel").owlCarousel({
        loop:true,
        nav : true,
        margin:20,
        items: 4,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            768:{
                items:3
            },
            1200:{
                items:4
            }
        },
        dots: false,
        autoplay: true

    });

    $(".owl-carousel .owl-nav .owl-prev").empty()
    $(".owl-carousel .owl-nav .owl-next").empty()
    

});