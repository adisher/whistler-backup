<?php ($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y'); ?>

<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="#"><?php echo app('translator')->get('menu.reports'); ?></a></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.work_order_report'); ?></li>  
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><?php echo app('translator')->get('fleet.work_order_report'); ?>
        </h3>
      </div>

      <div class="card-body">
        <?php echo Form::open(['route' => 'reports.work_order','method'=>'post','class'=>'form-inline']); ?>

        <div class="row">
          <div class="form-group" style="margin-right: 10px">
            <?php echo Form::label('year', __('fleet.year1'), ['class' => 'form-label']); ?>

            <?php echo Form::select('year', $years, $year_select,['class'=>'form-control']); ?>

          </div>
          <div class="form-group" style="margin-right: 10px">
            <?php echo Form::label('month', __('fleet.month'), ['class' => 'form-label']); ?>

            <?php echo Form::selectMonth('month',$month_select,['class'=>'form-control']); ?>

          </div>
          <div class="form-group" style="margin-right: 10px">
            <?php echo Form::label('user', __('fleet.vehicle'), ['class' => 'form-label']); ?>

            <select id="vehicle_id" name="vehicle_id" class="form-control" required>
              <option value=""><?php echo app('translator')->get('fleet.selectVehicle'); ?></option>
              <?php $__currentLoopData = $vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($v->id); ?>" <?php if($v['id'] == $vehicle_id): ?> selected <?php endif; ?>><?php echo e($v->make_name); ?>-<?php echo e($v->model_name); ?>-<?php echo e($v->license_plate); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <button type="submit" class="btn btn-info" style="margin-right: 10px"><?php echo app('translator')->get('fleet.generate_report'); ?></button>
          <button type="submit" formaction="<?php echo e(url('admin/print-workOrder-report')); ?>" class="btn btn-danger"><i class="fa fa-print"></i> <?php echo app('translator')->get('fleet.print'); ?></button>
          <?php echo Form::close(); ?>

        </div>
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
          <?php echo app('translator')->get('fleet.report'); ?>
        </h3>
      </div>

      <div class="card-body table-responsive">
        <table class="table table-bordered table-striped table-hover"  id="myTable">
          <thead>
            <tr>
                <th><?php echo app('translator')->get('fleet.vehicle_name'); ?></th>
                <th><?php echo app('translator')->get('fleet.created_on'); ?></th>
                <th><?php echo app('translator')->get('fleet.required_by'); ?></th>
                <th><?php echo app('translator')->get('fleet.vendor_name'); ?></th>
                <th><?php echo app('translator')->get('fleet.description'); ?></th>
                <th><?php echo app('translator')->get('fleet.work_order_price'); ?></th>
                <th><?php echo app('translator')->get('fleet.total'); ?> <?php echo app('translator')->get('fleet.parts'); ?> <?php echo app('translator')->get('fleet.cost'); ?></th>
                <th><?php echo app('translator')->get('fleet.total_cost'); ?></th>
                <th><?php echo app('translator')->get('fleet.meter'); ?></th>
                <th><?php echo app('translator')->get('fleet.status'); ?></th>
            </tr>
          </thead>

          <tbody>
            
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($row->vehicle['year']); ?>

                <?php echo e($row->vehicle['make']); ?> - <?php echo e($row->vehicle['model']); ?>

                <br>
                <b> <?php echo app('translator')->get('fleet.vin'); ?>: </b><?php echo e($row->vehicle['vin']); ?>

                <br>
                <b> <?php echo app('translator')->get('fleet.plate'); ?>:</b> <?php echo e($row->vehicle['license_plate']); ?>

              </td>
              <td><?php echo e(date($date_format_setting,strtotime($row->created_at))); ?></td>
              <td> <?php echo e(date($date_format_setting,strtotime($row->required_by))); ?></td>
              <td><?php echo e($row->vendor->name); ?></td>
              <td><?php echo e($row->description); ?></td>
              <td> <?php echo e(Hyvikk::get('currency')); ?> <?php echo e($row->price); ?></td>
              <td> <?php echo e(Hyvikk::get('currency')); ?> <?php echo e($row->parts->sum('total')); ?></td>
              <td> <?php echo e(Hyvikk::get('currency')); ?> <?php echo e($row->price + $row->parts->sum('total')); ?></td>
              <td><?php echo e($row->meter); ?></td>
              <td><?php echo e($row->status); ?></td>
              
             
               
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
          <tfoot>
            <tr>
              <th><?php echo app('translator')->get('fleet.vehicle_name'); ?></th>
              <th><?php echo app('translator')->get('fleet.created_on'); ?></th>
              <th><?php echo app('translator')->get('fleet.required_by'); ?></th>
              <th><?php echo app('translator')->get('fleet.vendor_name'); ?></th>
              <th><?php echo app('translator')->get('fleet.description'); ?></th>
              <th><?php echo app('translator')->get('fleet.work_order_price'); ?></th>
              <th><?php echo app('translator')->get('fleet.total'); ?> <?php echo app('translator')->get('fleet.parts'); ?> <?php echo app('translator')->get('fleet.cost'); ?></th>
              <th><?php echo app('translator')->get('fleet.total_cost'); ?></th>
              <th><?php echo app('translator')->get('fleet.meter'); ?></th>
              <th><?php echo app('translator')->get('fleet.status'); ?></th>
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

<script type="text/javascript">
	$(document).ready(function() {
		$("#vehicle_id").select2();
	});
</script>

<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/pdfmake.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/vfs_fonts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/cdn/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#myTable tfoot th').each( function () {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="'+title+'" />' );
    });
    var myTable = $('#myTable').DataTable({
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/reports/work_order.blade.php ENDPATH**/ ?>