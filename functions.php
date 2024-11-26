<?php
function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');

    register_nav_menus(
        array(
            'menu-1' => __('Primary Menu', 'your-theme-textdomain'),
            'sidebar-menu' => __('Sidebar Menu', 'your-theme-textdomain'),
        )
    );
}
add_action('after_setup_theme', 'theme_setup');

function theme_scripts() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_scripts');
function enqueue_tailwind_css() {
    wp_enqueue_style('tailwind', get_template_directory_uri() . '/dist/output.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'enqueue_tailwind_css');


function get_page_structure($page_id) {
    $content = get_post_field('post_content', $page_id);
    $structure = array(
        'subtopics' => array(),
    );

    // Extract h2 headings as subtopics
    preg_match_all('/<h2.*?>(.*?)<\/h2>/i', $content, $matches);
    if (!empty($matches[1])) {
        $structure['subtopics'] = $matches[1];
    }

    return $structure;
}



if (!function_exists('background_color')) {
    function background_color() {
        // Return default background color or empty
        echo 'ffffff';
    }
}

if (!function_exists('background_image')) {
    function background_image() {
        // Return default background image or empty
        return '';
    }
}

// Add this to ensure proper URL routing
function fix_theme_routing() {
    // Flush rewrite rules on theme activation
    flush_rewrite_rules();
}
add_action('after_setup_theme', 'fix_theme_routing');


// Add this to your functions.php
function register_theme_sidebars() {
    register_sidebar(array(
        'name'          => 'Left Sidebar',
        'id'            => 'left-sidebar',
        'description'   => 'Left sidebar widgets',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => 'Right Sidebar',
        'id'            => 'right-sidebar',
        'description'   => 'Right sidebar widgets',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'register_theme_sidebars');
