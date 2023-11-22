
<?php ($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y'); ?>

<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="#"><?php echo app('translator')->get('menu.reports'); ?></a></li>
<li class="breadcrumb-item active">Scheduled Reports</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Scheduled Reports
                </h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th>Report Name</th>
                            <th>Frequency</th>
                            <th>Format</th>
                            <th>Report Type</th>
                            <th>Recipients</th>
                            <th>Assets</th>
                            <th>Subject</th>
                            <th>Content</th>
                            <th>Date & Time</th>
                            <th>End Date</th>
                            <th>Created By</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $scheduled; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($row->name); ?></td>
                            <td><?php echo e($row->frequency); ?></td>
                            <td><?php echo e($row->format); ?></td>
                            <td><?php echo e($row->type); ?></td>
                            <td><?php echo e($row->recipients); ?></td>
                            <td><?php echo e($row->assets); ?></td>
                            <td><?php echo e($row->subject); ?></td>
                            <td><?php echo e($row->content); ?></td>
                            <td><?php echo e(date($date_format_setting,strtotime($row->date))); ?></td>
                            <td><?php echo e(date($date_format_setting,strtotime($row->end))); ?></td>
                            <td><?php echo e(date($date_format_setting,strtotime($row->created_by))); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Report Name</th>
                            <th>Frequency</th>
                            <th>Format</th>
                            <th>Report Type</th>
                            <th>Recipients</th>
                            <th>Assets</th>
                            <th>Subject</th>
                            <th>Content</th>
                            <th>Date & Time</th>
                            <th>End Date</th>
                            <th>Created By</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection("script"); ?>

<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/pdfmake.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/vfs_fonts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $("#vehicle_id").select2();
    $('#myTable tfoot th').each( function () {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="'+title+'" />' );
    });
  	var myTable =	$('#myTable').DataTable({
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
         // individual column search
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/reports/scheduled.blade.php ENDPATH**/ ?>