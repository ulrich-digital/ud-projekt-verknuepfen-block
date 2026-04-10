<?php 

defined('ABSPATH') || exit;

function ud_pv_register_block() {
    $dir  = dirname(__DIR__); // Plugin-Root
    $path = $dir . '/block.json';
    if (! file_exists($path)) {
        return;
    }

    // Block registrieren
    register_block_type(
        $dir,
        ['render_callback' => 'ud_pv_render_block']
    );
}
add_action('init', 'ud_pv_register_block');


// Meta separat registrieren
add_action('init', function() {
    register_post_meta( 'post', 'ud_projekt_verknuepfen', [
        'type'         => 'integer',
        'single'       => true,
        'show_in_rest' => true,
        'auth_callback' => function() {
            return current_user_can( 'edit_posts' );
        },
    ]);
});
