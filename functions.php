<?php

function LNSite_resources() 
{
    wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'LNSite_resources');

// Get top ancestor
function get_top_ancestor_id() 
{
    global $post;
    if($post->post_parent) {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }

    return $post->ID;
}

// Does page have children?
function has_children() 
{
    global $post;
    $pages = get_pages('child_of=' . $post->ID);
    return count($pages);
}

//Customize excerpt word count length
function custom_excerpt_length() {
    return 20;
}

add_filter('excerpt_length', 'custom_excerpt_length');

// Theme setup
function LNSite_setup() 
{
    //Navigation Menus
    register_nav_menus(array(
        'primary' => __( 'Primary Menu'),
        'footer' => __( 'Footer Munu'),
    ));

    // Add featured image support
    add_theme_support('post-thumbnails');
    add_image_size('small-thumbnail', 180, 120, true);
    add_image_size('banner-image', 920, 210, true);

    //Add post format support
    add_theme_support('post-formats', array('aside', 'gallery', 'link'));
}

add_action('after_setup_theme', 'LNSite_setup');

// Add Our Widget Locations
function ourWidgetsInit() {

    register_sidebar( array(
        'name' => 'Sidebar',
        'id' => 'sidebar1',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="my-special-class">',
        'after_title' => '</h4>'
    ));

    register_sidebar( array(
        'name' => 'Footer Area 1',
        'id' => 'footer1'
    ));

    register_sidebar( array(
        'name' => 'Footer Area 2',
        'id' => 'footer2'
    ));

    register_sidebar( array(
        'name' => 'Footer Area 3',
        'id' => 'footer3'
    ));

    register_sidebar( array(
        'name' => 'Footer Area 4',
        'id' => 'footer4'
    ));

}

add_action('widgets_init', 'ourWidgetsInit');

// post views
function setAndViewPostViews($postID) {
    $count_key = 'views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
    return $count; /* so you can show it */
}

