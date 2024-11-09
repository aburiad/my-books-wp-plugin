<?php
global $wpdb;
$table_name = my_author_table();
$author_results = $wpdb->get_results(
    "SELECT * FROM `$table_name` ORDER BY id DESC",
    ARRAY_A
);


?>
<div class="card container">
    <div class="alert alert-primary" role="alert">
        Add New Book
    </div>
    <form action="" method="post" id="add-new-form" enctype="multipart/form-data">
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput" class="form-label">Name</label></div>
                <div class="col-10">
                    <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Name"
                           required/>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput2" class="form-label">Author</label></div>
                <div class="col-10">

                    <select name="author" id="author_list">
                        <?php
                        if ( !empty($author_results) ) {
                            foreach ($author_results as $values) {
                                ?>
                                <option value="<?php echo esc_attr($values['name']); ?>">
                                    <?php echo esc_html($values['name']); ?>
                                </option>
                                <?php
                            }
                        } else {
                            ?>
                            <option value="">No authors found</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="exampleFormControlTextarea1" class="form-label">About</label>
                </div>
                <div class="col-10">
                    <textarea class="form-control" name="about" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formFileSm" class="form-label">Upload Image</label></div>
                <div class="col-10">
                    <input class="form-control form-control-md" value="Upload Image" id="btnimage" type="button"/>
                    <span id="show_image"></span>
                    <input type="hidden" id="book_image" name="book_image"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </div>
        </div>
    </form>
</div>
