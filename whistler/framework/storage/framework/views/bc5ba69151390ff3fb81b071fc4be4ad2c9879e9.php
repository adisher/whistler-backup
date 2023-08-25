<div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
      <span class="fa fa-gear"></span>
      <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu custom" role="menu">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('VehicleInspection edit')): ?><a class="dropdown-item" href="<?php echo e(url("admin/vehicle-review/".$row->id."/edit")); ?>"> <span aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span> <?php echo app('translator')->get('fleet.edit'); ?></a><?php endif; ?>
      <?php echo Form::hidden("id",$row->id); ?>

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('VehicleInspection delete')): ?><a class="dropdown-item" data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#myModal"><span aria-hidden="true" class="fa fa-trash" style="color: #dd4b39"></span> <?php echo app('translator')->get('fleet.delete'); ?></a><?php endif; ?>
      <a class="dropdown-item" href="<?php echo e(url('admin/view-vehicle-review/'.$row->id)); ?>">
      <span class="fa fa-eye" aria-hidden="true" style="color: #398439"></span> <?php echo app('translator')->get('fleet.view'); ?>
      </a>
    </div>
</div>
<?php echo Form::open(['url' => 'admin/delete-vehicle-review/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]); ?>

<?php echo Form::hidden("id",$row->id); ?>

<?php echo Form::close(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/vehicles/vehicle_review_index_list_actions.blade.php ENDPATH**/ ?>