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
 * Enqueue all CSS and JavaScript files required for the My Books plugin.
 *
 * This function loads all the necessary frontend assets for the plugin, including
 * third-party libraries (Bootstrap, DataTables, NotifyBar) and custom styles and scripts.
 *
 */
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

/*
 * Registers the My Books admin menu and submenus:
 * - Main menu: "My Books" with a book icon.
 * - Submenus: "Book List" and "Add New" pages.
 * - Access limited to users with 'manage_options' capability.
 */

function my_book_admin_menu()
{
    add_menu_page('My Books', 'My Books', 'manage_options', 'my-book-list', 'my_book_list', 'dashicons-book', 30);
    add_submenu_page('my-book-list', 'Book List', 'Book List', 'manage_options', 'my-book-list', 'my_book_list');
    add_submenu_page('my-book-list', 'Add New', 'Add New', 'manage_options', 'add-new', 'my_book_addnew');
}

add_action('admin_menu', 'my_book_admin_menu');

/*
 * Loads the Book List page.
 *
 * Includes the 'book-list.php' file from the views directory
 * to display the list of books.
 */

function my_book_list()
{
    require_once MY_BOOKS_DIR_PATH . 'views/book-list.php';
}

/*
 * Loads the Add New Book page.
 *
 * Includes the 'add-new.php' file from the views directory
 * to provide a form for adding new books.
 */

function my_book_addnew()
{
    require_once MY_BOOKS_DIR_PATH . 'views/add-new.php';
}