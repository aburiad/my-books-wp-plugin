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