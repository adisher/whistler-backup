<?php $currency = Hyvikk::get('currency') ?>
<?php $date_format_setting = (Hyvikk::get('date_format')) ? Hyvikk::get('date_format') : 'd-m-Y'; ?>
<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="#"><?php echo app('translator')->get('menu.reports'); ?></a></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.paymentReport'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><?php echo app('translator')->get('fleet.add'); ?> <?php echo app('translator')->get('fleet.driverPayment'); ?>
        </h3>
      </div>
      <div class="card-body">

        <?php echo Form::open(['route'=>'reports.payments', 'method'=>'POST']); ?>

        <div class="row">
          <div class="col-md-4 form-group">
            <?php echo Form::label('driver', trans('fleet.driver')); ?>

            <?php echo Form::select('driver',$drivers??[],null,['class'=>'form-control','placeholder'=>trans('fleet.select')],$driver_booking_amount); ?>

            <?php echo Form::hidden('remaining_amount_hidden', null, ['id'=>'remaining_amount_hidden']); ?>

            <small id="remaining_amount" style="display: none;"></small>
          </div>
          <div class="col-md-4 form-group">
            <?php echo Form::label('amount', trans('fleet.amount')); ?>

            <?php echo Form::number('amount',null,['class'=>'form-control','step'=>'0.01','min'=>0]); ?>

          </div>
          <div class="col-md-4 form-group">
            <?php echo Form::label('notes', trans('fleet.notes')); ?>

            <?php echo Form::textarea('notes',null,['class'=>'form-control','rows'=>2]); ?>

          </div>
          <div class="col-md-12">
            <?php echo Form::submit(trans('fleet.submit'), ['class'=>'btn btn-primary']); ?>

          </div>
        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><?php echo app('translator')->get('fleet.paymentReport'); ?>
        </h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table w-100" id="data_table">
                <thead>
                  <tr>
                    <th></th>
                    <th style="width: 7%;">#</th>
                    <th  style="width: 7%;"><?php echo app('translator')->get('fleet.driver'); ?> <?php echo app('translator')->get('fleet.id'); ?></th>
                    <th><?php echo app('translator')->get('fleet.driver'); ?></th>
                    <th><?php echo app('translator')->get('fleet.description'); ?></th>
                    <th><?php echo app('translator')->get('fleet.amount'); ?></th>
                    <th><?php echo app('translator')->get('fleet.datetime'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $driver_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($payment instanceof App\Model\Bookings): ?>
                  <tr>
                    <td></td>
                    <td><?php echo e($payment->id); ?></td>
                    <td><?php echo e($payment->driver_id); ?></td>
                    <td><?php echo e($payment->driver->name); ?></td>
                    <td><?php echo app('translator')->get('fleet.booking_id'); ?>: <?php echo e($payment->id); ?></td>
                    <td><?php echo e($currency); ?><?php echo e($payment->driver_amount??$payment->total); ?></td>
                    <td><?php echo e(date($date_format_setting.' h:i A',strtotime($payment->updated_at))); ?></td>
                  </tr>
                  <?php else: ?>
                  <tr>
                    <td></td>
                    <td><?php echo e($payment->id); ?></td>
                    <td><?php echo e($payment->driver_id); ?></td>
                    <td><?php echo e($payment->driver->name); ?></td>
                    <td><?php echo app('translator')->get('fleet.payment'); ?></td>
                    <td><?php echo e($currency); ?><?php echo e($payment->amount); ?></td>
                    <td><?php echo e(date($date_format_setting.' h:i A',strtotime($payment->updated_at))); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>#</th>
                    <th><?php echo app('translator')->get('fleet.driver'); ?> <?php echo app('translator')->get('fleet.id'); ?></th>
                    <th><?php echo app('translator')->get('fleet.driver'); ?></th>
                    <th><?php echo app('translator')->get('fleet.description'); ?></th>
                    <th><?php echo app('translator')->get('fleet.amount'); ?></th>
                    <th><?php echo app('translator')->get('fleet.datetime'); ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
  $(function(){
        $('#driver').on('change', function(){
          var remaining_amount = $(this).find('option:selected').attr('data-remaining-amount') || ($(this).find('option:selected').data('amount') || 0);
          
          if(Number.parseInt(remaining_amount) >= 0){
            $('#remaining_amount').text('<?php echo e(trans("fleet.remaining_amount")); ?>: <?php echo e($currency); ?>'+remaining_amount).show();
            $('#remaining_amount_hidden').val(remaining_amount);
            $('#amount').attr('max',remaining_amount);
          }else{
            $('#remaining_amount').hide();
          }
        });
      });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/reports/driver_payments.blade.php ENDPATH**/ ?>