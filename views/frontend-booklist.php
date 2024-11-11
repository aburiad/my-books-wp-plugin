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
        <a class="btn btn-success" href="<?php if($user_ID > 0){echo "javascript:void"; }else{echo wp_login_url();}?>" type="button">
            <?php
            if ($user_ID > 0) {
                ?>
                Enroll
                <?php
            } else {
                ?>
                Login to Enroll
                <?php
            }
            ?>

        </a>
    </div>
    <?php
}

?>

