<?php

/**
 * Plugin Name: Bazar
 * Plugin URI: https://agencialaf.com
 * Description: Plugin do site Bazar.
 * Version: 0.0.3
 * Author: Ingo Stramm
 * Text Domain: bazar
 * License: GPLv2
 */

defined('ABSPATH') or die('No script kiddies please!');

define('BAZAR_DIR', plugin_dir_path(__FILE__));
define('BAZAR_URL', plugin_dir_url(__FILE__));

function bazar_debug($debug)
{
    echo '<pre>';
    var_dump($debug);
    echo '</pre>';
}

// require_once 'tgm/tgm.php';
// require_once 'classes/classes.php';
require_once 'scripts.php';
require_once 'woocommerce.php';
require_once 'shortcodes.php';

require 'plugin-update-checker-4.10/plugin-update-checker.php';
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://raw.githubusercontent.com/IngoStramm/bazar/master/info.json',
    __FILE__,
    'bazar'
);
