<?php ($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y'); ?>

<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('work_order.index')); ?>">Fleet Utilization </a></li>
<li class="breadcrumb-item active">Fleet Utilization History</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          Fleet Utilization History
        </h3>
      </div>
      <div class="card-body table-responsive">
        <table class="table" id="data_table">
          <thead class="thead-inverse">
            <tr>
              <th>
                <?php if($data->count() > 0): ?>
                <input type="checkbox" id="chk_all">
                <?php endif; ?>
              </th>
              <th>Fleet Details</th>
              <th></th>
              <th>Site</th>
              <th>Shift</th>
              <th><?php echo app('translator')->get('fleet.date'); ?></th>
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
                <input type="checkbox" name="ids[]" value="<?php echo e($row->id); ?>" class="checkbox" id="chk<?php echo e($row->id); ?>"
                  onclick='checkcheckbox();'>
              </td>
              <td>
                <?php if($row->vehicle['vehicle_image'] != null): ?>
                <img src="<?php echo e(asset('uploads/'.$row->vehicle['vehicle_image'])); ?>" height="70px" width="70px">
                <?php else: ?>
                <img src="<?php echo e(asset(" assets/images/vehicle.jpeg")); ?>" height="70px" width="70px">
                <?php endif; ?>
              </td>
              <td nowrap>
                <?php echo e($row->vehicle->vehicleData->make); ?> <?php echo e($row->vehicle->vehicleData->model); ?>

                <br>
                <b> <?php echo app('translator')->get('fleet.plate'); ?>:</b> <?php echo e($row->vehicle['license_plate']); ?>

              </td>
              <td>
                <?php echo e($row->sites->site_name); ?>

              </td>
              <td>
                <?php if($row->shift_id == "1"): ?>
                <span>Morning</span>
                <?php elseif($row->shift_id == "2"): ?>
                <span>Evening</span>
                <?php else: ?>
                N/A
                <?php endif; ?>
              </td>
              <td nowrap>
                <?php echo e($row->date); ?>

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
                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="fa fa-gear"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu custom" role="menu">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('WorkOrders edit')): ?><a class="dropdown-item" href='<?php echo e(url("admin/work_order/".$row->id."/edit")); ?>'> <span
                        aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span> <?php echo app('translator')->get('fleet.edit'); ?></a><?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('WorkOrders delete')): ?><a class="dropdown-item" data-id="<?php echo e($row->id); ?>" data-toggle="modal"
                      data-target="#myModal"><span aria-hidden="true" class="fa fa-trash" style="color: #dd4b39"></span>
                      <?php echo app('translator')->get('fleet.delete'); ?></a><?php endif; ?>
                  </div>
                </div>
                <?php echo Form::open(['url' =>
                'admin/work_order/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]); ?>

                <?php echo Form::hidden("id",$row->id); ?>

                <?php echo Form::close(); ?>

              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
          <tfoot>
            <tr>
              <th>
                
              </th>
              <th></th>
              <th>Fleet Details</th>
              <th>Site</th>
              <th>Shift</th>
              <th><?php echo app('translator')->get('fleet.date'); ?></th>
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
        <button id="del_btn" class="btn btn-danger" type="button" data-submit=""><?php echo app('translator')->get('fleet.delete'); ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('fleet.close'); ?></button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  $("#del_btn").on("click",function(){
    var id=$(this).data("submit");
    $("#form_"+id).submit();
  });

  $('#myModal').on('show.bs.modal', function(e) {
    var id = e.relatedTarget.dataset.id;
    $("#del_btn").attr("data-submit",id);
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/work_orders/logs.blade.php ENDPATH**/ ?>