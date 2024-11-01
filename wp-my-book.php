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

/**
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
    wp_enqueue_media();
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', MY_BOOKS_URL . 'assets/js/bootstrap.bundle.min.js', '', MY_BOOKS_VERSION, true);
    wp_enqueue_script('validate', MY_BOOKS_URL . 'assets/js/jquery.validate.min.js', '', MY_BOOKS_VERSION, true);
    wp_enqueue_script('dataTables', MY_BOOKS_URL . 'assets/js/dataTables.min.js', '', MY_BOOKS_VERSION, true);
    wp_enqueue_script('notifyBar', MY_BOOKS_URL . 'assets/js/jquery.notifyBar.js', '', MY_BOOKS_VERSION, true);
    wp_enqueue_script('custom', MY_BOOKS_URL . 'assets/js/custom.js', '', MY_BOOKS_VERSION, true);

    $data = array('ajax_url' => admin_url('admin-ajax.php'));
    wp_localize_script('custom', 'data', $data);

}

add_action('init', 'my_books_include_assets');

/**
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
    add_submenu_page('my-book-list', '', '', 'manage_options', 'book-edit', 'book_edit');
}

add_action('admin_menu', 'my_book_admin_menu');

/**
 * Loads the Book List page.
 *
 * Includes the 'book-list.php' file from the views directory
 * to display the list of books.
 */

function my_book_list()
{
    require_once MY_BOOKS_DIR_PATH . 'views/book-list.php';
}

/**
 * Loads the Add New Book page.
 *
 * Includes the 'add-new.php' file from the views directory
 * to provide a form for adding new books.
 */

function my_book_addnew()
{
    require_once MY_BOOKS_DIR_PATH . 'views/add-new.php';
}

/**
 * Loads the Book Edit page.
 *
 * Includes the 'book-edit.php' file from the views directory
 * to provide a form for editing book details.
 */

function book_edit()
{
    require_once MY_BOOKS_DIR_PATH . 'views/book-edit.php';
}

/**
 * Returns the name of the My Books database table.
 *
 * Uses the global $wpdb object to access the database prefix,
 * ensuring compatibility with custom table prefixes.
 */

function my_book_table()
{
    global $wpdb;
    return $wpdb->prefix . "my-books";
}

/**
 * Generates the My Books database table.
 *
 * Creates a table with the following structure:
 * - id: Primary key, auto-incrementing integer.
 * - name: Book name, varchar(255), allows NULL.
 * - author: Author name, varchar(255), allows NULL.
 * - about: Book description, text, allows NULL.
 * - book_image: Image URL or path, text, allows NULL.
 * - created_at: Timestamp of record creation, defaults to current timestamp.
 *
 * Utilizes dbDelta for safe table creation and updates.
 */

function my_book_generate_table()
{
    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql = "CREATE TABLE `" . my_book_table() . "` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) DEFAULT NULL,
      `author` varchar(255) DEFAULT NULL,
      `about` text DEFAULT NULL,
      `book_image` text DEFAULT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`)
    )";
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'my_book_generate_table');

/**
 * Drops the My Books database table if it exists.
 *
 * Uses the global $wpdb object to execute the SQL query
 * that removes the table specified by my_book_table().
 *
 * This function is typically called during plugin deactivation
 * to clean up the database.
 */

function my_book_drop_table()
{
    global $wpdb;
    $table_name = my_book_table();
    $wpdb->query("DROP TABLE IF EXISTS `$table_name`");
}

register_deactivation_hook(__FILE__, 'my_book_drop_table');
register_uninstall_hook(__FILE__, 'my_book_drop_table');

/**
 * Handle AJAX request to save book data
 *
 * This function processes data submitted from the
 * frontend form and saves it to the database.
 */
add_action('wp_ajax_my_book_action', 'my_book_save_data');
add_action('wp_ajax_nopriv_my_book_action', 'my_book_save_data');

function my_book_save_data()
{
    global $wpdb;
    if (isset($_REQUEST['param']) && $_REQUEST['param'] === 'savedata') {
        $data = array(
            'name' => $_REQUEST['name'],
            'author' => $_REQUEST['author'],
            'about' => $_REQUEST['about'],
            'book_image' => $_REQUEST['book_image']
        );
        $wpdb->insert(my_book_table(), $data);
        echo json_encode(array('status' => 1, 'message' => 'book data insert successfully'));

    } elseif (isset($_REQUEST['param']) && $_REQUEST['param'] === 'editdata') {
        $data = array(
            'name' => $_REQUEST['name'],
            'author' => $_REQUEST['author'],
            'about' => $_REQUEST['about'],
            'book_image' => $_REQUEST['book_image']
        );
        $wpdb->update(my_book_table(), $data, array('id' => $_REQUEST['book_edit_id']));
        echo json_encode(array('status' => 1, 'message' => 'book data updated successfully'));
    }
    wp_die();
}