<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('work_order.index')); ?>"><?php echo app('translator')->get('fleet.work_orders'); ?> </a></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.partsUsed'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          <?php echo app('translator')->get('fleet.partsUsed'); ?>
        </h3>
      </div>

      <div class="card-body table-responsive">
        <table class="table" id="data_table">
          <thead class="thead-inverse">
            <tr>
              <th><?php echo app('translator')->get('fleet.vehicle'); ?></th>
              <th><?php echo app('translator')->get('fleet.description'); ?></th>
              <th><?php echo app('translator')->get('fleet.part'); ?></th>
              <th><?php echo app('translator')->get('fleet.qty'); ?></th>
              <th><?php echo app('translator')->get('fleet.unit_cost'); ?></th>
              <th><?php echo app('translator')->get('fleet.total_cost'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $order->parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($row->workorder->vehicle->make_name); ?> - <?php echo e($row->workorder->vehicle->model_name); ?> - <?php echo e($row->workorder->vehicle->license_plate); ?></td>
              <td><?php echo $row->workorder->description; ?></td>
              <td><?php echo e($row->part->title); ?></td>
              <td><?php echo e($row->qty); ?></td>
              <td><?php echo e(Hyvikk::get('currency')." ". $row->price); ?></td>
              <td><?php echo e(Hyvikk::get('currency')." ". $row->total); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/work_orders/parts_used.blade.php ENDPATH**/ ?>