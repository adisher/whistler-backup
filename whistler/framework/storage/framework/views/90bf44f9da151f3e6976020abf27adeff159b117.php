<!DOCTYPE html>
<?php ($language = Hyvikk::frontend("language")); ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="manifest" href="<?php echo e(asset('manifest.json?v2')); ?>">
    
    <!-- Bootstrap & Other library css -->
    <title><?php echo e(Hyvikk::get('app_name')); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/libraries/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/libraries/fontawesome/css/all.min.css')); ?>">
    <!-- slick -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/libraries/slider/slick/slick.css')); ?>">
    <!-- Dropdown -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/libraries/dropdown/css/nice-select.css')); ?>">
    
    
    <!-- Date time picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Checkboxes and radios -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/select2/select2.min.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
  </head>

  <!-- BODY START -->

  <body <?php if($language == "Arabic-ar"): ?> dir="rtl" <?php endif; ?>>
    <!-- Wrapper -->
      <?php echo $__env->make('frontend.includes.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- ALL SECTIONS -->
      <section id="content">
        <?php echo $__env->yieldContent('content'); ?>
        
        
        <!---------------------- Modal --------------------------->
        <div class="login-modal-wrapper animated fadeInUp faster" id="login-modal">
            <div class="login-modal" role="document">
                <div class="modal-content">
                    <div class="modal-body px-0">
                        <div class="container-fluid h-100">
                            <div class="row h-100  back-primary">
                                <div class="col-sm-5 d-flex flex-column justify-content-center align-items-center animated fadeInUp delay-05s">
                                    <img src="<?php echo e(asset('assets/frontend/images/fleet-login.png')); ?>" alt="">
                                </div>
                                <div class="col-sm-7 d-flex flex-column justify-content-center align-items-center animated fadeInUp delay-05s">
                                    <h2 class="modal-title pl-3 text-left w-100 mb-3">
                                        <?php echo app('translator')->get('frontend.register'); ?>
                                        <div class="modal-close" data-close="login-modal">
                                            <img src="<?php echo e(asset('assets/frontend/icons/fleet-close-white.png')); ?>">
                                        </div>
                                    </h2>
                                    <?php if(count($errors->register) > 0): ?>
                                        <div class="alert alert-danger xs-mt mb-4">
                                        <ul>
                                        <?php $__currentLoopData = $errors->register->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        </div>
                                    <?php endif; ?>
                                    <form action="<?php echo e(url('user-register')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>

                                        <div class="row w-100 m-0 p-0">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="label-animate"><?php echo app('translator')->get('frontend.first_name'); ?></label>
                                                    <input type="text" class="text-input" name="first_name" value="<?php echo e(old('first_name')); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="label-animate"><?php echo app('translator')->get('frontend.last_name'); ?></label>
                                                    <input type="text" class="text-input" name="last_name" value="<?php echo e(old('last_name')); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="checkboxes form-group">
                                                    <div class="pretty p-default p-round">
                                                        <input type="radio" name="gender" value="1" checked>
                                                        <div class="state custom-state">
                                                            <label class="text-white"><?php echo app('translator')->get('frontend.male'); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-default p-round">
                                                        <input type="radio" name="gender" value="0" <?php echo e((old('gender') == "0") ? "checked" : ""); ?>>
                                                        <div class="state custom-state">
                                                            <label class="text-white"><?php echo app('translator')->get('frontend.female'); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="label-animate"><?php echo app('translator')->get('frontend.email'); ?></label>
                                                    <input type="text" class="text-input" name="email" value="<?php echo e(old('email')); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="label-animate"><?php echo app('translator')->get('frontend.phone'); ?></label>
                                                    <input type="text" class="text-input" name="phone" value="<?php echo e(old('phone')); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="label-animate"><?php echo app('translator')->get('frontend.password'); ?></label>
                                                    <input type="password" class="text-input" name="password" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="label-animate"><?php echo app('translator')->get('frontend.confirm_password'); ?></label>
                                                    <input type="password" class="text-input" name="confirm_password" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea class="text-input" cols="30" rows="4" name="address" placeholder="<?php echo app('translator')->get('frontend.your_address'); ?>"><?php echo e(old('address')); ?></textarea>
                                            </div>
                                            <input class="tab-button ml-3 mt-5" type="submit" value="<?php echo app('translator')->get('frontend.sign_up'); ?>">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
     </section>
     <?php echo $__env->make('frontend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <!-- END ALL SECTIONS -->
    <!-- END WRAPPER -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script src="<?php echo e(asset('assets/frontend/js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/js/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/libraries/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- PLUGINS -->
    <!-- slick carousel -->
    <script src="<?php echo e(asset('assets/frontend/libraries/slider/slick/slick.min.js')); ?>"></script>
    <!-- Nice select -->
    <script src="<?php echo e(asset('assets/frontend/libraries/dropdown/js/jquery.nice-select.min.js')); ?>"></script>
    
    
     
    <!-- Date time picker -->
    <script src="<?php echo e(asset('assets/frontend/js/moment.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/sw.js?v5')); ?>"></script>
    <script src="<?php echo e(asset('web-sw.js?v1')); ?>"></script>
	<script>
		if ('serviceWorker' in navigator) {
			navigator.serviceWorker.register('sw.js?v5', {
				scope: '.' // <--- THIS BIT IS REQUIRED
			}).then(function(registration) {
				// Registration was successful
				// console.log('ServiceWorker registration successful with scope: ', registration.scope);
			}, function(err) {
				// registration failed :(
				console.log('ServiceWorker registration failed: ', err);
			});
		}
	</script>
	<script>
		if ('serviceWorker' in navigator) {
			navigator.serviceWorker.register('web-sw.js?v1', {
				scope: '.' // <--- THIS BIT IS REQUIRED
			}).then(function(registration) {
				// Registration was successful
				// console.log('ServiceWorker registration successful with scope: ', registration.scope);
			}, function(err) {
				// registration failed :(
				console.log('ServiceWorker registration failed: ', err);
			});
		}
	</script>
    <?php echo $__env->yieldContent('scripts'); ?>
    <?php echo $__env->yieldContent('javascript'); ?>
    <?php if(count($errors->register) > 0): ?>
    <script type="text/javascript">
         $('#login-modal').addClass('active');
         $('#password_label').addClass('label-top');
        $('#password_label').addClass('stay');
        $('#password').addClass('active');
    </script>
    <?php endif; ?>
      <script>
    $(function(){
    var email=$('#email').val();
    var password=$('#password').val();
    if((email != null || email != '') || (password != null || password != '' )){
       
        $('#password_label').addClass('label-top');
        $('#password_label').addClass('stay');
        $('#password').addClass('active');
        $('#email_label').addClass('label-top');
        $('#email_label').addClass('stay');
        $('#email').addClass('active');
    }
    else{   
        $('#password_label').removeClass('label-top');
        $('#password_label').removeClass('stay');
        $('#password').removeClass('active');
        $('#email_label').removeClass('label-top');
        $('#email_label').removeClass('stay');
        $('#email').removeClass('active');
    }
    });

      </script>
    <?php if(session('success')): ?>
    <script type="text/javascript">
        $('#login-popup').addClass('active'); 
        $('#login-popup').removeClass('fadeOutDown');
       
    </script>
    <?php endif; ?>

    <?php if(count($errors->login) > 0): ?>
    <script>
        $('#login-popup').addClass('active');
        $('#login-popup').removeClass('fadeOutDown'); 
        $('#password_label').addClass('label-top');
        $('#password_label').addClass('stay');
        $('#password').addClass('active');
    </script>
    <?php endif; ?>

    <script>
    $(function(){
        var current = location.pathname;
        $('.navbar-nav a').each(function(){
            var $this = $(this);
            //alert(current.substring(current.lastIndexOf('/') + 1));
            if($this.attr('href').substring(this.href.lastIndexOf('/') + 1) == current.substring(current.lastIndexOf('/') + 1)){
                $this.addClass('active');
            }
            
            if(current.substring(current.lastIndexOf('/') + 1) == '')
            {
                $('.navbar-nav a').first().addClass('active');
            }
        });

        $('.offcanvas-nav_links a').each(function(){
            var $this = $(this);
            //alert(current.split('/')[2]);
            if($this.attr('href').substring(this.href.lastIndexOf('/') + 1) == current.substring(current.lastIndexOf('/') + 1)){
                $this.addClass('active');
            }

            if(current.substring(current.lastIndexOf('/') + 1) == '')
            {
                $('.offcanvas-nav_links a').first().addClass('active');
            }
        });
            
        
    });

    window.setTimeout(function () { 
         $(".alert-success").alert('close'); 
    }, 3000);

    if ($(location).attr('href').substring($(location).attr('href').lastIndexOf('/') + 1) == "#login")
    {
        $('#login-popup').addClass('active');
        $('#login-popup').removeClass('fadeOutDown'); 
    }
    </script>
  </body>
  <!-- Body End -->
</html>
<?php /**PATH /var/www/html/whistler/framework/resources/views/frontend/layouts/app.blade.php ENDPATH**/ ?>