<?php

if (!defined('ABSPATH')) {
	exit;
}

function eihe_addon_failed_load()
{

	$screen = get_current_screen();

	if (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) {
		return;
	}

	$plugin = 'elementor/elementor.php';

	if (eihe_is_elementor_installed()) {

		if (!current_user_can('activate_plugins')) {
			return;
		}

		$activation_url = wp_nonce_url('plugins.php?action=activate&plugin=' . $plugin . '&plugin_status=all&paged=1&s', 'activate-plugin_' . $plugin);

		$message = '<p><b>Image Hover ScrollUp Effects</b> requires Elementor to be activated.</p>';
		$message .= '<p><a href="' . $activation_url . '" class="button-primary">Activate Elementor</a></p>';
	} else {

		if (!current_user_can('install_plugins')) {
			return;
		}

		$install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');

		$message = '<p><b>Image Hover ScrollUp Effects</b> requires Elementor to be installed and activated.</p>';
		$message .= '<p><a href="' . $install_url . '" class="button-primary">Install Elementor</a></p>';
	}

	echo '<div class="notice notice-error"><p>' . $message . '</p></div>';
}

function eihe_addon_failed_outofdate()
{

	if (!current_user_can('update_plugins')) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url(self_admin_url('update.php?action=upgrade-plugin&plugin=') . $file_path, 'upgrade-plugin_' . $file_path);

	$message = '<p><b>Image Hover ScrollUp Effects</b> does not work since you are using an older version of Elementor</p>';
	$message .= '<p><a href="' . $upgrade_link . '" class="button-primary">Update Elementor</a></p>';

	echo '<div class="notice notice-error">' . $message . '</div>';
}

function eihe_is_elementor_installed()
{
	$file_path = 'elementor/elementor.php';
	$installed_plugins = get_plugins();

	return isset($installed_plugins[$file_path]);
}

