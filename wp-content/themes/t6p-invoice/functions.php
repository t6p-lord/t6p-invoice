<?php

add_action('wp_enqueue_scripts', function()
{
    wp_enqueue_style( 'styles', get_stylesheet_uri(), [], filemtime(get_stylesheet_directory()) );
});


add_action('init', function()
{
    register_post_type('invoice', [
        'labels' => [
            'name' => __('Invoices'),
            'singular_name' => __('Invoice')
        ],
        'menu_icon' => 'dashicons-media-text',
        'supports' => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'],
        'show_ui' => true,

    ]);
});

?>