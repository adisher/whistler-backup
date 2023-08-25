<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('fuel.index')); ?>"><?php echo app('translator')->get('fleet.fuel'); ?></a></li>
<li class="breadcrumb-item active"> <?php echo app('translator')->get('fleet.edit_fuel'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card-body table-responsive">
      <div class="nav-tabs-custom">
        <ul class="nav nav-pills custom">
            <li class="nav-item"><a class="nav-link active" href="#fleet_allocation" data-toggle="tab" id="fleetAllocationLink"> 
              Edit Fleet Allocation Details
                    <i class="fa"></i></a></li>
        </ul>
    </div>
    <hr>
    <div class="tab-content">
      <div class="tab-pane active" id="fleet_allocation">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              
            </h3>
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
    
            <?php echo Form::open(['route' => ['fuel.update',$fuel_allocation->id],'method'=>'PATCH','files'=>'true']); ?>

            <?php echo Form::hidden('user_id',Auth::user()->id); ?>

            <?php echo Form::hidden('vehicle_id',$vehicle_id); ?>

            <?php echo Form::hidden('id',$fuel_allocation->id); ?>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <?php echo Form::label('vehicle_id',__('Select Fleet'), ['class' => 'form-label']); ?>

                  <select id="vehicle_id" disabled name="vehicle_id" class="form-control xxhvk" required>
                    <option selected value="<?php echo e($vehicle_id); ?>"><?php echo e($fuel_allocation->vehicle_data->vehicleData->make); ?> -
                      <?php echo e($fuel_allocation->vehicle_data->vehicleData->model); ?> - <?php echo e($fuel_allocation->vehicle_data->fleet_no); ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <?php echo Form::label('date',__('fleet.date'), ['class' => 'form-label']); ?>

                  <div class='input-group'>
                    <div class="input-group-prepend">
                      <span class="input-group-text"><span class="fa fa-calendar"></span>
                    </div>
                    <?php echo Form::text('date',$fuel_allocation->date,['class'=>'form-control','required']); ?>

                  </div>
                </div>
              <?php if($type_id == '1'): ?>
                <div class="form-group meter-reading">
                  <?php echo Form::label('meter_reading', __('Meter Reading'), ['class' => 'form-label']); ?>

                  <?php echo Form::number('meter_reading', $fuel_allocation->meter, ['class' => 'form-control']); ?>

                  <small><?php echo app('translator')->get('fleet.meter_reading'); ?></small>
                </div>
                <!-- Quantity -->
                <div class="form-group">
                  <?php echo Form::label('quantity', __('Quantity'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false); ?>

                  <?php echo Form::number('quantity', $fuel_allocation->qty, ['class' => 'form-control', 'required']); ?>

                </div>
              <?php elseif($type_id == '2'): ?> 
                <div class="form-group hours">
                  <?php echo Form::label('hours', __('Hours'), ['class' => 'form-label']); ?>

                  <?php echo Form::text('hours', $fuel_allocation->time, ['class' => 'form-control']); ?>

                </div>
                  <div class="form-group">
                  <?php echo Form::label('Quantity',__('Quantity'), ['class' => 'form-label']); ?>

                  <?php echo Form::number('quantity',$fuel_allocation->qty,['class'=>'form-control']); ?>

                </div>
              <?php endif; ?> 
    
                <div class="form-group">
                  <?php echo Form::label('image',__('fleet.select_image'), ['class' => 'form-label']); ?>

                  <?php if(!is_null($fuel_allocation->image) && file_exists('uploads/'.$fuel_allocation->image)): ?>
                    <a href="<?php echo e(url('uploads/'.$fuel_allocation->image)); ?>" target="_blank">View</a>
                  <?php endif; ?>
                  <?php echo Form::file('image',['class'=>'form-control']); ?>

                </div>
    
                <div class="form-group">
                  <?php echo Form::label('note',__('fleet.note'), ['class' => 'form-label']); ?>

                  <?php echo Form::text('note',$fuel_allocation->note,['class'=>'form-control']); ?>

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
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/moment.js')); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
<link rel="stylesheet" type="text/css"
  href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css" />
<script type="text/javascript">
  $(document).ready(function() {

  $("#vehicle_id").select2({placeholder: "<?php echo app('translator')->get('fleet.selectVehicle'); ?>"});
  $("#vendor_name").select2({placeholder: "<?php echo app('translator')->get('fleet.select_fuel_vendor'); ?>"});

  $('#date').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  });
  $('#hours').timepicker({
  'timeFormat': 'H:i',
  'step': 15
  });

  $("#date").on("dp.change", function (e) {
    var date=e.date.format("YYYY-MM-DD");
  });

  //Flat green color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  });
});
</script>
<?php $__env->stopSection(); ?>
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
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/fuel/edit.blade.php ENDPATH**/ ?>