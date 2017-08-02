<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="user-scalable=no,width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title><?php bloginfo('name'); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed&amp;subset=cyrillic" rel="stylesheet">

    <?php wp_head(); ?>
</head>
<!--[if gte IE 9]
    <style type="text/css">
        .gradient {
        filter: none;
        }
    </style>
<![endif]-->
<body>
<header>
    <div class="main-container">
        <div class="header-container__wrap clearfix">
            <div class="top-elements">
                <div class="main-logo">
                    <a href="<?php bloginfo('url'); ?>">
                        <img src="<?php bloginfo('template_url'); ?>/images/main-logo.png" alt="">
                    </a>
                </div>
                <div class="lang-block">
                    <a href="javascript: void(0);" class="active">ru</a>
                    <a href="javascript: void(0);">eng</a>
                </div>
            </div>


            <div class="main-menu">

                <?php

                $args =  array(
                    'theme_location'  => 'header-top-menu',
                    'menu'            => '',
                    'container'       => 'nav',
                    'container_class' => 'main-menu-nav',
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



        </div>
    </div>
</header>