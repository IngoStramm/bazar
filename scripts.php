<?php

add_action('wp_enqueue_scripts', 'bazar_frontend_scripts');

function bazar_frontend_scripts()
{

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';

    if (empty($min)) :
        wp_enqueue_script('bazar-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true);
    endif;

    // wp_register_script('bazar-script', BAZAR_URL . 'assets/js/bazar' . $min . '.js', array('jquery'), '1.0.0', true);

    // wp_enqueue_script('bazar-script');

    // wp_localize_script('bazar-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    wp_enqueue_style('bazar-style', BAZAR_URL . 'assets/css/bazar.css', array(), BAZAR_VERSION, 'all');
}
