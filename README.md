# WordPress のプラグイン開発方法

WP プラグイン開発における導入をまとめる。

とりあえずプラグインとして管理画面のダッシュボードに WP, MySQL, PHP のバージョンを表示するプラグイン。

## 1. プラグイン用のフォルダを作る

今回はリポジトリの通り `wp-plugin-sample` を命名。

## 2. php ファイルを 1 つ作成

`my-plugin.php` を作成。（名前はなんでも OK）

基本的には、分かりやすくフォルダ名に合わせて、ファイル名も同じ名前になっているプラグインが多い。

## 3. プラグインの情報をコメントで書き込む

メインとなる php ファイルにコメントでプラグイン名やバージョン番号などを情報として書き込む。

それだけでプラグインとして認識してくれるようになる。

```php
<?php
/*
  Plugin Name: My Plugin
  Description: テストプラグイン
  Version: 1.0
*/
if (!defined('ABSPATH')) exit; // phpファイルのURLに直接アクセスされても中身見られないようにする
```

## 4. css や js を読み込む

`assets` フォルダを作成して、`script.js`, `style.css` を作成する。

`my-plugin.php` で読み込む。

```php
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
```

## 5. プラグインを読み込む

以下のどちらかでプラグインを読み込む。

- `/wp-content/plugins` に入れる
- zip 化して普通に管理画面でアップロード
