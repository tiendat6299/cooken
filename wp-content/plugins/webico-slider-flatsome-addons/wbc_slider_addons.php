<?php
/*
Plugin Name: Webico Slider Flatsome Addons
Plugin URI: https://www.webico.vn
Description: Plugin được chia sẻ bởi Webico teams. Plugin tạo timeline cho flatsome hoặc theme bất kỳ
Contributors: tranbinhcse, Webico
Version: 1.0.1
Author: Webico Teams
Text Domain: webico
Domain Path: /languages
Tags: Webico.vn, Tran Binh, Flatsome Addons
Tested up to: 3.9.4
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate link: https://www.webico.vn

 Plugin được chia sẻ bởi Webico teams.
*/
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


define('WBC_FL_Slide_Addons_DIR', plugin_dir_path(__FILE__));
define('WBC_FL_Slide_Addons_URL', plugins_url('/', __FILE__));
class WBC_FL_Slide_Addons
{
    /**
     * WBC_FL_Slide_Addons constructor.
     */
    public function __construct()
    {
        add_action('ux_builder_setup', array($this, 'ux_builder_element'));
        $this->includes();
    }
    public function includes()
    {

    }
    public function ux_builder_element()
    {
        include(WBC_FL_Slide_Addons_DIR . '/builder/wbc_slider.php' );
    }
}
function wbc_fl_slide_addons_run()
{
    new WBC_FL_Slide_Addons();
}
add_action('after_setup_theme', 'wbc_fl_slide_addons_run');


require_once (WBC_FL_Slide_Addons_DIR. '/shortcodes/wbc_slider.php');
