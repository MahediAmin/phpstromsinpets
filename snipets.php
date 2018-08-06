<?php

// php start
[php]

// after_setup_theme_function with parametter
[afc]

/**
 * Demo Theme Bootstraping
 */

function demoTheme_bootstraping()
{

    load_theme_textdomain("demoThem");
    add_theme_support("post-thumbnails");
    add_theme_support("title-tag");
    add_theme_support("post-formats", array(
        "aside",
        "gallery",
        "image",
        "quote",
        "status",
        "video",
        "audio",
        "chat"
    ));
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
    add_theme_support('html5', array('search-form'));


}
add_action("after_setup_theme", "demoTheme_bootstraping");

// cssand and js add korar sinpites
[cssjs]


/*
 * Demo Theme style and scripts enquee
 */
function demoTheme_assets_list(){




    wp_enqueue_style("demoTheme-basecss", get_theme_file_uri("assets/css/base.css"), null, "0.1.0", "all");
    wp_enqueue_style("demoTheme-css", get_stylesheet_uri());


    wp_enqueue_script('jquery');
    wp_enqueue_script("demoThememodazanier-js", get_theme_file_uri("assets/js/modernizr.js"), array("jquery"), "0.1.0", false);





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



/**
 * hilight search result
 */


 [searchH]
    function demoTheme_search_result($text)
{
    if (is_search()) {
        $pattern = '/(' . join('|', explode(' ', get_search_query())) . ')/i';
        $text = preg_replace($pattern, '<span class="badge badge-primary">\0</span>', $text);
    }
    return $text;
}
add_filter('the_content', 'demoTheme_search_result');
add_filter('the_excerpt', 'demoTheme_search_result');
add_filter('the_title', 'demoTheme_search_result');


/*
 * pagination for listed pagination
 */
[pagination]

function philosophy_pagination()
{
    global $wp_query;
    $links = paginate_links(array(
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type' => 'list',
        'mid_size' => 3
    ));
    $links = str_replace("page-numbers", "pgn__num", $links);
    $links = str_replace("<ul class='pgn__num'>", "<ul>", $links);
    $links = str_replace("next pgn__num", "pgn__next", $links);
    $links = str_replace("prev pgn__num", "pgn__prev", $links);
    echo $links;
}

// echo the function
< ? php philosophy_pagination (); ?>