<?php get_header(); ?>
<div class="content-main">
    <div class="main-container">
        <div class="wrap-breadcrumbs">
            <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
        </div>

        <section class="related-products news-main">
            <div class="title-block">
                <h1>новости</h1>
            </div>
            <div class="related-news__wrap">
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                    <div class="news-item">
                        <a href="<?php the_permalink(); ?>">
                            <span class="img-block">
                                <?php the_post_thumbnail('post-img'); ?>
                            </span>
                        </a>
                        <div class="item-date"><?php the_time('d.m.y') ?></div>
                        <a href="<?php the_permalink(); ?>">
                            <h3 class="news-title"><?php the_title(); ?></h3>
                        </a>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="wrap-pagination">
                <?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
            </div>
        </section>
    </div>
</div>

<?php get_footer(); ?>