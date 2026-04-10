<?php

defined('ABSPATH') || exit;

function ud_pv_register_block() {
    $dir  = dirname(__DIR__);
    $path = $dir . '/block.json';

    if (! file_exists($path)) {
        return;
    }

    register_block_type(
        $dir,
        ['render_callback' => 'ud_pv_render_block']
    );
}
add_action('init', 'ud_pv_register_block');

function ud_pv_register_post_meta() {
    register_post_meta(
        'post',
        'ud_projekt_verknuepfen',
        [
            'type'          => 'integer',
            'single'        => true,
            'show_in_rest'  => true,
            'default'       => 0,
            'auth_callback' => function () {
                return current_user_can('edit_posts');
            },
        ]
    );
}
add_action('init', 'ud_pv_register_post_meta');
