<?php 

add_action('init', 'register_post_slider');

function register_post_slider(){
    register_post_type('slider', array(
        'label'  => null,
        'labels' => array(
            'name'               => 'Слайдер', // основное название для типа записи
            'singular_name'      => 'Слайдер', // название для одной записи этого типа 
            'add_new'            => 'Добавить слайд', // для добавления новой записи
            'add_new_item'       => 'Добавление слада', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование слайда', // для редактирования типа записи
            'new_item'           => 'Новый слайда', // текст новой записи
            'view_item'          => 'Смотреть слайда', // для просмотра записи этого типа.
            'search_items'       => 'Искать слайд', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Слайды', // название меню 
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_ui'             => true, 
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
        'show_in_nav_menus'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-format-image', 
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => false,
        'supports'            => array('title', 'thumbnail','excerpt'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => array(),
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ) );
}


/*//////////////////////////////////////////////////////
//////////////////////////////////////////////////////*/


add_action('init', 'register_post_products');

function register_post_products(){
    register_post_type('products', array(
        'label'  => null,
        'labels' => array(
            'name'               => 'Продукция', // основное название для типа записи
            'singular_name'      => 'Продукция', // название для одной записи этого типа
            'add_new'            => 'Добавить продукт', // для добавления новой записи
            'add_new_item'       => 'Добавление продукта', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование продукта', // для редактирования типа записи
            'new_item'           => 'Новый продукт', // текст новой записи
            'view_item'          => 'Смотреть продукт', // для просмотра записи этого типа.
            'search_items'       => 'Искать продукт', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Продукты', // название меню
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_ui'             => true, 
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
        'show_in_nav_menus'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-shield-alt',
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => false,
        'supports'            => array('title', 'editor',  'thumbnail','excerpt'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => array('type', 'company'),
        'has_archive'         => true,
        'rewrite'             => true,
        'query_var'           => true,
    ) );
}




// хук для регистрации
add_action('init', 'create_taxonomy_type');

function create_taxonomy_type(){
    // заголовки
    $labels = array(
        'name'              => 'Тип продуктов',
        'singular_name'     => 'Типы продуктов',
        'search_items'      => 'Искать тип',
        'all_items'         => 'Все типы',
        'parent_item'       => 'Родительский тип',
        'parent_item_colon' => 'Родительский тип:',
        'edit_item'         => 'Редактировать тип',
        'update_item'       => 'Обновить тип',
        'add_new_item'      => 'Добавить тип',
        'new_item_name'     => 'Новое имя тип',
        'menu_name'         => 'Типы продуктов',
    ); 
    // параметры
    $args = array(
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => $labels,
        'description'           => '', // описание таксономии
        'public'                => true,
        'publicly_queryable'    => true, // равен аргументу public
        'show_in_nav_menus'     => true, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_tagcloud'         => true, // равен аргументу show_ui
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities'          => array(),
        'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
        'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
        '_builtin'              => false,
        'show_in_quick_edit'    => null, // по умолчанию значение show_ui
    );

    register_taxonomy('type', array('products'), $args );
}


// хук для регистрации
add_action('init', 'create_taxonomy_company');

function create_taxonomy_company(){
    // заголовки
    $labels = array(
        'name'              => 'Компания',
        'singular_name'     => 'Компании',
        'search_items'      => 'Искать компанию',
        'all_items'         => 'Все компании',
        'parent_item'       => 'Родительская компания',
        'parent_item_colon' => 'Родительская компания:',
        'edit_item'         => 'Редактировать компанию',
        'update_item'       => 'Обновить компанию',
        'add_new_item'      => 'Добавить компанию',
        'new_item_name'     => 'Новое имя компанию',
        'menu_name'         => 'Компании',
    );
    // параметры
    $args = array(
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => $labels,
        'description'           => '', // описание таксономии
        'public'                => true,
        'publicly_queryable'    => true, // равен аргументу public
        'show_in_nav_menus'     => true, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_tagcloud'         => true, // равен аргументу show_ui
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities'          => array(),
        'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
        'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
        '_builtin'              => false,
        'show_in_quick_edit'    => null, // по умолчанию значение show_ui
    );

    register_taxonomy('company', array('products'), $args );
}




?>