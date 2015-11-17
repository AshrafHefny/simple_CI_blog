<style>
    label{
        width: 200px;
    }
</style>

<?php  
$category = $category[0];
?>
<div class="row">
    
    <div class="col-lg-12 col-lg-offset-2 col-md-10 col-md-offset-1">
        <h3 class="btn-primary">Update Category</h3>
        <?php 
        foreach ($msg as $msg){
            echo '<li>'.$msg.'</li>';
        }
        ?>
        <form class="form-horizontal" role="form" action="<?php echo site_url('admin/update_category/'.$category['cat_id']); ?>" method="post">
            <div class="form-group">
                <label class="in" for="Category Name">Category Name</label>
                <input type="text" name="cat_name" value="<?php echo $category['cat_name_en'] ?>" class="form-cantrol" id="name"/>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Update" class="btn-default" />
            </div>

        </form>
    </div>
</div>