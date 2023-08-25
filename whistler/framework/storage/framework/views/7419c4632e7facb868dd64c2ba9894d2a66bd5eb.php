<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item active"><?php echo app('translator')->get('menu.notifications'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><?php echo app('translator')->get('menu.notifications'); ?></h3>
      </div>
      <div class="card-body table-responsive">
        <table class="table" id="data_table">
          <thead class="thead-inverse">
            <tr>
              <th><?php echo app('translator')->get('fleet.driverImage'); ?></th>
              <th><?php echo app('translator')->get('fleet.name'); ?></th>
              <th><?php echo app('translator')->get('fleet.notification'); ?></th>
              <th><?php echo app('translator')->get('fleet.remaining_days'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $user = App\Model\User::find(Auth::id());
            
            ?>
            <?php if($type = "renew-driving-licence"): ?>
            <?php ($type = "App\Notifications\RenewDriverLicence"); ?>
            <?php endif; ?>
            <?php $__currentLoopData = $user->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($notification->type==$type): ?>
            <?php ($notification->markAsRead()); ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $driver; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $user->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($notification->type == $type): ?>
            <?php ($to = \Carbon\Carbon::now()); ?>

            <?php ($from = \Carbon\Carbon::createFromFormat('Y-m-d', $notification->data['date'])); ?>

            <?php ($diff_in_days = $to->diffInDays($from)); ?>

            <?php if($data->id == $notification->data['vid']): ?>
            <tr>
              <td>
                <?php if($data->getMeta('driver_image') == null): ?>
                  <img src="<?php echo e(asset("assets/images/no-user.jpg")); ?>" height="70px" width="70px">
                <?php else: ?>
                  <img src="<?php echo e(asset('uploads/'.$data->getMeta('driver_image'))); ?>" height="70px" width="70px">
                <?php endif; ?>
              </td>
              <td>
                <?php echo e($data->getMeta('first_name')); ?> <?php echo e($data->getMeta('last_name')); ?>

              </td>
              <td> <?php echo app('translator')->get('fleet.driver_licence'); ?> <?php echo e(date(Hyvikk::get('date_format'),strtotime($notification->data['msg']))); ?></td>
              <td>
              <?php if(strtotime($notification->data['msg'])>strtotime("now")): ?>
                <?php echo e($diff_in_days); ?>

              <?php else: ?>
                <span class="text-danger">Expired</span>
              <?php endif; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/notifications/driver_notification.blade.php ENDPATH**/ ?>