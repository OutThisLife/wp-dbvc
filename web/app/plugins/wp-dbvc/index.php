<?php
if (!defined('ABSPATH')) {
  exit;
}

/**
 * WordPress database management made simple.
 *
 * @package WP Database Version Control
 * @author Talasan Nicholson
 * @license GPL-2.0+
 * @link https://crunchify.com/tag/wordpress-beginner/
 *
 * @wordpress-plugin
 * Plugin name: WP Database Version Control
 * Description: WordPress database management made simple.
 * Author: Talasan Nicholson
 * Plugin URI: https://github.com/OutThisLife/wp-dbvc
 * Author URI: https://twitter.com/outthislife
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wpdbvc
 */

class WPDB_VC {
  private $slug = 'wp-dbvc', $title;

  public function __construct() {
    global $wpdb;

    $this->title = __('WPDB VC', $this->slug);

    add_action('admin_menu', function () {
      wp_enqueue_style($this->slug.'_css', plugins_url('admin/styles.css', __FILE__));
      wp_enqueue_script($this->slug.'_js', plugins_url('admin/scripts.js', __FILE__), [], false, true);

      add_management_page($this->title, $this->title, 'manage_options', $this->slug, function () {
        require_once plugin_dir_path(__FILE__).'./admin/index.php';
      });
    });
  }
}

add_action('init', function () {
  if (current_user_can('activate_plugins')) {
    new WPDB_VC();
  }
});
