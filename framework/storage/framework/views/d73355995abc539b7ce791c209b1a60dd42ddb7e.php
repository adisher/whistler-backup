<?php $__env->startSection('extra_css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('work_order.index')); ?>">Fleet Utilization </a></li>
    <li class="breadcrumb-item active">Deploy Fleet</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        Deploy Fleet
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

                    <?php echo Form::open(['route' => 'work_order.store', 'method' => 'post']); ?>

                    <?php echo Form::hidden('user_id', Auth::user()->id); ?>

                    <?php echo Form::hidden('type', 'Created'); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label(
                                    'vehicle_id',
                                    __('Select Vehicle/Equipment') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                                    <option value="">-</option>
                                    <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($vehicle->id); ?>"
                                            <?php echo e(in_array($vehicle->id, $open_shift) ? 'disabled' : ''); ?>>
                                            <?php echo e($vehicle->vehicleData->make); ?> -
                                            <?php echo e($vehicle->vehicleData->model); ?> -
                                            <?php echo e($vehicle->license_plate); ?>

                                            <?php if(in_array($vehicle->id, $open_shift)): ?>
                                                (Shift Open)
                                            <?php endif; ?>
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <?php echo Form::label(
                                    'driver_id',
                                    __('Select Driver') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="driver_id" name="driver_id" class="form-control" required>
                                    <option value="">-</option>
                                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($d->id); ?>"
                                            <?php echo e(isset($assigned_driver[$d->id]) ? 'disabled' : ''); ?>>
                                            <?php echo e($d->name); ?>

                                            <?php if(isset($assigned_driver[$d->id])): ?>
                                                (Assigned to Vehicle:
                                                <?php echo e($assigned_driver[$d->id]['vehicle_data']->vehicleData->make); ?> -
                                                <?php echo e($assigned_driver[$d->id]['vehicle_data']->vehicleData->model); ?> -
                                                <?php echo e($assigned_driver[$d->id]['vehicle_data']->license_plate); ?>)
                                            <?php endif; ?>
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php echo Form::label(
                                    'site_id',
                                    __('Select Site') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="site_id" name="site_id" class="form-control" required>
                                    <option value="">-</option>
                                    <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($s->id); ?>"> <?php echo e($s->site_name); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <?php echo Form::label('date', __('Date') . ' <span class="text-danger">*</span>', ['class' => 'form-label'], false); ?>

                                <?php echo Form::date('date', null, ['class' => 'form-control', 'required']); ?>

                            </div>

                            <div class="form-group">
                                <?php echo Form::label(
                                    'shift_id',
                                    __('Select Shift') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="shift_id" name="shift_id" class="form-control" required>
                                    <option value="" disabled>Select Shift</option>
                                    <option value="1">Morning</option>
                                    <option value="2">Evening</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php echo Form::label(
                                    'start_meter',
                                    __('Start Meter') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <?php echo Form::text('start_meter', null, ['class' => 'form-control', 'required']); ?>

                            </div>
                            
                            
                        </div>
                        <input type="hidden" name="expense_amount" id="expense_amount" value="0">

                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <?php echo Form::label('description', __('Description'), ['class' => 'form-label']); ?>

                                <?php echo Form::textarea('description', null, ['class' => 'form-control']); ?>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="parts col-md-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Form::submit(__('Deploy'), ['class' => 'btn btn-success']); ?>

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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#vehicle_id').select2({
                placeholder: "Select Vehicle/Equipment"
            });
            $('#vendor_id').select2({
                placeholder: "<?php echo app('translator')->get('fleet.select_vendor'); ?>"
            });
            $('#mechanic_id').select2({
                placeholder: "<?php echo app('translator')->get('fleet.select_mechanic'); ?>"
            });
            $('#select_part').select2({
                placeholder: "<?php echo app('translator')->get('fleet.selectPart'); ?>"
            });
            $('#site_id').select2({
                placeholder: "Select Site"
            });
            $('#driver_id').select2({
                placeholder: "Select Driver"
            });
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
                    if (vehicleData.expense_type === 'rental') {
                        var cost = workHours * vehicleData.expense_amount;
                        $('input[name="price"]').val(cost);
                    } else {
                        $('input[name="price"]').val(0);
                    }
                });

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

            $('input[name="work_hours"]').on('change keyup', function() {
                workHours = $(this).val();
                var vehicleId = $('#vehicle_id').val();
                if (vehicleId) {
                    var url = "<?php echo e(route('vehicles.expense', ['id' => ':id'])); ?>".replace(':id', vehicleId);
                    $.get(url, function(vehicleData) {
                        if (vehicleData.expense_type === 'rental') {
                            var cost = workHours * vehicleData.expense_amount;
                            $('input[name="price"]').val(cost);
                        } else {
                            $('input[name="price"]').val(0);
                        }
                    });
                }
            });

            $('#driver_id').change(function() {
                var driver_id = $(this).val();
                var url = "<?php echo e(route('assigned_driver', ['id' => ':id'])); ?>".replace(':id', driver_id);
                if (driver_id) {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(response) {
                            if (response.error) {
                                alert(response.error);
                                $('#driver_id').val(null).trigger(
                                    'change'); // Reset the selection
                            }
                        },
                        error: function(xhr) {
                            console.error('An error occurred:', xhr);
                        }
                    });
                }
            });

            //Flat green color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/work_orders/create.blade.php ENDPATH**/ ?>