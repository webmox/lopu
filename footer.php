<?php $contacts = new WP_Query(array('post_type'=>'page', 'page_id'=>42)); ?>

<?php

if($contacts->have_posts()) : while($contacts->have_posts()) : $contacts->the_post();

$address = get_field('address');
$phone = get_field('photo');
$email = get_field('email');

endwhile;
endif;


?>

<footer>
    <div class="main-container">
        <div class="footer-wrap clearfix">
            <div class="footer-item contacts">

                <?php if($address){ ?>
                <div class="address">
                    <?php echo $address; ?>
                </div>
                <?php } ?>

                <?php if($phone){ ?>
                    <div class="phone">Колл центр: <a href="tel: <?php echo $phone; ?>"><?php echo $phone; ?></a></div>
                <?php } ?>

                <?php if($email){ ?><div class="mail"><a href="mailto: <?php echo $email; ?>"><?php echo $email; ?></a></div><?php } ?>


                <a href="javascript: void(0);" class="feedback-link">обратная связь</a>
            </div>
            <div class="footer-item">

                <?php

                $args =  array(
                    'theme_location'  => 'header-top-menu',
                    'menu'            => '',
                    'container'       => 'nav',
                    'container_class' => 'footer-nav',
                    'container_id'    => '',
                    'menu_class'      => '',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => '',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => '',
                );

                wp_nav_menu( $args );
                ?>

            </div>
            <div class="footer-item-big clearfix">

                <?php

                $args = array(
                    'child_of'                 => 0,
                    'parent'                   =>$term->term_id,
                    'orderby'                  => 'name',
                    'order'                    => 'ASC',
                    'hide_empty'               => false,
                    'hierarchical'             => 1,
                    'exclude'                  => '',
                    'include'                  => '',
                    'number'                   => 0,
                    'taxonomy'                 => 'type',
                    'pad_counts'               => false
                );

                $tax_type = get_categories($args);
                ?>

                <?php if($tax_type){ ?>
                <div class="catalog-block">
                    <ul class="service-catalog">
                        <?php foreach($tax_type as $item){ ?>
                            <li><a href="<?php echo get_category_link($item->term_id); ?>"><?php echo get_cat_name($item->term_id); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="footer-copy">
                    <img src="<?php bloginfo('template_url'); ?>/images/iso.png" alt="">
                    <h4>Сертификация международного стандарта</h4>
                    <div class="copyright">
                        &copy; НПО Практика. 2017
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



<script>
    var map;
    function initMap() {
        var mypos = {lat: 50.484505, lng: 30.36796300000003};
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
            '<p>03680, Украина, г. Киев, ул. Малинская, 20-А</p>' +
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
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDVhTlYnp1f6q0wyVpbQMLHpySDdADFRZ0&callback=initMap" async defer></script>
<?php wp_footer(); ?>
</body>
</html>