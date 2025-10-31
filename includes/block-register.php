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


// functions.php oder Plugin
// Meta automatisch entfernen, wenn der Block "ud/projekt-verknuepfen" nicht (mehr) im Inhalt steht.
add_action('save_post', function ( $post_id, $post, $update ) {
    if ( wp_is_post_autosave($post_id) || wp_is_post_revision($post_id) ) {
        return;
    }

    // optional: nur auf bestimmte Post Types reagieren
    // $allowed = ['post', 'page', 'projekt'];
    // if ( ! in_array( get_post_type($post_id), $allowed, true ) ) return;

    if ( ! has_block( 'ud/projekt-verknuepfen', $post ) ) {
        delete_post_meta( $post_id, 'ud_projekt_verknuepfen' );
    }
}, 10, 3);

