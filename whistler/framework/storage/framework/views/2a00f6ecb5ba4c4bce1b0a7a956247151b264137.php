<?php ($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y'); ?>
<?php $__env->startSection('extra_css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css')); ?>">
<style type="text/css">
  .checkbox,
  #chk_all {
    width: 20px;
    height: 20px;
  }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item active"><?php echo app('translator')->get('menu.bookings'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header with-border">
        <h3 class="card-title"> <?php echo app('translator')->get('fleet.manage_bookings'); ?> &nbsp;
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bookings add')): ?><a href="<?php echo e(route('bookings.create')); ?>" class="btn btn-success"
            title="<?php echo app('translator')->get('fleet.new_booking'); ?>"><i class="fa fa-plus"></i></a><?php endif; ?>
        </h3>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-responsive display" id="ajax_data_table" style="padding-bottom: 35px; width: 100%">
            <thead class="thead-inverse">
              <tr>
                <th>
                  <input type="checkbox" id="chk_all">
                </th>
                <th style="width: 10% !important"><?php echo app('translator')->get('fleet.customer'); ?></th>
                <th style="width: 10% !important"><?php echo app('translator')->get('fleet.vehicle'); ?></th>
                <th style="width: 10% !important"><?php echo app('translator')->get('fleet.pickup_addr'); ?></th>
                <th style="width: 10% !important"><?php echo app('translator')->get('fleet.dropoff_addr'); ?></th>
                <th style="width: 10% !important"><?php echo app('translator')->get('fleet.pickup'); ?></th>
                <th style="width: 10% !important"><?php echo app('translator')->get('fleet.dropoff'); ?></th>
                <th style="width: 10% !important"><?php echo app('translator')->get('fleet.passengers'); ?></th>
                <th style="width: 10% !important"><?php echo app('translator')->get('fleet.payment_status'); ?></th>
                <th><?php echo app('translator')->get('fleet.booking_status'); ?></th>
                <th style="width: 10% !important"><?php echo app('translator')->get('fleet.amount'); ?></th>
                <th style="width: 10% !important"><?php echo app('translator')->get('fleet.action'); ?></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <tr>
                <th>
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bookings delete')): ?><button class="btn btn-danger" id="bulk_delete" data-toggle="modal"
                    data-target="#bulkModal" disabled title="<?php echo app('translator')->get('fleet.delete'); ?>"><i
                      class="fa fa-trash"></i></button><?php endif; ?>
                </th>
                <th><?php echo app('translator')->get('fleet.customer'); ?></th>
                <th><?php echo app('translator')->get('fleet.vehicle'); ?></th>
                <th><?php echo app('translator')->get('fleet.pickup_addr'); ?></th>
                <th><?php echo app('translator')->get('fleet.dropoff_addr'); ?></th>
                <th><?php echo app('translator')->get('fleet.pickup'); ?></th>
                <th><?php echo app('translator')->get('fleet.dropoff'); ?></th>
                <th><?php echo app('translator')->get('fleet.passengers'); ?></th>
                <th><?php echo app('translator')->get('fleet.payment_status'); ?></th>
                <th><?php echo app('translator')->get('fleet.booking_status'); ?></th>
                <th><?php echo app('translator')->get('fleet.amount'); ?></th>
                <th><?php echo app('translator')->get('fleet.action'); ?></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- cancel booking Modal -->
<div id="cancelBooking" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo app('translator')->get('fleet.cancel_booking'); ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p><?php echo app('translator')->get('fleet.confirm_cancel'); ?></p>
        <?php echo Form::open(['url'=>url('admin/cancel-booking'),'id'=>'cancel_booking']); ?>

        <div class="form-group">
          <?php echo Form::hidden('cancel_id',null,['id'=>'cancel_id']); ?>

          <?php echo Form::label('reason',__('fleet.addReason'),['class'=>"form-label"]); ?>

          <?php echo Form::text('reason',null,['class'=>"form-control",'required']); ?>

        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success"><?php echo app('translator')->get('fleet.submit'); ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('fleet.close'); ?></button>
      </div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>
<!-- cancel booking Modal -->

