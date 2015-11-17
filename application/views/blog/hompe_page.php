
<div class="container">
     <div class="row">
        <div class="col-lg-12 col-lg-offset-2 col-md-10 col-md-offset-1">
            Sort By Date: 
            <select id="sortPostsByDate">
                <option value="">Date</option>
                <option <?php if($_GET['sortPostsByDate'] == 'Asc'){echo 'selected';} ?>  value="Asc">Date Ascending</option>
                <option <?php if($_GET['sortPostsByDate'] == 'Desc'){echo 'selected';} ?>  value="Desc">Date Descending</option>
            </select>
            
            Filter By Author: 
            <select id="sortPostsByAuthor">
                <option value="">Authors</option>
                <?php foreach ($users as $users){ ?>
                <option <?php if($_GET['sortPostsByAuthor'] == $users['usr_id']){echo 'selected';} ?> value="<?php echo $users['usr_id'] ?>"><?php echo $users['usr_fname'] ?></option>
                <?php } ?>
            </select>
            
            Filter By Date: 
            <select id="sortPostsByCategory">
                <option value="">Categories</option>
                <?php foreach ($categories as $categories){ ?>
                <option <?php if($_GET['sortPostsByCategory'] == $categories['cat_id']){echo 'selected';} ?>  value="<?php echo $categories['cat_id'] ?>"><?php echo $categories['cat_name_en'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
<?php 
foreach ($posts as $post){
    ?>
    
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <a href="<?php echo site_url('blog/post/'.$post['post_id']) ?>">
                        <h2 class="post-title">
                            <?php echo $post['post_title']; ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?php echo substr($post['post_body'], 0,150); ?>
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <?php echo $post['usr_fname']; ?> on <?php echo $post['post_created_date'] ?></p>
                    
                </div>
                <hr>
                <p style="text-align: right">
                        <a href="<?php echo site_url('admin/edit_post/'.$post['post_id']); ?>" class="btn-link">Edit</a> - 
                        <a href="<?php echo site_url('admin/delete_post/'.$post['post_id']); ?>" class="btn-link" onclick="return confirm('Are you sure !! ?')">Delete</a>
                
                    </p>
                
            </div>
        </div>
    

    <hr>
    <?php
}
?>
    <ul class="pagination"><?php echo $pagination; ?></ul>
</div>
    