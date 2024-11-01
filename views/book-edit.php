<?php
$editid = isset($_GET['editid']) ? intval($_GET['editid']) : 0;
global $wpdb;
$table_name = my_book_table();
$books_results = $wpdb->get_row(
    $wpdb->prepare("SELECT * FROM `$table_name` WHERE id = %d", $editid),
    ARRAY_A
);


?>
<div class="card container">
    <div class="alert alert-primary" role="alert">
        Book Edit
    </div>
    <form action="javascript:void(0)" method="post" id="edit-form" enctype="multipart/form-data">
        <input type="hidden" name="book_edit_id"
               value="<?php echo isset($_GET['editid']) ? intval($_GET['editid']) : 0 ?>">
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput" class="form-label">Name</label></div>
                <div class="col-10">
                    <input type="text" class="form-control" name="name" id="formGroupExampleInput"
                           value="<?php echo $books_results['name']; ?>"/>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput2" class="form-label">Author</label></div>
                <div class="col-10">
                    <input type="text" class="form-control" name="author" id="formGroupExampleInput2"
                           value="<?php echo $books_results['author']; ?>"/>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="exampleFormControlTextarea1" class="form-label">About</label>
                </div>
                <div class="col-10">
                    <textarea class="form-control" name="about" id="exampleFormControlTextarea1"
                              rows="3"><?php echo $books_results['about']; ?></textarea>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formFileSm" class="form-label">Upload Image</label></div>
                <div class="col-10">
                    <input class="form-control form-control-md" value="Upload Image" id="btnimage" type="button"/>
                    <span id="show_image">
                        <img src="<?php echo $books_results['book_image']; ?>" style="height: 80px;width: 80px; object-fit: cover;" alt="">
                    </span>
                    <input type="hidden" id="book_image" name="book_image" value="<?php echo $books_results['book_image']; ?>"/>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <button type="submit" class="btn btn-primary mb-3">Update</button>
            </div>
        </div>
    </form>
</div>
