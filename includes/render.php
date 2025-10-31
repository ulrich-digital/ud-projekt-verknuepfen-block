<?php
defined('ABSPATH') || exit;

function ud_pv_render_block($attributes, $content, $block) {
    $post_id = get_the_ID();
    if (! $post_id) {
        return ''; // im Template-Editor → keine Ausgabe
    }

    $project_id = (int) get_post_meta($post_id, 'ud_projekt_verknuepfen', true);
    if (! $project_id) {
        if (is_admin()) {
            return '<p style="color:red;">' . esc_html__('Kein Projekt verknüpft. Bitte im Beitrags-Editor auswählen.', 'ud-projekt-verknuepfen') . '</p>';
        }
        return '';
    }

    $url   = get_permalink($project_id);
    $title = get_the_title($project_id);

    if (! $url || ! $title) {
        return '';
    }

    //$heading   = ! empty($attributes['heading']) ? wp_kses_post($attributes['heading']) : '';
    $heading = "Weitere Informationen";
    $show_icon = ! empty($attributes['showIcon']);
    $icon_html = $show_icon ? '<i class="fa-sharp fa-regular fa-arrow-down-right arrow_before_text" aria-hidden="true"></i>' : '';

    $wrapper_attributes = get_block_wrapper_attributes([
        'class' => 'ud-projekt-verknuepfen',
        'data-move-to-head' => ! empty($attributes['moveToHead']) ? '1' : '0',
    ]);

    ob_start(); ?>
    <div <?= $wrapper_attributes; ?>>
        <?php if (! is_admin() && $heading) : ?>
            <h2 class="wp-block-heading ud-pv-heading"><?= $heading; ?></h2>
        <?php endif; ?>
        <a class="projekt_link_in_content" href="<?= esc_url($url); ?>">
            <?= $icon_html . esc_html($title); ?>
        </a>
    </div>
    <?php
    return ob_get_clean();
}

