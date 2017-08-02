<?php get_header(); ?>
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


        ?>

        <?php $similar = new WP_Query(array('post_type'=>'post', 'cat'=>$term_id, 'posts_per_page'=>4)); ?>

        <?php if($similar->found_posts){ ?>
            <section class="related-products">
                <div class="title-block">
                    <h1>похожие материалы</h1>
                </div>
                <div class="related-news__wrap">

                 <?php if($similar->have_posts()) : while($similar->have_posts()) : $similar->the_post(); ?>
                    <div class="news-item">
                        <a href="<?php the_permalink(); ?>">
                            <span class="img-block">
                                <?php the_post_thumbnail('post-img'); ?>
                            </span>
                        </a>
                        <div class="item-date"><?php the_time('d.m.y'); ?></div>
                        <h3 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </div>

                <?php endwhile; ?>
                <?php endif; ?>

                </div>
            </section>
        <?php } ?>
    </div>
</div>

<?php get_footer(); ?>