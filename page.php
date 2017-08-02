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

        <?php echo get_template_part('section-news');  ?>

    </div>
</div>

<?php get_footer(); ?>