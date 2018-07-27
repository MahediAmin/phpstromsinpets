<?php

// php start
[php]

// after_setup_theme_function with parametter
[afc]

/*
 * Demo Theme Bootstraping
 */

function demoTheme_bootstraping()
{

    load_theme_textdomain("demoThem");
    add_theme_support("post-thumbnails");
    add_theme_support("title-tag");
    $demoTheme_custom_theader_detils = array(
        "header_text" => true,
        "default-text-color" => "#333",
        "width" => '1920',
        "height" => '650',
        "flex_height" => true,
        "flex_width" => true

    );
    add_theme_support("custom-header", $demoTheme_custom_theader_detils);
    $demoTheme_custom_logo_css = array(
        "width" => '100',
        "height" => '100'
    );
    add_theme_support("custom-logo", $demoTheme_custom_logo_css);
    add_theme_support("custom-background");


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



// defeault loop
[lp]
if (have_posts()) :
    while (have_posts()) : the_post(); ?>

        <h2>post ace</h2>

    <?php endwhile;
    else : ?>

        <h2>post nai</h2>

<?php endif;


// wp_inlne fucntion
[wpinline_fun]



/*
 * wp head e inline style
 */

function demoTheme_inlinestyle()
{
    if (is_home()) {
        ?>
        <style>
            body{
                background: #ccc;
            }
        </style>
 <?php

}
if (is_front_page()) {
    if (current_theme_supports("custom-header")) {
        ?>


            <style>
                .site-header{
                    background-image: url(<?php header_image(); ?>);
                    height: 50vh;
                    background-size: cover;
                    background-position: center center;

                }
                h3{
                    color: #<?php echo get_header_textcolor(); ?>;
                    margin-top: 100px;
                    text-align: center;
                    font-size: 45px;
                <?php
                if (!display_header_text()) {
                    echo "display: none;";
                }
                ?>

                }
            </style>





            <?php

        }
    }
}
add_action("wp_head", "demoTheme_inlinestyle");