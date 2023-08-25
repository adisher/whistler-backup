<?php $__env->startSection('extra_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/bootstrap-datetimepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="<?php echo e(url('admin/vehicle-reviews')); ?>"><?php echo app('translator')->get('fleet.vehicle_inspection'); ?></a></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.edit_vehicle_inspection'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title"><?php echo app('translator')->get('fleet.edit_vehicle_inspection'); ?></h3>
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

      <?php echo Form::open(['url' => 'admin/vehicle-review-update','method'=>'post','files'=>true]); ?>

      <?php echo Form::hidden('user_id',Auth::user()->id); ?>

      <?php echo Form::hidden('id',$review->id); ?>


      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <?php echo Form::label('vehicle_id',__('fleet.selectVehicle'), ['class' => 'form-label']); ?>

            <select id="vehicle_id" name="vehicle_id" class="form-control" required>
              <option value=""></option>
              <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($vehicle->id); ?>" <?php if($vehicle->id == $review->vehicle_id): ?> selected <?php endif; ?>><?php echo e($vehicle->make_name); ?> - <?php echo e($vehicle->model_name); ?> - <?php echo e($vehicle->license_plate); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <?php echo Form::label('kms_out',__('fleet.kms_out')." (".Hyvikk::get('dis_format').")", ['class' => 'form-label']); ?>

            <?php echo Form::number('kms_out',$review->kms_outgoing,['class'=>'form-control','required']); ?>

          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?php echo Form::label('kms_in',__('fleet.kms_in')." (".Hyvikk::get('dis_format').")", ['class' => 'form-label']); ?>

            <?php echo Form::number('kms_in',$review->kms_incoming,['class'=>'form-control','required']); ?>

          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?php echo Form::label('fuel_out',__('fleet.fuel_out'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="fuel_out" class="flat-red" value="0" <?php if($review->fuel_level_out == 0): ?> checked <?php endif; ?>> 1/4 &nbsp; &nbsp; &nbsp;
            <input type="radio" name="fuel_out" class="flat-red" value="1" <?php if($review->fuel_level_out == 1): ?> checked <?php endif; ?>> 1/2 &nbsp; &nbsp; &nbsp;
            <input type="radio" name="fuel_out" class="flat-red" value="2" <?php if($review->fuel_level_out == 2): ?> checked <?php endif; ?>> 3/4 &nbsp; &nbsp; &nbsp;
            <input type="radio" name="fuel_out" class="flat-red" value="3" <?php if($review->fuel_level_out == 3): ?> checked <?php endif; ?>> Full Tank
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?php echo Form::label('fuel_in',__('fleet.fuel_in'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="fuel_in" class="flat-red" value="0" <?php if($review->fuel_level_in == 0): ?> checked <?php endif; ?>> 1/4 &nbsp; &nbsp; &nbsp;
            <input type="radio" name="fuel_in" class="flat-red" value="1" <?php if($review->fuel_level_in == 1): ?> checked <?php endif; ?>> 1/2 &nbsp; &nbsp; &nbsp;
            <input type="radio" name="fuel_in" class="flat-red" value="2" <?php if($review->fuel_level_in == 2): ?> checked <?php endif; ?>> 3/4 &nbsp; &nbsp; &nbsp;
            <input type="radio" name="fuel_in" class="flat-red" value="3" <?php if($review->fuel_level_in == 3): ?> checked <?php endif; ?>> Full Tank
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <?php echo Form::label('datetime_out',__('fleet.datetime_out'), ['class' => 'form-label']); ?>

            <div class='input-group'>
              <div class="input-group-prepend">
                <span class="input-group-text"><span class="fa fa-calendar"></span></span>
              </div>
              <?php echo Form::text('datetime_out',$review->datetime_outgoing,['class'=>'form-control','required','id'=>'date_out']); ?>

            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?php echo Form::label('datetime_in',__('fleet.datetime_in'), ['class' => 'form-label']); ?>

            <div class='input-group'>
              <div class="input-group-prepend">
                <span class="input-group-text"> <span class="fa fa-calendar"></span></span>
              </div>
              <?php echo Form::text('datetime_in',$review->datetime_incoming,['class'=>'form-control','required','id'=>'date_in']); ?>

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <?php ($petrol_card=unserialize($review->petrol_card)); ?>
          <div class="form-group">
            <?php echo Form::label('petrol_card',__('fleet.petrol_card'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="petrol_card" class="flat-red" value="1" <?php if($petrol_card['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="petrol_card" class="flat-red" value="0" <?php if($petrol_card['flag'] == 0 && $petrol_card['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="petrol_card_text" style="width: 300px; margin-top:5px;" value="<?php echo e($petrol_card['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($light=unserialize($review->lights)); ?>
          <div class="form-group">
            <?php echo Form::label('lights',__('fleet.lights'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="lights" class="flat-red" value="1" <?php if($light['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="lights" class="flat-red" value="0" <?php if($light['flag'] == 0 && $light['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="lights_text" style="width: 300px; margin-top:5px;" value="<?php echo e($light['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($invertor=unserialize($review->invertor)); ?>
          <div class="form-group">
            <?php echo Form::label('invertor',__('fleet.invertor'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="invertor" class="flat-red" value="1" <?php if($invertor['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="invertor" class="flat-red" value="0" <?php if($invertor['flag'] == 0 && $invertor['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="invertor_text" style="width: 300px; margin-top:5px;" value="<?php echo e($invertor['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($car_mat=unserialize($review->car_mats)); ?>
          <div class="form-group">
            <?php echo Form::label('car_mats',__('fleet.car_mats'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="car_mats" class="flat-red" value="1" <?php if($car_mat['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="car_mats" class="flat-red" value="0" <?php if($car_mat['flag'] == 0 && $car_mat['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="car_mats_text" style="width: 300px; margin-top:5px;" value="<?php echo e($car_mat['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($int_damage=unserialize($review->int_damage)); ?>
          <div class="form-group">
            <?php echo Form::label('int_damage',__('fleet.int_damage'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="int_damage" class="flat-red" value="1" <?php if($int_damage['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="int_damage" class="flat-red" value="0" <?php if($int_damage['flag'] == 0 && $int_damage['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="int_damage_text" style="width: 300px; margin-top:5px;" value="<?php echo e($int_damage['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($int_lights=unserialize($review->int_lights)); ?>
          <div class="form-group">
            <?php echo Form::label('int_lights',__('fleet.int_lights'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="int_lights" class="flat-red" value="1" <?php if($int_lights['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="int_lights" class="flat-red" value="0" <?php if($int_lights['flag'] == 0 && $int_lights['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="int_lights_text" style="width: 300px; margin-top:5px;" value="<?php echo e($int_lights['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($ext_car=unserialize($review->ext_car)); ?>
          <div class="form-group">
            <?php echo Form::label('ext_car',__('fleet.ext_car'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="ext_car" class="flat-red" value="1" <?php if($ext_car['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="ext_car" class="flat-red" value="0" <?php if($ext_car['flag'] == 0 && $ext_car['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="ext_car_text" style="width: 300px; margin-top:5px;" value="<?php echo e($ext_car['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($tyre=unserialize($review->tyre)); ?>
          <div class="form-group">
            <?php echo Form::label('tyre',__('fleet.tyre'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="tyre" class="flat-red" value="1" <?php if($tyre['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="tyre" class="flat-red" value="0" <?php if($tyre['flag'] == 0 && $tyre['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="tyre_text" style="width: 300px; margin-top:5px;" value="<?php echo e($tyre['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($ladder=unserialize($review->ladder)); ?>
          <div class="form-group">
            <?php echo Form::label('ladder',__('fleet.ladder'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="ladder" class="flat-red" value="1" <?php if($ladder['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="ladder" class="flat-red" value="0" <?php if($ladder['flag'] == 0 && $ladder['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="ladder_text" style="width: 300px; margin-top:5px;" value="<?php echo e($ladder['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($leed=unserialize($review->leed)); ?>
          <div class="form-group">
            <?php echo Form::label('leed',__('fleet.leed'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="leed" class="flat-red" value="1" <?php if($leed['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="leed" class="flat-red" value="0" <?php if($leed['flag'] == 0 && $leed['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="leed_text" style="width: 300px; margin-top:5px;" value="<?php echo e($leed['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($power_tool=unserialize($review->power_tool)); ?>
          <div class="form-group">
          <?php echo Form::label('power_tool',__('fleet.power_tool'), ['class' => 'form-label']); ?>

          <br>
          <input type="radio" name="power_tool" class="flat-red" value="1" <?php if($power_tool['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
          <input type="radio" name="power_tool" class="flat-red" value="0" <?php if($power_tool['flag'] == 0 && $power_tool['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
          <input type="text" name="power_tool_text" style="width: 300px; margin-top:5px;" value="<?php echo e($power_tool['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($ac=unserialize($review->ac)); ?>
          <div class="form-group">
            <?php echo Form::label('ac',__('fleet.ac'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="ac" class="flat-red" value="1" <?php if($ac['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="ac" class="flat-red" value="0" <?php if($ac['flag'] == 0 && $ac['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="ac_text" style="width: 300px; margin-top:5px;" value="<?php echo e($ac['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($head_light=unserialize($review->head_light)); ?>
          <div class="form-group">
            <?php echo Form::label('head_light',__('fleet.head_light'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="head_light" class="flat-red" value="1" <?php if($head_light['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="head_light" class="flat-red" value="0" <?php if($head_light['flag'] == 0 && $head_light['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="head_light_text" style="width: 300px; margin-top:5px;" value="<?php echo e($head_light['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($lock=unserialize($review->lock)); ?>
          <div class="form-group">
            <?php echo Form::label('lock',__('fleet.lock'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="lock" class="flat-red" value="1" <?php if($lock['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="lock" class="flat-red" value="0" <?php if($lock['flag'] == 0 && $lock['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="lock_text" style="width: 300px; margin-top:5px;" value="<?php echo e($lock['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($windows=unserialize($review->windows)); ?>
          <div class="form-group">
            <?php echo Form::label('windows',__('fleet.windows'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="windows" class="flat-red" value="1" <?php if($windows['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="windows" class="flat-red" value="0" <?php if($windows['flag'] == 0 && $windows['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="windows_text" style="width: 300px; margin-top:5px;" value="<?php echo e($windows['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($condition=unserialize($review->condition)); ?>
          <div class="form-group">
          <?php echo Form::label('condition',__('fleet.condition'), ['class' => 'form-label']); ?>

          <br>
          <input type="radio" name="condition" class="flat-red" value="1" <?php if($condition['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
          <input type="radio" name="condition" class="flat-red" value="0" <?php if($condition['flag'] == 0 && $condition['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
          <input type="text" name="condition_text" style="width: 300px; margin-top:5px;" value="<?php echo e($condition['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($oil_chk=unserialize($review->oil_chk)); ?>
          <div class="form-group">
            <?php echo Form::label('oil_chk',__('fleet.oil_chk'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="oil_chk" class="flat-red" value="1" <?php if($oil_chk['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="oil_chk" class="flat-red" value="0" <?php if($oil_chk['flag'] == 0 && $oil_chk['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="oil_chk_text" style="width: 300px; margin-top:5px;" value="<?php echo e($oil_chk['text']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <?php ($suspension=unserialize($review->suspension)); ?>
          <div class="form-group">
            <?php echo Form::label('suspension',__('fleet.suspension'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="suspension" class="flat-red" value="1" <?php if($suspension['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="suspension" class="flat-red" value="0" <?php if($suspension['flag'] == 0 && $suspension['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="suspension_text" style="width: 300px; margin-top:5px;" value="<?php echo e($suspension['text']); ?>">
          </div>
        </div>

        <div class="col-md-12">
          <?php ($tool_box=unserialize($review->tool_box)); ?>
          <div class="form-group">
            <?php echo Form::label('tool_box',__('fleet.tool_box'), ['class' => 'form-label']); ?>

            <br>
            <input type="radio" name="tool_box" class="flat-red" value="1" <?php if($tool_box['flag'] == 1): ?> checked <?php endif; ?>> Yes &nbsp; &nbsp; &nbsp;
            <input type="radio" name="tool_box" class="flat-red" value="0" <?php if($tool_box['flag'] == 0 && $tool_box['flag'] != null): ?> checked <?php endif; ?>> No &nbsp; &nbsp; &nbsp;
            <input type="text" name="tool_box_text" style="width: 300px; margin-top:5px;" value="<?php echo e($tool_box['text']); ?>">
          </div>
        </div>
        <div class="form-group col-md-6">
          <?php echo Form::label('image',__('fleet.select_image'), ['class' => 'form-label']); ?>

          <?php echo Form::file('image',['class'=>'form-control']); ?>

        
          <?php if(!is_null($review->image) && file_exists('uploads/'.$review->image)): ?>
              <a href="<?php echo e(url('uploads/'.$review->image)); ?>" target="_blank">View</a>
          <?php endif; ?>
        </div>
      </div>

      <hr>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('udf1',__('fleet.add_udf'), ['class' => 'col-xs-5 control-label']); ?>

          <div class="row">
            <div class="col-md-8">
              <?php echo Form::text('udf1', null,['class' => 'form-control']); ?>

            </div>
            <div class="col-md-4">
              <button type="button" class="btn btn-info add_udf"> <?php echo app('translator')->get('fleet.add'); ?></button>
            </div>
          </div>
        </div>
        <div class="blank"></div>
        <?php if($udfs != null): ?>
        <?php $__currentLoopData = $udfs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row"><div class="col-md-8">  <div class="form-group"> <label class="form-label text-uppercase"><?php echo e($key); ?></label> <input type="text" name="udf[<?php echo e($key); ?>]" class="form-control" required value="<?php echo e($value); ?>"></div></div><div class="col-md-4"> <div class="form-group" style="margin-top: 30px"><button class="btn btn-danger" type="button" onclick="this.parentElement.parentElement.parentElement.remove();">Remove</button> </div></div></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php echo Form::submit(__('fleet.submit'), ['class' => 'btn btn-success']); ?>

        </div>
      </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/moment.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datetimepicker.js')); ?>"></script>
<script type="text/javascript">
$(function(){

  $('#vehicle_id').select2({placeholder:"<?php echo app('translator')->get('fleet.selectVehicle'); ?>"});
  $('#date_in').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss',sideBySide: true,icons: {
    previous: 'fa fa-arrow-left',
              next: 'fa fa-arrow-right',
              up: "fa fa-arrow-up",
              down: "fa fa-arrow-down"
            }
          });
          $('#date_out').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss',sideBySide: true,icons: {
            previous: 'fa fa-arrow-left',
            next: 'fa fa-arrow-right',
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
          }}).on('dp.change', function (e) { 

            var selectedDate = e.date;
            $('#date_in').data("DateTimePicker").minDate(e.date);
           });
          
         
          
        });

          $(".add_udf").click(function () {
            // alert($('#udf').val());
            var field = $('#udf1').val();
    if(field == "" || field == null){
      alert('Enter field name');
    }

    else{
      $(".blank").append('<div class="row"><div class="col-md-8">  <div class="form-group"> <label class="form-label">'+ field.toUpperCase() +'</label> <input type="text" name="udf['+ field +']" class="form-control" placeholder="Enter '+ field +'" required></div></div><div class="col-md-4"> <div class="form-group" style="margin-top: 30px"><button class="btn btn-danger" type="button" onclick="this.parentElement.parentElement.parentElement.remove();">Remove</button> </div></div></div>');
      $('#udf1').val("");
    }
  });
  //Flat green color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass   : 'iradio_flat-blue'
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/vehicles/vehicle_review_edit.blade.php ENDPATH**/ ?>