<?php

global $wpdb;
global $user_ID;

$table_name = my_book_table();
$enroll_table_name = $wpdb->prefix . 'my-enroll';

$books_results = $wpdb->get_results("SELECT * FROM `$table_name`", ARRAY_A);

foreach ($books_results as $value) {
    ?>
    <div class="col-lg-4 book-card">
        <img src="<?php echo esc_url($value['book_image']); ?>" alt="no image found" style="width: 100%">
        <h3><?php echo esc_html($value['author']); ?></h3>
        <p><?php echo esc_html($value['name']); ?></p>

        <!-- Enroll or Already Enrolled Button -->
        <?php
        if ($user_ID > 0) {
            $is_enrolled = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM `$enroll_table_name` WHERE student_id = %d AND book_id = %d",
                $user_ID,
                $value['id']
            ));

            if ($is_enrolled) {
                echo '<span class="btn btn-secondary">Already Enrolled</span>';

                // Show Read More button for enrolled users
                ?>
                <button class="btn btn-info read-more-btn" data-book-id="<?php echo esc_attr($value['id']); ?>">Read More</button>

                <!-- Modal Structure -->
                <div id="modal-<?php echo esc_attr($value['id']); ?>" class="modal">
                    <div class="modal-content">
                        <span class="close" data-book-id="<?php echo esc_attr($value['id']); ?>">&times;</span>
                        <h4><?php echo esc_html($value['name']); ?></h4>
                        <p><strong>Author:</strong> <?php echo esc_html($value['author']); ?></p>
                        <p><?php echo esc_html($value['about']); ?></p>
                        <img src="<?php echo esc_url($value['book_image']); ?>" alt="Book Image" style="width: 100%">
                    </div>
                </div>
                <?php
            } else {
                ?>
                <a class="btn btn-success enroll-button" data-book-id="<?php echo esc_attr($value['id']); ?>"
                   href="javascript:void(0);">Enroll</a>
                <?php
            }
        } else {
            ?>
            <a class="btn btn-success" href="<?php echo esc_url(wp_login_url()); ?>">Login to Enroll</a>
            <?php
        }
        ?>
    </div>
    <?php
}
?>


<script>
document.addEventListener('DOMContentLoaded', function () {
    // Get all "Read More" buttons
    var readMoreButtons = document.querySelectorAll('.read-more-btn');
    var closeButtons = document.querySelectorAll('.close');

    // Open modal on "Read More" button click
    readMoreButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var bookId = button.getAttribute('data-book-id');
            var modal = document.getElementById('modal-' + bookId);
            modal.style.display = 'block';
        });
    });

    // Close modal when the close button is clicked
    closeButtons.forEach(function (close) {
        close.addEventListener('click', function () {
            var bookId = close.getAttribute('data-book-id');
            var modal = document.getElementById('modal-' + bookId);
            modal.style.display = 'none';
        });
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function (event) {
        closeButtons.forEach(function (close) {
            var bookId = close.getAttribute('data-book-id');
            var modal = document.getElementById('modal-' + bookId);
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
});
</script>

