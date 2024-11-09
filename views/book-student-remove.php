<?php

global $wpdb;

$books_results = $wpdb->get_results("SELECT * FROM `" . my_students_table() . "`", ARRAY_A);


?>
<div class="container">
    <div class="my-books-container">
        <table id="my-books-table" class="display" style="width:100%">
            <thead>
            <tr>
                <th>S.L</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Name</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php

            if (count($books_results) > 0) {
                $i = 0;
                foreach ($books_results as $key => $value) {
                    $userdetails = get_userdata($value['user_loggin_id']);
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['email']; ?></td>
                        <td><?php echo $userdetails->user_login; ?></td>
                        <td><?php echo $value['created_at']; ?></td>
                        <td>
                            <a href="admin.php?page=author-edit&editid=<?php echo $value['id']; ?>"
                               class="btn btn-info">Edit</a>
                            <a href="javascript:void(0)" class="btn btn-danger deleteBtn"
                               data-id="<?php echo $value['id']; ?>">Delete</a>
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
                <th>Email</th>
                <th>User Name</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
