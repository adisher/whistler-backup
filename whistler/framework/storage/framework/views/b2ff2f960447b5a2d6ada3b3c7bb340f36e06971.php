<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><?php echo app('translator')->get('menu.settings'); ?></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.chat'); ?> <?php echo app('translator')->get('menu.settings'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title"><?php echo app('translator')->get('fleet.chat'); ?> <?php echo app('translator')->get('menu.settings'); ?>
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

        <?php echo Form::open(['route' => 'chat_settings.store','method'=>'post']); ?>

        <div class="row">          
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('pusher_app_id',__('fleet.pusher_app_id'),['class'=>"form-label"]); ?>

              <?php echo Form::text('pusher_app_id',
              Hyvikk::chat('pusher_app_id'),['class'=>"form-control"]); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('pusher_app_key',__('fleet.pusher_app_key'),['class'=>"form-label"]); ?>

              <?php echo Form::text('pusher_app_key',
              Hyvikk::chat('pusher_app_key'),['class'=>"form-control razorpay"]); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('pusher_app_secret',__('fleet.pusher_app_secret'),['class'=>"form-label"]); ?>

              <?php echo Form::text('pusher_app_secret',
              Hyvikk::chat('pusher_app_secret'),['class'=>"form-control"]); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('pusher_app_cluster',__('fleet.pusher_app_cluster'),['class'=>"form-label"]); ?>

              <?php echo Form::text('pusher_app_cluster',
              Hyvikk::chat('pusher_app_cluster'),['class'=>"form-control"]); ?>

            </div>
          </div>          
        </div>
        
        <div class="row">
          <div class="col-md-12">
            
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="col-md-2">
          <div class="form-group">
            <input type="submit"  class="form-control btn btn-success"  value="<?php echo app('translator')->get('fleet.save'); ?>" />
          </div>
        </div>
      </div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/moment.js')); ?>"></script>

<script type="text/javascript">
  

  <?php if(Session::get('msg')): ?>
    new PNotify({
      title: 'Success!',
      text: '<?php echo e(Session::get('msg')); ?>',
      type: 'success',
      delay: 15000
    });
  <?php endif; ?>
  <?php if(Session::get('error_msg')): ?>
    new PNotify({
      title: 'Failed!',
      text: '<?php echo e(Session::get('error_msg')); ?>',
      type: 'error',
      delay: 15000
    });
  <?php endif; ?>

  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/utilities/chat_settings.blade.php ENDPATH**/ ?>