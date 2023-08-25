<div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
    <span class="fa fa-gear"></span>
    <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu custom" role="menu">
      <a class="dropdown-item" href='<?php echo e(url("admin/parts-used/".$row->id)); ?>'> <span aria-hidden="true" class="fa fa-wrench" style="color: green;"></span> <?php echo app('translator')->get('fleet.partsUsed'); ?></a>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('WorkOrders edit')): ?><a class="dropdown-item" href='<?php echo e(url("admin/work_order/".$row->id."/edit")); ?>'> <span aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span> <?php echo app('translator')->get('fleet.edit'); ?></a><?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('WorkOrders delete')): ?><a class="dropdown-item" data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#myModal"><span aria-hidden="true" class="fa fa-trash" style="color: #dd4b39"></span> <?php echo app('translator')->get('fleet.delete'); ?></a><?php endif; ?>
    </div>
</div>
<?php echo Form::open(['url' => 'admin/work_order/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]); ?>

<?php echo Form::hidden("id",$row->id); ?>

<?php echo Form::close(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/work_orders/list-actions.blade.php ENDPATH**/ ?>