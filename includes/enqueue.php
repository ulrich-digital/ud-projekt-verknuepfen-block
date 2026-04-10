<?php

defined('ABSPATH') || exit;

function ud_pv_enqueue_editor_assets() {
    $script_path = plugin_dir_path(dirname(__FILE__)) . 'assets/js/projekt-verknuepfen-panel.js';
    $script_url  = plugin_dir_url(dirname(__FILE__)) . 'assets/js/projekt-verknuepfen-panel.js';

    if (! file_exists($script_path)) {
        return;
    }

    wp_enqueue_script(
        'ud-projekt-verknuepfen-panel',
        $script_url,
        [
            'wp-plugins',
            'wp-edit-post',
            'wp-components',
            'wp-data',
            'wp-element',
            'wp-api-fetch',
        ],
        filemtime($script_path),
        true
    );
}
add_action('enqueue_block_editor_assets', 'ud_pv_enqueue_editor_assets');
