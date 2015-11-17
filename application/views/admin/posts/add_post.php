<style>
    label{
        width: 200px;
    }
</style>


<div class="row">
    
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <h3 class="btn-primary">Add New Post</h3>
        <?php 
        foreach ($msg as $msg){
            echo '<li>'.$msg.'</li>';
        }
        ?>
        <form class="form-horizontal"  action="<?php echo site_url('admin/create_post'); ?>" method="post">
            <div class="form-group">
                <label class="in" for="Post Title">Post Title</label>
                <input type="text" name="post_title" value="<?php echo set_value('post_title') ?>" class="form-cantrol" id="name"/>
            </div>

            <div class="form-group">
                <label for="First Name">Post Body</label>
                <textarea class="ckeditor" name="post_body" ></textarea>
            </div>

            <div class="form-group">
                <label for="Categories">Categories</label>
                <select name="cat_id">
                    <?php  
                    foreach ($categories as $categorie){
                        if($categorie['gro_id'] == set_value('cat_id')){
                           ?>
                            <option selected value="<?php echo $categorie['cat_id'] ?>"><?php echo $categorie['cat_name_en'] ?></option>
                            <?php 
                        }else{
                           ?>
                            <option value="<?php echo $categorie['cat_id'] ?>"><?php echo $categorie['cat_name_en'] ?></option>
                            <?php 
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Create" class="btn-default" />
            </div>

        </form>
    </div>
</div>