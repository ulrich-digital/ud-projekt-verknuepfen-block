<?php
/**
 * Plugin Name:     UD Block: Projekt-Verknüpfung
 * Description:     Block zum Verknüpfen von Magazin-Beiträgen mit einem Projekt.
 * Version:         1.0.1
 * Author:          ulrich.digital gmbh
 * Author URI:      https://ulrich.digital/
 * License:         ulrich.digital Nutzungslizenz 1.0
 */

defined('ABSPATH') || exit;

// Plugin-Funktionalitäten laden
foreach (
    [
        'helpers.php',
        'block-register.php',
        'enqueue.php',
        'render.php',
    ] as $file
) {
    $path = plugin_dir_path(__FILE__) . 'includes/' . $file;
    if (file_exists($path)) {
        require_once $path;
    } else {
        error_log("ud-projekt-verknuepfen: Missing required file $file");
    }
}