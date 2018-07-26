<?php

// php start
[php]

// after_setup_theme_function with parametter
[afc]

/*
 * Demo Theme Bootstraping
 *
 */

function demoTheme_bootstraping(){

    load_textdomain(demoThem);
    add_theme_support("post-thumbnails");
    add_theme_support("title-tag");


}
add_action("after_setup_theme", "demoTheme_bootstraping");
