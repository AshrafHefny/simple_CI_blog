 <div class="container">
     <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h3 class="btn-link"><a href="<?php echo site_url('admin/add_post'); ?>">Add New Post</a></h3>
        </div>
    </div>
<?php 
foreach ($posts as $post){
    ?>
    
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <a href="post.html">
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
    