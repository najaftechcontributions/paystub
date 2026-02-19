<?php
/**
 * Hayyat Apps
 *
 * @package     Hayyat Apps
 * @author      Hayyat Apps
 * @copyright   2020 Hayyat Apps
 * @license     GPL-1.1-or-later
 *
 * @wordpress-plugin
 * Plugin Name: PayStub Calculator
 * Plugin URI:  https://hayyatapps.com/
 * Description: PayStub Calculator  - By Hayyat apps

 * Version:     1.5
 * Author:      Hayyat Apps
 * Author URI:  https://hayyatapps.com
 * Text Domain: Dynasty Rankings 
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
// return 0;

include __DIR__ . '/functions.php';
include __DIR__ . '/manage-db.php';
// Load PayPal AJAX endpoints only when admin-ajax.php is running
add_action('plugins_loaded', function () {
  if (defined('DOING_AJAX') && DOING_AJAX) {
    require_once __DIR__ . '/APP/pypl/ajax.php';
  }
});
function my_plugin_enqueue_google_fonts()
{
  // Preconnect to Google Fonts
  echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
  echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";

  // Enqueue Google Fonts stylesheet
  echo '<link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">' . "\n";
}
add_action('wp_head', 'my_plugin_enqueue_google_fonts');



// Allow AJAX requests even though they are under /wp-admin/admin-ajax.php
if (is_admin() && !(defined('DOING_AJAX') && DOING_AJAX)) {
  // Admin pages only (no shortcode needed here)
} else {
  add_shortcode('paystub-calculator', 'inititate_app_PSC_happs');
}


register_activation_hook(__FILE__, 'CREATE_PAYSTUB_TB');
// register_deactivation_hook(__FILE__, 'DEL_PAYSTUB_TB');


add_action('admin_enqueue_scripts', 'add_kzr_css_PSC_happs');
add_action('admin_menu', 'admin_menu_PSC_happs');
