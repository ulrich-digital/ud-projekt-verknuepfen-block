<?php
defined('ABSPATH') || exit;

function ud_pv_get_default_heading() {
// Versucht den bisherigen ACF-Optionswert zu übernehmen, ansonsten Fallback
if ( function_exists('get_field') ) {
$opt = get_field('uberschrift_fur_das_zugehorige_projekt_auf_magazin-seiten', 'option');
if ( is_string($opt) && $opt !== '' ) return $opt;
}
return __('Verknüpftes Projekt', 'ud-projekt-verknuepfen');
}