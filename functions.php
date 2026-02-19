<?php

function add_kzr_css_PSC_happs() {wp_enqueue_style( 'prefix-style', plugins_url('CSS/style.css', __FILE__) );}
function plugin_home_PSC_happs(){include 'Pages/activation.php';}
function f_paypal_settings_PSC_happs(){include 'Pages/paypal-settings.php';}
function f_purchase_records_PSC_happs(){include 'Pages/purchase-records.php';}
function f_rate_settings_PSC_happs(){include 'Pages/rate-settings.php';}

function inititate_app_PSC_happs($atts, $content = null){
   
   extract(shortcode_atts(array(
      "version" => 'simple'  
   ), $atts));

$enable_addon = ($version == "simple") ? 0 : 1;

  ob_start();
  include 'Pages/home.php';
       $output = ob_get_clean();
            return $output;

}


function HAPPS_MASK(string $str, string $maskChar = '*'): string
{
    $len = strlen($str);

    if ($len <= 2) {
        return str_repeat($maskChar, $len);
    }

    // number of chars to mask (50%)
    $maskLen = (int) floor($len * 0.5);

    // start position from center
    $start = (int) floor(($len - $maskLen) / 2);

    return substr($str, 0, $start)
         . str_repeat($maskChar, $maskLen)
         . substr($str, $start + $maskLen);
}



function admin_menu_PSC_happs() {
  

  add_menu_page ( 'Menu', 'PayStub Calculator', 'manage_options', 'main-menu-PSC_happs', 'plugin_home_PSC_happs', 'dashicons-calculator' );

add_submenu_page ( 'main-menu-PSC_happs', 'Rate Settings', 'Rate Settings', 'manage_options','rate_settings_PSC_happs' ,'f_rate_settings_PSC_happs', '');


  add_submenu_page ( 'main-menu-PSC_happs', 'Paypal Settings', 'Paypal Settings', 'manage_options','paypal_settings_PSC_happs' ,'f_paypal_settings_PSC_happs', '');

  
add_submenu_page ( 'main-menu-PSC_happs', 'PDF Records', 'PDF Records', 'manage_options','pdf_records_PSC_happs' ,'f_purchase_records_PSC_happs', '');

  
  

}?>