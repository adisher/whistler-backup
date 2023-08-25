
<div role="tabpanel">
    <ul class="nav nav-pills">
        <li class="nav-item"><a href="#info-tab" data-toggle="tab" class="nav-link custom_padding active"> <?php echo app('translator')->get('fleet.general_info'); ?> <i class="fa"></i></a>
        </li>

        <li class="nav-item"><a href="#address-tab" data-toggle="tab" class="nav-link custom_padding"> <?php echo app('translator')->get('fleet.insurance'); ?> <i class="fa"></i></a>
        </li>

        <li class="nav-item"><a href="#acq-tab" data-toggle="tab" class="nav-link custom_padding"> <?php echo app('translator')->get('fleet.purchase_info'); ?> <i class="fa"></i></a>
        </li>

        <li class="nav-item"><a href="#reviews" data-toggle="tab" class="nav-link custom_padding"> <?php echo app('translator')->get('fleet.vehicle_inspection'); ?> <i class="fa"></i></a>
        </li>
    </ul>

	<div class="tab-content">
		<!-- tab1-->
		<div class="tab-pane active" id="info-tab">
			<table class="table table-striped">
				<tr>
					<th><?php echo app('translator')->get('fleet.vehicle'); ?></th>
					<td><?php echo e($vehicle->make_name); ?></td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.model'); ?></th>
					<td>
						<?php echo e($vehicle->model_name); ?>

					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.type'); ?></th>
					<td>
						<?php echo e($vehicle->types->displayname); ?>

					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.year'); ?></th>
					<td>
						<?php echo e($vehicle->year); ?>

					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.average'); ?> 
					<?php if(Hyvikk::get('dis_format') == "km" && Hyvikk::get('fuel_unit') == "gallon"): ?>
					(<?php echo app('translator')->get('fleet.kmpg'); ?>)
					<?php endif; ?>
					<?php if(Hyvikk::get('dis_format') == "km" && Hyvikk::get('fuel_unit') == "liter"): ?>
					(<?php echo app('translator')->get('fleet.kmpl'); ?>)
					<?php endif; ?>
					<?php if(Hyvikk::get('dis_format') == "miles" && Hyvikk::get('fuel_unit') == "gallon"): ?>
					(<?php echo app('translator')->get('fleet.mpg'); ?>)
					<?php endif; ?>
					<?php if(Hyvikk::get('dis_format') == "miles" && Hyvikk::get('fuel_unit') == "liter"): ?>
					(<?php echo app('translator')->get('fleet.mpl'); ?>)
					<?php endif; ?>
				    </th>
					<td>
						<?php echo e($vehicle->average); ?> 
					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.intMileage'); ?> <?php if(Hyvikk::get('dis_format') == "km"): ?>(<?php echo app('translator')->get('fleet.km'); ?>) <?php endif; ?> <?php if(Hyvikk::get('dis_format') == "miles"): ?>(<?php echo app('translator')->get('fleet.miles'); ?>) <?php endif; ?></th>
					<td>
						<?php echo e($vehicle->int_mileage); ?>

					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.vehicleImage'); ?></th>
					<td>
						<?php if($vehicle->vehicle_image != null): ?>
			            <a href="<?php echo e(asset('uploads/'.$vehicle->vehicle_image)); ?>" target="_blank" class="col-xs-3 control-label">View</a>
			            <?php else: ?>
						-
						<?php endif; ?>
					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.engine'); ?></th>
					<td>
						<?php echo e($vehicle->engine_type); ?>

					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.horsePower'); ?></th>
					<td>
						<?php echo e($vehicle->horse_power); ?>

					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.color'); ?></th>
					<td>
						<?php echo e($vehicle->color_name ?? ''); ?>

					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.vin'); ?></th>
					<td>
						<?php echo e($vehicle->vin); ?>

					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.licensePlate'); ?></th>
					<td>
						<?php echo e($vehicle->license_plate); ?>

					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.lic_exp_date'); ?></th>
					<td>
						<?php if($vehicle->lic_exp_date): ?>
						<?php echo e(date(Hyvikk::get('date_format'),strtotime($vehicle->lic_exp_date))); ?>

						<?php endif; ?>
					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.reg_exp_date'); ?></th>
					<td>
						<?php if($vehicle->reg_exp_date): ?>
						<?php echo e(date(Hyvikk::get('date_format'),strtotime($vehicle->reg_exp_date))); ?>

						<?php endif; ?>
					</td>
				</tr>

				
			</table>
		</div>
		<!--tab1-->

		<!--tab2-->
		<div class="tab-pane" id="address-tab" >
			<table class="table table-striped">
				<tr>
					<th><?php echo app('translator')->get('fleet.vehicle'); ?></th>
					<td>
					<?php echo e($vehicle->make_name); ?>-<?php echo e($vehicle->model_name); ?>-<?php echo e($vehicle->types->displayname); ?>

					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.insuranceNumber'); ?></th>
					<td>
					<?php echo e($vehicle->getMeta('ins_number')); ?>

					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.inc_doc'); ?></th>
					<td>
					<?php if($vehicle->getMeta('documents') != null): ?>
					<a href="<?php echo e(asset('uploads/'.$vehicle->getMeta('documents'))); ?>" target="_blank">
					View
					</a>
					<?php endif; ?>
					</td>
				</tr>

				<tr>
					<th><?php echo app('translator')->get('fleet.inc_expirationDate'); ?></th>
					<td>
						<?php if($vehicle->getMeta('ins_exp_date')): ?>
							<?php echo e(date(Hyvikk::get('date_format'),strtotime($vehicle->getMeta('ins_exp_date')))); ?>

						<?php endif; ?>
					</td>
				</tr>
			</table>
		</div>
		<!--tab2-->

		
		<div class="tab-pane " id="acq-tab" >
			<div class="card card-default">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table class="table">
								<thead>
									<th><?php echo app('translator')->get('fleet.expenseType'); ?></th>
									<th><?php echo app('translator')->get('fleet.expenseAmount'); ?></th>
								</thead>
								<?php
								$value = unserialize($vehicle->getMeta('purchase_info'));
								?>
								<tbody id="hvk">
									<?php if($value != null): ?>
									<?php
									$i=0;
									?>
									<?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<?php
										$i+=$row['exp_amount'];
										?>
										<td><?php echo e($row['exp_name']); ?></td>
										<td><?php echo e(Hyvikk::get('currency')." ". $row['exp_amount']); ?></td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><strong><?php echo app('translator')->get('fleet.total'); ?></strong></td>
										<td><strong><?php echo e(Hyvikk::get('currency')." ". $i); ?></strong></td>
										<td></td>
									</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--tab3-->

		<!-- tab4 -->
		<div class="tab-pane " id="reviews" >
			<div class="card card-default">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
						<?php $__currentLoopData = $vehicle->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a href="<?php echo e(url('admin/view-vehicle-review/'.$r->id)); ?>" class="btn btn-success" style="margin-bottom: 5px;" title="View Review"><?php echo app('translator')->get('fleet.reg_no'); ?>: <?php echo e($r->reg_no); ?></a>
							&nbsp; <a href="<?php echo e(url('admin/print-vehicle-review/'.$r->id)); ?>" class="btn btn-danger" target="_blank" title="<?php echo app('translator')->get('fleet.print'); ?>" style="margin-bottom: 5px;"><i class="fa fa-print"></i> <?php echo app('translator')->get('fleet.print'); ?></a>
							<br>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>

					</div>

				</div>
			</div>
		</div>
		<!-- tab4 -->
	</div>
</div><?php /**PATH /var/www/html/whistler/framework/resources/views/vehicles/view_event.blade.php ENDPATH**/ ?>