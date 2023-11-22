<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('parts.index')); ?>"><?php echo app('translator')->get('menu.manageParts'); ?></a></li>
    <li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.addParts'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><?php echo app('translator')->get('fleet.addParts'); ?></h3>
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

                    <?php echo Form::open(['route' => 'parts.store', 'method' => 'post', 'files' => true]); ?>

                    <?php echo Form::hidden('user_id', Auth::user()->id); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label(
                                    'category_id',
                                    __('fleet.parts_category') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="category_id" name="category_id" class="form-control" required
                                    onchange="handleCategorySelectChange(this)">
                                    <option value="">-</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <optgroup label="">
                                        <option value="add_new_category">Add New Category</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group" id="new_category_form"></div>

                            <div class="form-group">
                                <?php echo Form::label(
                                    'title',
                                    __('fleet.title') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <?php echo Form::text('title', null, ['class' => 'form-control', 'required']); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('date', __('fleet.date'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false); ?>

                                <div class='input-group'>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <?php echo Form::text('date', date('Y-m-d'), ['class' => 'form-control', 'required']); ?>

                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo Form::label(
                                    'stock',
                                    __('No. of Items') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <?php echo Form::number('stock', null, ['class' => 'form-control', 'required']); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label(
                                    'unit_cost',
                                    __('fleet.unit_cost') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₵</span>
                                    </div>

                                    <?php echo Form::number('unit_cost', null, ['class' => 'form-control', 'required']); ?>

                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo Form::label('image', __('fleet.picture'), ['class' => 'form-label']); ?>

                                <br>
                                <?php echo Form::file('image', null, ['class' => 'form-control']); ?>

                            </div>
                            <hr>
                            <div class="form-group">
                                <?php echo Form::label('udf1', __('fleet.add_udf'), ['class' => 'col-xs-5 control-label']); ?>

                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo Form::text('udf1', null, ['class' => 'form-control']); ?>

                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-info add_udf"> <?php echo app('translator')->get('fleet.add'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="blank"></div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label(
                                    'vendor_id',
                                    __('fleet.vendor') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ); ?>

                                <select id="vendor_id" name="vendor_id" class="form-control" required
                                    onchange="handleVendorSelectChange(this)">
                                    <option value="">-</option>
                                    <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <optgroup label="">
                                        <option value="add_new_vendor">Add New Vendor</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group" id="new_vendor_form"></div>


                            <div class="form-group">
                                <?php echo Form::label('manufacturer', __('fleet.manufacturer'), ['class' => 'form-label']); ?>

                                <?php echo Form::text('manufacturer', null, ['class' => 'form-control']); ?>

                            </div>

                            <div class="form-group">
                                <?php echo Form::label('year', __('fleet.year1'), ['class' => 'form-label']); ?>

                                <?php echo Form::text('year', null, ['class' => 'form-control']); ?>

                            </div>

                            <div class="form-group">
                                <?php echo Form::label('model', __('fleet.part_model'), ['class' => 'form-label']); ?>

                                <?php echo Form::text('model', null, ['class' => 'form-control']); ?>

                            </div>

                            <div class="form-group">
                                <?php echo Form::label('note', __('fleet.note'), ['class' => 'form-label']); ?>

                                <?php echo Form::textarea('note', null, ['class' => 'form-control']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php echo Form::submit(__('fleet.savePart'), ['class' => 'btn btn-success']); ?>

                    </div>
                    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $("#vendor_id").select2({
            placeholder: "<?php echo app('translator')->get('fleet.select_vendor'); ?>"
        });
        $("#category_id").select2({
            placeholder: "<?php echo app('translator')->get('fleet.parts_category'); ?>"
        });

        function handleVendorSelectChange(selectElement) {
            var selectedOption = selectElement.value;
            if (selectedOption === 'add_new_vendor') {
                var newForm = `
          <label for="new_vendor_name">New Vendor Name</label>
          <input type="text" name="new_vendor_name" id="new_vendor_name" placeholder="Enter new vendor name" class='form-control'>
        `;
                // Append new form to the div
                $('#new_vendor_form').html(newForm);
            } else {
                // Empty the div
                $('#new_vendor_form').empty();
            }
        }

        function handleCategorySelectChange(selectElement) {
            var selectedOption = selectElement.value;
            if (selectedOption === 'add_new_category') {
                var newForm = `
          <label for="new_category_name">New Category Name</label>
          <input type="text" name="new_category_name" id="new_category_name" placeholder="Enter new category name" class='form-control'>
        `;
                // Append new form to the div
                $('#new_category_form').html(newForm);
            } else {
                // Empty the div
                $('#new_category_form').empty();
            }
        }


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

        //Flat green color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/parts/create.blade.php ENDPATH**/ ?>