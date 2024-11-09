<?php

$editid = isset($_GET['editid']) ? intval($_GET['editid']) : 0;
global $wpdb;
$table_name = my_author_table();
$books_results = $wpdb->get_row(
    $wpdb->prepare("SELECT * FROM `$table_name` WHERE id = %d", $editid),
    ARRAY_A
);

?>
<div class="card container">
    <div class="alert alert-primary" role="alert">
        Edit Author
    </div>
    <form action="" method="post" id="edit-author-form" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $editid; ?>" class="form-control" name="author_edit_id"/>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput" class="form-label">Name</label></div>
                <div class="col-10">
                    <input type="text" value="<?php echo $books_results['name'] ?>" class="form-control" name="name"
                           id="formGroupExampleInput" placeholder="Name"
                    />
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput2" class="form-label">Fb Link</label></div>
                <div class="col-10">
                    <input type="url" value="<?php echo $books_results['fb_link'] ?>" class="form-control" name="fb_link" id="formGroupExampleInput2"
                           placeholder="Example Author"/>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="exampleFormControlTextarea1" class="form-label">About</label>
                </div>
                <div class="col-10">
                    <textarea class="form-control"  name="about" id="exampleFormControlTextarea1" rows="3"><?php echo $books_results['about'] ?></textarea>
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
