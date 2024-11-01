<?php
/*
Plugin Name: My Book
Plugin URI: https://example.com
Description: A simple example of creating a custom Test One.
text-domain: mybook
Version: 1.0
Author: Abu Riad
Author URI: https://example.com
License: GPLv2 or later
*/

if (!defined("ABSPATH"))
    exit;

if (!defined('MY_BOOKS_DIR_PATH')) {
    define('MY_BOOKS_DIR_PATH', plugin_dir_path(__FILE__));
}
if (!defined('MY_BOOKS_URL')) {
    define('MY_BOOKS_URL', plugin_dir_url(__FILE__));
}

if (!defined('MY_BOOKS_VERSION')) {
    define('MY_BOOKS_VERSION', '1.0');
}

/*
 * Load my-books plugin
 * all js and css
 *
 * */
function my_books_include_assets()
{
    wp_enqueue_style('bootstrap', MY_BOOKS_URL . 'assets/css/bootstrap.min.css', '', MY_BOOKS_VERSION, 'all');
    wp_enqueue_style('datatables', MY_BOOKS_URL . 'assets/css/dataTables.dataTables.min.css', '', MY_BOOKS_VERSION, 'all');
    wp_enqueue_style('notifybar', MY_BOOKS_URL . 'assets/css/jquery.notifyBar.css', '', MY_BOOKS_VERSION, 'all');
    wp_enqueue_style('custom', MY_BOOKS_URL . 'assets/css/custom.css', '', MY_BOOKS_VERSION, 'all');

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', MY_BOOKS_URL . 'assets/js/bootstrap.bundle.min.js', '', MY_BOOKS_VERSION, true);
    wp_enqueue_script('validate', MY_BOOKS_URL . 'assets/js/jquery.validate.min.js', '', MY_BOOKS_VERSION, true);
    wp_enqueue_script('dataTables', MY_BOOKS_URL . 'assets/js/dataTables.min.js', '', MY_BOOKS_VERSION, true);
    wp_enqueue_script('notifyBar', MY_BOOKS_URL . 'assets/js/jquery.notifyBar.js', '', MY_BOOKS_VERSION, true);
    wp_enqueue_script('custom', MY_BOOKS_URL . 'assets/js/custom.js', '', MY_BOOKS_VERSION, true);

}

add_action('init', 'my_books_include_assets');