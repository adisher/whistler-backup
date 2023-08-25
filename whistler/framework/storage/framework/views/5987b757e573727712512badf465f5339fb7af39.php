<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo e(Hyvikk::get('app_name')); ?></title>
  <!-- Tell be browser to be responsive to screen widb -->
  <meta content="widb=device-widb, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
 <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/cdn/bootstrap.min.css')); ?>" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/cdn/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link href="<?php echo e(asset('assets/css/cdn/ionicons.min.css')); ?>" rel="stylesheet">
  <!-- beme style -->
   <link href="<?php echo e(asset('assets/css/AdminLTE.min.css')); ?>" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view be page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/cdn/fonts.css')); ?>">
  <style type="text/css">
    body {
      height: auto;
    }
  </style>
</head>
<body onload="window.print();">
  <?php ($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y'); ?>
  <div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <span class="logo-lg">
          <img src="<?php echo e(asset('assets/images/'. Hyvikk::get('icon_img') )); ?>" class="navbar-brand" style="margin-top: -15px">
          <?php echo e(Hyvikk::get('app_name')); ?>

          </span>

          <small class="pull-right"> <b><?php echo app('translator')->get('fleet.date'); ?> :</b> <?php echo e(date($date_format_setting)); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      <div class="col-md-12 text-center">
        <h3><?php echo app('translator')->get('fleet.vehicle_inspection'); ?>&nbsp;<small><?php echo e($review->vehicle->make_name); ?>-<?php echo e($review->vehicle->model_name); ?>-<?php echo e($review->vehicle->types['displayname']); ?></small></h3>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table" id="data_table">
          <tr>
            <td><b><?php echo app('translator')->get('fleet.vehicle'); ?>: </b>
            <?php echo e($review->vehicle->make_name); ?> - <?php echo e($review->vehicle->model_name); ?> - <?php echo e($review->vehicle->types['displayname']); ?></td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.review_by'); ?>: </b>
              <?php echo e($review->user->name); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.reg_no'); ?>: </b>
            <?php echo e($review->reg_no); ?></td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.kms_out'); ?> (<?php echo e(Hyvikk::get('dis_format')); ?>): </b>
            <?php echo e($review->kms_outgoing); ?> <?php echo e(Hyvikk::get('dis_format')); ?></td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.kms_in'); ?> (<?php echo e(Hyvikk::get('dis_format')); ?>): </b>
            <?php echo e($review->kms_incoming); ?> <?php echo e(Hyvikk::get('dis_format')); ?></td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.fuel_out'); ?>: </b>

              <?php if($review->fuel_level_out == 0): ?> 1/4 <?php endif; ?>
              <?php if($review->fuel_level_out == 1): ?> 1/2 <?php endif; ?>
              <?php if($review->fuel_level_out == 2): ?> 3/4 <?php endif; ?>
              <?php if($review->fuel_level_out == 3): ?> Full Tank <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.fuel_in'); ?>: </b>

              <?php if($review->fuel_level_in == 0): ?> 1/4 <?php endif; ?>
              <?php if($review->fuel_level_in == 1): ?> 1/2 <?php endif; ?>
              <?php if($review->fuel_level_in == 2): ?> 3/4 <?php endif; ?>
              <?php if($review->fuel_level_in == 3): ?> Full Tank <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.datetime_out'); ?>: </b>
            <?php echo e(date($date_format_setting.' g:i A',strtotime($review->datetime_outgoing))); ?></td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.datetime_in'); ?>: </b>
            <?php echo e(date($date_format_setting.' g:i A',strtotime($review->datetime_incoming))); ?></td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.petrol_card'); ?>: </b>

              <?php ($petrol_card=unserialize($review->petrol_card)); ?>
              <?php if($petrol_card['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($petrol_card['flag'] == 0 && $petrol_card['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp;<?php echo e($petrol_card['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.lights'); ?>: </b>

              <?php ($light=unserialize($review->lights)); ?>
              <?php if($light['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($light['flag'] == 0 && $light['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($light['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.invertor'); ?>: </b>

              <?php ($invertor=unserialize($review->invertor)); ?>
              <?php if($invertor['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($invertor['flag'] == 0 && $invertor['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($invertor['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.car_mats'); ?>: </b>

              <?php ($car_mat=unserialize($review->car_mats)); ?>
              <?php if($car_mat['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($car_mat['flag'] == 0 && $car_mat['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($car_mat['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.int_damage'); ?>: </b>

               <?php ($int_damage=unserialize($review->int_damage)); ?>
                <?php if($int_damage['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                  <?php if($int_damage['flag'] == 0 && $int_damage['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                  &nbsp; <?php echo e($int_damage['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.int_lights'); ?>: </b>

              <?php ($int_lights=unserialize($review->int_lights)); ?>
              <?php if($int_lights['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($int_lights['flag'] == 0 && $int_lights['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($int_lights['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.ext_car'); ?>: </b>

              <?php ($ext_car=unserialize($review->ext_car)); ?>
              <?php if($ext_car['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($ext_car['flag'] == 0 && $ext_car['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($ext_car['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.tyre'); ?>: </b>

              <?php ($tyre=unserialize($review->tyre)); ?>
              <?php if($tyre['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($tyre['flag'] == 0 && $tyre['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($tyre['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.ladder'); ?>: </b>

              <?php ($ladder=unserialize($review->ladder)); ?>
              <?php if($ladder['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($ladder['flag'] == 0 && $ladder['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($ladder['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.leed'); ?>: </b>

              <?php ($leed=unserialize($review->leed)); ?>
              <?php if($leed['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($leed['flag'] == 0 && $leed['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($leed['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.power_tool'); ?> : </b>

              <?php ($power_tool=unserialize($review->power_tool)); ?>
              <?php if($power_tool['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($power_tool['flag'] == 0 && $power_tool['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($power_tool['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.ac'); ?>: </b>

              <?php ($ac=unserialize($review->ac)); ?>
              <?php if($ac['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($ac['flag'] == 0 && $ac['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($ac['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.head_light'); ?>: </b>

              <?php ($head_light=unserialize($review->head_light)); ?>
              <?php if($head_light['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($head_light['flag'] == 0 && $head_light['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($head_light['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.lock'); ?>: </b>

              <?php ($lock=unserialize($review->lock)); ?>
              <?php if($lock['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($lock['flag'] == 0 && $lock['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($lock['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.windows'); ?>: </b>

              <?php ($windows=unserialize($review->windows)); ?>
              <?php if($windows['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($windows['flag'] == 0 && $windows['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($windows['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.condition'); ?>: </b>

              <?php ($condition=unserialize($review->condition)); ?>
              <?php if($condition['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($condition['flag'] == 0 && $condition['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($condition['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.oil_chk'); ?>: </b>

              <?php ($oil_chk=unserialize($review->oil_chk)); ?>
              <?php if($oil_chk['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($oil_chk['flag'] == 0 && $oil_chk['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($oil_chk['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.suspension'); ?>: </b>

              <?php ($suspension=unserialize($review->suspension)); ?>
              <?php if($suspension['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($suspension['flag'] == 0 && $suspension['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($suspension['text']); ?>

            </td>
          </tr>
          <tr>
            <td><b><?php echo app('translator')->get('fleet.tool_box'); ?>: </b>

              <?php ($tool_box=unserialize($review->tool_box)); ?>
              <?php if($tool_box['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
                <?php if($tool_box['flag'] == 0 && $tool_box['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
                &nbsp; <?php echo e($tool_box['text']); ?>

            </td>
          </tr>
        </table>
      </div>
    </div>
  </section>
  </div>
  <!-- ./wrapper -->
</body>
</html><?php /**PATH /var/www/html/whistler/framework/resources/views/vehicles/print_vehicle_review.blade.php ENDPATH**/ ?>