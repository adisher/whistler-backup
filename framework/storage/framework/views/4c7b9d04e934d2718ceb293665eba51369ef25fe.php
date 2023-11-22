<?php ($date_format_setting = Hyvikk::get('date_format') ? Hyvikk::get('date_format') : 'd-m-Y'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">
        Fleet Utilization</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extra_css'); ?>
    <style type="text/css">
        .checkbox,
        #chk_all {
            width: 20px;
            height: 20px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Fleet Utilization
                        &nbsp;
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('WorkOrders add')): ?>
                            <a href="<?php echo e(route('work_order.create')); ?>" class="btn btn-success" title="Deploy Fleet"><i
                                    class="fa fa-plus"></i></a>
                        <?php endif; ?>
                    </h3>
                </div>

                <div class="card-body table-responsive">
                    <table class="table" id="ajax_data_table">
                        <thead class="thead-inverse">
                            <tr>
                                <th>
                                    <?php if($data->count() > 0): ?>
                                        <input type="checkbox" id="chk_all">
                                    <?php endif; ?>
                                </th>
                                <th></th>
                                <th>Fleet Details</th>
                                <th>Driver</th>
                                <th>Site</th>
                                <th>Shift</th>
                                <th><?php echo app('translator')->get('fleet.date'); ?></th>
                                <th>Start Meter</th>
                                <th>End Meter</th>
                                <th>Work Hours</th>
                                <th>Cost</th>
                                <th><?php echo app('translator')->get('fleet.description'); ?></th>
                                <th><?php echo app('translator')->get('fleet.action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="ids[]" value="<?php echo e($row->id); ?>" class="checkbox"
                                            id="chk<?php echo e($row->id); ?>" onclick='checkcheckbox();'>
                                    </td>
                                    <td>
                                        <?php if($row->vehicle['vehicle_image'] != null): ?>
                                            <img src="<?php echo e(asset('uploads/' . $row->vehicle['vehicle_image'])); ?>"
                                                height="70px" width="70px">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/images/vehicle.jpeg')); ?>" height="70px"
                                                width="70px">
                                        <?php endif; ?>
                                    </td>
                                    <td nowrap>
                                        <?php echo e($row->vehicle->vehicleData->make); ?> <?php echo e($row->vehicle->vehicleData->model); ?>

                                        <br>
                                        <b> <?php echo app('translator')->get('fleet.plate'); ?>:</b> <?php echo e($row->vehicle['license_plate']); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->assigned_driver->name); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->sites->site_name); ?>

                                    </td>
                                    <td>
                                        <?php if($row->shift_id == '1'): ?>
                                            <span>Morning</span>
                                        <?php elseif($row->shift_id == '2'): ?>
                                            <span>Evening</span>
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                    <td nowrap>
                                        <?php echo e($row->date); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->start_meter); ?>

                                    </td>
                                    <td>
                                        <?php if($row->end_meter == null): ?>
                                            N/A
                                        <?php else: ?>
                                            <?php echo e($row->end_meter); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e($row->work_hours); ?>

                                    </td>
                                    <td>
                                        <?php if($row->price == null || $row->price == 0): ?>
                                            N/A
                                        <?php else: ?>
                                            <?php echo e($row->price); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($row->description == null): ?>
                                            N/A
                                        <?php else: ?>
                                            <?php echo e($row->description); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-stretch">
                                            <div>
                                                <?php if($row->work_hours == 0 && $row->end_meter == null): ?>
                                                    <a class="btn btn-success close-shift" href="#"
                                                        data-id="<?php echo e($row->id); ?>"
                                                        data-vehicle-id="<?php echo e($row->vehicle->id); ?>"
                                                        data-driver-id="<?php echo e($row->driver_id); ?>"
                                                        data-start-meter="<?php echo e($row->start_meter); ?>"
                                                        data-toggle="tooltip" title="Close Shift">
                                                        <span class="fa fa-check-square fa-lg"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="btn-group ml-2">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    <span class="fa fa-gear"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu custom" role="menu">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('WorkOrders edit')): ?>
                                                        <a class="dropdown-item"
                                                            href='<?php echo e(url('admin/work_order/' . $row->id . '/edit')); ?>'> <span
                                                                aria-hidden="true" class="fa fa-edit"
                                                                style="color: #f0ad4e;"></span> <?php echo app('translator')->get('fleet.edit'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('WorkOrders delete')): ?>
                                                        <a class="dropdown-item" data-id="<?php echo e($row->id); ?>"
                                                            data-toggle="modal" data-target="#myModal"><span aria-hidden="true"
                                                                class="fa fa-trash" style="color: #dd4b39"></span>
                                                            <?php echo app('translator')->get('fleet.delete'); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php echo Form::open([
                                                'url' => 'admin/work_order/' . $row->id,
                                                'method' => 'DELETE',
                                                'class' => 'form-horizontal',
                                                'id' => 'form_' . $row->id,
                                            ]); ?>

                                            <?php echo Form::hidden('id', $row->id); ?>

                                            <?php echo Form::close(); ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>
                                    <?php if($data->count() > 0): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('WorkOrders delete')): ?>
                                            <button class="btn btn-danger" id="bulk_delete" data-toggle="modal"
                                                data-target="#bulkModal" disabled title="<?php echo app('translator')->get('fleet.delete'); ?>"><i
                                                    class="fa fa-trash"></i></button>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </th>
                                <th></th>
                                <th>Fleet Details</th>
                                <th>Driver</th>
                                <th>Site</th>
                                <th>Shift</th>
                                <th><?php echo app('translator')->get('fleet.date'); ?></th>
                                <th>Start Meter</th>
                                <th>End Meter</th>
                                <th>Work Hours</th>
                                <th>Cost</th>
                                <th><?php echo app('translator')->get('fleet.description'); ?></th>
                                <th><?php echo app('translator')->get('fleet.action'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="bulkModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo app('translator')->get('fleet.delete'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <?php echo Form::open(['url' => 'admin/delete-work-orders', 'method' => 'POST', 'id' => 'form_delete']); ?>

                    <div id="bulk_hidden"></div>
                    <p><?php echo app('translator')->get('fleet.confirm_bulk_delete'); ?></p>
                </div>
                <div class="modal-footer">
                    <button id="bulk_action" class="btn btn-danger" type="submit"
                        data-submit=""><?php echo app('translator')->get('fleet.delete'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('fleet.close'); ?></button>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
    <!-- Close Shift Modal -->
    <div class="modal fade" id="closeShiftModal" tabindex="-1" aria-labelledby="closeShiftModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="closeShiftModalLabel">Close Shift</h5>
                </div>
                <div class="modal-body">
                    <form id="closeShiftForm">
                        <input type="hidden" name="id" id="row_id" value="" />
                        <input type="hidden" name="vehicle_id" id="vehicle_id" value="" />
                        <input type="hidden" name="driver_id" id="driver_id" value="" />
                        <div class="mb-3">
                            <label for="start_meter" class="form-label">Start Meter</label>
                            <input type="number" name="start_meter" class="form-control" id="start_meter" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="end_meter" class="form-label">End Meter</label>
                            <input type="number" name="end_meter" class="form-control" id="end_meter" />
                        </div>
                        <div class="mb-3">
                            <label for="work_hours" class="form-label">Work Hours</label>
                            <input type="text" name="work_hours" class="form-control" id="work_hours" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Cost</label>
                            <input type="number" name="price" class="form-control" id="price" readonly />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="submitShift">Close Shift</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo app('translator')->get('fleet.delete'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p><?php echo app('translator')->get('fleet.confirm_delete'); ?></p>
                </div>
                <div class="modal-footer">
                    <button id="del_btn" class="btn btn-danger" type="button"
                        data-submit=""><?php echo app('translator')->get('fleet.delete'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('fleet.close'); ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $("#del_btn").on("click", function() {
            var id = $(this).data("submit");
            $("#form_" + id).submit();
        });

        $('#myModal').on('show.bs.modal', function(e) {
            var id = e.relatedTarget.dataset.id;
            $("#del_btn").attr("data-submit", id);
        });

        // Function to open the modal and populate the data
        function closeShiftModal(row_id, vehicle_id, driver_id, start_meter) {
            $('#row_id').val(row_id);
            $('#vehicle_id').val(vehicle_id);
            $('#driver_id').val(driver_id);
            $('#start_meter').val(start_meter);
            $('#closeShiftModal').modal('show');
        }

        // Click event on the "Close Shift" link
        $('a.close-shift').click(function(e) {
            e.preventDefault();
            var row_id = $(this).data('id');
            var vehicle_id = $(this).data('vehicle-id');
            var driver_id = $(this).data('driver-id');
            var start_meter = $(this).data('start-meter');
            closeShiftModal(row_id, vehicle_id, driver_id, start_meter);
        });

        // Calculate work hours and cost when the end meter changes
        $('#end_meter').on('change keyup', function() {
            var start_meter = parseFloat($('#start_meter').val());
            var end_meter = parseFloat($(this).val());
            var total_hours = end_meter - start_meter;

            // Extract the integer part as hours
            var hours = Math.floor(total_hours);

            // Extract the fractional part and convert to minutes
            var minutes = Math.round((total_hours - hours) * 60);

            // Format the result as hh:mm
            var work_hours_format = (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes;
            $('#work_hours').val(work_hours_format);

            var vehicleId = $('#vehicle_id').val();
            if (vehicleId) {
                var url = "<?php echo e(route('vehicles.expense', ['id' => ':id'])); ?>".replace(':id', vehicleId);
                $.get(url, function(vehicleData) {
                    if (vehicleData.expense_type === 'rental') {
                        var cost = total_hours * vehicleData
                            .expense_amount; // Calculating cost based on total_hours
                        var roundedCost = cost.toFixed(2);
                        $('#price').val(roundedCost);
                    } else {
                        $('#price').val(0);
                    }
                });
            }
        });

        // Save changes button click handler
        $('#submitShift').click(function() {
            var formData = $('#closeShiftForm').serialize();
            var formDataObj = new URLSearchParams(formData);
            var id = formDataObj.get('id');
            $.ajax({
                url: "<?php echo e(route('close_shift')); ?>",
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success, e.g., close the modal and refresh the page
                    $('#closeShiftModal').modal('hide');
                    location.reload(); // Refresh the page
                },
                error: function(response) {
                    // Handle error, e.g., display a message
                    alert('An error occurred. Please try again.');
                }
            });
        });




        // $(function(){

        //   var table = $('#ajax_data_table').DataTable({
        //         "language": {
        //             "url": '<?php echo e(asset('assets/datatables/') . '/' . __('fleet.datatable_lang')); ?>',
        //         },
        //        processing: true,
        //        serverSide: true,
        //        ajax: {
        //         url: "<?php echo e(url('admin/work-orders-fetch')); ?>",
        //         type: 'POST',
        //         data:{}
        //        },

        //        columns: [
        //           {data: 'check',name:'id', searchable:false, orderable:false},            
        //           {data: 'vehicle_image',name:'vehicle_image', searchable:false, orderable:false},
        //           {data: 'vehicle', name: 'vehicle'},
        //           {data: 'date', name: 'date'},
        //           {data: 'description', name: 'description'},
        //           {data: 'status', name: 'status'},            
        //           {data: 'action',name:'action',  searchable:false, orderable:false}
        //       ],        
        //       order: [[3, 'desc']],
        //       "initComplete": function() {
        //             table.columns().every(function () {
        //               var that = this;
        //               $('input', this.footer()).on('keyup change', function () {
        //                 // console.log($(this).parent().index());
        //                   that.search(this.value).draw();
        //               });
        //             });
        //           }
        //   });
        // });
        $(document).on('click', 'input[type="checkbox"]', function() {
            if (this.checked) {
                $('#bulk_delete').prop('disabled', false);

            } else {
                if ($("input[name='ids[]']:checked").length == 0) {
                    $('#bulk_delete').prop('disabled', true);
                }
            }

        });

        $('#bulk_delete').on('click', function() {
            // console.log($( "input[name='ids[]']:checked" ).length);
            if ($("input[name='ids[]']:checked").length == 0) {
                $('#bulk_delete').prop('type', 'button');
                new PNotify({
                    title: 'Failed!',
                    text: "<?php echo app('translator')->get('fleet.delete_error'); ?>",
                    type: 'error'
                });
                $('#bulk_delete').attr('disabled', true);
            }
            if ($("input[name='ids[]']:checked").length > 0) {
                // var favorite = [];
                $.each($("input[name='ids[]']:checked"), function() {
                    // favorite.push($(this).val());
                    $("#bulk_hidden").append('<input type=hidden name=ids[] value=' + $(this).val() + '>');
                });
                // console.log(favorite);
            }
        });

        $('#chk_all').on('click', function() {
            if (this.checked) {
                $('.checkbox').each(function() {
                    $('.checkbox').prop("checked", true);
                });
            } else {
                $('.checkbox').each(function() {
                    $('.checkbox').prop("checked", false);
                });
                $('#bulk_delete').prop('disabled', true);
            }
        });

        $(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        // Checkbox checked
        function checkcheckbox() {
            // Total checkboxes
            var length = $('.checkbox').length;
            // Total checked checkboxes
            var totalchecked = 0;
            $('.checkbox').each(function() {
                if ($(this).is(':checked')) {
                    totalchecked += 1;
                }
            });
            // console.log(length+" "+totalchecked);
            // Checked unchecked checkbox
            if (totalchecked == length) {
                $("#chk_all").prop('checked', true);
            } else {
                $('#chk_all').prop('checked', false);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/work_orders/index.blade.php ENDPATH**/ ?>