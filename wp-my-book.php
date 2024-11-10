<?php
/*
Plugin Name: My Book
Plugin URI: https://example.com
Description: A simple Plugin To Learn CRUD Operation using $wpdb
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
    $slug = '';
    $page_includes = array('frontendpage', 'my-book-list', 'add-new', 'author-add', 'author-remove', 'student-add', 'student-remove', 'course-track', 'book-edit', 'author-edit');
    $current_page = isset($_GET['page']) ? $_GET['page'] : '';

    if (empty($current_page)) {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (preg_match("/my_book/", $actual_link)) {
            $current_page = 'frontendpage';
        }
    }

    if (in_array($current_page, $page_includes)) {
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
    add_submenu_page('my-book-list', 'Add New Book', 'Add New Book', 'manage_options', 'add-new', 'my_book_addnew');
    add_submenu_page('my-book-list', 'Add New Author', 'Add New Author', 'manage_options', 'author-add', 'my_author_add');
    add_submenu_page('my-book-list', 'Manage Author', 'Manage Author', 'manage_options', 'author-remove', 'my_author_remove');
    add_submenu_page('my-book-list', 'Add New Student', 'Add New Student', 'manage_options', 'student-add', 'my_student_add');
    add_submenu_page('my-book-list', 'Manage Student', 'Manage Student', 'manage_options', 'student-remove', 'my_student_remove');
    add_submenu_page('my-book-list', 'Course Tracker', 'Course Tracker', 'manage_options', 'course-track', 'my_course_track');
    add_submenu_page('my-book-list', '', '', 'manage_options', 'book-edit', 'book_edit');
    add_submenu_page('my-book-list', 'Edit Author', '', 'manage_options', 'author-edit', 'author_edit');
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

function my_author_add()
{
    require_once MY_BOOKS_DIR_PATH . 'views/book-author.php';
}

function author_edit()
{
    require_once MY_BOOKS_DIR_PATH . 'views/book-author-edit.php';
}

function my_author_remove()
{
    require_once MY_BOOKS_DIR_PATH . 'views/book-author-remove.php';
}

function my_student_add()
{
    require_once MY_BOOKS_DIR_PATH . 'views/book-student-add.php';
}

function my_student_remove()
{
    require_once MY_BOOKS_DIR_PATH . 'views/book-student-remove.php';
}

function my_course_track()
{
    require_once MY_BOOKS_DIR_PATH . 'views/book-course-track.php';
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

function my_author_table()
{
    global $wpdb;
    return $wpdb->prefix . "my-author";
}

function my_students_table()
{
    global $wpdb;
    return $wpdb->prefix . "my-students";
}

function my_enroll_table()
{
    global $wpdb;
    return $wpdb->prefix . "my-enroll";
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

    $author_sql = "CREATE TABLE `" . my_author_table() . "` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) DEFAULT NULL,
      `fb_link` text DEFAULT NULL,
      `about` text DEFAULT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`)
    )";
    dbDelta($author_sql);

    $students_sql = "CREATE TABLE `" . my_students_table() . "` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) DEFAULT NULL,
      `email` text DEFAULT NULL,
      `user_loggin_id` int(11) DEFAULT NULL,
     `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`)
    ) ";
    dbDelta($students_sql);

    $enroll_sql = "CREATE TABLE `" . my_enroll_table() . "` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `student_id` int(11) NOT NULL,
      `book_id` int(11) NOT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`)
    )";
    dbDelta($enroll_sql);

    // user role regestration
    add_role('wp_book_user_key', 'My Book User', array(
        'read' => true,
    ));

    // Create post object
    $my_post = array(
        'post_title' => "Book Page",
        'post_content' => "[book_page]",
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'my_book'
    );

    // Insert the post into the database
    $book_page_id = wp_insert_post($my_post);
    add_option('my_book_page_id', $book_page_id);
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
    $wpdb->query("DROP TABLE IF EXISTS `" . my_author_table() . "`");
    $wpdb->query("DROP TABLE IF EXISTS `" . my_students_table() . "`");
    $wpdb->query("DROP TABLE IF EXISTS `" . my_enroll_table() . "`");

    // remove role
    if (get_role('wp_book_user_key')) {
        remove_role('wp_book_user_key');
    }

    if (!empty(get_option('my_book_page_id'))) {
        $pageId = get_option('my_book_page_id');
        wp_delete_post($pageId, true);
        delete_option('my_book_page_id');
    }
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

    } elseif (isset($_REQUEST['param']) && $_REQUEST['param'] === 'deleteBook') {
        $wpdb->delete(my_book_table(), array(
            "id" => $_REQUEST['id']
        ));
        echo json_encode(array('status' => 1, 'message' => 'book data Deleted successfully'));
    } else if (isset($_REQUEST['param']) && $_REQUEST['param'] === 'saveauthor') {
        $data = array(
            'name' => $_REQUEST['name'],
            'fb_link' => $_REQUEST['fb_link'],
            'about' => $_REQUEST['about'],
        );
        $wpdb->insert(my_author_table(), $data);
        echo json_encode(array('status' => 1, 'message' => 'Author data insert successfully'));
    } else if (isset($_REQUEST['param']) && $_REQUEST['param'] === 'editauthor') {
        $data = array(
            'name' => $_REQUEST['name'],
            'fb_link' => $_REQUEST['fb_link'],
            'about' => $_REQUEST['about'],
        );
        $wpdb->update(my_author_table(), $data, array('id' => $_REQUEST['author_edit_id']));
        echo json_encode(array('status' => 1, 'message' => 'Author data updated successfully'));
    } else if (isset($_REQUEST['param']) && $_REQUEST['param'] === 'savestudent') {
        $student_id = $user_id = wp_create_user($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['email']);
        $user = new WP_User($student_id);
        $user->set_role("wp_book_user_key");
        $data = array(
            'name' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'user_loggin_id' => $user_id,
        );
        $wpdb->insert(my_students_table(), $data);
        echo json_encode(array('status' => 1, 'message' => 'Student data insert successfully'));
    }
    wp_die();
}

function book_page_function()
{
    require_once MY_BOOKS_DIR_PATH . 'views/frontend-booklist.php';
}

add_shortcode('book_page', 'book_page_function');

function custom_page_template($page_template)
{
    global $post;
    $page_slug = $post->post_name;
    if ("my_book" == $page_slug) {
        $page_template = MY_BOOKS_DIR_PATH . 'views/frontendbook.php';
    }
    return $page_template;
}

add_filter('page_template', 'custom_page_template');


