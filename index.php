<?php get_header(); ?>
    <div class="content-main">
        <?php $slider = new WP_Query(array('post_type'=>'slider')); ?>

        <?php if($slider->found_posts){ ?>
        <section class="top-carousel-section">
            <div class="top-carousel owl-carousel owl-theme">
                <?php if($slider->have_posts()) : while($slider->have_posts()) : $slider->the_post();

                    $sub_title = get_field('sub_title');
                    $thumb_url = get_the_post_thumbnail_url($post->ID, 'slider');

                 ?>
                <div class="item">
                    <img src="<?php echo $thumb_url; ?>" alt="">
                    <div class="item__right">
                        <div class="right-content">
                            <h1 class="yell-title"><span><?php the_title(); ?></span></h1>
                            <?php if($sub_title) { ?><h1 class="white-title"><span><?php echo $sub_title; ?></span></h1><?php } ?>
                            <?php if(get_the_excerpt()){ ?>
                            <div class="item-text">
                               <?php echo get_the_excerpt(); ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </section>
        <?php } ?>


        <?php $predpriyatiya = new WP_Query(array('post_type'=>'post', 'cat'=>18, 'posts_per_page'=>12)); ?>

        <?php if($predpriyatiya->found_posts){ ?>
            <section class="members-carousel-section">
                <div class="main-container">
                    <h1 class="main-title">підприємства члени ліги та їх продукція</h1>
                    <div class="members-carousel owl-carousel owl-theme">
                        <?php if($predpriyatiya->have_posts()) : while($predpriyatiya->have_posts()) : $predpriyatiya->the_post(); ?>
                            <div class="item">
                                <div class="img-wrap">
                                    <?php the_post_thumbnail('img-product'); ?>
                                </div>
                                <h3 class="member-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="more-block">
                                    <a href="<?php the_permalink(); ?>">подробнее</a>
                                </div>
                            </div>
                         <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php } ?>

        <?php $about = new WP_Query(array('post_type'=>'page', 'page_id'=>4));


        if($about->have_posts()) : while($about->have_posts()) : $about->the_post();
        $sub_title = get_field('sub_title');

        ?>
        <section class="about-section">
            <div class="about-container">
                <?php if($sub_title){ ?><h1 class="white-title-about"><?php echo $sub_title; ?></h1><?php } ?>
                <div class="about-text">
                    <?php the_excerpt(); ?>
                </div>

                <?php $args = array(
                    'sort_order' => 'asc',
                    'sort_column' => 'post_title',
                    'hierarchical' => 1,
                    'exclude' => '',
                    'include' => '',
                    'meta_key' => '',
                    'meta_value' => '',
                    'authors' => '',
                    'child_of' => 0,
                    'parent' => 4,
                    'exclude_tree' => '',
                    'number' => '',
                    'offset' => 0,
                    'post_type' => 'page',
                    'post_status' => 'publish'
                );
                $pages = get_pages($args);

                //print_array($pages);


                ?>
                <?php if($pages){ ?>
                    <div class="about-items-wrap clearfix">
                        <?php foreach($pages as $page_item){ ?>
                            <div class="about-item">
                                <?php $thumb = wp_get_attachment_image(get_post_thumbnail_id($page_item->ID), 'full'); ?>
                                <?php echo $thumb; ?>
                                <h3><a href="<?php echo get_the_permalink($page_item->ID); ?>"><?php echo $page_item->post_title; ?></a></h3>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </section>
        <?php endwhile; ?>
        <?php endif; ?>

        <?php $deal = new WP_Query(array('post_type'=>'post', 'cat'=>16, 'posts_per_page'=>4)); ?>
        <?php if($deal->found_posts){ ?>
        <section class="activity-section">
            <div class="main-container">
                <h1 class="main-title"><?php echo get_cat_name(16); ?></h1>
                <div class="activities-wrap clearfix">
                    <?php if($deal->have_posts()) : while($deal->have_posts()) : $deal->the_post(); ?>
                    <div class="activity-item">
                        <div class="img-wrap">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-img'); ?></a>
                        </div>
                        <div class="activity-info">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                   <?php endwhile; ?>
                   <?php endif; ?>
                </div>
            </div>
        </section>
        <?php } ?>


        <div class="map-section">
            <div id="map"></div>
        </div>
    </div>
<?php get_footer(); ?>