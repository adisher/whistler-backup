<?php $__env->startSection('extra_css'); ?>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css')); ?>">
<style type="text/css">
  .select2-selection:not(.select2-selection--multiple) {
    height: 38px !important;
  }

  .input-group-append,
  .input-group-prepend {
    display: flex;
    /* width: calc(100% / 2); */
  }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('drivers.index')); ?>"><?php echo app('translator')->get('fleet.drivers'); ?></a></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.addDriver'); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header with-border">
        <h3 class="card-title"><?php echo app('translator')->get('fleet.addDriver'); ?></h3>
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

        <?php echo Form::open(['route' => 'drivers.store','files'=>true,'method'=>'post','id'=>'driver-create-form']); ?>

        <?php echo Form::hidden('is_active',0); ?>

        <?php echo Form::hidden('is_available',0); ?>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('first_name', __('fleet.firstname') . ' <span class="text-danger">*</span>', ['class' => 'form-label
              required'], false); ?>

              <?php echo Form::text('first_name', null,['class' => 'form-control','required','autofocus']); ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('middle_name', __('fleet.middlename'), ['class' => 'form-label']); ?>

              <?php echo Form::text('middle_name', null,['class' => 'form-control']); ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('last_name', __('fleet.lastname') . ' <span class="text-danger">*</span>', ['class' => 'form-label required'], false); ?>

              <?php echo Form::text('last_name', null,['class' => 'form-control','required']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('address', __('fleet.address'), ['class' => 'form-label required']); ?>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                </div>
                <?php echo Form::text('address', null,['class' => 'form-control']); ?>

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
                  <?php echo Form::select('phone_code',$phone_code,null,['class' => 'form-control
                  code','required','style'=>'width:80px']); ?>

                </div>
                <?php echo Form::number('phone', null,['class' => 'form-control','required']); ?>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('emp_id', __('fleet.employee_id'), ['class' => 'form-label']); ?>

              <?php echo Form::text('emp_id', 'WD-' . str_pad(rand(0,9999), 4, '0', STR_PAD_LEFT),['class' => 'form-control','required']); ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('contract_number', __('Insurance Number'), ['class' => 'form-label']); ?>

              <?php echo Form::text('contract_number', null,['class' => 'form-control']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('license_number', __('fleet.licenseNumber'). ' <span class="text-danger">*</span>', ['class' => 'form-label required'], false); ?>

              <?php echo Form::text('license_number', null,['class' => 'form-control','required']); ?>

            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('issue_date', __('License Issue Date'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false); ?>

              <div class="input-group date">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <?php echo Form::text('issue_date', null,['class' => 'form-control','required']); ?>

              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('exp_date', __('License Expiry Date'). ' <span class="text-danger">*</span>', ['class' => 'form-label required'], false); ?>

              <div class="input-group date">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <?php echo Form::text('exp_date', null,['class' => 'form-control','required']); ?>

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
                <?php echo Form::text('start_date', null,['class' => 'form-control','required']); ?>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('end_date', __('fleet.leave_date'), ['class' => 'form-label']); ?>

              <div class="input-group date">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <?php echo Form::text('end_date', null,['class' => 'form-control']); ?>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::input('hidden', 'password', '12345678', ['class' => 'form-control','required']); ?>

            </div>
          </div>
        </div>
        <div class="row">
          
          
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('gender', __('fleet.gender'). ' <span class="text-danger">*</span>' , ['class' => 'form-label'], false); ?><br>
              <input type="radio" name="gender" class="flat-red gender" value="1" checked> <?php echo app('translator')->get('fleet.male'); ?><br>

              <input type="radio" name="gender" class="flat-red gender" value="0"> <?php echo app('translator')->get('fleet.female'); ?>
            </div>

            <div class="form-group">
              <?php echo Form::label('driver_image', __('fleet.driverImage'), ['class' => 'form-label']); ?>


              <?php echo Form::file('driver_image',null,['class' => 'form-control']); ?>

            </div>
            <div class="form-group">
              <?php echo Form::label('documents', __('fleet.documents'), ['class' => 'form-label']); ?>

              <?php echo Form::file('documents',null,['class' => 'form-control']); ?>

            </div>


            <div class="form-group">
              <?php echo Form::label('license_image', __('fleet.licenseImage'), ['class' => 'form-label']); ?>

              <?php echo Form::file('license_image',null,['class' => 'form-control']); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('econtact', __('Other Details'), ['class' => 'form-label']); ?>

              <?php echo Form::textarea('econtact',null,['class' => 'form-control']); ?>

            </div>
          </div>
        </div>
        <div class="col-md-12">
          <?php echo Form::submit(__('fleet.saveDriver'), ['class' => 'btn btn-success']); ?>

        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("script"); ?>
<script src="<?php echo e(asset('assets/js/moment.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

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
    
    $('.code').select2();
    $('#vehicle_id').select2({
      placeholder:"<?php echo app('translator')->get('fleet.selectVehicle'); ?>"
    });
    
    $("#first_name").focus();
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

    $("#driver-create-form").validate({
      // in 'rules' user have to specify all the constraints for respective fields
      rules: {        
        password: {
          required:true,
          minlength: 6
        }
      },
      // in 'messages' user have to specify message as per rules
      messages: {
        vehicle_id: "Assign Vehicle field is required.",           
      },
      errorPlacement: function (error, element) {
        if(element.hasClass('select2-hidden-accessible') && element.next('.select2-container').length) {
            error.insertAfter(element.next('.select2-container'));
        }else if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        }
        else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
            error.insertAfter(element.parent().parent());
        }
        else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
            error.appendTo(element.parent().parent());
        }
        else {
            error.insertAfter(element);
        }
      },
      highlight: function (element, errorClass, validClass) {
        if($(element).hasClass('select2-hidden-accessible') && $(element).next('.select2-container').length) {
          
          $(element).next('.select2-container').find('.select2-selection').addClass('border-danger');
        }else{

        $(element).addClass('is-invalid');     
        }
        // return false;
      },
      unhighlight: function (element, errorClass, validClass) {
        if($(element).hasClass('select2-hidden-accessible') && $(element).next('.select2-container').length) {
        console.log(element, errorClass, validClass)

          $(element).next('.select2-container').find('.select2-selection').removeClass('border-danger');
        }else{
          $(element).removeClass('is-invalid');
        }
      }
    });
    
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/drivers/create.blade.php ENDPATH**/ ?>