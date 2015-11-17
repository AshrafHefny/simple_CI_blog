<?php $post = $post[0]; ?>
    <!-- Post Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <h2>
                      <?php echo $post['post_title'] ?>  
                    </h2>
                    <p>
                        <p class="post-meta">Posted by <?php echo $post['usr_fname']; ?> on <?php echo $post['post_created_date'] ?></p>
                    
                    </p>
                    <p>
                      <?php echo $post['post_body'] ?>    
                    </p>
                </div>
            </div>
        </div>

    <hr>