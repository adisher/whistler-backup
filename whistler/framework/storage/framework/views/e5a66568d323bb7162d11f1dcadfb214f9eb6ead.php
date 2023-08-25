
<?php $__env->startSection('extra_css'); ?>
<style type="text/css">
    .modal {
        overflow: auto;
        overflow-y: hidden;
    }

    /* .modal-open {
                                margin-left: -250px
                            } */

    .custom_padding {
        padding: .3rem !important;
    }

    .checkbox,
    #chk_all {
        width: 20px;
        height: 20px;
    }

    #loader {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        color: #555;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="#"><?php echo app('translator')->get('menu.reports'); ?></a></li>
<li class="breadcrumb-item active">Fleet Report</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Fleet Report
                </h3>
            </div>

            <div class="card-body">
                <?php echo Form::open(['route' => 'reports.fleet_report', 'method' => 'post', 'class' => 'form-inline']); ?>

                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="form-group" style="margin-right: 10px">
                        
                        <div id="reportrange" class="form-control">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                            <input type="hidden" name="daterange" id="daterange">
                        </div>
                    </div>
                    <div class="form-group" style="margin-right: 10px">
                        
                        <select id="vehicle_id" name="vehicle_id" class="form-control vehicles" style="width: 250px;">
                            <option value=""><?php echo app('translator')->get('fleet.selectVehicle'); ?></option>
                            <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($vehicle['id']); ?>" <?php if($vehicle['id']==$vehicle_id): ?> selected <?php endif; ?>>
                                <?php echo e($vehicle->make_name); ?>-<?php echo e($vehicle->model_name); ?>-<?php echo e($vehicle['license_plate']); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin-right: 10px">
                        
                        <select id="site_id" name="site_id" class="form-control vehicles" style="width: 250px;">
                            <option value="">Select Site</option>
                            <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s['id']); ?>" <?php if($s['id']==$site_id): ?> selected <?php endif; ?>>
                                <?php echo e($s->site_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info"
                        style="margin-right: 10px"><?php echo app('translator')->get('fleet.generate_report'); ?></button>
                    <button type="submit" formaction="<?php echo e(url('admin/print-fuel-report')); ?>" class="btn btn-danger"><i
                            class="fa fa-print"></i> <?php echo app('translator')->get('fleet.print'); ?></button>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>
<?php if(isset($fleet_result)): ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Fleet Report
                </h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table" id="myTable" style="padding-bottom: 25px">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Index</th>
                            <th nowrap>Make - Model - Engine</th>
                            <th>License Plate</th>
                            <th>In Service?</th>
                            <th>Assigned Driver</th>
                            <th>Assigned Site</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $yield; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->make_name); ?> - <?php echo e($item->model_name); ?> - <?php echo e($item->engine_type); ?>

                            <br /><strong>Type: </strong><?php echo e($item->types->displayname); ?>

                            <br/><strong>Color: </strong><?php echo e($item->color_name); ?> 
                            <br /><strong>Condition: </strong><?php echo e($item->fleet_condition); ?>

                            </td>
                            <td><?php echo e($item->license_plate); ?></td>
                            <td><?php echo e($item->in_service? 'YES' : 'NO'); ?></td>
                            <td>
                                <?php if($item->drivers->isEmpty()): ?>
                                N/A
                                <?php else: ?>
                                <?php $__currentLoopData = $item->drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($driver->name); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($item->sites->isEmpty()): ?>
                                N/A
                                <?php else: ?>
                                <?php $__currentLoopData = $item->sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($s->site_name); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Index</th>
                            <th>Make - Model - Engine - Color - Condition</th>
                            <th>License Plate</th>
                            <th>In Service?</th>
                            <th>Assigned Driver</th>
                            <th>Assigned Site</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/pdfmake.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/vfs_fonts.js')); ?>"></script>
<script type="text/javascript">
    $(function() {
            var start = '<?php echo e($start_date); ?>' ? moment('<?php echo e($start_date); ?>') : moment().subtract(29, 'days');
            var end = '<?php echo e($end_date); ?>' ? moment('<?php echo e($end_date); ?>') : moment();

            function cb(start, end) {
            if(start && end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            } else {
            $('#reportrange span').html('All Time');
            $('#daterange').val(''); // send an empty string for "All Time"
            }
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                        'All Time': ['', ''],
                }
            }, cb);

            cb(start, end);
            $("#vehicle_id").select2();
            $("#site_id").select2();

           $('#myTable tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="'+title+'" />' );
            });
            var myTable = $('#myTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [{
            extend: 'collection',
            text: 'Export',
            buttons: [
            'copy',
            'excel',
            'csv',
            'pdf',
            ]}
            ],
            
            "language": {
            "url": '<?php echo e(asset("assets/datatables/")."/".__("fleet.datatable_lang")); ?>',
            },
            "initComplete": function() {
            myTable.columns().every(function () {
            var that = this;
            console.log(that);
            $('input', this.footer()).on('keyup change', function () {
            that.search(this.value).draw();
            });
            });
            }
            });
            });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/reports/fleet.blade.php ENDPATH**/ ?>