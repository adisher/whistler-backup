<?php $__env->startSection('extra_css'); ?>
    <style type="text/css">
        .nav-tabs-custom>.nav-tabs>li.active {
            border-top-color: #00a65a !important;
        }

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

        .custom .nav-link.active {

            background-color: #3f51b5 !important;

        }

        .purchase-amount-div,
        .rent-amount-div {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('vehicles.index')); ?>">Fleet</a></li>
    <li class="breadcrumb-item active">Add Fleet</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Add Fleet</h3>
                </div>

                <div class="card-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-pills custom">
                            <li class="nav-item"><a class="nav-link active" href="#info-tab" data-toggle="tab">
                                    <?php echo app('translator')->get('fleet.general_info'); ?> <i class="fa"></i></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="info-tab">
                            <?php echo Form::open([
                                'route' => 'vehicles.store',
                                'files' => true,
                                'method' => 'post',
                                'class' => 'form-horizontal',
                                'id' => 'accountForm',
                            ]); ?>

                            <?php echo Form::hidden('user_id', Auth::user()->id); ?>

                            <div class="row card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo Form::label('type_id', __('Select Fleet Type'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>


                                        <div class="col-xs-6">
                                            <select name="type_id" class="form-control" required id="type_id">
                                                <option></option>
                                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($type->id); ?>" data-type-name="<?php echo e($type->type_name); ?>"><?php echo e($type->type_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::label('make_model', __('Select Make - Model'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>


                                        <div class="col-xs-6">
                                            <select name="make_model_id" class="form-control" required id="make_model">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Fleet no -->
                                    <div class="form-group">
                                        <?php echo Form::label('fleet_no', __('Vehicle/Equipment No.'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('fleet_no', null, ['class' => 'form-control', 'required', 'data-unique' => 'true', 'id' =>
                                            'fleet_no']); ?>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo Form::label('year', __('Vehicle/Equipment Year'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::number('year', null, ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>

                                    <!-- Engine No. -->
                                    <div class="form-group">
                                        <?php echo Form::label('engine_no', __('Engine No.'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('engine_no', null, ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>
                                    
                                    <!-- Chasis No -->
                                    <div class="form-group">
                                        <?php echo Form::label('chasis_no', __('Chasis No.'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('chasis_no', null, ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::label('license_plate', __('fleet.licensePlate'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('license_plate', null, ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo Form::label('lic_exp_date', __('fleet.lic_exp_date'). ' <span class="text-danger">*</span>', [
                                            'class' => 'col-xs-5 control-label required',
                                    ], false); ?>

                                        <div class="col-xs-6">
                                            <div class="input-group date">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span></div>
                                                <?php echo Form::text('lic_exp_date', null, ['class' => 'form-control', 'required']); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tracker No -->
                                    <div class="form-group">
                                        <?php echo Form::label('tracker_no', __('Tracker No.'), ['class' => 'col-xs-5 control-label']); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('tracker_no', null, ['class' => 'form-control']); ?>

                                        </div>
                                    </div>
                                    <!-- Tracker Exp Date -->
                                    <div class="form-group">
                                        <?php echo Form::label('tracker_exp_date', __('Tracker Expiry Date'), [
                                            'class' => 'col-xs-5 control-label',
                                        ]); ?>

                                        <div class="col-xs-6">
                                            <div class="input-group date">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span></div>
                                                <?php echo Form::text('tracker_exp_date', null, ['class' => 'form-control']); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fitness Certificate No -->
                                    <div class="form-group">
                                        <?php echo Form::label('fitness_cert_no', __('Fitness Certificate No.'), ['class' => 'col-xs-5 control-label']); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('fitness_cert_no', null, ['class' => 'form-control']); ?>

                                        </div>
                                    </div>
                                    <!-- Fitness Cert Exp Date -->
                                    <div class="form-group">
                                        <?php echo Form::label('fitness_cert_exp_date', __('Fitness Cert Expiry Date'), [
                                            'class' => 'col-xs-5 control-label',
                                        ]); ?>

                                        <div class="col-xs-6">
                                            <div class="input-group date">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span></div>
                                                <?php echo Form::text('fitness_cert_exp_date', null, ['class' => 'form-control']); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo Form::label('in_service', __('fleet.service'), ['class' => 'col-xs-5 control-label']); ?>

                                            </div>
                                            <div class="col-ms-6" style="margin-left: -140px">
                                                <label class="switch">
                                                    <input type="checkbox" name="in_service" value="1">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo Form::label('color_name', __('Select Fleet Color'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>


                                        <div class="col-xs-6">
                                            <select name="color_name" class="form-control" required id="color_name">
                                                <option></option>
                                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($color->color); ?>"><?php echo e($color->color); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- condition -->
                                    <div class="form-group">
                                        <?php echo Form::label('condition', __('Condition'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::select('condition', ['Old' => 'Old', 'New' => 'New'], null, ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        
                                        <div class="col-xs-6">
                                            <?php echo Form::hidden('vin', 'asdasdas', ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::label('average', '<span class="avg">'.__('fleet.average') . ' (' . __('fleet.kmpl') . ')</span>'. ' <span class="text-danger">*</span>', [
                                            'class' => 'col-xs-5 control-label', 'id' => 'average_label'
                                    ], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::number('average', null, ['class' => 'form-control', 'required', 'step' => 'any']); ?>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php if(Hyvikk::get('dis_format') == 'km'): ?>
                                            <?php echo Form::label('int_mileage', __('fleet.intMileage') . '(' . __('fleet.km') . ')'. ' <span class="text-danger">*</span>', [
                                                'class' => 'col-xs-5 control-label',
                                    ], false); ?>

                                        <?php else: ?>
                                            <?php echo Form::label('int_mileage', __('fleet.intMileage') . '(' . __('fleet.miles') . ')'. ' <span class="text-danger">*</span>', [
                                                'class' => 'col-xs-5 control-label',
                                    ], false); ?>

                                        <?php endif; ?>
                                        <div class="col-xs-6">
                                            <?php echo Form::number('int_mileage', null, ['class' => 'form-control']); ?>

                                        </div>
                                    </div>
                                    
                                    
                                    <!-- Expense Type -->
                                    <div class="form-group">
                                        <?php echo Form::label('expense_type', __('Select Expense Type'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <select name="expense_type" class="form-control" required id="expense_type">
                                                <option disabled selected>Select Expense Type</option>
                                                <option value="own">Own</option>
                                                <option value="rental">Rental</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Purchase Amount -->
                                    <div class="form-group purchase-amount-div">
                                        <?php echo Form::label('purchase_amount', __('Purchase Amount'), ['class' => 'col-xs-5 control-label']); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::number('purchase_amount', null, ['class' => 'form-control']); ?>

                                        </div>
                                    </div>
                                    <!-- Rent Amount -->
                                    <div class="form-group rent-amount-div">
                                        <?php echo Form::label('rent_amount', __('Rent Amount'), ['class' => 'col-xs-5 control-label']); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::number('rent_amount', null, ['class' => 'form-control']); ?>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo Form::label('vehicle_image', __('Fleet Image'), ['class' => 'col-xs-5 control-label']); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::file('vehicle_image', null, ['class' => 'form-control']); ?>

                                        </div>
                                    </div>
                                    <!-- certificates images upload -->
                                    <div class="form-group">
                                        <?php echo Form::label('certificates_images', __('Certificates Images'), ['class' => 'col-xs-5 control-label']); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::file('certificates_images', null, ['class' => 'form-control']); ?>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <?php echo Form::label('udf1', __('fleet.add_udf'), ['class' => 'col-xs-5 control-label']); ?>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <?php echo Form::text('udf1', null, ['class' => 'form-control']); ?>

                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-info add_udf">
                                                    <?php echo app('translator')->get('fleet.add'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blank"></div>
                                </div>
                            </div>
                            <div style=" margin-bottom: 20px;">
                                <div class="form-group" style="margin-top: 15px;">
                                    <div class="col-xs-6 col-xs-offset-3">
                                        <?php echo Form::submit(__('fleet.submit'), ['class' => 'btn btn-success']); ?>

                                    </div>
                                </div>
                            </div>
                            <?php echo Form::close(); ?>

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
        $(".add_udf").click(function() {
            // alert($('#udf').val());
            var field = $('#udf1').val();
            if (field == "" || field == null) {
                alert('Enter field name');
            } else {
                $(".blank").append(
                    '<div class="row"><div class="col-md-8">  <div class="form-group"> <label class="form-label">' +
                    field.toUpperCase() + '</label> <input type="text" name="udf[' + field +
                    ']" class="form-control" placeholder="Enter ' + field +
                    '" required></div></div><div class="col-md-4"> <div class="form-group" style="margin-top: 30px"><button class="btn btn-danger" type="button" onclick="this.parentElement.parentElement.parentElement.remove();">Remove</button> </div></div></div>'
                );
                $('#udf1').val("");
            }
        });

        $(document).ready(function() {
            var getByTypeUrl = '<?php echo e(route("vehicle-data-by-type", "")); ?>';

            $('#type_id').change(function() {
                var typeId = $(this).val();
                var typeName = $(this).find('option:selected').data('type-name');
                
                $.get(getByTypeUrl + '/' + typeId, function(data) {
                    var makeModelDropdown = $('#make_model');
                    makeModelDropdown.empty();
                    makeModelDropdown.append(
                    '<option selected></option>'); // to keep the initial empty option
                
                    $.each(data, function(index, item) {
                        makeModelDropdown.append('<option value="' + item.id + '">' + item.make + ' - ' + item.model + '</option>');
                    });

                    makeModelDropdown.prop('selectedIndex', 0).change(); // Reset the selection to the first option and trigger change event
                });

                if(typeName == 'Vehicle') { // Replace 'vehicle' with the actual id of vehicle type
                    $('#average_label .avg').text('Average (Km Per Liter)');
                }
                else if(typeName == 'Equipment') { // Replace 'equipment' with the actual id of equipment type
                    $('#average_label .avg').text('Average (Per hour)');
                }
            });

            var getFleetNoUrl = '<?php echo e(route("check-fleet-no")); ?>';
            $('#fleet_no').blur(function(){
                var fleet_no = $(this).val();
                console.log(fleet_no);
                $.ajax({
                    url: getFleetNoUrl,
                    type: 'get',
                    data: {fleet_no: fleet_no},
                    success: function(response){
                        if(response.exists){
                            alert('The fleet number already exists');
                        }
                    }
                });
            });
            $('#expense_type').change(function() {
                // Hide both divs
                $('.purchase-amount-div').hide();
                $('.rent-amount-div').hide();

                // Show the appropriate div based on the selected option
                if ($(this).val() === 'own') {
                    $('.purchase-amount-div').show();
                } else if ($(this).val() === 'rental') {
                    $('.rent-amount-div').show();
                }
            });
            $('#site_id').select2({
                placeholder: "Select Site"
            });
            $('#driver_id').select2({
                placeholder: "Select Driver"
            });
            $('#type_id').select2({
                placeholder: "Fleet Type"
            });
            $('#make_model').select2({
                placeholder: "Fleet Make"
            });
            $('#model_name').select2({
                placeholder: "Fleet Model"
            });
            $('#color_name').select2({
                placeholder: "Fleet Color"
            });
            $('#model_name').on('select2:select', () => {
                selectionMade = true;

            });

            $('#start_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#end_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#exp_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#lic_exp_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#fitness_cert_exp_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#tracker_exp_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#insurance_issue_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#insurance_exp_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#reg_exp_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#issue_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            //Flat green color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/vehicles/create.blade.php ENDPATH**/ ?>