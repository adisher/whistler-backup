<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo e(Hyvikk::get('app_name')); ?></title>
  <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/dist/adminlte.min.css')); ?>">
  <!-- iCheck -->
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>" />

  <?php echo $__env->yieldContent("extra_css"); ?>
  <style>
    i.fa {
      padding: 0 !important;
      margin: 0 !important;
    }

    .input-group-text {
      width: 41px !important;
      padding: 0 !important;
      margin: 0 !important;
      text-align: center;
      display: flex;
      align-items: center;
      vertical-align: middle;
      width: 100%;
      justify-content: center;
    }
  </style>
  <script>
    window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
    ]); ?>;
  </script>
</head>

<body class="hold-transition login-page">
  <!-- fleet manager version 4.0.2 -->
  <div class="login-box">
    <div class="login-logo">
      <center> <img src="<?php echo e(asset('assets/images/logo-whistler.png')); ?>" height="100px" width="120px" />
      </center>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"><?php echo app('translator')->get('passwords.login_desc'); ?></p>
        
        <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>">
          <?php echo e(csrf_field()); ?>

          <div class="form-group has-feedback">
            <div class="input-group ">
              <input type="email" class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                placeholder="<?php echo app('translator')->get('passwords.email'); ?>" name="email" value="<?php echo e(old('email')); ?>" id="email" autofocus
                required>
              <div class="input-group-append">
                <span class="input-group-text"><i class="fa fa-envelope"></i></span> 

              </div>

              <?php if($errors->has('email')): ?>
              <span class="invalid-feedback">
                <strong class="text-danger"><?php echo e($errors->first('email')); ?></strong>
              </span>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group has-feedback">
            <div class="input-group">
              <input type="password" class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                placeholder="<?php echo app('translator')->get('passwords.password'); ?>" id="password" name="password" required>
              <div class="input-group-append">
                <span class="fa fa-lock  input-group-text"></span> 

              </div>
              <?php if($errors->has('password')): ?>
              <span class="invalid-feedback">
                <strong class="text-danger"><?php echo e($errors->first('password')); ?></strong>
              </span>
              <?php endif; ?>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> id="remember">
                <label for="remember"> <?php echo app('translator')->get('passwords.remember'); ?></label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block"><?php echo app('translator')->get('passwords.sign_in'); ?>
                
              </button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- /.social-auth-links -->
        <p class="mb-1">
          <a href="<?php echo e(route('password.request')); ?>"><?php echo app('translator')->get('passwords.forgot_password'); ?>
            
          </a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
  <!-- iCheck -->
  <script>
    $(function () {
    // $('input').iCheck({
    //   checkboxClass: 'icheckbox_square-blue',
    //   radioClass   : 'iradio_square-blue',
    //   increaseArea : '20%' // optional
    // })
  })
  </script>
</body>

</html><?php /**PATH /var/www/html/whistler/framework/resources/views/auth/login.blade.php ENDPATH**/ ?>