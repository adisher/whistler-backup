<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('preventive-maintenance.index')); ?>">Preventive Maintenance</a></li>
<li class="breadcrumb-item active">Add Preventive Maintenance</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extra_css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Preventive Maintenance</h3>
      </div>
      <?php echo Form::open(['route' => 'preventive-maintenance.store','method'=>'post']); ?>

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
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('vehicle_id',__('Select Fleet'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false); ?>

              <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                <option value=""></option>
                <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($v->id); ?>"><?php echo e($v->vehicleData->make); ?> <?php echo e($v->vehicleData->model); ?> - <?php echo e($v->license_plate); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="form-group">
              <?php echo Form::label('start_meter', __('Last Meter Reading'), ['class' => 'form-label']); ?>

              <div class="input-group date">
                <div class="input-group-prepend"><span class="input-group-text"><?php echo e(Hyvikk::get('dis_format')); ?></span></div>
                <?php echo Form::number('start_meter',null,['class'=>'form-control','required', 'min'=>'0',
                'readonly'
                ]); ?>

              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('date', __('Date'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false); ?>

              <div class="input-group date">
                <div class="input-group-prepend"><span class="input-group-text"><span
                      class="fa fa-calendar"></span></span></div>
                <?php echo Form::text('date',date('Y-m-d'),['class'=>'form-control','required','id'=>'start_date']); ?>

              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label(
              'recipient',
              __('Email Reminder Recipients') . ' <span class="text-danger">*</span>',
              ['class' => 'form-label'],
              false,
              ); ?>

              <select id="recipient" name="recipients[]" multiple="multiple" class="form-control">
                <option value="">-</option>
                <?php $__currentLoopData = $recipients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($recipient->email); ?>"><?php echo e($recipient->email); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label(
              'parts_id',
              __('Select Part/Item') . ' <span class="text-danger">*</span>',
              ['class' => 'form-label'],
              false,
              ); ?>

              <select id="parts_id" name="parts_id" class="form-control" required>
                <option value="">-</option>
                <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($part->id); ?>"><?php echo e($part->title); ?> - <?php echo e($part->vendor->name); ?>

                  -
                  <?php echo e($part->stock); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="form-group">
              <?php echo Form::label(
              'quantity',
              __('Used Parts/Items Quantity') . ' <span class="text-danger">*</span>',
              ['class' => 'form-label'],
              false,
              ); ?>

              <?php echo Form::number('quantity', null, ['class' => 'form-control', 'required']); ?>

            </div>
            <div class="form-group">
              <?php echo Form::label('price', __('Price') . ' <span class="text-danger">*</span>', ['class' => 'form-label'], false); ?>

              <?php echo Form::text('price', null, ['class' => 'form-control', 'required']); ?>

            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead class="thead-inverse">
              <tr>
                <th>
                </th>
                <th><?php echo app('translator')->get('fleet.description'); ?></th>
                <th>Planned Meter Interval (kms)</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                  <input type="checkbox" name="chk[]" value="<?php echo e($service->id); ?>" class="flat-red">
                </td>
                <td>
                  <?php echo e($service->description); ?>

                </td>
                <td>
                  <?php echo e($service->meter_interval); ?> 
                  <?php if($service->overdue_meter != null): ?>
                  <?php echo app('translator')->get('fleet.or'); ?> <?php echo e($service->overdue_meter); ?> <?php echo e(Hyvikk::get('dis_format')); ?>

                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
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
<script src="<?php echo e(asset('assets/js/moment.js')); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#vehicle_id').select2({placeholder: "Select Fleet"});
    $('#parts_id').select2({placeholder: "Select Parts/Item"});
    $('#recipient').select2({
    placeholder: "Select Recipients"
    });

    $('#vehicle_id').change(function() {
    var vehicleId = $(this).val();
    
    // Fetch start_meter data for the selected vehicle
    var meterUrl = "<?php echo e(route('vehicles.getMeter', ['id' => ':id'])); ?>".replace(':id',
    vehicleId);
    $.get(meterUrl, function(data) {
    if (data.start_meter) {
    $('input[name="start_meter"]').val(data.start_meter);
    } else {
    $('input[name="start_meter"]').val(0); // Or any default value
    }
    });
    });

    // Declare a variable to store unit cost
            let unitCost = 0;

            // Listen for change event on #parts_id select field
            $('#parts_id').change(function() {
                var partId = $(this).val();
                console.log(partId);
                if (partId) {
                    console.log(partId);
                    // Initialize a URL template with a placeholder for the partId
                    var urlTemplate = '<?php echo e(route('parts_unit_cost', ['id' => ':id'])); ?>';

                    // Replace the placeholder with the actual partId
                    var url = urlTemplate.replace(':id', partId);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            // Update the unitCost variable
                            unitCost = parseFloat(response);

                            // Trigger a change event on #quantity to update the price
                            $('#quantity').trigger('change');
                        },
                        error: function(error) {
                            console.error('Error fetching unit cost:', error);
                        }
                    });
                }
            });

            // Listen for change or input event on #quantity field
            $('#quantity').on('change input', function() {
                const quantity = parseFloat($(this).val());
                if (quantity && unitCost) {
                    // Calculate the total price
                    const totalPrice = unitCost * quantity;
                    // Populate the #price field
                    $('#price').val(totalPrice.toFixed(2));
                } else {
                    // Clear the #price field if either quantity or unitCost is not available
                    $('#price').val('');
                }
            });
    //Flat green color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    });

  $('#start_date').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/preventive_maintenance/create.blade.php ENDPATH**/ ?>