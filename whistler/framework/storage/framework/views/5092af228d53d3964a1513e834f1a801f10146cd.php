<?php $__env->startSection('extra_css'); ?>
<style type="text/css">
  .custom{
  min-width: 50px;
  left: -105px !important;
  right: 0;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="<?php echo e(url('admin/vehicle-reviews')); ?>"><?php echo app('translator')->get('Fleet Inspection'); ?></a></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('View Fleet Inspection'); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php ($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title"><?php echo app('translator')->get('Fleet Inspection'); ?> : <?php echo e($review->vehicle->makeModel->make); ?> - <?php echo e($review->vehicle->makeModel->model); ?> - <?php echo e($review->vehicle->license_plate); ?>&nbsp; <a href="<?php echo e(url('admin/print-vehicle-review/'.$review->id)); ?>" class="btn btn-danger"><i class="fa fa-print"></i>&nbsp; <?php echo app('translator')->get('fleet.print'); ?></a></h3>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <?php echo Form::label('vehicle_id',__('Fleet')." : ", ['class' => 'form-label']); ?>

              <?php echo e($review->vehicle->makeModel->make); ?> - <?php echo e($review->vehicle->makeModel->model); ?> - <?php echo e($review->vehicle->license_plate); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('kms_out',__('fleet.kms_out')." (".Hyvikk::get('dis_format').") : ", ['class' => 'form-label']); ?>

              <?php echo e($review->kms_outgoing); ?> <?php echo e(Hyvikk::get('dis_format')); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('kms_in',__('fleet.kms_in')." (".Hyvikk::get('dis_format').") : ", ['class' => 'form-label']); ?>

              <?php echo e($review->kms_incoming); ?> <?php echo e(Hyvikk::get('dis_format')); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('fuel_out',__('fleet.fuel_out')." : ", ['class' => 'form-label']); ?>

              <?php if($review->fuel_level_out == 0): ?> 1/4 <?php endif; ?>
              <?php if($review->fuel_level_out == 1): ?> 1/2 <?php endif; ?>
              <?php if($review->fuel_level_out == 2): ?> 3/4 <?php endif; ?>
              <?php if($review->fuel_level_out == 3): ?> Full Tank <?php endif; ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('fuel_in',__('fleet.fuel_in')." : ", ['class' => 'form-label']); ?>

              <?php if($review->fuel_level_in == 0): ?> 1/4 <?php endif; ?>
              <?php if($review->fuel_level_in == 1): ?> 1/2 <?php endif; ?>
              <?php if($review->fuel_level_in == 2): ?> 3/4 <?php endif; ?>
              <?php if($review->fuel_level_in == 3): ?> Full Tank <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('datetime_out',__('fleet.datetime_out')." : ", ['class' => 'form-label']); ?>

              <?php echo e(date($date_format_setting.' g:i A',strtotime($review->datetime_outgoing))); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('datetime_in',__('fleet.datetime_in')." : ", ['class' => 'form-label']); ?>

              <?php echo e(date($date_format_setting.' g:i A',strtotime($review->datetime_incoming))); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?php ($petrol_card=unserialize($review->petrol_card)); ?>
            <div class="form-group">
              <?php echo Form::label('petrol_card',__('fleet.petrol_card')." : ", ['class' => 'form-label']); ?>

              <?php if($petrol_card['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($petrol_card['flag'] == 0 && $petrol_card['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp;<?php echo e($petrol_card['text']); ?>

            </div>
          </div>

          <div class="col-md-6">
            <?php ($light=unserialize($review->lights)); ?>
            <div class="form-group">
              <?php echo Form::label('lights',__('fleet.lights')." : ", ['class' => 'form-label']); ?>

              <?php if($light['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($light['flag'] == 0 && $light['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($light['text']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?php ($invertor=unserialize($review->invertor)); ?>
            <div class="form-group">
              <?php echo Form::label('invertor',__('fleet.invertor')." : ", ['class' => 'form-label']); ?>

              <?php if($invertor['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($invertor['flag'] == 0 && $invertor['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($invertor['text']); ?>

            </div>
          </div>

          <div class="col-md-6">
            <?php ($car_mat=unserialize($review->car_mats)); ?>
            <div class="form-group">
              <?php echo Form::label('car_mats',__('fleet.car_mats')." : ", ['class' => 'form-label']); ?>

              <?php if($car_mat['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($car_mat['flag'] == 0 && $car_mat['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($car_mat['text']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?php ($int_damage=unserialize($review->int_damage)); ?>
            <div class="form-group">
              <?php echo Form::label('int_damage',__('fleet.int_damage')." : ", ['class' => 'form-label']); ?>

              <?php if($int_damage['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($int_damage['flag'] == 0 && $int_damage['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($int_damage['text']); ?>

            </div>
          </div>

          <div class="col-md-6">
            <?php ($int_lights=unserialize($review->int_lights)); ?>
            <div class="form-group">
              <?php echo Form::label('int_lights',__('fleet.int_lights')." : ", ['class' => 'form-label']); ?>

              <?php if($int_lights['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($int_lights['flag'] == 0 && $int_lights['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($int_lights['text']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?php ($ext_car=unserialize($review->ext_car)); ?>
            <div class="form-group">
              <?php echo Form::label('ext_car',__('fleet.ext_car')." : ", ['class' => 'form-label']); ?>

              <?php if($ext_car['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($ext_car['flag'] == 0 && $ext_car['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($ext_car['text']); ?>

            </div>
          </div>

          <div class="col-md-6">
            <?php ($tyre=unserialize($review->tyre)); ?>
            <div class="form-group">
            <?php echo Form::label('tyre',__('fleet.tyre')." : ", ['class' => 'form-label']); ?>

            <?php if($tyre['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
            <?php if($tyre['flag'] == 0 && $tyre['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
            &nbsp; <?php echo e($tyre['text']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?php ($ladder=unserialize($review->ladder)); ?>
            <div class="form-group">
              <?php echo Form::label('ladder',__('fleet.ladder')." : ", ['class' => 'form-label']); ?>

              <?php if($ladder['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($ladder['flag'] == 0 && $ladder['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($ladder['text']); ?>

            </div>
          </div>

          <div class="col-md-6">
            <?php ($leed=unserialize($review->leed)); ?>
            <div class="form-group">
              <?php echo Form::label('leed',__('fleet.leed')." : ", ['class' => 'form-label']); ?>

              <?php if($leed['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($leed['flag'] == 0 && $leed['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($leed['text']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?php ($power_tool=unserialize($review->power_tool)); ?>
            <div class="form-group">
              <?php echo Form::label('power_tool',__('fleet.power_tool')." : ", ['class' => 'form-label']); ?>

              <?php if($power_tool['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($power_tool['flag'] == 0 && $power_tool['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($power_tool['text']); ?>

            </div>
          </div>

          <div class="col-md-6">
            <?php ($ac=unserialize($review->ac)); ?>
            <div class="form-group">
              <?php echo Form::label('ac',__('fleet.ac')." : ", ['class' => 'form-label']); ?>

              <?php if($ac['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($ac['flag'] == 0 && $ac['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($ac['text']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?php ($head_light=unserialize($review->head_light)); ?>
            <div class="form-group">
              <?php echo Form::label('head_light',__('fleet.head_light')." : ", ['class' => 'form-label']); ?>

              <?php if($head_light['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($head_light['flag'] == 0 && $head_light['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($head_light['text']); ?>

            </div>
          </div>

          <div class="col-md-6">
            <?php ($lock=unserialize($review->lock)); ?>
            <div class="form-group">
              <?php echo Form::label('lock',__('fleet.lock')." : ", ['class' => 'form-label']); ?>

              <?php if($lock['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($lock['flag'] == 0 && $lock['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($lock['text']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?php ($windows=unserialize($review->windows)); ?>
            <div class="form-group">
              <?php echo Form::label('windows',__('fleet.windows')." : ", ['class' => 'form-label']); ?>

              <?php if($windows['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($windows['flag'] == 0 && $windows['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($windows['text']); ?>

            </div>
          </div>

          <div class="col-md-6">
            <?php ($condition=unserialize($review->condition)); ?>
            <div class="form-group">
              <?php echo Form::label('condition',__('fleet.condition')." : ", ['class' => 'form-label']); ?>

              <?php if($condition['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($condition['flag'] == 0 && $condition['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($condition['text']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?php ($oil_chk=unserialize($review->oil_chk)); ?>
            <div class="form-group">
              <?php echo Form::label('oil_chk',__('fleet.oil_chk')." : ", ['class' => 'form-label']); ?>

              <?php if($oil_chk['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($oil_chk['flag'] == 0 && $oil_chk['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($oil_chk['text']); ?>

            </div>
          </div>

          <div class="col-md-6">
            <?php ($suspension=unserialize($review->suspension)); ?>
            <div class="form-group">
              <?php echo Form::label('suspension',__('fleet.suspension')." : ", ['class' => 'form-label']); ?>

              <?php if($suspension['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($suspension['flag'] == 0 && $suspension['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($suspension['text']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <?php ($tool_box=unserialize($review->tool_box)); ?>
            <div class="form-group">
              <?php echo Form::label('tool_box',__('fleet.tool_box')." : ", ['class' => 'form-label']); ?>

              <?php if($tool_box['flag'] == 1): ?> <i class="fa fa-check fa-lg"></i> <?php endif; ?>
              <?php if($tool_box['flag'] == 0 && $tool_box['flag'] != null): ?> <i class="fa fa-times fa-lg"></i> <?php endif; ?>
              &nbsp; <?php echo e($tool_box['text']); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/vehicles/view_vehicle_review.blade.php ENDPATH**/ ?>