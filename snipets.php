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
    add_theme_support('automatic-feed-links');s
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


/*
* wp_menu query with child class
*/
[menu2]
<?php
$philosophy_menu = wp_nav_menu(array(
    'theme_location' => 'topmenu',
    'menu_id' => 'topmenu',
    'menu_class' => 'header__nav',
    'echo' => false
));
$philosophy_menu = str_replace("menu-item-has-children", "menu-item-has-children has-children", $philosophy_menu);
echo $philosophy_menu;
?>

[menu1]
<?php wp_nav_menu(array(

    'theme_location' => 'top_menu',
    'menu_id' => 'top_menu',
    'menu_class' => 'header__nav',
    'container' => '',



)); ?>


// this code for if the post type is not for gallery function will destroy
    [gal]
    $post_id = null;
    if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
        $post_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }
    if ( ! $post_id || get_post_format( $post_id ) != "gallery" ) {
        return;
    }

// single page prev navigation


    <?php
    $philosophy_prev_post = get_previous_post();
    if ($philosophy_prev_post) :
    ?>
    <a href="<?php echo get_the_permalink($philosophy_prev_post); ?>" rel="prev">
        <span><?php _e("Previous Post", "philosophy"); ?></span>
        <?php echo get_the_title($philosophy_prev_post); ?>
    </a>
<?php
endif;
?>



// single page next navagtion

<?php
$philosophy_next_post = get_next_post();
if ($philosophy_next_post) :
?>
<a href="<?php echo get_the_permalink($philosophy_next_post); ?>" rel="next">
    <span><?php _e("Next Post", "philosophy"); ?></span>
    <?php echo get_the_title($philosophy_next_post); ?>
</a>
<?php
endif;
?>


// sidebar 
[sidebar]
 register_sidebar( array(
        'name' => __( 'About Us Page', 'philosophy' ),
        'id' => 'about-us',
        'description' => __( 'Widgets in this area will be shown on about us page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="col-block %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="quarter-top-margin">',
        'after_title'   => '</h3>',
    ) );


// search style 
function philosophy_search_form( $form ) {
    $homedir      = home_url( "/" );
    $label        = __( "Search for:", "philosophy" );
    $button_label = __( "Search", "philosophy" );
    $newform      = <<<FORM
<form role="search" method="get" class="header__search-form" action="{$homedir}">
    <label>
        <span class="hide-content">{$label}</span>
        <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s"
               title="{$label}" autocomplete="off">
    </label>
    <input type="submit" class="search-submit" value="{$button_label}">
</form>
FORM;
    return $newform;
}
add_filter( "get_search_form", "philosophy_search_form" );

// customizer logo upload option
<?php if (has_custom_logo()) {
    the_custom_logo();
} else {
    echo "<h1><a href='" . home_url("/") . "'>" . get_bloginfo('name') . "</a></h1>";
}
?>