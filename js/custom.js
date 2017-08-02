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

    $(".owl-carousel .owl-nav .owl-prev").empty();
    $(".owl-carousel .owl-nav .owl-next").empty();



    var per_page = -1;
    jQuery('.category-section__filter .cat_item input:checkbox').on('click', function(){

        var params = new Array();

        var page_number = 1;

        var $this = jQuery(this),
            form_block = $this.closest('.category-section__filter'),

            all_chackbox = form_block.find('.cat_item'),
            select_chackbox = all_chackbox.find('input:checked');

            var arr1 = new Array();
            var arr2 = new Array();

            select_chackbox.each(function(){

                var cat_id;
                var taxonomy =  $(this).data('taxonomy');

                if(taxonomy == 'type'){
                    cat_id = $(this).data('term_id');
                    arr2.push(cat_id);
                }else{
                     cat_id = $(this).data('term_id');
                     arr1.push(cat_id);
                }

            });

        load_products(arr1, arr2, page_number, per_page);

    });


    jQuery('.wrap-pagination').delegate('.ajax-number', 'click',  function(){

        var params = new Array();
        var page_number = $(this).text();

        var
            form_block = $('.category-section__filter'),

            all_chackbox = form_block.find('.cat_item'),
            select_chackbox = all_chackbox.find('input:checked');

        var arr1 = new Array();
        var arr2 = new Array();

        select_chackbox.each(function(){

            var cat_id;
            var taxonomy =  $(this).data('taxonomy');

            if(taxonomy == 'type'){
                cat_id = $(this).data('term_id');
                arr2.push(cat_id);
            }else{
                cat_id = $(this).data('term_id');
                arr1.push(cat_id);
            }

        });

        load_products(arr1, arr2, page_number, per_page);


    });


    function createPagination(per_page, counte_page){
       var  $one_page = parseInt(counte_page/per_page);

        var pagination = '';

        pagination += "<div class='navigation'>";

            for($i=1; $i<=$one_page; $i++){
                pagination += "<a class='page-numbers ajax-number'>"+$i+"</a>";
            }

        pagination += "</div>";

        return pagination;

    }

    function addslashes(str)
    {
        return str.replace('/(["\'\])/g', "\\$1");
    }

    function load_products(company, type, paged=1, perPage=-1){

        var loader = $('.load_block'),
            speed = 300;


        loader.fadeIn(speed);

        $.ajax({
            url: 'http://' + location.hostname + '/wp-admin/admin-ajax.php',
            method: 'POST',
            dataType: "json",
            type: 'POST',
            data: {action: 'load_posts', id_company: company, id_type: type, paged: paged, perPage: perPage},
            success:function($data){

                console.log($data);

                $html = '';

                if($data.posts){


                    for ($i=0; $i<$data.posts.length; $i++) {
                        
                        $data.posts[$i];

                        $html += "<div class='related-item'>";
                        $html +=      "<div class='item-sub'>";
                        $html +=         $data.posts[$i]['thumb'];
                        $html +=       "</div>";
                        $html +=       "<h3 class='related-title'>"+$data.posts[$i]['title']+"</h3>";
                        $html +=       "<h4 class='related-descr'>"+$data.posts[$i]['excerpt']+"</h4>";
                        $html +=       "<div class='more-block'><a href'"+decodeURIComponent($data.posts[$i]['url'])+"'>подробнее</a></div>";
                        $html +="</div>";


                    }

                    $('.related-products__wrap').html($html);

                    loader.fadeOut(speed);
                }

                $('.wrap-pagination').html('');

                /*
                if($data['found']/8>1){
                    $pagination = createPagination(8, $data['found']);
                    $('.wrap-pagination').html($pagination);
                }
                */
            }
        });
    }


});