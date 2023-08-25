<?php $__env->startSection('extra_css'); ?>
<style type="text/css">
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
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('maintenance.index')); ?>"> Corrective Maintenance </a></li>
<li class="breadcrumb-item active">Edit Maintenance</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Maintenance</h3>
      </div>

      <div class="card-body">
        <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
          <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
        <?php endif; ?>


        <?php echo Form::open(['route' => ['maintenance.update',$maintenance->id],'files'=>true,'method'=>'PATCH']); ?>

        <?php echo Form::hidden('id',$maintenance->id); ?>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('vehicle_id',__('Select Vehicle/Equipment'). ' <span class="text-danger">*</span>',
              ['class' =>
              'form-label'], false); ?>

              <select name="vehicle_id" class="form-control" id="vehicle_id">
                <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($vehicle->id); ?>" <?php if(old('vehicle_id', $maintenance->vehicle_id) == $vehicle->id): ?>
                  selected
                  <?php endif; ?>>
                  <?php echo e($vehicle->vehicleData->make); ?> - <?php echo e($vehicle->vehicleData->model); ?> - <?php echo e($vehicle->license_plate); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="form-group">
              <?php echo Form::label('date', __('Date'), ['class' => 'form-label']); ?>

              <?php echo Form::date('date', $maintenance->date,['class' => 'form-control','required']); ?>

            </div>
            <div class="form-group">
              <?php echo Form::label('subject', __('Subject'), ['class' => 'form-label']); ?>

              <?php echo Form::text('subject', $maintenance->subject,['class' => 'form-control','required']); ?>

            </div>
            <div class="form-group">
              <?php echo Form::label('files', __('Select Image'), ['class' => 'form-label']); ?>

              <?php echo Form::file('files',['class' => 'form-control']); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('description', __('Description'), ['class' => 'form-label']); ?>

              <?php echo Form::textarea('description', $maintenance->description,['class' => 'form-control']); ?>

            </div>
          </div>
        </div>
        <div class="col-md-12">
          <?php echo Form::submit(__('fleet.update'), ['class' => 'btn btn-success']); ?>

        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#group_id').select2({placeholder: "<?php echo app('translator')->get('fleet.selectGroup'); ?>"});
    $('#role_id').select2({placeholder: "<?php echo app('translator')->get('fleet.role'); ?>"});
    //Flat green color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/maintenance/edit.blade.php ENDPATH**/ ?>