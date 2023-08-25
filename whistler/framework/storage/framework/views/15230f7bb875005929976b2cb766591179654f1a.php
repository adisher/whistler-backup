
<?php ($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y'); ?>

<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="#"><?php echo app('translator')->get('menu.reports'); ?></a></li>
<li class="breadcrumb-item active">Product Yield Report</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Product Yield Report
                </h3>
            </div>

            <div class="card-body">
                <?php echo Form::open(['route' => 'reports.yield_report','method'=>'post','class'=>'form-inline']); ?>

                <?php echo csrf_field(); ?>
                <div class="row">
                    <div id="reportrange" class="form-control" style="margin-right: 10px">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                        <input type="hidden" name="daterange" id="daterange">
                    </div>

                    <div class="form-group" style="margin-right: 10px">
                        
                        <select id="site_name" name="site_name" class="form-control vehicles" style="width: 250px;">
                            <option value="">Select Site</option>
                            <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s['site_name']); ?>" <?php if($s['site_name']==$site): ?> selected <?php endif; ?>>
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
<?php if(isset($result)): ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Fuel Report
                </h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table" id="myTable" style="padding-bottom: 25px">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->get('fleet.site_name'); ?></th>
                            <th><?php echo app('translator')->get('fleet.site_details'); ?></th>
                            <th><?php echo app('translator')->get('fleet.shift_details'); ?></th>
                            <th>Shift Yield Details</th>
                            <th>Site Production Details</th>
                            <th>Stock Details</th>
                            <th>Product Transfer</th>
                            <th><?php echo app('translator')->get('fleet.shift_yield'); ?></th>
                            <th><?php echo app('translator')->get('fleet.daily_yield'); ?></th>
                            <th>Daily Quantity</th>
                            <th>Wastage</th>
                            <th><?php echo app('translator')->get('fleet.date'); ?></th>
                            <th><?php echo app('translator')->get('fleet.time'); ?></th>
                            <th><?php echo app('translator')->get('fleet.shift_incharge_id'); ?></th>
                            <th>Shift Quantity</th>
                            <th>Yield Quality</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $yield; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->site_name); ?></td>
                            <td><?php echo e(\Illuminate\Support\Str::limit($item->site_details, 10, '...')); ?></td>
                            <td><?php echo e(\Illuminate\Support\Str::limit($item->shift_details, 10, '...')); ?></td>
                            <td><?php echo e(\Illuminate\Support\Str::limit($item->shift_yield_details, 10, '...')); ?></td>
                            <td><?php echo e(\Illuminate\Support\Str::limit($item->site_production_details, 10, '...')); ?></td>
                            <td><?php echo e(\Illuminate\Support\Str::limit($item->stock_details, 10, '...')); ?></td>
                            <td><?php echo e($item->product_transfer ? 'Yes' : 'No'); ?></td>
                            <td><?php echo e($item->shift_yield); ?></td>
                            <td><?php echo e($item->daily_yield); ?></td>
                            <td><?php echo e($item->daily_quantity); ?></td>
                            <td><?php echo e($item->wastage); ?></td>
                            <td><?php echo e(date('d/m/Y', strtotime($item->date))); ?></td>
                            <td><?php echo e(date('h:i a', strtotime($item->time))); ?></td>
                            <td><?php echo e($item->incharge->name); ?></td>
                            <td><?php echo e($item->shift_quantity); ?></td>
                            <td><?php echo e($item->yield_quality); ?></td>
                            <?php if(Auth::user()->user_type == 'O' && Auth::user()->group_id == 1): ?>
                            <td><?php echo e($item->status ? 'Forwarded' : 'Not Forwarded'); ?></td>
                            <?php else: ?>
                            <td><?php echo e($item->status ? 'Approved' : 'Not Approved'); ?></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->get('fleet.site_name'); ?></th>
                            <th><?php echo app('translator')->get('fleet.site_details'); ?></th>
                            <th><?php echo app('translator')->get('fleet.shift_details'); ?></th>
                            <th>Shift Yield Details</th>
                            <th>Site Production Details</th>
                            <th>Stock Details</th>
                            <th>Product Transfer</th>
                            <th><?php echo app('translator')->get('fleet.shift_yield'); ?></th>
                            <th><?php echo app('translator')->get('fleet.daily_yield'); ?></th>
                            <th>Daily Quantity</th>
                            <th>Wastage</th>
                            <th><?php echo app('translator')->get('fleet.date'); ?></th>
                            <th><?php echo app('translator')->get('fleet.time'); ?></th>
                            <th><?php echo app('translator')->get('fleet.shift_incharge_id'); ?></th>
                            <th>Shift Quantity</th>
                            <th>Yield Quality</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("script"); ?>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/pdfmake.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/vfs_fonts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();
        
        function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        // Update the hidden input field's value
        $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
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
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
        }, cb);
        
        cb(start, end);
		$("#vehicle_id").select2();
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
	                  $('input', this.footer()).on('keyup change', function () {
	                      that.search(this.value).draw();
	                  });
	                });
	              }
	    });
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/reports/product_yield.blade.php ENDPATH**/ ?>