<?php
/*
  Plugin Name: My Plugin
  Description: テストプラグイン
  Version: 1.0.0
  Author: sa8a
*/
if (!defined('ABSPATH')) exit;

// 必要な定数を定義
if (!defined('MY_PLUGIN_VERSION')) {
	define('MY_PLUGIN_VERSION', '1.0.0');
}
if (!defined('MY_PLUGIN_PATH')) {
	define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));
}
if (!defined('MY_PLUGIN_URL')) {
	define('MY_PLUGIN_URL', plugins_url('/', __FILE__));
}

// assetsの読み込み
add_action( 'wp_enqueue_scripts', function() {
	// JS
	wp_enqueue_script(
		'my-script',
		MY_PLUGIN_URL . 'assets/script.js',
		array(),
		MY_PLUGIN_VERSION,
		true,
	);

	// CSS
	wp_enqueue_style(
		'my-style',
		MY_PLUGIN_URL . 'assets/style.css',
		array(),
		MY_PLUGIN_VERSION,
	);
});

// ダッシュボードにボックスを追加
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

// ボックスのタイトル
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'バージョン情報', 'dashboard_text');
}

// ボックスの内容（各バージョンを表示）
function dashboard_text() {
  $wp_version = get_bloginfo('version');
  echo '<p>WordPress: ' . $wp_version . '</p>';

  $php_version = phpversion();
	echo '<p>PHP: ' . $php_version . '</p>';

  global $wpdb;
  $mysql_version = $wpdb->db_version();
  echo '<p>MySQL: ' . $mysql_version . '</p>';
}