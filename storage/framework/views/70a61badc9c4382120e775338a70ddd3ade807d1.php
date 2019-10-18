<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>CPHL/UNHLS | Log in</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Bootstrap 3.3.7 -->
<link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
<!-- Font Awesome -->
<link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
<!-- Ionicons -->
<link href="<?php echo e(asset('css/ionicons.min.css')); ?>" rel="stylesheet">
<!-- Theme style -->
<link href="<?php echo e(asset('css/AdminLTE.min.css')); ?>" rel="stylesheet">
<!-- iCheck -->
<link href="<?php echo e(asset('css/login/blue.css')); ?>" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo" style="margin-bottom:7px;"><img src="<?php echo e(asset('img/coat_of_arms.png')); ?>" class="img-responsive" width="150" height="150" style="display: block;  margin-left: auto;  margin-right: auto;"> </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form class="form-horizontal" method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
    
  </div>
  <!-- /.login-box-body --> 
</div>
<!-- /.login-box --> 

<!-- jQuery 3 --> 
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script> 
<!-- Bootstrap 3.3.7 --> 
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script> 
<!-- iCheck --> 
<script src="<?php echo e(asset('js/login/icheck.min.js')); ?>"></script> 
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
