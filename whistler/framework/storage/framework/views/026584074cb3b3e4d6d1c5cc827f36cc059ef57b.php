<?php $__env->startComponent('mail::message'); ?>
# <?php echo e($title); ?> Reminder




Reminder Details:
	<?php ($title=(isset($reminder->preventive_maintenance->vehicle)? $reminder->preventive_maintenance->vehicle->vehicleData->make.' ':'').$reminder->preventive_maintenance->vehicle->vehicleData->model.' '.$reminder->preventive_maintenance->vehicle->license_plate); ?>
	<?php ($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y'); ?>

	Fleet: <?php echo e($title); ?>

	Service: <?php echo e($reminder->preventive_maintenance->services->description); ?>

	Current meter: <?php echo e($reminder->preventive_maintenance->vehicle->int_mileage); ?> kms
	Planned: <?php echo e($reminder->preventive_maintenance->next_planned); ?> kms
	Last service: <?php echo e($reminder->preventive_maintenance->last_performed); ?> kms

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /var/www/html/whistler/framework/resources/views/emails/service_reminder.blade.php ENDPATH**/ ?>