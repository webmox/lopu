<?php get_header(); ?>

<?php

function get_terms_ids($arr){

    $result = array();

    if(is_array($arr)){

        foreach($arr as $k=>$item_el){
            $result[$k] = $item_el->term_id;
        }

        return $result;

    }else{
        return false;
    }
}


?>


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

                        <?php the_content(); ?>

                    </div>
                </section>
            <?php endwhile; ?>
            <?php endif; ?>


            <?php


            $category = get_the_category();

            $term_id = $category[0]->term_id;

            $post = $wp_query->post;

            $cats = get_the_terms($post->ID, 'type');

            $tax_ids;

            if($cats){
                $tax_ids = $cats;
            }else{
                $cats = get_the_terms($post->ID, 'company');
                $tax_ids = $cats;
            }

            ?>

            <?php $similar = new WP_Query(array('post_type'=>'products', 'terms'=>get_terms_ids($tax_ids), 'posts_per_page'=>3)); ?>

            <?php if($similar->found_posts){ ?>
                <section class="related-products">
                    <div class="title-block">
                        <h1>Похожая продукция</h1>
                    </div>
                    <div class="related-products__wrap">
                    <?php if($similar->have_posts()) : while($similar->have_posts()) : $similar->the_post(); ?>
                        <div class="related-item">
                            <div class="item-sub">
                               <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('img-product'); ?></a>
                            </div>
                            <h3 class="related-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <h4 class="related-descr"><?php the_excerpt(); ?></h4>
                            <div class="more-block">
                                <a href="<?php the_permalink(); ?>">подробнее</a>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </section>
            <?php } ?>

        </div>
    </div>

<?php get_footer(); ?>