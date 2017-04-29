<?php 

// Create custom post
function demo_register() {

    $args = array(
        'labels' => array(
            'name'                  => __('Demo', 'diegoteliz'),
            'singular_name'         => __('demos', 'diegoteliz'),
            'add_new'               => __('Add new', 'diegoteliz'),
            'add_new_item'          => __('Add new demo', 'diegoteliz'),
            'edit_item'             => __('Edit demo', 'diegoteliz'),
            'new_item'              => __('New demo', 'diegoteliz'),
            'view_item'             => __('View demo', 'diegoteliz'),
            'search_items'          => __('Find demos', 'diegoteliz'),
            'not_found'             => __('No demos found', 'diegoteliz'),
            'not_found_in_trash'    => __('No demos found in Trash', 'diegoteliz'),
            'parent_item_colon'     => ''
        ),
        'public'                    => true,
        'publicly_queryable'        => true,
        'show_ui'                   => true,
        'query_var'                 => true,
        'rewrite'                   => array( 'slug' => '/demos' , 'with_front' => true ),
        'capability_type'           => 'post',
        'hierarchical'              => false,
        'menu_position'             => 6,
        'menu_icon'                 => 'dashicons-format-aside',
        'taxonomies'                => array( 'category' , 'post_tag' ),
        'supports'                  => array( 'title' , 'excerpt' , 'editor' , 'thumbnail' ),
        'can_export'                => true
    ); 
    register_post_type( 'demo' , $args );
}

add_action( 'init' , 'demo_register' );


// Create taxonomy
function demo_taxonomy_register() {

    $labels = array(
        'name'                       => __( 'Demos' , 'diegoteliz' ),
        'singular_name'              => __( 'Demo' , 'diegoteliz' ),
        'search_items'               => __( 'Seach Demos' , 'diegoteliz' ),
        'popular_items'              => __( 'Popular Demos' , 'diegoteliz' ),
        'all_items'                  => __( 'All Demos' , 'diegoteliz' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Demo' , 'diegoteliz' ),
        'update_item'                => __( 'Update Demo' , 'diegoteliz' ),
        'add_new_item'               => __( 'Add New Demo' , 'diegoteliz' ),
        'new_item_name'              => __( 'New Demos Name' , 'diegoteliz' ),
        'separate_items_with_commas' => __( 'Separate demos with commas' , 'diegoteliz' ),
        'add_or_remove_items'        => __( 'Add or remove demos' , 'diegoteliz' ),
        'choose_from_most_used'      => __( 'Choose from the most used demos' , 'diegoteliz' ),
        'not_found'                  => __( 'No demos found' , 'diegoteliz' ),
        'menu_name'                  => __( 'Demos' , 'diegoteliz' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'demo' ),
    );

    register_taxonomy( 'demo' , array( 'demo' ) , $args );

}

add_action( 'init' , 'demo_taxonomy_register' , 0 );


// Login logo

function custom_login_logo() {
    echo '<style type="text/css">
            .login h1 a { background: url(' . get_bloginfo( 'template_directory' ) . '/img/login-logo.png) 20px 0 / auto auto no-repeat; width: auto; }
            
        </style>';
}
add_action( 'login_head' , 'custom_login_logo' );


// Add class name to menu item links
function add_menuclass( $ulclass ) {
    return preg_replace( '/<a /' , '<a class="menu-item-link"' , $ulclass );
}
add_filter( 'wp_nav_menu' , 'add_menuclass' );


// Replace Posts label as News in Admin Panel 

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[ 5 ][ 0 ] = 'News';
    $submenu[ 'edit.php' ][ 5 ][ 0 ] = 'News';
    $submenu[ 'edit.php' ][ 10 ][ 0 ] = 'Add News';
    echo '';
}
function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types[ 'post' ]->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add News';
    $labels->add_new_item = 'Add News';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
}
add_action( 'init' , 'change_post_object_label' );
add_action( 'admin_menu' , 'change_post_menu_label' );


// Remove items from admin menu
function remove_menus() {
    remove_menu_page( 'edit.php' );                   // Posts
    remove_menu_page( 'edit-comments.php' );          // Comments
}
add_action( 'admin_menu' , 'remove_menus' );


// Remove width/height dimensions from <img> tags

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/' , '' , $html );
    return $html;
}
add_filter( 'post_thumbnail_html' , 'remove_thumbnail_dimensions' , 10 );
add_filter( 'image_send_to_editor' , 'remove_thumbnail_dimensions' , 10 );


// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args( $args = '' ) {
    $args[ 'container' ] = false;
    return $args;
}
add_filter( 'wp_nav_menu_args' , 'my_wp_nav_menu_args' );

?>