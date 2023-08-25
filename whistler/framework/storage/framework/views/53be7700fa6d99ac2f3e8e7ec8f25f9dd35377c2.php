<div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
      <span class="fa fa-gear"></span>
      <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu custom" role="menu">
      <?php if($row->status==0 && $row->ride_status != "Cancelled"): ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bookings edit')): ?><a class="dropdown-item" href="<?php echo e(url('admin/bookings/'.$row->id.'/edit')); ?>"> <span aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span> <?php echo app('translator')->get('fleet.edit'); ?></a><?php endif; ?>
      <?php if($row->receipt != 1): ?>
      <a class="dropdown-item vtype" data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#cancelBooking" > <span class="fa fa-times" aria-hidden="true" style="color: #dd4b39"></span> <?php echo app('translator')->get('fleet.cancel_booking'); ?></a>
      <?php endif; ?>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bookings delete')): ?><a class="dropdown-item vtype" data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#myModal" > <span class="fa fa-trash" aria-hidden="true" style="color: #dd4b39"></span> <?php echo app('translator')->get('fleet.delete'); ?></a><?php endif; ?>
      <?php if($row->vehicle_id != null): ?>
      <?php if($row->status==0 && $row->receipt != 1): ?>
      <?php if(Auth::user()->user_type != "C" && $row->ride_status != "Cancelled"): ?>
      <a data-toggle="modal" data-target="#receiptModal" class="open-AddBookDialog dropdown-item" data-booking-id="<?php echo e($row->id); ?>" data-user-id="<?php echo e($row->user_id); ?>" data-customer-id="<?php echo e($row->customer_id); ?>" data-vehicle-id= "<?php echo e($row->vehicle_id); ?>" data-vehicle-type="<?php echo e(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype))); ?>" data-base-mileage="<?php echo e(($row->total_kms)?$row->total_kms:Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_base_km')); ?>" data-base-fare="<?php echo e(($row->total)?$row->total:Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_base_fare')); ?>"
      data-base_km_1="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_base_km')); ?>"
      data-base_fare_1="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_base_fare')); ?>"
      data-wait_time_1="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_base_time')); ?>"
      data-std_fare_1="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_std_fare')); ?>"

      data-base_km_2="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_weekend_base_km')); ?>"
      data-base_fare_2="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_weekend_base_fare')); ?>"
      data-wait_time_2="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_weekend_wait_time')); ?>"
      data-std_fare_2="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_weekend_std_fare')); ?>"

      data-base_km_3="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_night_base_km')); ?>"
      data-base_fare_3="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_night_base_fare')); ?>"
      data-wait_time_3="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_night_wait_time')); ?>"
      data-std_fare_3="<?php echo e(Hyvikk::fare(strtolower(str_replace(' ','',$row->vehicle->types->vehicletype)).'_night_std_fare')); ?>"
      ><span aria-hidden="true" class="fa fa-file" style="color: #5cb85c;">

      </span> <?php echo app('translator')->get('fleet.invoice'); ?>
      </a>
      <?php endif; ?>
      <?php elseif($row->receipt == 1): ?>
      <a class="dropdown-item" href="<?php echo e(url('admin/bookings/receipt/'.$row->id)); ?>"><span aria-hidden="true" class="fa fa-list" style="color: #31b0d5;"></span> <?php echo app('translator')->get('fleet.receipt'); ?>
      </a>
      <?php if($row->receipt == 1 && $row->status == 0 && Auth::user()->user_type != "C"): ?>
      <a class="dropdown-item" href="<?php echo e(url('admin/bookings/complete/'.$row->id)); ?>" data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#journeyModal"><span aria-hidden="true" class="fa fa-check" style="color: #5cb85c;"></span> <?php echo app('translator')->get('fleet.complete'); ?>
      </a>
      <?php endif; ?>
      <?php endif; ?>
      <?php endif; ?>

      <?php if($row->status==1): ?>
      <?php if($row->payment==0 && Auth::user()->user_type !="C"): ?>
      <a class="dropdown-item" href="<?php echo e(url('admin/bookings/payment/'.$row->id)); ?>"><span aria-hidden="true" class="fa fa-credit-card" style="color: #5cb85c;"></span> <?php echo app('translator')->get('fleet.make_payment'); ?>
      </a>
      <?php elseif($row->payment==1): ?>
      <a class="dropdown-item text-muted" class="disabled"><span aria-hidden="true" class="fa fa-credit-card" style="color: #5cb85c;"></span> <?php echo app('translator')->get('fleet.paid'); ?>
      </a>
      <?php endif; ?>
      <?php endif; ?>
    </div>
</div>
<?php echo Form::open(['url' => 'admin/bookings/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'book_'.$row->id]); ?>

<?php echo Form::hidden("id",$row->id); ?>

<?php echo Form::close(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/bookings/list-actions.blade.php ENDPATH**/ ?>