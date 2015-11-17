<div class="row">
    <div class="col-lg-12 col-lg-offset-2 col-md-10 col-md-offset-1">
        <a href="<?php echo site_url('admin/add_user'); ?>" class="btn-link ">Add New User</a>
        <h3>All Users</h3>
        <table class="table-condensed">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Rule</th>
                <th>Date Created</th>
                <th>Manage</th>
            </tr>
        <?php
        //var_dump($users);
        foreach ($users as $users){
            ?>

            <tr>
                <td><?php echo $users['usr_id']; ?></td>
                <td><?php echo $users['usr_fname']; ?></td>
                <td><?php echo $users['usr_lname']; ?></td>
                <td><?php echo $users['usr_email']; ?></td>
                <td><?php echo $users['gro_name_en']; ?></td>
                <td><?php echo $users['usr_created']; ?></td>
                <td>
                    <a href="<?php echo site_url('admin/edit_user/'.$users['usr_id']); ?>" class="btn-link">Edit</a> - 
                    <a href="<?php echo site_url('admin/delete_user/'.$users['usr_id']); ?>" class="btn-link" onclick="return confirm('Are you sure !! ?')">Delete</a>
                </td>
            </tr>

            <?php
        }

        ?>
        </table>
    </div>
    <ul><?php echo $pagination; ?></ul>
</div>