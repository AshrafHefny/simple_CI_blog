<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

     <?php echo $this->head; ?>
    <?php echo $this->css; ?>

    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url(); ?>">Simple Blog </a>
            </div>

            
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <form action="<?php echo site_url('log/check_login'); ?>" method="post">

                <div class="row">
                    <h3>Login Panel</h3>
                </div>

                <div class="row">
                    <?php foreach($mes as $mes){
                        ?><p class="help-block text-danger"><?php echo $mes; ?></p> <?php
                    } ?>
                </div>
                <!-- <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group "> -->
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" placeholder="User Name"required data-validation-required-message="Please enter your name.">
                        <p class="help-block text-danger"></p>
                   <!--  </div>
                </div> -->

                <!-- <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group "> -->
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" id="name" required data-validation-required-message="Please enter your password.">
                        <p class="help-block text-danger"></p>
                    <!-- </div>
                </div> -->
                <div class="row">
                    <div class="form-group col-xs-12">
                    <input type="submit" value="Login" >
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; Simple Blog 2015</p>
                </div>
            </div>
        </div>
    </footer>


</body>

</html>
