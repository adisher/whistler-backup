<?php $__env->startSection('extra_css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item "><a href="<?php echo e(route('work_order.index')); ?>">Manage Fleet Utilization </a></li>
<li class="breadcrumb-item active">Edit Fleet Utilization</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Fleet Utilization</h3>
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

        <?php echo Form::open(['route' => ['work_order.update',$data->id],'method'=>'PATCH']); ?>

        <?php echo Form::hidden('user_id',Auth::user()->id); ?>

        <?php echo Form::hidden('id',$data->id); ?>

        <?php echo Form::hidden('type','Updated'); ?>


        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('vehicle_id',__('Select Vehicle/Equipment'). ' <span class="text-danger">*</span>',
              ['class' =>
              'form-label'], false); ?>

              <select name="vehicle_id" class="form-control" id="vehicle_id">
                <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($vehicle->id); ?>" <?php if(old('vehicle_id', $data->vehicle_id) == $vehicle->id): ?>
                  selected
                  <?php endif; ?>>
                  <?php echo e($vehicle->vehicleData->make); ?> - <?php echo e($vehicle->vehicleData->model); ?> - <?php echo e($vehicle->license_plate); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="form-group">
              <?php echo Form::label('site_id',__('Select Site'). ' <span class="text-danger">*</span>', ['class' =>
              'form-label'], false); ?>

              <select id="site_id" name="site_id" class="form-control" required>
                <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s->id); ?>" <?php if(old('site_id', $data->site_id) == $s->id): ?>
                  selected
                  <?php endif; ?>> <?php echo e($s->site_name); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="form-group">
              <?php echo Form::label('date', __('Date'). ' <span class="text-danger">*</span>', ['class' => 'form-label'],
              false); ?>

              <?php echo Form::date('date',$data->date,['class'=>'form-control', 'required']); ?>

            </div>

            <div class="form-group">
              <?php echo Form::label('shift_id',__('Select Shift'). ' <span class="text-danger">*</span>', ['class' =>
              'form-label'],
              false); ?>

              <select id="shift_id" name="shift_id" class="form-control" required>
                <option value="" disabled>Select Shift</option>
                <option value="1" <?php if($data->shift_id == '1'): ?> selected <?php endif; ?>>Morning</option>
                <option value="2" <?php if($data->shift_id == '2'): ?> selected <?php endif; ?>>Evening</option>
              </select>
            </div>
            <div class="form-group" id="work_hours_div">
              <?php echo Form::label('work_hours', __('Work Hours'), ['class' =>
              'form-label']); ?>

              <?php echo Form::number('work_hours',$data->work_hours,['class'=>'form-control']); ?>

            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('price', __('Cost'), ['class' => 'form-label']); ?>

              <?php echo Form::number('price',$data->price,['class'=>'form-control', 'readonly']); ?>

            </div>
            <div class="form-group">
              <?php echo Form::label('description',__('fleet.description'), ['class' => 'form-label']); ?>

              <?php echo Form::textarea('description',$data->description,['class'=>'form-control','size'=>'30x4']); ?>

            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
            <?php echo Form::submit(__('fleet.update'), ['class' => 'btn btn-success']); ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection("script"); ?>
<script src="<?php echo e(asset('assets/js/moment.js')); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript">
  $(document).ready(function() {
  $('#vehicle_id').select2({placeholder: "Select Vehicle/Equipment"});
  $('#site_id').select2({placeholder: "Select Sitet"});
  $('#vendor_id').select2({placeholder: "<?php echo app('translator')->get('fleet.select_vendor'); ?>"});
  $('#mechanic_id').select2({placeholder: "<?php echo app('translator')->get('fleet.select_mechanic'); ?>"});
  $('#select_part').select2({placeholder: "<?php echo app('translator')->get('fleet.selectPart'); ?>"});
  $('#required_by').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });
  $('#created_on').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

    var workHours = $('input[name="work_hours"]').val();
    
    $('#vehicle_id').change(function() {
    var vehicleId = $(this).val();
    var url = "<?php echo e(route('vehicles.expense', ['id' => ':id'])); ?>".replace(':id', vehicleId);
    $.get(url, function(vehicleData) {
    if(vehicleData.expense_type === 'rental'){
    var cost = workHours * vehicleData.expense_amount;
    $('input[name="price"]').val(cost);
    } else {
    $('input[name="price"]').val(0);
    }
    });
    });
    
    $('input[name="work_hours"]').on('change keyup', function() {
    workHours = $(this).val();
    var vehicleId = $('#vehicle_id').val();
    if(vehicleId){
    var url = "<?php echo e(route('vehicles.expense', ['id' => ':id'])); ?>".replace(':id', vehicleId);
    $.get(url, function(vehicleData) {
    if(vehicleData.expense_type === 'rental'){
    var cost = workHours * vehicleData.expense_amount;
    $('input[name="price"]').val(cost);
    } else {
    $('input[name="price"]').val(0);
    }
    });
    }
    });

  //Flat green color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/work_orders/edit.blade.php ENDPATH**/ ?>