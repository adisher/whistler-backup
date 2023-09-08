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
<li class="breadcrumb-item"><a href="<?php echo e(route('service-item.index')); ?>"><?php echo app('translator')->get('fleet.serviceItems'); ?></a></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.add_service_item'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo Form::open(['route' => 'service-item.store','method'=>'post']); ?>

    <?php echo Form::hidden('user_id',Auth::user()->id); ?>

    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">
          <?php echo app('translator')->get('fleet.create_service_item'); ?>
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
        <div class="row">
          <div class="form-group col-md-6">
            <?php echo Form::label('description', __('Service Title'), ['class' => 'form-label']); ?>

            <?php echo Form::text('description', null,['class' => 'form-control','required', 'placeholder'=>'e.g. Engine Inspection']); ?>

          </div>
          <div class="form-group col-md-6">
            <?php echo Form::label('meter_interval', __('Planned Meter Interval'), ['class' => 'form-label']); ?>

            <div class="input-group date">
              <div class="input-group-prepend"><span class="input-group-text"><?php echo e(Hyvikk::get('dis_format')); ?></span></div>
              <?php echo Form::number('meter_interval',null,['class'=>'form-control','required','id'=>'start_date', 'min'=>'0',
              'placeholder'=>'e.g. 250']); ?>

            </div>
          </div>
        </div>
        
        <div class="col-md-12">
          <?php echo Form::submit(__('fleet.save'), ['class' => 'btn btn-success']); ?>

        </div>
      </div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  $('#time1').on('change',function(){
    $("#chk1").prop('checked',true);
  });

  $('#time2').on('change',function(){
    $("#chk3").prop('checked',true);
  });

  $('#meter1').on('change',function(){
    $("#chk2").prop('checked',true);
  });

  $('#meter2').on('change',function(){
    $("#chk4").prop('checked',true);
  });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/service_items/create.blade.php ENDPATH**/ ?>