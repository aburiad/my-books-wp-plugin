<?php
/*
template name: Book FrontEnd Template
*/

get_header();

?>

    <div class="container">
        <div class="row">
            <?php
            do_shortcode("[book_page]");
            ?>
        </div>
    </div>

<?php
get_footer();