<!-- complete journey Modal -->
<div id="journeyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo app('translator')->get('fleet.complete'); ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p><?php echo app('translator')->get('fleet.confirm_journey'); ?></p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" href="" id="journey_btn"><?php echo app('translator')->get('fleet.submit'); ?></a>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('fleet.close'); ?></button>
      </div>
    </div>
  </div>
</div>
<!-- complete journey Modal -->

<!-- bulk delete Modal -->
<div id="bulkModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo app('translator')->get('fleet.delete'); ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?php echo Form::open(['url'=>'admin/delete-bookings','method'=>'POST','id'=>'form_delete']); ?>

        <div id="bulk_hidden"></div>
        <p><?php echo app('translator')->get('fleet.confirm_bulk_delete'); ?></p>
      </div>
      <div class="modal-footer">
        <button id="bulk_action" class="btn btn-danger" type="submit" data-submit=""><?php echo app('translator')->get('fleet.delete'); ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('fleet.close'); ?></button>
      </div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>
<!-- bulk delete Modal -->

<!-- single delete Modal -->
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
<!-- single delete Modal -->


<!-- generate invoic Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="card card-info">
        <div class="modal-header">
          <h3 class="modal-title"><?php echo app('translator')->get('fleet.add_payment'); ?></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
        </div>

        <div class="fleet card-body">
          <?php echo Form::open(['route' => 'bookings.complete','method'=>'post']); ?>

          <input type="hidden" name="status" id="status" value="1" />
          <input type="hidden" name="booking_id" id="bookingId" value="" />
          <input type="hidden" name="userId" id="userId" value="" />
          <input type="hidden" name="customerId" id="customerId" value="" />
          <input type="hidden" name="vehicleId" id="vehicleId" value="" />
          <input type="hidden" name="type" id="type" value="" />
          <input type="hidden" name="base_km_1" value="" id="base_km_1">
          <input type="hidden" name="base_fare_1" value="" id="base_fare_1">
          <input type="hidden" name="wait_time_1" value="" id="wait_time_1">
          <input type="hidden" name="std_fare_1" value="" id="std_fare_1">
          <input type="hidden" name="base_km_2" value="" id="base_km_2">
          <input type="hidden" name="base_fare_2" value="" id="base_fare_2">
          <input type="hidden" name="wait_time_2" value="" id="wait_time_2">
          <input type="hidden" name="std_fare_2" value="" id="std_fare_2">
          <input type="hidden" name="base_km_3" value="" id="base_km_3">
          <input type="hidden" name="base_fare_3" value="" id="base_fare_3">
          <input type="hidden" name="wait_time_3" value="" id="wait_time_3">
          <input type="hidden" name="std_fare_3" value="" id="std_fare_3">
          <?php ($no_of_tax = 0); ?>
          <?php if(Hyvikk::get('tax_charge') != "null"): ?>
          <?php ($no_of_tax = sizeof(json_decode(Hyvikk::get('tax_charge'), true))); ?>
          <?php ($taxes = json_decode(Hyvikk::get('tax_charge'), true)); ?>
          <?php ($i=0); ?>
          <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <input type="hidden" name="<?php echo e('tax_'.$i); ?>" value="<?php echo e($val); ?>" class="<?php echo e('tax_'.$i); ?>">
          <?php ($i++); ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label"><?php echo app('translator')->get('fleet.incomeType'); ?></label>
                <select id="income_type" name="income_type" class="form-control vehicles" required>
                  <option value=""><?php echo app('translator')->get('fleet.incomeType'); ?></option>
                  <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label"><?php echo app('translator')->get('fleet.daytype'); ?></label>
                <select id="day" name="day" class="form-control vehicles" required>
                  <option value="1" selected>Weekdays</option>
                  <option value="2">Weekend</option>
                  <option value="3">Night</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label"><?php echo app('translator')->get('fleet.trip_mileage'); ?> (<?php echo e(Hyvikk::get('dis_format')); ?>)</label>
                <?php echo Form::number('mileage',null,['class'=>'form-control sum','min'=>1,'id'=>'mileage']); ?>

              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label"><?php echo app('translator')->get('fleet.waitingtime'); ?></label>
                <?php echo Form::number('waiting_time',0,['class'=>'form-control sum','min'=>0,'id'=>'waiting_time']); ?>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label"><?php echo app('translator')->get('fleet.total_tax'); ?> (%) </label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text fa fa-percent"></span>
                  </div>
                  <?php echo Form::number('total_tax_charge',0,['class'=>'form-control
                  sum','readonly','id'=>'total_tax_charge','min'=>0,'step'=>'0.01']); ?>

                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label"><?php echo app('translator')->get('fleet.total'); ?> <?php echo app('translator')->get('fleet.tax_charge'); ?></label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><?php echo e(Hyvikk::get('currency')); ?></span>
                  </div>
                  <?php echo Form::number('total_tax_charge_rs',0,['class'=>'form-control
                  sum','readonly','id'=>'total_tax_charge_rs','min'=>0,'step'=>'0.01']); ?>

                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label"><?php echo app('translator')->get('fleet.amount'); ?> </label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><?php echo e(Hyvikk::get('currency')); ?></span>
                  </div>
                  <?php echo Form::number('total',null,['class'=>'form-control','id'=>'total','required','min'=>0,
                  'step'=>'0.01']); ?>

                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label"><?php echo app('translator')->get('fleet.total'); ?> <?php echo app('translator')->get('fleet.amount'); ?> </label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><?php echo e(Hyvikk::get('currency')); ?></span>
                  </div>
                  <?php echo Form::number('tax_total',null,['class'=>'form-control','id'=>'tax_total','readonly','min'=>0,
                  'step'=>'0.01']); ?>

                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label"><?php echo app('translator')->get('fleet.date'); ?></label>
                <div class='input-group'>
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <span class="fa fa-calendar"></span></span>
                  </div>
                  <?php echo Form::text('date',date('Y-m-d'),['class'=>'form-control','id'=>'date']); ?>

                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <?php echo Form::submit(__('fleet.invoice'), ['class' => 'btn btn-info']); ?>

            </div>
          </div>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- generate invoice modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection("script"); ?>

<script src="<?php echo e(asset('assets/js/moment.js')); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript">
  <?php if(Session::get('msg')): ?>
    new PNotify({
        title: 'Success!',
        text: '<?php echo e(Session::get('msg')); ?>',
        type: 'success'
      });
  <?php endif; ?>

  $(document).ready(function() {
    $('#date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });
  });
</script>
<script type="text/javascript">
  $(document).on("click", ".open-AddBookDialog", function () {
    // alert($(this).data('base_km_1'));
    // window.open("route('bookings.index')/?type="+$(this).data('vehicle-type'));

    // const query = new URLSearchParams(window.location.search);
    // query.append("type", "true");

    // window.location.search = 'type='+$(".fleet #type").val( type );

     var booking_id = $(this).data('booking-id');

     $(".fleet #bookingId").val( booking_id );

     var user_id = $(this).data('user-id');
     $(".fleet #userId").val( user_id );

     var customer_id = $(this).data('customer-id');
     $(".fleet #customerId").val( customer_id );

     var vehicle_id = $(this).data('vehicle-id');
     $(".fleet #vehicleId").val( vehicle_id );

     var type = $(this).data('vehicle-type');
     $(".fleet #type").val( type );

     $(".fleet #mileage").val($(this).data('base-mileage'));
     $(".fleet #total").val($(this).data('base-fare'));

     $(".fleet #base_km_1").val($(this).data('base_km_1'));
     $(".fleet #base_fare_1").val($(this).data('base_fare_1'));
     $(".fleet #wait_time_1").val($(this).data('wait_time_1'));
     $(".fleet #std_fare_1").val($(this).data('std_fare_1'));
     $(".fleet #base_km_2").val($(this).data('base_km_2'));
     $(".fleet #base_fare_2").val($(this).data('base_fare_2'));
     $(".fleet #wait_time_2").val($(this).data('wait_time_2'));
     $(".fleet #std_fare_2").val($(this).data('std_fare_2'));
     $(".fleet #base_km_3").val($(this).data('base_km_3'));
     $(".fleet #base_fare_3").val($(this).data('base_fare_3'));
     $(".fleet #wait_time_3").val($(this).data('wait_time_3'));
     $(".fleet #std_fare_3").val($(this).data('std_fare_3'));

    var total = $("#total").val();

    var i;
    var tax_size = '<?php echo e($no_of_tax); ?>';
    var total_tax_val = 0;
    for (i = 0; i < tax_size; i++) {
      total_tax_val = Number(total_tax_val) + Number($('.tax_'+i).val());
      // console.log($('.tax_'+i).val());
    }
    // console.log(total_tax_val);
    $('#total_tax_charge').val(total_tax_val);
    $('#total_tax_charge_rs').val((Number(total)*Number(total_tax_val))/100);
    $('#tax_total').val(Number(total) + (Number(total)*Number(total_tax_val))/100);

  });

  $("#del_btn").on("click",function(){
    var id=$(this).data("submit");
    $("#book_"+id).submit();
  });

  $('#myModal').on('show.bs.modal', function(e) {
    var id = e.relatedTarget.dataset.id;
    $("#del_btn").attr("data-submit",id);
  });

  $('#journeyModal').on('show.bs.modal', function(e) {
    var id = e.relatedTarget.dataset.id;
    $("#journey_btn").attr("href","<?php echo e(url('admin/bookings/complete/')); ?>/"+id);
  });

    $('#cancelBooking').on('show.bs.modal', function(e) {
    var id = e.relatedTarget.dataset.id;
    $("#cancel_id").val(id);
  });
</script>

<!-- testing total-->
<script type="text/javascript" language="javascript">
  $(".sum").change(function(){
  // alert($("#base_km_1").val());
  // alert($('.vtype').data('base_km_1'));
  // console.log($("#type").val());

    var day = $("#day").find(":selected").val();
    if(day == 1){
      var base_km = $("#base_km_1").val();
      var base_fare = $("#base_fare_1").val();
      var wait_time = $("#wait_time_1").val();
      var std_fare = $("#std_fare_1").val();
        if(Number($("#mileage").val()) <= Number(base_km)){
          var total = Number(base_fare) + (Number($("#waiting_time").val()) * Number(wait_time));
        }
        else{
          var sum = Number($("#mileage").val() - base_km) * Number(std_fare);
      var total = Number(base_fare) + Number(sum) + (Number($("#waiting_time").val()) * Number(wait_time));
      }
    }

    if(day == 2){
      var base_km = $("#base_km_2").val();
      var base_fare = $("#base_fare_2").val();
      var wait_time = $("#wait_time_2").val();
      var std_fare = $("#std_fare_2").val();
        if(Number($("#mileage").val()) <= Number(base_km)){
          var total = Number(base_fare) + (Number($("#waiting_time").val()) * Number(wait_time));
        }
        else{
          var sum = Number($("#mileage").val() - base_km) * Number(std_fare);
      var total = Number(base_fare) + Number(sum) + (Number($("#waiting_time").val()) * Number(wait_time));
      }
    }

    if(day == 3){
      var base_km = $("#base_km_3").val();
      var base_fare = $("#base_fare_3").val();
      var wait_time =$("#wait_time_3").val();
      var std_fare = $("#std_fare_3").val();
        if(Number($("#mileage").val()) <= Number(base_km)){
          var total = Number(base_fare) + (Number($("#waiting_time").val()) * Number(wait_time));
        }
        else{
          var sum = Number($("#mileage").val() - base_km) * Number(std_fare);
      var total = Number(base_fare) + Number(sum) + (Number($("#waiting_time").val()) * Number(wait_time));
      }
    }
    $("#total").val(total);
    var i;
    var tax_size = '<?php echo e($no_of_tax); ?>';
    var total_tax_val = 0;
    for (i = 0; i < tax_size; i++) {
      total_tax_val = Number(total_tax_val) + Number($('.tax_'+i).val());
      // console.log($('.tax_'+i).val());
    }
    // console.log(total_tax_val);
    $('#total_tax_charge').val(total_tax_val);
    $('#total_tax_charge_rs').val((Number(total)*Number(total_tax_val))/100);
    $('#tax_total').val(Number(total) + (Number(total)*Number(total_tax_val))/100);
});

  $("#total").change(function(){
    var total = $("#total").val();
    var i;
    var tax_size = '<?php echo e($no_of_tax); ?>';
    var total_tax_val = 0;
    for (i = 0; i < tax_size; i++) {
      total_tax_val = Number(total_tax_val) + Number($('.tax_'+i).val());
      // console.log($('.tax_'+i).val());
    }
    // console.log(total_tax_val);
    $('#total_tax_charge_rs').val((Number(total)*Number(total_tax_val))/100);
    $('#tax_total').val(Number(total) + (Number(total)*Number(total_tax_val))/100);

  });
  
  $(document).on('click','input[type="checkbox"]',function(){
    if(this.checked){
      $('#bulk_delete').prop('disabled',false);

    }else { 
      if($("input[name='ids[]']:checked").length == 0){
        $('#bulk_delete').prop('disabled',true);
      } 
    } 
    
  });

  $(function(){
    
    var table = $('#ajax_data_table').DataTable({
      dom: 'Bfrtip',
      buttons: [
          {
        extend: 'print',
        text: '<i class="fa fa-print"></i> <?php echo e(__("fleet.print")); ?>',

        exportOptions: {
           columns: ([1,2,3,4,5,6,7,8,9,10]),
        },
        customize: function ( win ) {
                $(win.document.body)
                    .css( 'font-size', '10pt' )
                    .prepend(
                        '<h3><?php echo e(__("fleet.bookings")); ?></h3>'
                    );
                $(win.document.body).find( 'table' )
                    .addClass( 'table-bordered' );
                // $(win.document.body).find( 'td' ).css( 'font-size', '10pt' );

            }
          }
    ],
          "language": {
              "url": '<?php echo e(asset("assets/datatables/")."/".__("fleet.datatable_lang")); ?>',
          },
          processing: true,
          serverSide: true,
          ajax: {
            url: "<?php echo e(url('admin/bookings-fetch')); ?>",
            type: 'POST',
            data:{}
          },
          columns: [
            {data: 'check',   name: 'check', searchable:false, orderable:false},
            {data: 'customer',   name: 'customer.name'},
            {data: 'vehicle', name: 'vehicle'},
            {data: 'pickup_addr',    name: 'pickup_addr'},
            {data: 'dest_addr',    name: 'dest_addr'},
            {name: 'pickup',data: {_: 'pickup.display',sort: 'pickup.timestamp'}},
            {name: 'dropoff',data: {_: 'dropoff.display',sort: 'dropoff.timestamp'}},
            {data: 'travellers',  name: 'travellers'},
            {data: 'payment',  name: 'payment'},
            {data: 'ride_status',  name: 'ride_status'},
            {data: 'tax_total',  name: 'tax_total'},
            {data: 'action',  name: 'action', searchable:false, orderable:false}
        ],
        order: [[1, 'desc']],
        "initComplete": function() {
              table.columns().every(function () {
                var that = this;
                $('input', this.footer()).on('keyup change', function () {
                  // console.log($(this).parent().index());
                    that.search(this.value).draw();
                });
              });
            }
    });
  });

  $('#bulk_delete').on('click',function(){
    // console.log($( "input[name='ids[]']:checked" ).length);
    if($( "input[name='ids[]']:checked" ).length == 0){
      $('#bulk_delete').prop('type','button');
        new PNotify({
            title: 'Failed!',
            text: "<?php echo app('translator')->get('fleet.delete_error'); ?>",
            type: 'error'
          });
        $('#bulk_delete').attr('disabled',true);
    }
    if($("input[name='ids[]']:checked").length > 0){
      // var favorite = [];
      $.each($("input[name='ids[]']:checked"), function(){
          // favorite.push($(this).val());
          $("#bulk_hidden").append('<input type=hidden name=ids[] value='+$(this).val()+'>');
      });
      // console.log(favorite);
    }
  });


  $('#chk_all').on('click',function(){
    if(this.checked){
      $('.checkbox').each(function(){
        $('.checkbox').prop("checked",true);
      });
    }else{
      $('.checkbox').each(function(){
        $('.checkbox').prop("checked",false);
      });
      $('#bulk_delete').prop('disabled',true);
    }
  });

  // Checkbox checked
  function checkcheckbox(){
    // Total checkboxes
    var length = $('.checkbox').length;
    // Total checked checkboxes
    var totalchecked = 0;
    $('.checkbox').each(function(){
        if($(this).is(':checked')){
            totalchecked+=1;
        }
    });
    // console.log(length+" "+totalchecked);
    // Checked unchecked checkbox
    if(totalchecked == length){
        $("#chk_all").prop('checked', true);
    }else{
        $('#chk_all').prop('checked', false);
    }
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/bookings/index.blade.php ENDPATH**/ ?>