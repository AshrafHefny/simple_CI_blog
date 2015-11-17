<style>
    label{
        width: 200px;
    }
</style>


<div class="row">
    
    <div class="col-lg-12 col-lg-offset-2 col-md-10 col-md-offset-1">
        <h3 class="btn-primary">Add New User</h3>
        <?php 
        foreach ($msg as $msg){
            echo '<li>'.$msg.'</li>';
        }
        ?>
        <form class="form-horizontal" role="form" action="<?php echo site_url('admin/create_user'); ?>" method="post">
            <div class="form-group">
                <label class="in" for="User Name">User Name</label>
                <input type="text" name="usr_name" value="<?php echo set_value('usr_name') ?>" class="form-cantrol" id="name"/>
            </div>

            <div class="form-group">
                <label for="First Name">First Name</label>
                <input type="text" name="fname" value="<?php echo set_value('usr_fname') ?>" class="form-cantrol" id="name"/>
            </div>

            <div class="form-group">
                <label for="Last Name">Last Name</label>
                <input type="text" name="lname" value="<?php echo set_value('usr_lname') ?>" class="form-cantrol" id="name"/>
            </div>

            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" name="password" class="form-cantrol" id="password"/>
            </div>

            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" name="email" value="<?php echo set_value('usr_email') ?>" class="form-cantrol" id="email"/>
            </div>

            <div class="form-group">
                <label for="Rule">Rule</label>
                <select name="gro_id">
                    <?php  
                    foreach ($rules as $rule){
                        if($rule['gro_id'] == set_value('gro_id')){
                           ?>
                            <option selected value="<?php echo $rule['gro_id'] ?>"><?php echo $rule['gro_name_en'] ?></option>
                            <?php 
                        }else{
                           ?>
                            <option value="<?php echo $rule['gro_id'] ?>"><?php echo $rule['gro_name_en'] ?></option>
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