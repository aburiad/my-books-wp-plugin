<?php

global $wpdb;
$table_name = my_book_table();
$books_results = $wpdb->get_results("SELECT * FROM `$table_name`", ARRAY_A);


?>
<div class="container">
    <div class="my-books-container">
        <table id="my-books-table" class="display" style="width:100%">
            <thead>
            <tr>
                <th>S.L</th>
                <th>Name</th>
                <th>Author</th>
                <th>About</th>
                <th>Image</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php

            if (count($books_results) > 0) {
                $i = 0;
                foreach ($books_results as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['author']; ?></td>
                        <td><?php echo $value['about']; ?></td>
                        <td>
                            <img src="<?php echo $value['book_image']; ?>" style="height: 80px; width: 80px; object-fit: cover;">
                        </td>
                        <td><?php echo $value['created_at']; ?></td>
                        <td>
                            <a href="admin.php?page=book-edit&editid=<?php echo $value['id'];?>" class="btn btn-info">Edit</a>
                            <a href="javascript:void(0)" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            }

            ?>

            </tbody>
            <tfoot>
            <tr>
                <th>S.L</th>
                <th>Name</th>
                <th>Author</th>
                <th>About</th>
                <th>Image</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
