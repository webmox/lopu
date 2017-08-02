<?php
/**
 * Template Name: Contacts page
 */
get_header(); ?>
    <div class="content-main">
        <div class="main-container">

            <div class="wrap-breadcrumbs">
                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            </div>


            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                <section class="simple-news-section">
                    <div class="title-block">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="item-content clearfix text">
                        <div class="wrap-row">
                            <div class="left-col">
                                <?php the_content(); ?>
                            </div>
                            <div class="right-col">
                                <?php

                                    $phone =  get_field('photo');
                                    $address = get_field('address');
                                    $map = get_field('map');

                                ?>
                                <div class="top-content">
                                    <p class="phone-text"><i class="fa fa-phone" aria-hidden="true"></i><?php echo $phone; ?></p>
                                    <p class="address-text"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $address; ?></p>
                                </div>
                                <div id="map"></div>
                            </div>
                        </div>


                    </div>
                </section>
            <?php endwhile; ?>
            <?php endif; ?>

            <script>
                var map;
                function initMap() {
                    var mypos = {lat: <?php  $map['lat'] ?>, lng: <?php  $map['lng'] ?>};
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: mypos,
                        zoom: 16,
                        scrollwheel: false,
                        streetViewControl: false,
                        navigationControl: false,
                        mapTypeControl: false,
                        scaleControl: false,
                        draggable: true
                    });

                    var contentString = '<div id="content">'+
                        '<div id="bodyContent">'+
                        '<p><?php echo $address; ?></p>' +
                        '</div>'+
                        '</div>';

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    var marker = new google.maps.Marker({
                        position: mypos,
                        map: map,
                        icon: '<?php bloginfo('template_url'); ?>/images/marker.png'
                    });
                    marker.addListener('click', function() {
                        infowindow.open(map, marker);
                    });
                    infowindow.open(map,marker);
                }
            </script>

            <?php echo get_template_part('section-news');  ?>

        </div>
    </div>

<?php get_footer(); ?>