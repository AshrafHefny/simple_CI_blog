<style>
    label{
        width: 200px;
    }
</style>


<div class="row">
    
    <div class="col-lg-12 col-lg-offset-2 col-md-10 col-md-offset-1">
        <h3 class="btn-primary">Add New Category</h3>
        <?php 
        foreach ($msg as $msg){
            echo '<li>'.$msg.'</li>';
        }
        ?>
        <form class="form-horizontal" role="form" action="<?php echo site_url('admin/create_category'); ?>" method="post">
            <div class="form-group">
                <label class="in" for="Category Name">Category Name</label>
                <input type="text" name="cat_name" value="<?php echo set_value('cat_name') ?>" class="form-cantrol" id="name"/>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Create" class="btn-default" />
            </div>

        </form>
    </div>
</div>