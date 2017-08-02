<?php $news = new WP_Query(array('post_type'=>'post', 'cat'=>2, 'posts_per_page'=>4)) ?>
<section class="related-products">
    <div class="title-block">
        <h1><?php echo  get_cat_name(2); ?></h1>
    </div>
    <div class="related-news__wrap">
        <?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
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