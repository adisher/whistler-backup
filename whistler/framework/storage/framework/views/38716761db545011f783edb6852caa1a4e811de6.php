<!DOCTYPE html>
<?php if(Auth::user()->getMeta('language') != null): ?>
<?php ($language = Auth::user()->getMeta('language')); ?>
<?php else: ?>
<?php ($language = Hyvikk::get('language')); ?>
<?php endif; ?>

<html>
<!--
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>  -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="manifest" href="<?php echo e(asset('web-manifest.json?v2')); ?>">

    <title><?php echo e(Hyvikk::get('app_name')); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/font-awesome/css/all.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/ionicons.min.css')); ?>">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fullcalendar/fullcalendar.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fullcalendar/fullcalendar.print.css')); ?>" media="print">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/cdn/buttons.dataTables.min.css')); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/select2/select2.min.css')); ?>">

    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/dist/adminlte.min.css')); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/iCheck/flat/blue.css')); ?>">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/iCheck/all.css')); ?>">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/morris/morris.css')); ?>">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css')); ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="<?php echo e(asset('assets/css/fonts/fonts.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('assets/css/pnotify.custom.min.css')); ?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" type="text/css" rel="stylesheet" />
    <style>
        [data-toggle='modal'] {
            cursor: pointer;
        }

        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .brand-text {
            font-size: 1rem !important;
        }

        .brand-image {
            /* filter: invert(1); */
        }
    </style>
    <?php echo $__env->yieldContent('extra_css'); ?>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'subscription_url' => asset('assets/push_notification/push_subscription.php'),
            'serviceWorkerUrl' => asset('serviceWorker.js'),
        ]); ?>;
    </script>
    <!-- browser notification -->
    <script src="<?php echo e(asset('assets/push_notification/app.js')); ?>"></script>
    <style>
        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
            font-size: 0.6em;
            height: 35px !important;
        }

        .error {
            font-weight: 400 !important;
            color: red;
        }

        .input-group input {
            width: 65% !important;
        }
    </style>
    <?php if($language == 'Arabic-ar'): ?>
    <style type="text/css">
        .sidebar {
            text-align: right;
        }

        .nav-sidebar .nav-link>p>.right {
            position: absolute;
            right: 0rem;
            top: 12px;
        }

        .nav-sidebar>.nav-item {
            margin-right: -20px;
        }
    </style>
    <?php endif; ?>
</head>

