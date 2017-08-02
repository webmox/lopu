<?php
function print_array($arr){
        echo "<pre>";
                print_r($arr);
        echo "</pre>";
}

require_once('include/custom-types.php');
//require_once('include/options_theme.php');

function my_load_scripts(){
  wp_enqueue_style('normalize', get_template_directory_uri().'/css/normalize.css');
  wp_enqueue_style('owl.theme', get_template_directory_uri().'/css/owl.theme.default.min.css');
  wp_enqueue_style('owl.carousel', get_template_directory_uri().'/css/owl.carousel.min.css');
  wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/font-awesome.min.css');
  wp_enqueue_style('magnific-popup', get_template_directory_uri().'/css/magnific-popup.css');

  wp_enqueue_style('style', get_template_directory_uri().'/style.css');
  wp_enqueue_style('responsive', get_template_directory_uri().'/css/media.cs');

  wp_enqueue_script('myjquery', get_template_directory_uri().'/js/jquery-1.12.2.min.js');
  wp_enqueue_script('jquery.magnific-popup', get_template_directory_uri().'/js/jquery.magnific-popup.min.js');
  wp_enqueue_script('owl.carousel.min', get_template_directory_uri().'/js/owl.carousel.min.js');
  wp_enqueue_script('myfunctions', get_template_directory_uri().'/js/custom.js');
}

add_action('wp_enqueue_scripts', 'my_load_scripts');

/*-----------добавляем поддержку миниатюр------------*/
add_theme_support('post-thumbnails');

/*----регистрация меню в самом верху сайта---------*/
register_nav_menu('header-top-menu', 'top-menu');

/*----регистрация для футаре---------*/
register_nav_menu('menu-footer', 'footer-menu');


function add_custom_sizes() {
    add_image_size('img-product', 340, 260, true);
    add_image_size('post-img', 250, 155, true);
    add_image_size('slider', 1920, 770, true);

}

add_action('after_setup_theme','add_custom_sizes');

/*----------------------добавляем цитату для страниц---------------*/
function add_excerpt_page(){
    add_post_type_support( 'page', 'excerpt' );
}
add_action('init', 'add_excerpt_page');


add_theme_support('category-thumbnails');


/*-------------------------sidebar-------------------------------*/
register_sidebar(array(
        'name' => "Сайдбар",
        'id' => 'sidebar',
        'description' => 'Этот виджет будет показан в категории услуг',
        'class'=>'list-page',
        'before_title' => '<h2 class="title">',
        'after_title' => "</h2>\n",
        'before_widget' => '<div class="widget-block">',
        'after_widget' => "</div>")
);


/*///////////обрезаем заголовки в верхнем слайдере//////////*/
function title_chars($count, $t) {
  $title = get_the_title();
  if (mb_strlen($title) > $count)
  $title = mb_substr($title,0,$count);
  else $t = ''; echo $title . $t;
}

/*//////////////////////////////////////////////*/
function limit_words($str, $limit)
{
  $words = explode(' ', $str, ($limit + 1));
  if(count($words) > $limit) {
  array_pop($words);
  return implode(' ', $words)."..."; } else {
  return implode(' ', $words); }
}

/*//////////////////////paginations////////////////////////*/

function wp_corenavi() {
  global $wp_query;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
  $a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
  $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
  $a['prev_text'] = '«'; //текст ссылки "Предыдущая страница"
  $a['next_text'] = '»'; //текст ссылки "Следующая страница"

  if ($max > 1) echo '<div class="navigation">';
  if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
  echo $pages . paginate_links($a);
  if ($max > 1) echo '</div>';
}



/*---------------------------load more events function--------------------*/

add_action('wp_ajax_load_posts', 'load_posts');
add_action('wp_ajax_nopriv_load_posts', 'load_posts');


function load_posts(){

    $request_data = [];

    /*-------------get page id------------*/
    if(isset($_POST['id_company'])){
        $arr_company = $_POST['id_company'];
    }

    if(isset($_POST['id_type'])){
        $arr_type = $_POST['id_type'];
    }

    if(isset($_POST['perPage'])){
        $perPage = $_POST['perPage'];
    }
    /*-------------get current page--------*/
    if(isset($_POST['paged'])){
        $paged = $_POST['paged'];
    }

    $request_data['post_type'] = 'products';
    $request_data['tax_query']['relation'] = 'OR';

    if(isset($arr_type)){
        $request_data['tax_query'][] = array(
            "taxonomy"  =>  "type",
            "field"     =>  "id",
            "terms"     =>  $arr_type
        );
    }

    if(isset($arr_company)){
        $request_data['tax_query'][] = array(
            "taxonomy"  =>  "company",
            "field"     =>  "id",
            "terms"     =>  $arr_company
        );
    }


    $request_data['posts_per_page'] = $perPage;
    $request_data['paged'] = $paged;


    //print_array($request_data);

    $products = new WP_Query($request_data);

    $resultArr = [];
    $array_posts = [];

    $i = 0;

    if($products->have_posts()) : while($products->have_posts()) : $products->the_post();

        $array_posts[$i]['url'] = urlencode(get_the_permalink($post->ID));
        $array_posts[$i]['title'] = get_the_title();
        $array_posts[$i]['excerpt'] = get_the_excerpt();
        $array_posts[$i]['thumb'] = get_the_post_thumbnail($post->ID, 'img-product');

        $i++;

    endwhile;
    endif;

    $resultArr['posts'] = $array_posts;
    $resultArr['found'] = $products->found_posts;

    echo json_encode($resultArr);

    die();

}


