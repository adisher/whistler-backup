<td>
    <a href="<?php echo e(route('sites.edit', $row->id)); ?>" class="btn btn-sm btn-secondary m-1">Edit</a>
    <?php if(Auth::user()->user_type == 'O' ||
    (Auth::user()->user_type == 'EO' && Auth::user()->group_id == 1) ||
    Auth::user()->group_id == 2): ?>
    <form action="<?php echo e(route('sites.destroy', $row->id)); ?>" method="POST" style="display: inline-block;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="btn btn-sm btn-danger m-1"
            onclick="return confirm('Are you sure?')">Delete</button>
    </form>
    <?php endif; ?>
    <?php if(Auth::user()->user_type == 'SM' && Auth::user()->group_id == 3): ?>
    <?php if($row->status): ?>
    <form action="<?php echo e(route('sites.approve', $row->id)); ?>" method="POST" style="display: inline-block;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <button type="submit" class="btn btn-sm btn-success m-1" hidden="hidden"
            onclick="return confirm('Are you sure?')">Approve</button>
    </form>
    <?php else: ?>
    <form action="<?php echo e(route('sites.approve', $row->id)); ?>" method="POST" style="display: inline-block;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <button type="submit" class="btn btn-sm btn-success m-1"
            onclick="return confirm('Are you sure?')">Approve</button>
    </form>
    <?php endif; ?>
    <?php endif; ?>

</td><?php /**PATH /var/www/html/whistler/framework/resources/views/sites/list-actions.blade.php ENDPATH**/ ?>