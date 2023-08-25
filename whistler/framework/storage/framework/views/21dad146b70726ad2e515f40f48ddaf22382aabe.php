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

        .custom .nav-link.active {

            background-color: #3f51b5 !important;
            color: inherit;
        }

        .select2-selection:not(.select2-selection--multiple) {
            height: 38px !important;
        }

        span.select2-selection.select2-selection--multiple {
            width: 100%;
        }

        input.select2-search__field {
            width: auto !important;
        }

        span.select2.select2-container {
            width: 100% !important;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('vehicles.index')); ?>">Fleet</a></li>
    <li class="breadcrumb-item active">Edit Fleet</li>
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


            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Edit Fleet</h3>
                </div>

                <div class="card-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-pills custom">
                            <li class="nav-item"><a class="nav-link active" href="#info-tab" data-toggle="tab">
                                    <?php echo app('translator')->get('fleet.general_info'); ?> <i class="fa"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="#insurance" data-toggle="tab"> <?php echo app('translator')->get('fleet.insurance'); ?>
                                    <i class="fa"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="#acq-tab" data-toggle="tab"> <?php echo app('translator')->get('fleet.purchase_info'); ?>
                                    <i class="fa"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="#driver" data-toggle="tab"> <?php echo app('translator')->get('fleet.assign_driver'); ?>
                                    <i class="fa"></i></a></li>
                            
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="info-tab">
                            <?php echo Form::open([
                                'route' => ['vehicles.update', $vehicle->id],
                                'files' => true,
                                'method' => 'PATCH',
                                'class' => 'form-horizontal',
                                'id' => 'accountForm1',
                            ]); ?>

                            <?php echo Form::hidden('user_id', Auth::user()->id); ?>

                            <?php echo Form::hidden('id', $vehicle->id); ?>

                            <div class="row card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo Form::label('type_id', __('Select Fleet Type'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>


                                        <div class="col-xs-6">
                                            <select name="type_id" class="form-control" required id="type_id">
                                                <option></option>
                                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($type->id); ?>"
                                                        <?php if($vehicle->type_id == $type->id): ?> selected <?php endif; ?> data-type-name="<?php echo e($type->type_name); ?>">
                                                        <?php echo e($type->displayname); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        
                                        <?php echo Form::label('make_model_id', __('Select Make - Model'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>


                                        <div class="col-xs-6">
                                            <select name="make_model_id" class="form-control" required id="make_model">
                                                <option></option>
                                                <?php $__currentLoopData = $vehicleData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($item->id); ?>"
                                                        <?php if($vehicle->make_model_id == $item->id): ?> selected <?php endif; ?>>
                                                        <?php echo e($item->make); ?> - <?php echo e($item->model); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Fleet no -->
                                    <div class="form-group">
                                        <?php echo Form::label('fleet_no', __('Vehicle/Equipment No.'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('fleet_no', $vehicle->fleet_no, ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::label('year', __('Vehicle/Equipment Year'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::number('year', $vehicle->year, ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>
                                    <!-- Engine No. -->
                                    <div class="form-group">
                                        <?php echo Form::label('engine_no', __('Engine No.'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('engine_no', $vehicle->engine_no, ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>
                                    
                                    <!-- Chasis No -->
                                    <div class="form-group">
                                        <?php echo Form::label('chasis_no', __('Chasis No.'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('chasis_no', $vehicle->chasis_no, ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::label('license_plate', __('fleet.licensePlate'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('license_plate', $vehicle->license_plate, ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo Form::label('lic_exp_date', __('fleet.lic_exp_date'). ' <span class="text-danger">*</span>', [
                                            'class' => 'col-xs-5 control-label
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          required',
                                    ], false); ?>

                                        <div class="col-xs-6">
                                            <div class="input-group date">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span></div>
                                                <?php echo Form::text('lic_exp_date', $vehicle->lic_exp_date, ['class' => 'form-control', 'required']); ?>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tracker No -->
                                    <div class="form-group">
                                        <?php echo Form::label('tracker_no', __('Tracker No.'), ['class' => 'col-xs-5 control-label']); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('tracker_no', $vehicle->tracker_no == 0 ? '' : $vehicle->tracker_no, [
                                                'class' => 'form-control',
                                            ]); ?>

                                        </div>
                                    </div>
                                    <!-- Tracker Exp Date -->
                                    <div class="form-group">
                                        <?php echo Form::label('tracker_exp_date', __('Tracker Expiry Date'), [
                                            'class' => 'col-xs-5 control-label
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          required',
                                        ]); ?>

                                        <div class="col-xs-6">
                                            <div class="input-group date">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span></div>
                                                <?php echo Form::text('tracker_exp_date', $vehicle->tracker_exp_date == 0 ? '' : $vehicle->tracker_exp_date, [
                                                    'class' => 'form-control'
                                                ]); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fitness Certificate No -->
                                    <div class="form-group">
                                        <?php echo Form::label('fitness_cert_no', __('Fitness Certificate No.'), ['class' => 'col-xs-5 control-label']); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::text('fitness_cert_no', $vehicle->fitness_cert_no == 0 ? '' : $vehicle->fitness_cert_no, [
                                                'class' => 'form-control',
                                            ]); ?>

                                        </div>
                                    </div>
                                    <!-- Fitness Cert Exp Date -->
                                    <div class="form-group">
                                        <?php echo Form::label('fitness_cert_exp_date', __('Fitness Cert Expiry Date'), [
                                            'class' => 'col-xs-5 control-label
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          required',
                                        ]); ?>

                                        <div class="col-xs-6">
                                            <div class="input-group date">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span></div>
                                                <?php echo Form::text(
                                                    'fitness_cert_exp_date',
                                                    $vehicle->fitness_cert_exp_date == 0 ? '' : $vehicle->fitness_cert_exp_date,
                                                    [
                                                        'class' => 'form-control',
                                                    ],
                                                ); ?>

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
                                                    <input type="checkbox" name="in_service" value="1"
                                                        <?php if($vehicle->in_service == '1'): ?> checked <?php endif; ?>>
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
                                                    <option value="<?php echo e($color->color); ?>"
                                                        <?php if($vehicle->pluck('color_name')->contains($color->color)): ?> selected <?php endif; ?>>
                                                        <?php echo e($color->color); ?></option>
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
                                            <?php echo Form::hidden('vin', $vehicle->vin, ['class' => 'form-control']); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::label('average', '<span class="avg">'.__('fleet.average') . ' (' . __('fleet.kmpl') . ')</span>'. ' <span
                                            class="text-danger">*</span>', [
                                        'class' => 'col-xs-5 control-label', 'id' => 'average_label'
                                        ], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::number('average', $vehicle->average, ['class' => 'form-control', 'required', 'step' => 'any']); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php if(Hyvikk::get('dis_format') == 'km'): ?>
                                            <?php echo Form::label('int_mileage', __('fleet.intMileage') . '(' . __('fleet.km') . ')'. ' <span class="text-danger">*</span>', [
                                                'class' => 'col-xs-5
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      control-label',
                                    ], false); ?>

                                        <?php else: ?>
                                            <?php echo Form::label('int_mileage', __('fleet.intMileage') . '(' . __('fleet.miles') . ')', [
                                                'class' => 'col-xs-5
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      control-label',
                                            ]); ?>

                                        <?php endif; ?>
                                        <div class="col-xs-6">
                                            <?php echo Form::text('int_mileage', $vehicle->int_mileage, ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>
                                    <!-- Expense Type -->
                                    <div class="form-group">
                                        <?php echo Form::label('expense_type', __('Select Expense Type'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false); ?>

                                        <div class="col-xs-6">
                                            <?php echo Form::select('expense_type', ['own' => 'own', 'rental' => 'rental'], $vehicle->expense_type, [
                                                'class' => 'form-control',
                                                'id' => 'expense_type',
                                                'required',
                                            ]); ?>

                                        </div>
                                    </div>
                                        <!-- Purchase Amount -->
                                        <div class="form-group purchase-amount-div">
                                            <?php echo Form::label('purchase_amount', __('Purchase Amount'), ['class' => 'col-xs-5 control-label']); ?>

                                            <div class="col-xs-6">
                                                <?php echo Form::number('purchase_amount', $vehicle->expense_amount, ['class' => 'form-control']); ?>

                                            </div>
                                        </div>
                                        <!-- Rent Amount -->
                                        <div class="form-group rent-amount-div">
                                            <?php echo Form::label('rent_amount', __('Rent Amount'), ['class' => 'col-xs-5 control-label']); ?>

                                            <div class="col-xs-6">
                                                <?php echo Form::number('rent_amount', $vehicle->expense_amount, ['class' => 'form-control']); ?>

                                            </div>
                                        </div>

                                    <div class="form-group">
                                        <?php echo Form::label('vehicle_image', __('Fleet Image'), ['class' => 'col-xs-5 control-label']); ?>

                                        <?php if($vehicle->vehicle_image != null): ?>
                                            <a href="<?php echo e(asset('uploads/' . $vehicle->vehicle_image)); ?>" target="_blank"
                                                class="col-xs-3 control-label">View</a>
                                        <?php endif; ?>
                                        <br>
                                        <?php echo Form::file('vehicle_image', null, ['class' => 'form-control']); ?>

                                    </div>
                                    <!-- certificates images upload -->
                                    <div class="form-group">
                                        <?php echo Form::label('certificates_images', __('Certificates Images'), ['class' => 'col-xs-5 control-label']); ?>

                                        <?php if($vehicle->certificates_images != null): ?>
                                            <a href="<?php echo e(asset('uploads/' . $vehicle->certificates_images)); ?>"
                                                target="_blank" class="col-xs-3 control-label">View</a>
                                        <?php endif; ?>
                                        <br>
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
                                    <?php if($udfs != null): ?>
                                        <?php $__currentLoopData = $udfs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group"> <label
                                                            class="form-label text-uppercase"><?php echo e($key); ?></label>
                                                        <input type="text" name="udf[<?php echo e($key); ?>]"
                                                            class="form-control" required value="<?php echo e($value); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" style="margin-top: 30px"><button
                                                            class="btn btn-danger" type="button"
                                                            onclick="this.parentElement.parentElement.parentElement.remove();">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
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

                        <div class="tab-pane " id="insurance">
                            <?php echo Form::open([
                                'url' => 'admin/store_insurance',
                                'files' => true,
                                'method' => 'post',
                                'class' => 'form-horizontal',
                                'id' => 'accountForm',
                            ]); ?>

                            <?php echo Form::hidden('user_id', Auth::user()->id); ?>

                            <?php echo Form::hidden('vehicle_id', $vehicle->id); ?>

                            <div class="row card-body">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?php echo Form::label('insurance_number', __('fleet.insuranceNumber'), ['class' => 'control-label']); ?>

                                        <?php echo Form::text('insurance_number', $vehicle->getMeta('ins_number'), ['class' => 'form-control', 'required']); ?>

                                    </div>
                                    <div class="form-group">
                                        <label for="documents" class="control-label"><?php echo app('translator')->get('fleet.inc_doc'); ?>
                                        </label>
                                        <?php if($vehicle->getMeta('documents') != null): ?>
                                            <a href="<?php echo e(asset('uploads/' . $vehicle->getMeta('documents'))); ?>"
                                                target="_blank">View</a>
                                        <?php endif; ?>
                                        <?php echo Form::file('documents', null, ['class' => 'form-control']); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::label('insurance_issue_date', __('Insurance Issue Date'), ['class' => 'control-label required']); ?>

                                        <div class="input-group date">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-calendar"></i></span></div>
                                            <?php echo Form::text('insurance_issue_date', $vehicle->getMeta('ins_issue_date'), [
                                                'class' => 'form-control',
                                                'required',
                                            ]); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::label('exp_date', __('fleet.inc_expirationDate'), ['class' => 'control-label required']); ?>

                                        <div class="input-group date">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-calendar"></i></span></div>
                                            <?php echo Form::text('exp_date', $vehicle->getMeta('ins_exp_date'), ['class' => 'form-control', 'required']); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style=" margin-bottom: 20px;">
                                <div class="form-group" style="margin-top: 15px;">
                                    <?php echo Form::submit(__('fleet.submit'), ['class' => 'btn btn-success']); ?>

                                </div>
                            </div>
                            <?php echo Form::close(); ?>

                        </div>

                        <div class="tab-pane " id="acq-tab">
                            <div class="row card-body">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title"><?php echo app('translator')->get('fleet.acquisition'); ?> <?php echo app('translator')->get('fleet.add'); ?></h3>
                                        </div>

                                        <div class="card-body">
                                            <?php echo Form::open([
                                                'route' => 'acquisition.store',
                                                'method' => 'post',
                                                'class' => 'form-inline',
                                                'id' => 'add_form',
                                            ]); ?>

                                            <?php echo Form::hidden('user_id', Auth::user()->id); ?>

                                            <?php echo Form::hidden('vehicle_id', $vehicle->id); ?>

                                            <div class="form-group" style="margin-right: 10px;">
                                                <?php echo Form::label('exp_name', __('fleet.expenseType'), ['class' => 'form-label']); ?>

                                                <?php echo Form::text('exp_name', null, ['class' => 'form-control', 'required']); ?>

                                            </div>
                                            <div class="form-group"></div>
                                            <div class="form-group" style="margin-right: 10px;">
                                                <?php echo Form::label('exp_amount', __('fleet.expenseAmount'), ['class' => 'form-label']); ?>

                                                <div class="input-group" style="margin-right: 10px;">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text"><?php echo e(Hyvikk::get('currency')); ?></span>
                                                    </div>
                                                    <?php echo Form::number('exp_amount', null, ['class' => 'form-control', 'required']); ?>

                                                </div>
                                            </div>
                                            <div class="form-group"></div>
                                            <button type="submit" class="btn btn-success"><?php echo app('translator')->get('fleet.add'); ?></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row card-body">
                                <div class="col-md-12">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title"><?php echo app('translator')->get('fleet.acquisition'); ?> :<strong>
                                                    <?php if($vehicle->make_name): ?>
                                                        <?php echo e($vehicle->make_name); ?>

                                                        <?php endif; ?> <?php if($vehicle->model_name): ?>
                                                            <?php echo e($vehicle->model_name); ?>

                                                        <?php endif; ?>
                                                        <?php echo e($vehicle->license_plate); ?>

                                                </strong>
                                            </h3>
                                        </div>
                                        <div class="card-body" id="acq_table">
                                            <div class="row">
                                                <div class="col-md-12 table-responsive">
                                                    <?php ($value = unserialize($vehicle->getMeta('purchase_info'))); ?>
                                                    <table class="table">
                                                        <thead>
                                                            <th><?php echo app('translator')->get('fleet.expenseType'); ?></th>
                                                            <th><?php echo app('translator')->get('fleet.expenseAmount'); ?></th>
                                                            <th><?php echo app('translator')->get('fleet.action'); ?></th>
                                                        </thead>
                                                        <tbody id="hvk">
                                                            <?php if($value != null): ?>
                                                                <?php ($i = 0); ?>
                                                                <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <?php ($i += $row['exp_amount']); ?>
                                                                        <td><?php echo e($row['exp_name']); ?></td>
                                                                        <td><?php echo e(Hyvikk::get('currency') . ' ' . $row['exp_amount']); ?>

                                                                        </td>
                                                                        <td>
                                                                            <?php echo Form::open([
                                                                                'route' => ['acquisition.destroy', $vehicle->id],
                                                                                'method' => 'DELETE',
                                                                                'class' => 'form-horizontal',
                                                                            ]); ?>

                                                                            <?php echo Form::hidden('vid', $vehicle->id); ?>

                                                                            <?php echo Form::hidden('key', $key); ?>

                                                                            <button type="button"
                                                                                class="btn btn-danger del_info"
                                                                                data-vehicle="<?php echo e($vehicle->id); ?>"
                                                                                data-key="<?php echo e($key); ?>">
                                                                                <span class="fa fa-times"></span>
                                                                            </button>
                                                                            <?php echo Form::close(); ?>

                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><strong><?php echo app('translator')->get('fleet.total'); ?></strong></td>
                                                                    <td><strong><?php echo e(Hyvikk::get('currency') . ' ' . $i); ?></strong>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Allocate Driver -->
                        <div class="tab-pane" id="driver">
                            <?php echo Form::open([
                                'url' => 'admin/assignDriver',
                                'files' => true,
                                'method' => 'post',
                                'class' => 'form-horizontal',
                                'id' => 'accountForm',
                            ]); ?>

                            <?php echo Form::hidden('user_id', Auth::user()->id); ?>

                            <?php echo Form::hidden('vehicle_id', $vehicle->id); ?>

                            <div class="row card-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php echo Form::label('driver_id', __('fleet.selectDriver'), ['class' => 'form-label']); ?>

                                        <select id="driver_id" name="driver_id" class="form-control" required>
                                            <option value="">-</option>
                                            <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($driver->id); ?>"
                                                    <?php if($vehicle->driver_id == $driver->id): ?> selected <?php endif; ?>
                                                    <?php if($driver->getMeta('is_active') != 1): ?> disabled <?php endif; ?>>
                                                    <?php echo e($driver->name); ?>

                                                    <?php if($driver->getMeta('is_active') != 1): ?>
                                                        (<?php echo app('translator')->get('fleet.in_active'); ?>)
                                                    <?php endif; ?>
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style=" margin-bottom: 20px;">
                                <div class="form-group" style="margin-top: 15px;">
                                    <?php echo Form::submit(__('fleet.submit'), ['class' => 'btn btn-success']); ?>

                                </div>
                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                        <!-- Allocate Site -->
                        


                        <?php echo Form::close(); ?>

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
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var getByTypeUrl = '<?php echo e(route('vehicle-data-by-type', '')); ?>';

            $('#type_id').change(function() {
                var typeId = $(this).val();
                var typeName = $(this).find('option:selected').data('type-name');

                $.get(getByTypeUrl + '/' + typeId, function(data) {
                    var makeModelDropdown = $('#make_model');
                    makeModelDropdown.empty();
                    makeModelDropdown.append(
                    '<option selected></option>'); // to keep the initial empty option

                    $.each(data, function(index, item) {
                        makeModelDropdown.append('<option value="' + item.id + '">' + item
                            .make + ' - ' + item.model + '</option>');
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
            expense_type = "<?php echo e($vehicle->expense_type); ?>";
            console.log(expense_type);
            if (expense_type === 'own') {
                $('.rent-amount-div').hide();
                $('.purchase-amount-div').show();
            } else if (expense_type === 'rental') {
                $('.purchase-amount-div').hide();
                $('.rent-amount-div').show();
            }
            $('#expense_type').change(function() {
                // Show the appropriate div based on the selected option
                if ($(this).val() === 'own') {
                    $('.purchase-amount-div').show();
                    $('.rent-amount-div').hide();
                } else if ($(this).val() === 'rental') {
                    $('.rent-amount-div').show();
                    $('.purchase-amount-div').hide();
                }
            });
            $('#driver_id').select2({
                placeholder: "<?php echo app('translator')->get('fleet.selectDriver'); ?>"
            });
            $('#group_id').select2({
                placeholder: "<?php echo app('translator')->get('fleet.selectGroup'); ?>"
            });
            $('#type_id').select2({
                placeholder: "<?php echo app('translator')->get('fleet.type'); ?>"
            });
            $('#make_model').select2({
                placeholder: "Fleet Make - Model"
            });
            $('#model_name').select2({
                placeholder: "<?php echo app('translator')->get('fleet.SelectVehicleModel'); ?>"
            });
            $('#color_name').select2({
                placeholder: "<?php echo app('translator')->get('fleet.SelectVehicleColor'); ?>"
            });
            // $('#make_name').on('change',function(){
            //       // alert($(this).val());
            //       $.ajax({
            //         type: "GET",
            //         url: "<?php echo e(url('admin/get-models')); ?>/"+$(this).val(),
            //         success: function(data){
            //           var models =  $.parseJSON(data);
            //             $('#model_name').empty();
            //             $.each( models, function( key, value ) {
            //               $('#model_name').append($('<option>', {
            //                 value: value.id,
            //                 text: value.text
            //               }));
            //               $('#model_name').select2({placeholder:"<?php echo app('translator')->get('fleet.SelectVehicleModel'); ?>"});
            //             });
            //         },
            //         dataType: "html"
            //       });
            //     });
            <?php if(isset($_GET['tab']) && $_GET['tab'] != ''): ?>
                $('.nav-pills a[href="#<?php echo e($_GET['tab']); ?>"]').tab('show')
            <?php endif; ?>
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
            $('#reg_exp_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#issue_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $(document).on("click", ".del_info", function(e) {
                var hvk = confirm("Are you sure?");
                if (hvk == true) {
                    var vid = $(this).data("vehicle");
                    var key = $(this).data('key');
                    var action = "<?php echo e(route('acquisition.index')); ?>/" + vid;

                    $.ajax({
                        type: "POST",
                        url: action,
                        data: "_method=DELETE&_token=" + window.Laravel.csrfToken + "&key=" + key +
                            "&vehicle_id=" + vid,
                        success: function(data) {
                            $("#acq_table").empty();
                            $("#acq_table").html(data);
                            new PNotify({
                                title: 'Deleted!',
                                text: '<?php echo app('translator')->get('fleet.deleted'); ?>',
                                type: 'wanring'
                            })
                        },
                        dataType: "HTML",
                    });
                }
            });

            $("#add_form").on("submit", function(e) {
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    success: function(data) {
                        $("#acq_table").empty();
                        $("#acq_table").html(data);
                        new PNotify({
                            title: 'Success!',
                            text: '<?php echo app('translator')->get('fleet.exp_add'); ?>',
                            type: 'success'
                        });
                        $('#exp_name').val("");
                        $('#exp_amount').val("");
                    },
                    dataType: "HTML"
                });
                e.preventDefault();
            });

            // $("#accountForm").on("submit",function(e){
            //   $.ajax({
            //     type: "POST",
            //     url: $("#accountForm").attr("action"),
            //     data: new FormData(this),
            //     mimeType: 'multipart/form-data',
            //     contentType: false,
            //               cache: false,
            //               processData:false,
            //     success: new PNotify({
            //           title: 'Success!',
            //           text: '<?php echo app('translator')->get('fleet.ins_add'); ?>',
            //           type: 'success'
            //       }),
            //   dataType: "json",
            //   });
            //   e.preventDefault();
            // });

            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

        });
    </script>
    <script>
        // Initialize Select2 on your select boxes
        // Listen for the select2:select event on the first select box
        $('#make_name').on('select2:select', function(e) {
            // Clear the contents of the second select box
            $('#model_name').val(null).trigger('change');
            $('#color_name').val(null).trigger('change');

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/vehicles/edit.blade.php ENDPATH**/ ?>