<body class="hold-transition <?php echo e(auth()->user()->theme); ?> layout-fixed  sidebar-mini" <?php if($language=='Arabic-ar' ): ?>
    dir="rtl" <?php endif; ?>>
    <?php echo Form::hidden('loggedinuser', Auth::user()->id, ['id' => 'loggedinuser']); ?>

    <?php echo Form::hidden('user_type', Auth::user()->user_type, ['id' => 'user_type']); ?>

    <div class="wrapper">
        <!-- Navbar -->
        <nav
            class="main-header navbar navbar-expand <?php if(auth()->user()->theme == 'dark-mode'): ?> navbar-dark <?php else: ?> bg-white navbar-light <?php endif; ?> border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!-- Notifications Dropdown Menu -->
                <?php if(Auth::user()->user_type == 'S'): ?>
                <?php ($r = 0); ?>
                <?php ($i = 0); ?>
                <?php ($l = 0); ?>
                <?php ($d = 0); ?>
                <?php ($s = 0); ?>
                <?php ($user = Auth::user()); ?>
                <?php $__currentLoopData = $user->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($notification->type == 'App\Notifications\RenewRegistration'): ?>
                <?php ($r++); ?>
                <?php elseif($notification->type == 'App\Notifications\RenewInsurance'): ?>
                <?php ($i++); ?>
                <?php elseif($notification->type == 'App\Notifications\RenewVehicleLicence'): ?>
                <?php ($l++); ?>
                <?php elseif($notification->type == 'App\Notifications\RenewDriverLicence'): ?>
                <?php ($d++); ?>
                <?php elseif($notification->type == 'App\Notifications\ServiceReminderNotification'): ?>
                <?php ($s++); ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php ($n = $r + $i + $l + $d + $s); ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">
                            <?php if($n > 0): ?>
                            <?php echo e($n); ?>

                            <?php endif; ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <?php if($n > 0): ?>
                        <span class="dropdown-item dropdown-header"> <?php echo e($n); ?> Notifications </span>
                        <div class="dropdown-divider"></div>
                        <?php endif; ?>
                        <a href="<?php echo e(url('admin/vehicle_notification', ['type' => 'renew-registrations'])); ?>"
                            class="dropdown-item">
                            <i class="fa fa-id-card-o mr-2"></i> <?php echo app('translator')->get('fleet.renew_registration'); ?>
                            <span class="float-right text-muted text-sm">
                                <?php if($r > 0): ?>
                                <?php echo e($r); ?>

                                <?php endif; ?>
                            </span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo e(url('admin/vehicle_notification', ['type' => 'renew-insurance'])); ?>"
                            class="dropdown-item">
                            <i class="fa fa-file-text mr-2"></i> <?php echo app('translator')->get('fleet.renew_insurance'); ?>
                            <span class="float-right text-muted text-sm">
                                <?php if($i > 0): ?>
                                <?php echo e($i); ?>

                                <?php endif; ?>
                            </span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo e(url('admin/vehicle_notification', ['type' => 'renew-licence'])); ?>"
                            class="dropdown-item">
                            <i class="fa fa-file-o mr-2"></i> <?php echo app('translator')->get('fleet.renew_licence'); ?>
                            <span class="float-right text-muted text-sm">
                                <?php if($l > 0): ?>
                                <?php echo e($l); ?>

                                <?php endif; ?>
                            </span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo e(url('admin/driver_notification', ['type' => 'renew-driving-licence'])); ?>"
                            class="dropdown-item">
                            <i class="fa fa-file-text-o mr-2"></i> <?php echo app('translator')->get('fleet.renew_driving_licence'); ?>
                            <span class="float-right text-muted text-sm">
                                <?php if($d > 0): ?>
                                <?php echo e($d); ?>

                                <?php endif; ?>
                            </span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo e(url('admin/reminder', ['type' => 'service-reminder'])); ?>" class="dropdown-item">
                            <i class="fa fa-clock-rotate-left mr-2"></i> <?php echo app('translator')->get('fleet.serviceReminders'); ?>
                            <span class="float-right text-muted text-sm">
                                <?php if($s > 0): ?>
                                <?php echo e($s); ?>

                                <?php endif; ?>
                            </span>
                        </a>
                    </div>
                </li>
                <?php endif; ?>
                <!-- logout -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-user-circle"></i>
                        <span class="badge badge-danger navbar-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <?php if(Auth::user()->user_type == 'D' && Auth::user()->getMeta('driver_image') != null): ?>
                                <?php if(starts_with(Auth::user()->getMeta('driver_image'), 'http')): ?>
                                <?php ($src = Auth::user()->getMeta('driver_image')); ?>
                                <?php else: ?>
                                <?php ($src = asset('uploads/' . Auth::user()->getMeta('driver_image'))); ?>
                                <?php endif; ?>
                                <img src="<?php echo e($src); ?>" class="img-size-50 mr-3 img-circle" alt="User Image">
                                <?php elseif(Auth::user()->user_type == 'S' ||
                                Auth::user()->user_type == 'O' ||
                                Auth::user()->user_type == 'SM' ||
                                Auth::user()->user_type == 'SI' ||
                                Auth::user()->user_type == 'EO'): ?>
                                <?php if(Auth::user()->getMeta('profile_image') == null): ?>
                                <img src="<?php echo e(asset(' assets/images/no-user.jpg')); ?>" class="img-size-50 mr-3 img-circle"
                                    alt="User Image">
                                <?php else: ?>
                                <img src="<?php echo e(asset('uploads/' . Auth::user()->getMeta('profile_image'))); ?>"
                                    class="img-size-50 mr-3 img-circle" alt="User Image">
                                <?php endif; ?>
                                <?php elseif(Auth::user()->user_type == 'C' && Auth::user()->getMeta('profile_pic') != null): ?>
                                <?php if(starts_with(Auth::user()->getMeta('profile_pic'), 'http')): ?>
                                <?php ($src = Auth::user()->getMeta('profile_pic')); ?>
                                <?php else: ?>
                                <?php ($src = asset('uploads/' . Auth::user()->getMeta('profile_pic'))); ?>
                                <?php endif; ?>
                                <img src="<?php echo e($src); ?>" class="img-size-50 mr-3 img-circle" alt="User Image">
                                <?php else: ?>
                                <img src="<?php echo e(asset(' assets/images/no-user.jpg')); ?>" class="img-size-50 mr-3 img-circle"
                                    alt="User Image">
                                <?php endif; ?>

                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        <?php echo e(Auth::user()->name); ?>


                                        <span class="float-right text-sm text-danger">

                                        </span>
                                    </h3>
                                    <p class="text-sm text-muted"><?php echo e(Auth::user()->email); ?></p>
                                    <p class="text-sm text-muted"></p>

                                </div>
                            </div>
                        </a>
                        <div>
                            <div style="margin: 5px;">
                                <a href="<?php echo e(url('admin/change-details/' . Auth::user()->id)); ?>"
                                    class="btn btn-secondary btn-flat"><i class="fa fa-edit"></i>
                                    <?php echo app('translator')->get('fleet.editProfile'); ?></a>

                                <a href="<?php echo e(route('logout')); ?>"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="btn btn-secondary btn-flat pull-right"> <i class="fa fa-sign-out"></i>
                                    <?php echo app('translator')->get('menu.logout'); ?>
                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                    style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>

                            </div>
                            <div class="clear"></div>
                        </div>
                        <!-- Message End -->

                    </div>
                </li>
                
                <!-- logout -->
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">

            <a href="<?php echo e(url('admin/')); ?>" class="brand-link">
                <img src="<?php echo e(asset('assets/images/logo-whistler.png')); ?>" alt="Fleet Logo" class="brand-image">
                <span class="brand-text font-weight-light"><?php echo e(Hyvikk::get('app_name')); ?></span>
            </a>

            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php if(Auth::user()->user_type == 'D' && Auth::user()->getMeta('driver_image') != null): ?>
                        <?php if(starts_with(Auth::user()->getMeta('driver_image'), 'http')): ?>
                        <?php ($src = Auth::user()->getMeta('driver_image')); ?>
                        <?php else: ?>
                        <?php ($src = asset('uploads/' . Auth::user()->getMeta('driver_image'))); ?>
                        <?php endif; ?>
                        <img src="<?php echo e($src); ?>" class="img-circle elevation-2" alt="User Image">
                        <?php elseif(Auth::user()->user_type == 'S' || Auth::user()->user_type == 'O'): ?>
                        <?php if(Auth::user()->getMeta('profile_image') == null): ?>
                        <img src="<?php echo e(asset(' assets/images/no-user.jpg')); ?>" class="img-circle elevation-2"
                            alt="User Image">
                        <?php else: ?>
                        <img src="<?php echo e(asset('uploads/' . Auth::user()->getMeta('profile_image'))); ?>"
                            class="img-circle elevation-2" alt="User Image">
                        <?php endif; ?>
                        <?php elseif(Auth::user()->user_type == 'C' && Auth::user()->getMeta('profile_pic') != null): ?>
                        <?php if(starts_with(Auth::user()->getMeta('profile_pic'), 'http')): ?>
                        <?php ($src = Auth::user()->getMeta('profile_pic')); ?>
                        <?php else: ?>
                        <?php ($src = asset('uploads/' . Auth::user()->getMeta('profile_pic'))); ?>
                        <?php endif; ?>
                        <img src="<?php echo e($src); ?>" class="img-circle elevation-2" alt="User Image">
                        <?php else: ?>
                        <img src="<?php echo e(asset(' assets/images/no-user.jpg')); ?>" class="img-circle elevation-2"
                            alt="User Image">
                        <?php endif; ?>

                    </div>
                    <div class="info">
                        <a href="<?php echo e(url('admin/change-details/' . Auth::user()->id)); ?>" class="d-block"><?php echo e(Auth::user()->name); ?></a>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="sidebar-search-results">
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <div class="search-title">
                                    <div class="search-path"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar nav-flat flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                            <!-- customer -->
                            <?php if(Auth::user()->user_type == 'C'): ?>

                            <?php if(Request::is('admin/bookings*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>

                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-address-card"></i>
                                    <p>
                                        <?php echo app('translator')->get('menu.bookings'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('bookings.create')); ?>"
                                            class="nav-link <?php if(Request::is('admin/bookings/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-address-book nav-icon "></i>
                                            <p>
                                                <?php echo app('translator')->get('menu.newbooking'); ?></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('bookings.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/bookings*') && !Request::is('admin/bookings/create') && !Request::is('admin/bookings_calendar')): ?> active <?php endif; ?>">
                                            <i class="fa fa-tasks nav-icon"></i>
                                            <p>
                                                <?php echo app('translator')->get('menu.manage_bookings'); ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/change-details/' . Auth::user()->id)); ?>"
                                    class="nav-link <?php if(Request::is('admin/change-details*')): ?> active <?php endif; ?>">
                                    <i class="nav-icon fa fa-edit"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.editProfile'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/addresses')); ?>"
                                    class="nav-link <?php if(Request::is('admin/addresses*')): ?> active <?php endif; ?>">
                                    <i class="nav-icon fa fa-map-marker"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.addresses'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/')); ?>" class="nav-link <?php if(Request::is('admin')): ?> active <?php endif; ?>">
                                    <i class="nav-icon fa fa-money-bill-alt"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.expenses'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <?php endif; ?>
                            <!-- customer -->
                            <!-- user-type S or O -->

                            
                            <!-- user-type S or O -->

                            <!-- driver -->
                            <?php if(Auth::user()->user_type == 'D'): ?>

                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/')); ?>"
                                    class="nav-link <?php if(Request::is('admin/')): ?> active <?php endif; ?>">
                                    <i class="nav-icon fa fa-user"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.myProfile'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('my_bookings')); ?>"
                                    class="nav-link <?php if(Request::is('admin/my_bookings')): ?> active <?php endif; ?>">
                                    <i class="nav-icon fa fa-book"></i>
                                    <p>
                                        <?php echo app('translator')->get('menu.my_bookings'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/vehicle-inspection')); ?>" class="nav-link <?php if(Request::is('admin/vehicle-inspection*') ||
                                                Request::is('admin/view-vehicle-inspection*') ||
                                                Request::is('admin/print-vehicle-inspection*')): ?> active <?php endif; ?>">
                                    <i class="fa fa-briefcase nav-icon"></i>
                                    <p>Fleet Inspection</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/change-details/' . Auth::user()->id)); ?>"
                                    class="nav-link <?php if(Request::is('admin/change-details*')): ?> active <?php endif; ?>">
                                    <i class="nav-icon fa fa-edit"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.editProfile'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <?php if(
                            !empty(Hyvikk::chat('pusher_app_id')) &&
                            !empty(Hyvikk::chat('pusher_app_key')) &&
                            !empty(Hyvikk::chat('pusher_app_secret')) &&
                            !empty(Hyvikk::chat('pusher_app_cluster'))): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/chat/')); ?>"
                                    class="nav-link <?php if(Request::is('admin/chat')): ?> active <?php endif; ?>">
                                    <i class="nav-icon fa fa-comments-o"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.chat'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <?php endif; ?>

                            <?php if(Request::is('admin/notes*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>

                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-sticky-note"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.notes'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('notes.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/notes*') && !Request::is('admin/notes/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-flag nav-icon"></i>
                                            <p> <?php echo app('translator')->get('fleet.manage_note'); ?></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('notes.create')); ?>"
                                            class="nav-link <?php if(Request::is('admin/notes/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-plus-square nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.create_note'); ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <?php if(Request::is('admin/driver-reports*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>

                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-book"></i>
                                    <p>
                                        <?php echo app('translator')->get('menu.reports'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('dreports.monthly')); ?>"
                                            class="nav-link <?php if(Request::is('admin/driver-reports/monthly')): ?> active <?php endif; ?>">
                                            <i class="fa fa-calendar nav-icon"></i>
                                            <p><?php echo app('translator')->get('menu.monthlyReport'); ?></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('dreports.yearly')); ?>"
                                            class="nav-link <?php if(Request::is('admin/driver-reports/yearly')): ?> active <?php endif; ?>">
                                            <i class="fa fa-calendar nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.yearlyReport'); ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <?php if(Hyvikk::get('fuel_enable_driver') == 1): ?>
                            <?php if(Request::is('admin/fuel*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>

                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-filter"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.fuel'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('fuel.create')); ?>"
                                            class="nav-link <?php if(Request::is('admin/fuel/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-plus-square nav-icon"></i>
                                            <p> <?php echo app('translator')->get('fleet.add_fuel'); ?></p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?php echo e(route('fuel.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/fuel*') && !Request::is('admin/fuel/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-history nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.manage_fuel'); ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if(Hyvikk::get('income_enable_driver') == 1 || Hyvikk::get('expense_enable_driver') == 1): ?>
                            <?php if(Request::is('admin/income') ||
                            Request::is('admin/expense') ||
                            Request::is('admin/transaction') ||
                            Request::is('admin/income_records') ||
                            Request::is('admin/expense_records')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Transactions list')): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-money-bill-alt"></i>
                                    <p>
                                        <?php echo app('translator')->get('menu.transactions'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if(Hyvikk::get('income_enable_driver') == 1): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('income.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/income') || Request::is('admin/income_records')): ?> active <?php endif; ?>">
                                            <i class="fa fa-newspaper nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.manage_income'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(Hyvikk::get('expense_enable_driver') == 1): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('expense.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/expense') || Request::is('admin/expense_records')): ?> active <?php endif; ?>">
                                            <i class="fa fa-newspaper nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.manage_expense'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>
                            <?php endif; ?>

                            
                            <?php endif; ?>
                            <!-- driver -->

                            <!-- sidebar menus for office-admin and super-admin -->

                            <?php if(Auth::user()->user_type == 'S' || Auth::user()->user_type == 'O'): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/')); ?>" class="nav-link <?php if(Request::is('admin')): ?> active <?php endif; ?>">
                                    <i class="nav-icon fa fa-tachograph-digital"></i>
                                    <p>
                                        <?php echo app('translator')->get('menu.Dashboard'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <?php endif; ?>

                            <?php if(!Auth::guest() && Auth::user()->user_type != 'D' && Auth::user()->user_type != 'C'): ?>


                            <?php if(Request::is('admin/driver-logs') ||
                            Request::is('admin/drivers*') ||
                            Request::is('admin/vehicle-types*') ||
                            Request::is('admin/vehicles*') ||
                            Request::is('admin/vehicle_group*') ||
                            Request::is('admin/vehicle-reviews*') ||
                            Request::is('admin/view-vehicle-review*') ||
                            Request::is('admin/vehicle-review*') ||
                            Request::is('admin/vehicle-make*') ||
                            Request::is('admin/vehicle-model*') ||
                            Request::is('admin/vehicle-color*') ||
                            Request::is('admin/maintenance*') ||
                            Request::is('admin/service-reminder*') || Request::is('admin/service-item*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
                            'Vehicles list',
                            'VehicleType list',
                            'VehicleGroup list',
                            'VehicleInspection list',
                            'VehicleColors
                            list',
                            'VehicleModels list',
                            'VehicleMaker list', 'Drivers list'
                            ])): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-taxi"></i>
                                    <p>
                                        Fleet Management
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Drivers list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('drivers.index')); ?>" class="nav-link <?php if(Request::is('admin/drivers*')): ?> active <?php endif; ?>">
                                            <i class="fa fa-id-card nav-icon"></i>
                                            <p><?php echo app('translator')->get('menu.drivers'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vehicles list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('vehicle-types.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/vehicle-types*')): ?> active <?php endif; ?>">
                                            <i class="fa fa-th-list nav-icon"></i>
                                            <p>Define Fleet</p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vehicles list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('vehicles.index')); ?>" class="nav-link <?php if(Request::is('admin/vehicles*')): ?> active <?php endif; ?>"
                                            style="position:relative">
                                            <i class="fa fa-truck nav-icon"></i>
                                            <p>Manage Fleet</p>
                                        </a>
                            
                            
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('VehicleInspection list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/vehicle-reviews')); ?>" class="nav-link 
                                                                    <?php if(Request::is('admin/vehicle-reviews*') ||
                                                                            Request::is('admin/view-vehicle-review*') ||
                                                                            Request::is('admin/vehicle-review*')): ?> active 
                                                                    <?php endif; ?>">
                                            <i class="fa fa-briefcase nav-icon"></i>
                                            <p>Fleet Inspection</p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ServiceReminders list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('maintenance.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/maintenance*')): ?> active <?php endif; ?>">
                                            <i class="fa fa-arrows-alt nav-icon"></i>
                                            <p>Corrective Maintenance</p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(Request::is('admin/service-reminder*') || Request::is('admin/service-item*')): ?>
                                    <?php ($class = 'menu-open'); ?>
                                    <?php ($active = 'active'); ?>
                                    <?php else: ?>
                                    <?php ($class = ''); ?>
                                    <?php ($active = ''); ?>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ServiceReminders list', 'ServiceReminders add', 'ServiceItems list'])): ?>
                                    <li class="nav-item has-treeview <?php echo e($class); ?>">
                                        <a href="#" class="nav-link <?php echo e($active); ?>">
                                            <i class="nav-icon fa fa-clock-rotate-left"></i>
                                            <p>
                                                Preventive Maintenance
                                                <i class="right fa fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ServiceReminders list')): ?>
                                            <li class="nav-item">
                                                <a href="<?php echo e(route('service-reminder.index')); ?>"
                                                    class="nav-link <?php if(Request::is('admin/service-reminder')): ?> active <?php endif; ?>">
                                                    <i class="fa fa-arrows-alt nav-icon"></i>
                                                    <p><?php echo app('translator')->get('fleet.manage_reminder'); ?></p>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ServiceReminders add')): ?>
                                            <li class="nav-item">
                                                <a href="<?php echo e(route('service-reminder.create')); ?>"
                                                    class="nav-link <?php if(Request::is('admin/service-reminder/create')): ?> active <?php endif; ?>">
                                                    <i class="fa fa-check-square nav-icon"></i>
                                                    <p><?php echo app('translator')->get('fleet.add_service_reminder'); ?></p>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ServiceItems list')): ?>
                                            <li class="nav-item">
                                                <a href="<?php echo e(route('service-item.index')); ?>"
                                                    class="nav-link <?php if(Request::is('admin/service-item*')): ?> active <?php endif; ?>">
                                                    <i class="fa fa-warning nav-icon"></i>
                                                    <p><?php echo app('translator')->get('fleet.service_item'); ?></p>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if(Request::is('admin/work_order*') || Request::is('admin/parts-used*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['WorkOrders list', 'WorkOrders add'])): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-shopping-cart"></i>
                                    <p>
                                        Fleet Utilization
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('WorkOrders add')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('work_order.create')); ?>"
                                            class="nav-link <?php if(Request::is('admin/work_order/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-plus-square nav-icon"></i>
                                            <p> Deploy Fleet </p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('WorkOrders list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('work_order.index')); ?>" class="nav-link <?php if(
                                                                                        (Request::is('admin/work_order*') &&
                                                                                            !Request::is('admin/work_order/create') &&
                                                                                            !Request::is('admin/work_order/logs')) ||
                                                                                            Request::is('admin/parts-used*')): ?> active <?php endif; ?>">
                                            <i class="fa fa-inbox nav-icon"></i>
                                            <p>Manage Fleet Utilization</p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('WorkOrders list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/work_order/logs')); ?>"
                                            class="nav-link <?php if(Request::is('admin/work_order/logs')): ?> active <?php endif; ?>">
                                            <i class="fa fa-history nav-icon"></i>
                                            <p>Fleet Utilization History</p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                            
                                </ul>
                            </li>
                            <?php endif; ?>
                            <?php if(Request::is('admin/fuel*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Fuel list', 'Fuel add'])): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-filter"></i>
                                    <p>
                                        Fuel Management
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Fuel add')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('fuel.add_fuel_form')); ?>"
                                            class="nav-link <?php if(Request::is('admin/fuel/fuel-form')): ?> active <?php endif; ?>">
                                            <i class="fa fa-plus-square nav-icon"></i>
                                            <p>Add Fuel</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('fuel.create')); ?>" class="nav-link <?php if(Request::is('admin/fuel/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-plus-square nav-icon"></i>
                                            <p>Allocate To Fleet</p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Fuel list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('fuel.fuel_details')); ?>"
                                            class="nav-link <?php if(Request::is('admin/fuel/fuel-details')): ?> active <?php endif; ?>">
                                            <i class="fa fa-gas-pump nav-icon"></i>
                                            <p>Fuel Details</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('fuel.index')); ?>" class="nav-link <?php if(Request::is('admin/fuel')): ?> active <?php endif; ?>">
                                            <i class="fa fa-history nav-icon"></i>
                                            <p>Fuel Allocation Details</p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                            
                                </ul>
                            </li>
                            <?php endif; ?>
                            <!-- Product Yield -->
                            <?php if(Request::is('admin/sites*') ||
                            Request::is('admin/shifts*') ||
                            Request::is('admin/shift-details*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ProductYields list')): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-product-hunt"></i>
                                    <p>
                                        Yield Management
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('sites.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/sites*')): ?> active <?php endif; ?>" style="position:relative">
                                            <i class="fa fa-building nav-icon"></i>
                                            <p>Manage Sites</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('shifts.index')); ?>" class="nav-link <?php if(Request::is('admin/shifts*')): ?> active <?php endif; ?>"
                                            style="position:relative">
                                            <i class="fa fa-truck nav-icon"></i>
                                            <p>Manage Shifts</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('shift-details.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/shift-details*')): ?> active <?php endif; ?>" style="position:relative">
                                            <i class="fa fa-truck nav-icon"></i>
                                            <p>Manage Yield Details</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php endif; ?>
                            <!-- end product yield -->

                            <?php if(Request::is('admin/vendors*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Vendors list', 'Vendors add'])): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-cubes"></i>
                                    <p>
                                        Vendors Management
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vendors add')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('vendors.create')); ?>"
                                            class="nav-link <?php if(Request::is('admin/vendors/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-plus-square nav-icon"></i>
                                            <p> <?php echo app('translator')->get('fleet.add_vendor'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vendors list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('vendors.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/vendors*') && !Request::is('admin/vendors/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-cube nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.manage_vendor'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if(Request::is('admin/parts*') && !Request::is('admin/parts-used*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Parts list', 'Parts add', 'PartsCategory list'])): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-gear"></i>
                                    <p>
                                        Spare & Tools
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Parts add')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('parts.create')); ?>"
                                            class="nav-link <?php if(Request::is('admin/parts/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-plus-square nav-icon"></i>
                                            <p> <?php echo app('translator')->get('fleet.addParts'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Parts list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('parts.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/parts*') && !Request::is('admin/parts-category*') && !Request::is('admin/parts/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-gears nav-icon"></i>
                                            <p><?php echo app('translator')->get('menu.manageParts'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if(Request::is('admin/roles*') ||
                            Request::is('admin/users*') ||
                            Request::is('admin/chat')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Users list', 'Customer list', 'Settings list'])): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>
                                        Manage Roles
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('roles.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/roles*')): ?> active <?php endif; ?>">
                                            <i class="fa fa-tasks nav-icon"></i>
                                            <p>Role Access Management</p>
                                        </a>
                                    </li>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Users list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('users.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/users*')): ?> active <?php endif; ?>">
                                            <i class="fa fa-user nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.users'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(
                                    !empty(Hyvikk::chat('pusher_app_id')) &&
                                    !empty(Hyvikk::chat('pusher_app_key')) &&
                                    !empty(Hyvikk::chat('pusher_app_secret')) &&
                                    !empty(Hyvikk::chat('pusher_app_cluster'))): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('chat.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/chat')): ?> active <?php endif; ?>">
                                            <i class="fa fa-comments-o nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.chat'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                            

                            
                            <?php if(Request::is('admin/income') ||
                            Request::is('admin/expense') ||
                            Request::is('admin/transaction') ||
                            Request::is('admin/income_records') ||
                            Request::is('admin/expense_records')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Transactions list')): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-money-bill-alt"></i>
                                    <p>
                                        <?php echo app('translator')->get('menu.transactions'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('income.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/income') || Request::is('admin/income_records')): ?> active <?php endif; ?>">
                                            <i class="fa fa-newspaper nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.manage_income'); ?></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('expense.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/expense') || Request::is('admin/expense_records')): ?> active <?php endif; ?>">
                                            <i class="fa fa-newspaper nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.manage_expense'); ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if(Request::is('admin/transactions*') ||
                            Request::is('admin/bookings*') ||
                            Request::is('admin/bookings_calendar') ||
                            Request::is('admin/booking-quotation*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Bookings list', 'Bookings add', 'BookingQuotations list'])): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-address-card"></i>
                                    <p>
                                        <?php echo app('translator')->get('menu.bookings'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bookings add')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('bookings.create')); ?>"
                                            class="nav-link <?php if(Request::is('admin/bookings/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-address-book nav-icon "></i>
                                            <p>
                                                <?php echo app('translator')->get('menu.newbooking'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bookings list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('bookings.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/bookings*') && !Request::is('admin/bookings/create') && !Request::is('admin/bookings_calendar')): ?> active <?php endif; ?>">
                                            <i class="fa fa-tasks nav-icon"></i>
                                            <p>
                                                <?php echo app('translator')->get('menu.manage_bookings'); ?></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/transactions')); ?>"
                                            class="nav-link <?php if(Request::is('admin/transactions')): ?> active <?php endif; ?>">
                                            <i class="fa fa-money-bill-alt nav-icon"></i>
                                            <p>
                                                <?php echo app('translator')->get('fleet.transactions'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('BookingQuotations list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('booking-quotation.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/booking-quotation*')): ?> active <?php endif; ?>">
                                            <i class="fa fa-quote-left nav-icon"></i>
                                            <p>
                                                <?php echo app('translator')->get('fleet.booking_quotes'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bookings list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('bookings.calendar')); ?>"
                                            class="nav-link <?php if(Request::is('admin/bookings_calendar')): ?> active <?php endif; ?>">
                                            <i class="fa fa-calendar nav-icon"></i>
                                            <p>
                                                <?php echo app('translator')->get('menu.calendar'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                            

                            
                            <?php if(Request::is('admin/reports*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Reports list')): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-book"></i>
                                    <p>
                                        <?php echo app('translator')->get('menu.reports'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/reports/scheduled')); ?>"
                                            class="nav-link <?php if(Request::is('admin/reports/scheduled')): ?> active <?php endif; ?>">
                                            <i class="fa fa-credit-card nav-icon"></i>
                                            <p>Scheduled Reports</p>
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/reports/generate')); ?>"
                                            class="nav-link <?php if(Request::is('admin/reports/generate')): ?> active <?php endif; ?>">
                                            <i class="fa fa-money-bill-alt nav-icon"></i>
                                            <p>Create Report</p>
                                        </a>
                                    </li>
                                    

                                    

                                </ul>
                            </li>
                            <?php endif; ?>


                            

                            

                            <?php if(Request::is('admin/notes*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Notes list', 'Notes add'])): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-sticky-note"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.notes'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Notes list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('notes.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/notes*') && !Request::is('admin/notes/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-flag nav-icon"></i>
                                            <p> <?php echo app('translator')->get('fleet.manage_note'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Notes add')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('notes.create')); ?>"
                                            class="nav-link <?php if(Request::is('admin/notes/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-plus-square nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.create_note'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>
                            <!-- Maintenance -->
                            
                            <?php if(Request::is('admin/testimonials*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Testimonials list', 'Testimonials add'])): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-quote-left"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.testimonials'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Testimonials list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('testimonials.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/testimonials*') && !Request::is('admin/testimonials/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-tasks nav-icon"></i>
                                            <p> <?php echo app('translator')->get('fleet.manage_testimonial'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Testimonials add')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('testimonials.create')); ?>"
                                            class="nav-link <?php if(Request::is('admin/testimonials/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-plus-square nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.add_testimonial'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>



                            <?php if(Request::is('admin/team*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Team list', 'Team add'])): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.team'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Team list')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('team.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/team*') && !Request::is('admin/team/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-tasks nav-icon"></i>
                                            <p> <?php echo app('translator')->get('fleet.manage_team'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Team add')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('team.create')); ?>"
                                            class="nav-link <?php if(Request::is('admin/team/create')): ?> active <?php endif; ?>">
                                            <i class="fa fa-user-plus nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.addMember'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if(Request::is('admin/settings*') ||
                            Request::is('admin/fare-settings') ||
                            Request::is('admin/api-settings') ||
                            Request::is('admin/expensecategories*') ||
                            Request::is('admin/incomecategories*') ||
                            Request::is('admin/expensecategories*') ||
                            Request::is('admin/send-email') ||
                            Request::is('admin/set-email') ||
                            Request::is('admin/cancel-reason*') ||
                            Request::is('admin/frontend-settings*') ||
                            Request::is('admin/company-services*') ||
                            Request::is('admin/payment-settings*') ||
                            Request::is('admin/twilio-settings*') ||
                            Request::is('admin/chat-settings*')): ?>
                            <?php ($class = 'menu-open'); ?>
                            <?php ($active = 'active'); ?>
                            <?php else: ?>
                            <?php ($class = ''); ?>
                            <?php ($active = ''); ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Settings list')): ?>
                            <li class="nav-item has-treeview <?php echo e($class); ?>">
                                <a href="#" class="nav-link <?php echo e($active); ?>">
                                    <i class="nav-icon fa fa-gear"></i>
                                    <p>
                                        <?php echo app('translator')->get('menu.settings'); ?>
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="<?php echo e(route('settings.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/settings')): ?> active <?php endif; ?>">
                                            <i class="fa fa-gear nav-icon"></i>
                                            <p><?php echo app('translator')->get('menu.general_settings'); ?></p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/api-settings')); ?>"
                                            class="nav-link <?php if(Request::is('admin/api-settings')): ?> active <?php endif; ?>">
                                            <i class="fa fa-gear nav-icon"></i>
                                            <p><?php echo app('translator')->get('menu.api_settings'); ?></p>
                                        </a>
                                    </li>
                                    <?php if(Auth::user()->user_type == 'S'): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/payment-settings')); ?>"
                                            class="nav-link <?php if(Request::is('admin/payment-settings')): ?> active <?php endif; ?>">
                                            <i class="fa fa-gear nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.payment_settings'); ?></p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/twilio-settings')); ?>"
                                            class="nav-link <?php if(Request::is('admin/twilio-settings')): ?> active <?php endif; ?>">
                                            <i class="fa fa-gear nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.twilio_settings'); ?></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('chat_settings.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/chat-settings')): ?> active <?php endif; ?>">
                                            <i class="fa fa-gear nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.chat'); ?> <?php echo app('translator')->get('menu.settings'); ?></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('cancel-reason.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/cancel-reason*')): ?> active <?php endif; ?>">
                                            <i class="fa fa-ban nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.cancellation'); ?></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/send-email')); ?>"
                                            class="nav-link <?php if(Request::is('admin/send-email')): ?> active <?php endif; ?>">
                                            <i class="fa fa-envelope nav-icon"></i>
                                            <p><?php echo app('translator')->get('menu.email_notification'); ?></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/set-email')); ?>"
                                            class="nav-link <?php if(Request::is('admin/set-email')): ?> active <?php endif; ?>">
                                            <i class="fa fa-envelope-open nav-icon"></i>
                                            <p><?php echo app('translator')->get('menu.email_content'); ?></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/fare-settings')); ?>"
                                            class="nav-link <?php if(Request::is('admin/fare-settings')): ?> active <?php endif; ?>">
                                            <i class="fa fa-gear nav-icon"></i>
                                            <p><?php echo app('translator')->get('menu.fare_settings'); ?></p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?php echo e(route('expensecategories.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/expensecategories*')): ?> active <?php endif; ?>">
                                            <i class="fa fa-tasks nav-icon"></i>
                                            <p><?php echo app('translator')->get('menu.expenseCategories'); ?></p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?php echo e(route('incomecategories.index')); ?>"
                                            class="nav-link <?php if(Request::is('admin/incomecategories*')): ?> active <?php endif; ?>">
                                            <i class="fa fa-tasks nav-icon"></i>
                                            <p><?php echo app('translator')->get('menu.incomeCategories'); ?></p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/frontend-settings')); ?>"
                                            class="nav-link <?php if(Request::is('admin/frontend-settings')): ?> active <?php endif; ?>">
                                            <i class="fa fa-address-card nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.frontend_settings'); ?></p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?php echo e(url('admin/company-services')); ?>"
                                            class="nav-link <?php if(Request::is('admin/company-services*')): ?> active <?php endif; ?>">
                                            <i class="fa fa-tasks nav-icon"></i>
                                            <p><?php echo app('translator')->get('fleet.companyServices'); ?></p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if(Hyvikk::api('api_key') != null && Hyvikk::api('db_url') != null): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/driver-maps')); ?>"
                                    class="nav-link <?php if(Request::is('admin/driver-maps') || Request::is('admin/track-driver*')): ?> active <?php endif; ?>">
                                    <i class="nav-icon fa fa-map"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.maps'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <?php endif; ?>
                            <!-- super-admin -->

                            <?php if(Hyvikk::api('api') && Hyvikk::api('driver_review') == 1): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/reviews')); ?>"
                                    class="nav-link <?php if(Request::is('admin/reviews')): ?> active <?php endif; ?>">
                                    <i class="nav-icon fa fa-star"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.reviews'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Inquiries list')): ?>
                            <?php if(in_array(Auth::user()->user_type, ['S', 'O'])): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/messages')); ?>"
                                    class="nav-link <?php if(Request::is('admin/messages')): ?> active <?php endif; ?>">
                                    <i class="nav-icon fa fa-comments"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.inquiries'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php if(Auth::user()->user_type == 'S'): ?>
                            <li class="nav-item">
                                <a href="https://goo.gl/forms/PtzIirmT3ap8m5dY2" target="_blank" class="nav-link">
                                    <i class="nav-icon fa fa-comment"></i>
                                    <p>
                                        <?php echo app('translator')->get('fleet.helpus'); ?>
                                        <span class="right badge badge-danger"></span>
                                    </p>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>

        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"><?php echo $__env->yieldContent('heading'); ?> </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <?php if(!Request::is('admin')): ?>
                                <li class="breadcrumb-item"><a href="<?php echo e(url('admin/')); ?>"><?php echo app('translator')->get('fleet.home'); ?></a></li>
                                <?php endif; ?>
                                <?php echo $__env->yieldContent('breadcrumb'); ?>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php echo $__env->yieldContent('content'); ?>
                </div><!-- /.container-fluid -->
            </section>
            <div id="chat-overlay" class="row"></div>
            <audio id="chat-alert-sound" style="display: none">
                <source src="<?php echo e(asset('assets/chats/sound.mp3')); ?>" />
            </audio>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <?php echo Hyvikk::get('web_footer'); ?>

            <div class="float-right d-none d-sm-inline-block">
                <b><?php echo app('translator')->get('fleet.version'); ?></b> 6.1
            </div>
        </footer>



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php echo $__env->yieldContent('script2'); ?>
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/iCheck/icheck.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/fastclick/fastclick.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/cdn/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/cdn/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/cdn/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/adminlte.js')); ?>"></script>
    <script src="<?php echo e(asset('web-sw.js?v3')); ?>"></script>
    <script>
        $('[title]').tooltip();

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('<?php echo e(asset('web-sw.js?v3')); ?>', {
                scope: '.' // <--- THIS BIT IS REQUIRED
            }).then(function(registration) {
                // Registration was successful
                // console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }, function(err) {
                // registration failed :(
                // console.log('ServiceWorker registration failed: ', err);
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("input[type=search]").on("keydown", function() {
                if (this.value.length > 0) {
                    $(".nav-sidebar li").hide().filter(function() {
                        return $(this).text().toLowerCase().indexOf($("input[type=search]").val()
                            .toLowerCase()) != -1;
                    }) //.show(); 
                } else {
                    $(".nav-sidebar li").show();
                }
            });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });
            $('#data_table tfoot th').each(function() {
                // console.log($('#data_table tfoot th').length);
                if ($(this).index() != 0 && $(this).index() != $('#data_table tfoot th').length - 1) {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="' + title + '" />');
                }
            });

            $('#ajax_data_table tfoot th').each(function() {
                // console.log($('#data_table tfoot th').length);
                if ($(this).index() != 0 && $(this).index() != $('#data_table tfoot th').length - 1) {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="' + title + '" />');
                }
            });

            $('#data_table1 tfoot th').each(function() {
                // console.log($(this).index());
                if ($(this).index() != 0 && $(this).index() != $('#data_table1 tfoot th').length - 1) {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="' + title + '" />');
                }

            });

            var table1 = $('#data_table1').DataTable({
                dom: 'Bfrtip',

                buttons: [{
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> <?php echo e(__('fleet.print')); ?>',

                    exportOptions: {
                        columns: ([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
                    },
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '10pt')
                            .prepend(
                                '<h3><?php echo e(__('fleet.bookings')); ?></h3>'
                            );
                        $(win.document.body).find('table')
                            .addClass('table-bordered');
                        // $(win.document.body).find( 'td' ).css( 'font-size', '10pt' );

                    }
                }],
                "language": {
                    "url": '<?php echo e(asset('assets/datatables/') . '/' . __('fleet.datatable_lang')); ?>',
                },
                columnDefs: [{
                    orderable: false,
                    targets: [0]
                }],
                // individual column search
                "initComplete": function() {
                    table1.columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function() {
                            that.search(this.value).draw();
                        });
                    });
                }
            });

            var table = $('#data_table').DataTable({
                "language": {
                    "url": '<?php echo e(asset('assets/datatables/') . '/' . __('fleet.datatable_lang')); ?>',
                },
                columnDefs: [{
                    orderable: false,
                    targets: [0]
                }],
                // individual column search
                "initComplete": function() {
                    table.columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function() {
                            // console.log($(this).parent().index());
                            that.search(this.value).draw();
                        });
                    });
                }
            });
            $('[data-toggle="tooltip"]').tooltip();

        });
    </script>
    <script src="<?php echo e(asset('assets/js/pnotify.custom.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-countto/1.1.0/jquery.countTo.min.js"
        integrity="sha512-ZbM86dAmjIe3nPA2k8j3G//NO/zBYNnZ8wi+yUKh8VH24CHr0aDhDHoEM4IvGl+Sz6ga7ONnGBDxS+BTVJ+K2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php echo $__env->yieldContent('script'); ?>
    <script>
        var base_url = '<?php echo e(url('/')); ?>';
    </script>
</body>

</html><?php /**PATH /var/www/html/whistler/framework/resources/views/layouts/app.blade.php ENDPATH**/ ?>