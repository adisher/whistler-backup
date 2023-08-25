<?php $__env->startSection('extra_css'); ?>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css')); ?>">

<style type="text/css">
  .select2-selection:not(.select2-selection--multiple) {
    height: 38px !important;
  }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('drivers.index')); ?>"><?php echo app('translator')->get('fleet.drivers'); ?></a></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.edit_driver'); ?></li>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title"><?php echo app('translator')->get('fleet.edit_driver'); ?></h3>
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

        <?php echo Form::open(['route' => ['drivers.update',$driver->id],'files'=>true,'method'=>'PATCH']); ?>

        <?php echo Form::hidden('id',$driver->id); ?>

        <?php echo Form::hidden('edit',"1"); ?>

        <?php echo Form::hidden('detail_id',$driver->getMeta('id')); ?>

        <?php echo Form::hidden('user_id',Auth::user()->id); ?>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('first_name', __('fleet.firstname'). ' <span class="text-danger">*</span>', ['class' => 'form-label required'], false); ?>

              <?php echo Form::text('first_name', $driver->getMeta('first_name'),['class' => 'form-control','required']); ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('middle_name', __('fleet.middlename'), ['class' => 'form-label']); ?>

              <?php echo Form::text('middle_name', $driver->getMeta('middle_name'),['class' => 'form-control']); ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('last_name', __('fleet.lastname'). ' <span class="text-danger">*</span>', ['class' => 'form-label required'], false); ?>

              <?php echo Form::text('last_name', $driver->getMeta('last_name'),['class' => 'form-control','required']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('address', __('fleet.address'), ['class' => 'form-label required']); ?>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                </div>
                <?php echo Form::text('address', $driver->getMeta('address'),['class' => 'form-control']); ?>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::hidden('email', 'driver@email.com',['class' => 'form-control']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('phone', __('fleet.phone'). ' <span class="text-danger">*</span>', ['class' => 'form-label required'], false); ?>

              <div class="input-group">
                <div class="input-group-prepend">
                  <?php echo Form::select('phone_code',$phone_code,$driver->getMeta('phone_code'),['class' => 'form-control
                  code','required','style'=>'width:80px;']); ?>

                </div>
                <?php echo Form::number('phone', $driver->getMeta('phone'),['class' => 'form-control','required']); ?>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('emp_id', __('fleet.employee_id'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false); ?>

              <?php echo Form::text('emp_id', $driver->getMeta('emp_id'),['class' => 'form-control','required']); ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('contract_number', __('Insurance Number'), ['class' => 'form-label']); ?>

              <?php echo Form::text('contract_number', $driver->getMeta('contract_number'),['class' =>
              'form-control']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('license_number', __('fleet.licenseNumber'). ' <span class="text-danger">*</span>', ['class' => 'form-label required'], false); ?>

              <?php echo Form::text('license_number', $driver->getMeta('license_number'),['class' =>
              'form-control','required']); ?>

            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('issue_date', __('fleet.issueDate'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false); ?>

              <div class="input-group date">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <?php echo Form::text('issue_date', $driver->getMeta('issue_date'),['class' => 'form-control','required']); ?>

              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('exp_date', __('fleet.expirationDate'). ' <span class="text-danger">*</span>', ['class' => 'form-label required'], false); ?>

              <div class="input-group date">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <?php echo Form::text('exp_date', $driver->getMeta('exp_date'),['class' => 'form-control','required']); ?>

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('start_date', __('fleet.join_date'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false); ?>

              <div class="input-group date">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <?php echo Form::text('start_date', $driver->getMeta('start_date'),['class' => 'form-control']); ?>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('end_date', __('fleet.leave_date'), ['class' => 'form-label']); ?>

              <div class="input-group date">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <?php echo Form::text('end_date', $driver->getMeta('end_date'),['class' => 'form-control']); ?>

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          
          <div class="col-md-4" id="driver_commision_container" style="display: none;">
            <div class="form-group">
              <?php echo Form::label('driver_commision', __('fleet.driver_commision'), ['class' => 'form-label']); ?>              
                <?php echo Form::number('driver_commision',$driver->getMeta('driver_commision'),['class' => 'form-control']); ?>            
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('gender', __('fleet.gender') , ['class' => 'form-label']); ?><br>
              <input type="radio" name="gender" class="flat-red gender" value="1" <?php if($driver->getMeta('gender')== 1): ?>
              checked <?php endif; ?>> <?php echo app('translator')->get('fleet.male'); ?><br>
              <input type="radio" name="gender" class="flat-red gender" value="0" <?php if($driver->getMeta('gender')== 0): ?>
              checked <?php endif; ?>> <?php echo app('translator')->get('fleet.female'); ?>
            </div>
            <div class="form-group">
              <?php echo Form::label('driver_image', __('fleet.driverImage'), ['class' => 'form-label']); ?>

              <?php if($driver->getMeta('driver_image') != null): ?>
              <a href="<?php echo e(asset('uploads/'.$driver->getMeta('driver_image'))); ?>" target="_blank">View</a>
              <?php endif; ?>
              <?php echo Form::file('driver_image',null,['class' => 'form-control','required']); ?>

            </div>
            <div class="form-group">
              <?php echo Form::label('documents', __('fleet.documents'), ['class' => 'form-label']); ?>

              <?php if($driver->getMeta('documents') != null): ?>
              <a href="<?php echo e(asset('uploads/'.$driver->getMeta('documents'))); ?>" target="_blank">View</a>
              <?php endif; ?>
              <?php echo Form::file('documents',null,['class' => 'form-control','required']); ?>

            </div>
            <div class="form-group">
              <?php echo Form::label('license_image', __('fleet.licenseImage'), ['class' => 'form-label']); ?>

              <?php if($driver->getMeta('license_image') != null): ?>
              <a href="<?php echo e(asset('uploads/'.$driver->getMeta('license_image'))); ?>" target="_blank">View</a>
              <?php endif; ?>
              <?php echo Form::file('license_image',null,['class' => 'form-control','required']); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('econtact', __('Other Details'), ['class' => 'form-label']); ?>

              <?php echo Form::textarea('econtact',$driver->getMeta('econtact'),['class' => 'form-control']); ?>

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

<?php $__env->startSection("script"); ?>
<script src="<?php echo e(asset('assets/js/moment.js')); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#driver_commision_type').on('change', function(){
      var val = $(this).val();
      if(val==''){
        $('#driver_commision_container').hide();
      }else{
        if(val =='amount'){
          $('#driver_commision').attr('placeholder',"<?php echo app('translator')->get('fleet.enter_amount'); ?>");
        }else{
          $('#driver_commision').attr('placeholder',"<?php echo app('translator')->get('fleet.enter_percent'); ?>")
        }
        $('#driver_commision_container').show();
      }
    });
    $('#driver_commision_type').trigger('change');
    $('.code').select2();
    $('#vehicle_id').select2({
      placeholder:"<?php echo app('translator')->get('fleet.selectVehicle'); ?>"
    });
    $('#end_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      }).on('show', function() {
    var pickupdate = $( "#start_date" ).datepicker('getDate');
    if (pickupdate) {
      $("#end_date").datepicker('setStartDate', pickupdate);
    }
  
  });
    $('#exp_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      }).on('show', function() {
    var pickupdate = $( "#issue_date" ).datepicker('getDate');
    if (pickupdate) {
      $("#exp_date").datepicker('setStartDate', pickupdate);
    }
  });
    $('#issue_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
    $('#start_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });

    //Flat green color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    });

  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/drivers/edit.blade.php ENDPATH**/ ?>