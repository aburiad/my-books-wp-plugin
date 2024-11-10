<?php
/*
template name: Book FrontEnd Template
*/

get_header();

?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="book-item alert alert-danger">
                    <?php
                    do_shortcode("[book_page]");
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();