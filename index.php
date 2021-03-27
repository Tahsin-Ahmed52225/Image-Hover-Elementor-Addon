<?php

/**
 * Plugin Name: Image Hover Scrolling Addon
 * Description: This is elementor addon to make any images to scroll up and down 
 * Plugin URI:  https://thedevgarden.com/
 * Version:     1.0.0
 * Author:      Tahsin Ahmed
 * Author URI:  https://tahsinahmed.com
 * Text Domain: tdg-lang
 */

if (!defined('ABSPATH')) {
	exit;
}
define('EIHE_VERSION', '1.0.0');
define('EIHE_MINIMUM_ELEMENTOR_VERSION', '2.6.0');
define('EIHE_PATH', plugin_dir_path(__FILE__));
define('EIHE_URL', plugin_dir_url(__FILE__));

require_once EIHE_PATH . 'includes/elementor-checker.php';

class Elementor_Image_hover_Scrolling
{
	private static $_instance = null;

	public static function get_instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct()
	{
		add_action('plugins_loaded', [$this, 'init']);
	}

	public function init()
	{

		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', 'eihe_addon_failed_load');
			return;
		}

		if (!version_compare(ELEMENTOR_VERSION, EIHE_MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'eihe_addon_failed_outofdate']);
			return;
		}

		add_action('elementor/frontend/after_enqueue_styles', [$this, 'includes']);
		add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
		add_action('upgrader_process_complete', [$this, 'wp_upe_upgrade_completed'], 10, 2);
		add_action('admin_enqueue_scripts', [$this, 'eihe_scripts']);
		add_action('elementor/editor/before_enqueue_scripts', function () {
			wp_register_style('eihe-editor-css', EIHE_URL . 'assets/admin.css');
			wp_enqueue_style('eihe-editor-css');
		});
		add_action('admin_init', [$this, 'display_notice']);
		load_plugin_textdomain('tdg-lang', false, dirname(plugin_basename(__FILE__)) . '/languages');
		add_filter('wpml_elementor_widgets_to_translate', [$this, 'wpml_widgets_to_translate_filter']);
	}

	public function wpml_widgets_to_translate_filter($widgets)
	{
		$widgets['image_scrolling_effect'] = [
			'conditions' => ['widgetType' => 'image_scrolling_effect'],
			'fields'     => [
				[
					'field'       => 'tdg_title',
					'type'        => __('Image Hover Scrolling Effect : Title', 'tdg-lang'),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'tdg_description',
					'type'        => __('Image Hover Scrolling Effect : Description', 'tdg-lang'),
					'editor_type' => 'LINE'
				],
			],
		];

		return $widgets;
	}

	public function eihe_scripts()
	{
		wp_enqueue_style('tdg-css', EIHE_URL . 'assets/admin.css', array(), EIHE_VERSION, 'all');
		wp_enqueue_script('tdg-common', EIHE_URL . 'assets/admin.js', array('jquery'), EIHE_VERSION, true);
	}
	public function display_notice()
	{

		if (isset($_GET['eihe_dismiss']) && $_GET['eihe_dismiss'] == 1) {
			add_option('eihe_dismiss', true);
		}

		$upgrade = get_option('eihe_upgraded');
		$dismiss = get_option('eihe_dismiss');

		if (!get_option('eihe-top-notice')) {
			add_option('eihe-top-notice', strtotime(current_time('mysql')));
		}
		if (get_option('eihe-top-notice') && get_option('eihe-top-notice') != 0) {
			if (get_option('eihe-top-notice') < strtotime('-3 days')) { //if greater than 3 days
				add_action('admin_notices', 			array($this, 'eihe_top_admin_notice'));
				add_action('wp_ajax_eihe_top_notice',	array($this, 'eihe_top_notice_dismiss'));
			}
		}
	}

	public function eihe_top_notice_dismiss()
	{
		update_option('eihe-top-notice', '0');
		exit();
	}

	public function eihe_top_admin_notice()
	{
?>
		<div class="eihe-notice notice notice-success is-dismissible">
			<img class="eihe-iconimg" src="<?php echo EIHE_URL; ?>assets/icon.png" style="float:left;" />
			<p style="width:80%;"><?php _e('Enjoying our <strong>Image Hover Scrolling effects - Elementor Addon?</strong>  If you feel this plugin helped you, You can give us a 5 star rating!<br>It will motivate us to serve you more !', 'eihe-lang'); ?> </p>
			<a href="https://wordpress.org/support/plugin/image-hover-scrolling-effect/reviews/#new-post" class="button button-primary" style="margin-right: 10px !important;" target="_blank"><?php _e('Rate the Plugin!', 'eihe-lang'); ?> &#11088;&#11088;&#11088;&#11088;&#11088;</a>
			<a href="https://tiny.cc/eihe-pro" class="button button-secondary" target="_blank"><?php _e('Go Pro', 'eihe-lang'); ?></a>
			<span class="eihe-done"><?php _e('Already Done', 'eihe-lang'); ?></span>
		</div>
<?php
	}

	public function wp_upe_upgrade_completed($upgrader_object, $options)
	{

		$our_plugin = plugin_basename(__FILE__);

		if ($options['action'] == 'update' && $options['type'] == 'plugin' && isset($options['plugins'])) {
			foreach ($options['plugins'] as $plugin) {
				if ($plugin == $our_plugin) {
					add_option('eihe_upgraded', true);
				}
			}
		}
	}

	public function register_widgets()
	{
		require_once(EIHE_PATH . 'includes/widgets.php');
	}

	public function includes()
	{
		wp_enqueue_style('eihe-front-style', EIHE_URL . 'assets/style.css', array(), EIHE_VERSION);
	}
}

Elementor_Image_hover_Scrolling::get_instance();


?>