<?php

add_action('wp_enqueue_scripts', function()
{
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/css/vendor/bootstrap.min.css', [], filemtime(get_stylesheet_directory() . '/assets/css/vendor/bootstrap.min.css') );
    wp_enqueue_style('font-lato', 'https://fonts.googleapis.com/css?family=Lato:400,700', [], false);
    wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/assets/css/styles.css', [], filemtime(get_stylesheet_directory() . '/assets/css/styles.css'));
    wp_enqueue_script('main', get_stylesheet_directory_uri() . '/assets/js/main.js', [], filemtime(get_stylesheet_directory() . '/assets/js/main.js') , true );
});


add_action( 'init', function() 
{
    $labels = array(
		"name" => __( "Invoices", "custom-post-type-ui" ),
		"singular_name" => __( "Invoice", "custom-post-type-ui" ),
	);

	$args = array(
		"label" => __( "Invoices", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "invoice", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-media-text",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "invoice", $args );
});


?>