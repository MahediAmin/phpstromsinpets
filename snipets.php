<?php

// php start
[php]

// after_setup_theme_function with parametter
[afc]

/*
 * Demo Theme Bootstraping
 *
 */

function demoTheme_bootstraping()
{

    load_theme_textdomain("demoThem");
    add_theme_support("post-thumbnails");
    add_theme_support("title-tag");


}
add_action("after_setup_theme", "demoTheme_bootstraping");

// cssand and js add korar sinpites
[cssjs]


/*
 * Demo Theme style and scripts enquee
 */

function demoTheme_assets_list()
{

    wp_enqueue_style("demoThemcss", get_stylesheet_uri());


}
add_action("wp_enqueue_scripts", "demoTheme_assets_list");