function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyDVhTlYnp1f6q0wyVpbQMLHpySDdADFRZ0';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


/*
 * "Хлебные крошки" для WordPress
 * автор: Dimox
 * версия: 2017.01.21
 * лицензия: MIT
*/
function dimox_breadcrumbs(){

    /* === ОПЦИИ === */
    $text['home'] = 'Главная'; // текст ссылки "Главная"
    $text['category'] = '%s'; // текст для страницы рубрики
    $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
    $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
    $text['author'] = 'Статьи автора %s'; // текст для страницы автора
    $text['404'] = 'Ошибка 404'; // текст для страницы 404
    $text['page'] = 'Страница %s'; // текст 'Страница N'
    $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

    $wrap_before = '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
    $wrap_after = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
    $sep = ''; // разделитель между "крошками"
    $sep_before = '<span class="sep">'; // тег перед разделителем
    $sep_after = '</span>'; // тег после разделителя
    $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
    $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
    $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
    $before = '<span class="current">'; // тег перед текущей "крошкой"
    $after = '</span>'; // тег после текущей "крошки"
    /* === КОНЕЦ ОПЦИЙ === */

    global $post;
    $home_url = home_url('/');
    $link_before = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link_after = '</span>';
    $link_attr = ' itemprop="item"';
    $link_in_before = '<span itemprop="name">';
    $link_in_after = '</span>';
    $link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
    $frontpage_id = get_option('page_on_front');
    $parent_id = ($post) ? $post->post_parent : '';
    $sep = ' ' . $sep_before . $sep . $sep_after . ' ';
    $home_link = $link_before . '<a href="' . $home_url . '"' . $link_attr . ' class="home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;

    if (is_home() || is_front_page()) {

        if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;

    } else {

        echo $wrap_before;
        if ($show_home_link) echo $home_link;

        if ( is_category() ) {
            $cat = get_category(get_query_var('cat'), false);
            if ($cat->parent != 0) {
                $cats = get_category_parents($cat->parent, TRUE, $sep);
                $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
                $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                if ($show_home_link) echo $sep;
                echo $cats;
            }
            if ( get_query_var('paged') ) {
                $cat = $cat->cat_ID;
                echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) echo $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
            }

        } elseif ( is_search() ) {
            if (have_posts()) {
                if ($show_home_link && $show_current) echo $sep;
                if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
            } else {
                if ($show_home_link) echo $sep;
                echo $before . sprintf($text['search'], get_search_query()) . $after;
            }

        } elseif ( is_day() ) {
            if ($show_home_link) echo $sep;
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
            if ($show_current) echo $sep . $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
            if ($show_home_link) echo $sep;
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
            if ($show_current) echo $sep . $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
            if ($show_home_link && $show_current) echo $sep;
            if ($show_current) echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
            if ($show_home_link) echo $sep;
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($show_current) echo $sep . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $sep);
                if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
                $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                echo $cats;
                if ( get_query_var('cpage') ) {
                    echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
                } else {
                    if ($show_current) echo $before . get_the_title() . $after;
                }
            }

            // custom post type
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            if ( get_query_var('paged') ) {
                echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) echo $sep . $before . $post_type->label . $after;
            }

        } elseif ( is_attachment() ) {
            if ($show_home_link) echo $sep;
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            if ($cat) {
                $cats = get_category_parents($cat, TRUE, $sep);
                $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                echo $cats;
            }
            printf($link, get_permalink($parent), $parent->post_title);
            if ($show_current) echo $sep . $before . get_the_title() . $after;

        } elseif ( is_page() && !$parent_id ) {
            if ($show_current) echo $sep . $before . get_the_title() . $after;

        } elseif ( is_page() && $parent_id ) {
            if ($show_home_link) echo $sep;
            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo $sep;
                }
            }
            if ($show_current) echo $sep . $before . get_the_title() . $after;

        } elseif ( is_tag() ) {
            if ( get_query_var('paged') ) {
                $tag_id = get_queried_object_id();
                $tag = get_tag($tag_id);
                echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
            }

        } elseif ( is_author() ) {
            global $author;
            $author = get_userdata($author);
            if ( get_query_var('paged') ) {
                if ($show_home_link) echo $sep;
                echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_home_link && $show_current) echo $sep;
                if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
            }

        } elseif ( is_404() ) {
            if ($show_home_link && $show_current) echo $sep;
            if ($show_current) echo $before . $text['404'] . $after;

        } elseif ( has_post_format() && !is_singular() ) {
            if ($show_home_link) echo $sep;
            echo get_post_format_string( get_post_format() );
        }

        echo $wrap_after;

    }
} // end of dimox_breadcrumbs()


?>