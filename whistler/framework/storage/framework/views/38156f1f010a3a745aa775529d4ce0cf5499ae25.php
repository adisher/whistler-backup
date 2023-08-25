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
<li class="breadcrumb-item"><a href="<?php echo e(route('drivers.index')); ?>"><?php echo app('translator')->get('menu.drivers'); ?></a></li>
<li class="breadcrumb-item active"><?php echo e($driver->name); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
      <div class="card card-info">
        <div class="card-header with-border">
          <h3 class="card-title w-100 d-flex justify-content-between align-items-center"> <span><?php echo app('translator')->get('fleet.driver'); ?> <?php echo app('translator')->get('fleet.details'); ?></span>
            <div class=" float-right">
                <a href="<?php echo e(route('drivers.edit',$driver->id)); ?>" class="float-right btn btn-sm btn-warning" title="<?php echo app('translator')->get('fleet.edit_driver'); ?>"><i class="fa fa-edit"></i></a>
            </div>
          </h3>
        </div>
  
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><b><?php echo app('translator')->get('fleet.name'); ?></b>: <?php echo e($driver->name); ?></p>
                    <p><b><?php echo app('translator')->get('fleet.email'); ?></b>: <?php echo e($driver->email); ?></p>
                </div>
                <div class="col-md-6">
                    <p><b><?php echo app('translator')->get('fleet.phone'); ?></b>: <?php echo e($driver->phone); ?></p>
                    <p><b><?php echo app('translator')->get('fleet.start_date'); ?></b>: <?php echo e($driver->start_date); ?></p>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header with-border">
        <h3 class="card-title"> <?php echo app('translator')->get('fleet.driver'); ?> <?php echo app('translator')->get('fleet.bookings'); ?> &nbsp;          
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
                
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
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
            url: "<?php echo e(url('admin/driver-bookings-fetch')); ?>",
            type: 'POST',
            data:{
                'driver_id':"<?php echo e($driver->id); ?>"
            }
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
            // {data: 'action',  name: 'action', searchable:false, orderable:false}
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/drivers/show.blade.php ENDPATH**/ ?>