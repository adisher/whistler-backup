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
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('maintenance.index')); ?>"> Corrective Maintenance </a></li>
    <li class="breadcrumb-item active">Add Maintenance</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Add Maintenance</h3>
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

                    <?php echo Form::open(['route' => 'maintenance.store', 'files' => true, 'method' => 'post']); ?>

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
                                        <option value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->vehicleData->make); ?> -
                                            <?php echo e($vehicle->vehicleData->model); ?> -
                                            <?php echo e($vehicle->license_plate); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
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
                                <?php echo Form::label('date', __('Date') . ' <span class="text-danger">*</span>', ['class' => 'form-label'], false); ?>

                                <?php echo Form::date('date', null, ['class' => 'form-control', 'required']); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label(
                                    'meter',
                                    __('Meter Reading') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <?php echo Form::text('meter', null, ['class' => 'form-control', 'required']); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label(
                                    'quantity',
                                    __('Used Parts Quantity') . ' <span class="text-danger">*</span>',
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label(
                                    'subject',
                                    __('Subject') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <?php echo Form::text('subject', null, ['class' => 'form-control', 'required']); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('files', __('Select Image'), ['class' => 'form-label']); ?>

                                <?php echo Form::file('files', null, ['class' => 'form-control']); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('description', __('Description'), ['class' => 'form-label']); ?>

                                <?php echo Form::textarea('description', null, ['class' => 'form-control']); ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <?php echo Form::submit(__('Add'), ['class' => 'btn btn-success']); ?>

                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#group_id').select2({
                placeholder: "<?php echo app('translator')->get('fleet.selectGroup'); ?>"
            });
            $('#role_id').select2({
                placeholder: "<?php echo app('translator')->get('fleet.role'); ?>"
            });
            $('#vehicle_id').select2({
                placeholder: "Select Fleet"
            });
            $('#parts_id').select2({
                placeholder: "Select Parts/Items"
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
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/maintenance/create.blade.php ENDPATH**/ ?>