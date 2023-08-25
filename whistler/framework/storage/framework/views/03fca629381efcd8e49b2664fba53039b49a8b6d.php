<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><?php echo app('translator')->get('menu.settings'); ?></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.twilio_settings'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extra_css'); ?>
<style type="text/css">
  .nav-link {
    padding: .5rem !important;
  }

  .custom .nav-link.active {

      background-color: #21bc6c !important;
  }

  /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

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

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
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
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title"><?php echo app('translator')->get('fleet.twilio_settings'); ?>
        </h3>
      </div>
      <?php echo Form::open(['url' => 'admin/twilio-settings','method'=>'post']); ?>

      <div class="card-body">
        <div class="row">
          <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
              <ul>
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          <?php endif; ?>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('sid',__('fleet.sid'), ['class' => 'form-label']); ?>

              <?php echo Form::text('sid', Hyvikk::twilio('sid') ,['class' => 'form-control','required']); ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('token',__('fleet.token'), ['class' => 'form-label']); ?>

              <?php echo Form::text('token', Hyvikk::twilio('token') ,['class' => 'form-control','required']); ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('from',__('fleet.from'), ['class' => 'form-label']); ?>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                <?php echo Form::text('from', Hyvikk::twilio('from') ,['class' => 'form-control','required']); ?>

              </div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('customer_message',__('fleet.customer_message'), ['class' => 'form-label']); ?>

              <?php echo Form::textarea('customer_message', Hyvikk::twilio('customer_message') ,['class' => 'form-control','required','size'=>'30x3']); ?>

            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('driver_message',__('fleet.driver_message'), ['class' => 'form-label']); ?>

              <?php echo Form::textarea('driver_message', Hyvikk::twilio('driver_message') ,['class' => 'form-control','required','size'=>'30x3']); ?>

            </div>
          </div>
        </div>

        <h6 class="text-danger"> <strong><?php echo app('translator')->get('fleet.important_Notes'); ?>:</strong></h6>
        <div class="row" style="margin-top: 20px">
                
            <div class="col-md-6">
              <div class="form-group">

                <h6 class="text-success"> <strong>Replace below variables for given details:</strong></h6>
                <ul class="text-muted">
                  <li>$customer_name :<span>customer's name</span></li>
                  <li>$driver_name :<span>driver's name</span></li>
                  <li>$driver_contact :<span>driver's contact number</span></li>
                  <li>$pickup_address :<span>pickup address of booking</span></li>
                  <li>$destination_address :<span>destination address of booking</span></li>
                  <li>$pickup_datetime :<span>pickup date and time of the booking</span></li>
                  <li>$dropoff_datetime :<span>dropoff date and time of the booking</span></li>
                  <li>$passengers :<span>no. of passengers of the booking</span></li>
                </ul>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">                
                <ul class="text-muted">
                  <li>customer's phone number must have country code to send sms using twilio(e.g: +911234567890)</li>
                  <li>from contact number in twilio settings must be purchased number in twilio console</li>
                  <li>for trial account you must have to add customer's phone number in verified caller ids: <a href="https://www.twilio.com/console/phone-numbers/verified">Click here</a>
                  </li>                  
                </ul>
              </div>
            </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="form-group">
            <input type="submit" class="form-control btn btn-success" value="<?php echo app('translator')->get('fleet.save'); ?>"/>
          </div>
        </div>
      </div>
      <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("script"); ?>

<script type="text/javascript">
  <?php if(Session::get('msg')): ?>
    new PNotify({
        title: 'Success!',
        text: '<?php echo e(Session::get('msg')); ?>',
        type: 'success'
      });
  <?php endif; ?>
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/twilio/index.blade.php ENDPATH**/ ?>