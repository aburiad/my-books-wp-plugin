<?php

global $wpdb;
global $user_ID;
$table_name = my_book_table();
$books_results = $wpdb->get_results("SELECT * FROM `$table_name`", ARRAY_A);


foreach ($books_results as $key => $value) {
    ?>
    <div class="col-lg-4">
        <img src="<?php echo $value['book_image'] ?>" alt="no image found" style="width: 100%">
        <h3><?php echo $value['author']; ?></h3>
        <p><?php echo $value['name']; ?></p>
        <?php
        if ($user_ID > 0) {
            ?>
            <a class="btn btn-success enroll-button" href="<?php echo "javascript:void"; ?>">Enroll</a>
            <?php
        } else {
            ?>
            <a class="btn btn-success" href="<?php echo wp_login_url(); ?>">Login to Enroll</a>
            <?php
        }
        ?>
    </div>
    <?php
}

?>

