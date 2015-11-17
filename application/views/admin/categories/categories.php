<div class="row">
    <div class="col-lg-12 col-lg-offset-2 col-md-10 col-md-offset-1">
        <a href="<?php echo site_url('admin/add_category'); ?>" class="btn-link ">Add New Category</a>
        <h3>All Categories</h3>
        <table class="table-condensed">
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Date Created</th>
                <th>Manage</th>
            </tr>
        <?php
        foreach ($categories as $category){
            ?>

            <tr>
                <td><?php echo $category['cat_id']; ?></td>
                <td><?php echo $category['cat_name_en']; ?></td>
                <td><?php echo $category['cat_created']; ?></td>
                <td>
                    <a href="<?php echo site_url('admin/edit_category/'.$category['cat_id']); ?>" class="btn-link">Edit</a> - 
                    <a href="<?php echo site_url('admin/delete_category/'.$category['cat_id']); ?>" class="btn-link" onclick="return confirm('Are you sure !! ?')">Delete</a>
                </td>
            </tr>

            <?php
        }

        ?>
        </table>
        <ul class="pagination">
            <?php echo $pagination; ?>
        </ul>
    </div>
    
</div>