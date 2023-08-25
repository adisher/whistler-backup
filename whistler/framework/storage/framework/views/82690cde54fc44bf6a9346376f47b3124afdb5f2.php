<div class="btn-group">

    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
    <span class="fa fa-gear"></span>
    <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu custom" role="menu">

    <a class="dropdown-item" class="mybtn changepass" data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#changepass" title="<?php echo app('translator')->get('fleet.change_password'); ?>"><i class="fa fa-key"  aria-hidden="true" style="color:#269abc;"></i> <?php echo app('translator')->get('fleet.change_password'); ?></a>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Users edit')): ?><a class="dropdown-item" href="<?php echo e(url("admin/users/".$row->id."/edit")); ?>"> <span aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span> <?php echo app('translator')->get('fleet.edit'); ?></a><?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Users delete')): ?><a class="dropdown-item" data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#myModal"><span aria-hidden="true" class="fa fa-trash" style="color: #dd4b39"></span> <?php echo app('translator')->get('fleet.delete'); ?></a><?php endif; ?>

    </div>
</div>
<?php echo Form::open(['url' => 'admin/users/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]); ?>


<?php echo Form::hidden("id",$row->id); ?>


<?php echo Form::close(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/users/list-actions.blade.php ENDPATH**/ ?>