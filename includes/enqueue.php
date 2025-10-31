<?php
defined('ABSPATH') || exit;

function ud_pv_enqueue_assets() {
// (Optional) Nichts zusätzliches hier; Scripts/Styles kommen aus block.json build-Handles
}
add_action('wp_enqueue_scripts', 'ud_pv_enqueue_assets');