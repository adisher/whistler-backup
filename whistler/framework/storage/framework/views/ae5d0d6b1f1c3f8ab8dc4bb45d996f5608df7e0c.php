
    <!-- Starts Wrapper -->
    <div class="wrapper">
        <!-- MOBILE OFFCANVAS NAVIGATIONS -->
        <!-- Left side off canvas menu -->
        <div class="offcanvas-nav left-side-nav" id="nav-left">
            <div class="ml-5 mt-2">
                <a href="<?php echo e(route('frontend.home')); ?>"><img src="<?php echo e(url('assets/images/' . Hyvikk::get('logo_img'))); ?>" alt="" height="70px"></a>
            </div>
            <div class="offcanvas-nav_close" data-close="nav-left">
                <i class="fa fa-times"></i>
            </div>
            <ul class="list-unstyled offcanvas-nav_links mt-0">
                <li>
                    <a class="nav-item nav-link" href="<?php echo e(route('frontend.home')); ?>"><?php echo app('translator')->get('frontend.home'); ?></a>
                </li>
                <li>
                    <a class="nav-item nav-link" href="<?php echo e(route('frontend.about')); ?>"><?php echo app('translator')->get('frontend.about'); ?></a>
                </li>
                <li>
                    <a class="nav-item nav-link" href="<?php echo e(route('frontend.contact')); ?>"><?php echo app('translator')->get('frontend.contact'); ?></a>
                </li>
            </ul>
        </div>
        <!-- Ends Left side off canvas menu -->
      
        <!-- Header starts -->
        <header>
            <div class="container-fluid d-flex justify-content-between">
                <nav class="navbar navbar-expand-lg d-flex flex-row-reverse flex-lg-row justify-content-aronud w-100">
                    <!-- Right side navbar toggler -->
                    <!-- <div class="right-nav-trigger" data-target="nav-right">
                        <div class="user-icon">
                            <img src="assets/images/user.jpg" alt="">
                        </div>
                    </div> -->
                    <a class="navbar-brand d-none d-sm-inline-block mr-5 pr-5 mr-lg-0 pr-lg-0" href="<?php echo e(route('frontend.home')); ?>">
                        <img src="<?php echo e(url('assets/images/' . Hyvikk::get('logo_img'))); ?>" alt="fleet-logo" height="100px">
                    </a>
                    <!-- mini logo for mobile device -->
                    <a class="navbar-brand d-inline-block d-sm-none" href="<?php echo e(route('frontend.home')); ?>">
                        <img src="<?php echo e(url('assets/images/' . Hyvikk::get('icon_img'))); ?>" alt="fleet-logo">
                    </a>
                    <!-- Left side navbar toggler -->
                    <button class="navbar-toggler left-nav-trigger" data-target="nav-left">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse mx-auto" id="navbar">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="<?php echo e(route('frontend.home')); ?>"><?php echo app('translator')->get('frontend.home'); ?></a>
                            <a class="nav-item nav-link" href="<?php echo e(route('frontend.about')); ?>"><?php echo app('translator')->get('frontend.about'); ?></a>
                            <a class="nav-item nav-link" href="<?php echo e(route('frontend.contact')); ?>"><?php echo app('translator')->get('frontend.contact'); ?></a>
                        </div>
                    </div>
                </nav>

                <?php if(!Auth::guest() && (Auth::user()->user_type == "C" || Auth::user()->user_type == "D")): ?>
                    <!-- Item With Dropdown -->
                    <div class="login-container">
                        <div class="d-flex justify-content-center align-items-center dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><a href="#" class="stay"><?php echo e(Auth::user()->name); ?></a></div>
                            <!-- Dropdown -->
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?php echo e(route('frontend.edit_profile')); ?>"><?php echo app('translator')->get('frontend.edit_profile'); ?></a>
                                <a class="dropdown-item" href="<?php echo e(route('frontend.booking_history',Auth::user()->id)); ?>"><?php echo app('translator')->get('frontend.booking_history'); ?></a>
                                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><?php echo app('translator')->get('frontend.logout'); ?></a>
                            </div>   
                        </div>
                    
                        <form id="logout-form" action="<?php echo e(url('user-logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                <?php else: ?>
                    <div class="login-container">
                        <div class="login-popup-trigger d-flex justify-content-center align-items-center" data-target="login-popup">
                            <h6 class="av"><?php echo app('translator')->get('frontend.login'); ?></h6>
                            <img src="<?php echo e(asset('assets/frontend/icons/fleet-login2.png')); ?>" alt="">
                        </div>
                    
                        <div class="login-popup js-close-outside animated faster fadeInUp fadeOutDown" id="login-popup">
                            <?php if(session('success')): ?>
                                <div class="alert alert-success xs-mt">
                                <?php echo e(session('success')); ?>

                                </div>
                            <?php endif; ?>
                            <?php if(count($errors->login) > 0): ?>
                                <div class="alert alert-danger xs-mt">
                                <ul>
                                <?php $__currentLoopData = $errors->login->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                </div>
                            <?php endif; ?>
                            <form action="<?php echo e(url('user-login')); ?>" method="POST" class="text-center" id="hello">
                                <?php echo csrf_field(); ?>

                                <div class="form-group">
                                    <label id="email_label" class="label-animate"><?php echo app('translator')->get('frontend.email_address'); ?></label>
                                    <input type="email" id="email" class="text-input" name="email" value="<?php echo e(old('email')); ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <label id="password_label" class="label-animate"><?php echo app('translator')->get('frontend.password'); ?></label>
                                    <input type="password" id="password" class="text-input" name="password">
                                </div>
                                <button class="tab-button mx-auto mt-3 w-100" type="submit"><?php echo app('translator')->get('frontend.login'); ?></button>
                                <p class="login-helper mt-3">
                                    <a class="link" href="<?php echo e(url('forgot-password')); ?>"><?php echo app('translator')->get('frontend.forgot_password'); ?></a><br>
                                    <span><?php echo app('translator')->get('frontend.do_not_account'); ?></span>
                                    <a class="link" data-target="login-modal"><?php echo app('translator')->get('frontend.register_now'); ?></a>
                                </p>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </header><?php /**PATH /var/www/html/whistler/framework/resources/views/frontend/includes/navigation.blade.php ENDPATH**/ ?>