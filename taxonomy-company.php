<?php get_header(); ?>
    <div class="content-main">
        <div class="main-container">
            <div class="wrap-breadcrumbs">
                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            </div>
            <div class="category-section clearfix">


                <div class="category-section__filter">
                    <aside>
                        <h1>наша продукция</h1>
                        <!--<img src="<?php //bloginfo('template_url') ?>/images/filter_03.jpg" alt="">-->
                        <div class="sidebar">

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
                                'taxonomy'                 => 'company',
                                'pad_counts'               => false
                            );


                            $tax_company = get_categories($args);


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


                            //print_array($tax_company);

                            ?>
                            <?php if($tax_company){ ?>
                                <div class="widget-block company">
                                    <h3 class="widget-title">Компания</h3>
                                    <ul class="berocket_widget">
                                        <?php foreach($tax_company as $item_company){ ?>
                                            <li class="cat_item">
                                                <span>
                                                    <input id="checkbox_<?= $item_company->term_id ?>" class=" checkbox_<?= $item_company->term_id ?>" type="checkbox" data-term_id="<?= $item_company->term_id ?>" data-taxonomy="<?= $item_company->taxonomy ?>">
                                                    <label for="checkbox_<?= $item_company->term_id ?>" class="berocket_label_widgets berocket_checked"><?= $item_company->name ?></label>
                                                </span>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>

                            <?php if($tax_type){ ?>
                                <div class="widget-block type">
                                    <h3 class="widget-title">Тип</h3>
                                    <ul class="berocket_widget">
                                        <?php foreach($tax_type as $item_type){ ?>
                                            <li class="cat_item">
                                                <span>
                                                    <input id="checkbox_<?= $item_type->term_id ?>" class=" checkbox_<?= $item_type->term_id ?>" type="checkbox" data-term_id="<?= $item_type->term_id ?>" data-taxonomy="<?= $item_type->taxonomy ?>">
                                                    <label for="checkbox_<?= $item_type->term_id ?>" class="berocket_label_widgets berocket_checked"><?= $item_type->name ?></label>
                                                </span>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    </aside>
                </div>


                <div class="category-section__products">

                    <div class="load_block"></div>

                    <div class="related-products__wrap">

                        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                            <div class="related-item">
                                <div class="item-sub">
                                    <?php the_post_thumbnail('img-product'); ?>
                                </div>
                                <h3 class="related-title"><?php the_title(); ?></h3>
                                <h4 class="related-descr"><?php the_excerpt(); ?></h4>
                                <div class="more-block">
                                    <a href="<?php the_permalink(); ?>">подробнее</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                    <div class="wrap-pagination">
                        <?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>