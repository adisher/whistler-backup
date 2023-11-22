<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item active"><?php echo app('translator')->get('Fleet Inspection'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extra_css'); ?>
<style type="text/css">
  .checkbox, #chk_all{
    width: 20px;
    height: 20px;
  }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
        <?php echo app('translator')->get('Fleet Inspection'); ?>
        &nbsp;
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('VehicleInspection add')): ?><a href="<?php echo e(url('admin/vehicle-reviews-create')); ?>" class="btn btn-success" title="<?php echo app('translator')->get('Add Fleet Inspection'); ?>"><i class="fa fa-plus"></i></a><?php endif; ?></h3>
      </div>

      <div class="card-body table-responsive">
        <table class="table" id="ajax_data_table" style="padding-bottom: 25px">
          <thead class="thead-inverse">
            <tr>
              <th>
                <input type="checkbox" id="chk_all">
              </th>
              <th>Fleet</th>
              <th><?php echo app('translator')->get('fleet.review_by'); ?></th>
              <th><?php echo app('translator')->get('fleet.reg_no'); ?></th>
              <th><?php echo app('translator')->get('fleet.action'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td>
                
                <input type="checkbox" name="ids[]" value="<?php echo e($r->id); ?>" class="checkbox" id="chk<?php echo e($r->id); ?>" onclick='checkcheckbox();'>
              </td>
              <td>
              <?php if($r->vehicle && $r->vehicle->vehicleData): ?>
              <?php echo e($r->vehicle->vehicleData->make); ?> - <?php echo e($r->vehicle->vehicleData->model); ?> - <?php echo e($r->vehicle->year); ?>

              <?php else: ?>
              No Make and Model Found
              <?php endif; ?>
              </td>
              <td><?php echo e($r->user->name); ?></td>
              <td><?php echo e($r->vehicle->license_plate); ?></td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="fa fa-gear"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu custom" role="menu">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('VehicleInspection edit')): ?><a class="dropdown-item" href="<?php echo e(url("admin/vehicle-review/".$r->id."/edit")); ?>"> <span aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span> <?php echo app('translator')->get('fleet.edit'); ?></a><?php endif; ?>
                    <?php echo Form::hidden("id",$r->id); ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('VehicleInspection delete')): ?><a class="dropdown-item" data-id="<?php echo e($r->id); ?>" data-toggle="modal" data-target="#myModal"><span aria-hidden="true" class="fa fa-trash" style="color: #dd4b39"></span> <?php echo app('translator')->get('fleet.delete'); ?></a><?php endif; ?>
                    <a class="dropdown-item" href="<?php echo e(url('admin/view-vehicle-review/'.$r->id)); ?>">
                    <span class="fa fa-eye" aria-hidden="true" style="color: #398439"></span> <?php echo app('translator')->get('fleet.view'); ?>
                    </a>
                  </div>
                </div>
                <?php echo Form::open(['url' => 'admin/delete-vehicle-review/'.$r->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$r->id]); ?>

                <?php echo Form::hidden("id",$r->id); ?>

                <?php echo Form::close(); ?>

              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
          <tfoot>
            <tr>
              <th>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('VehicleInspection delete')): ?><button class="btn btn-danger" id="bulk_delete" data-toggle="modal" data-target="#bulkModal" disabled title="<?php echo app('translator')->get('fleet.delete'); ?>" ><i class="fa fa-trash"></i></button><?php endif; ?>
              </th>
              <th><?php echo app('translator')->get('fleet.vehicle'); ?></th>
              <th><?php echo app('translator')->get('fleet.review_by'); ?></th>
              <th><?php echo app('translator')->get('fleet.reg_no'); ?></th>
              <th><?php echo app('translator')->get('fleet.action'); ?></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="bulkModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo app('translator')->get('fleet.delete'); ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?php echo Form::open(['url'=>'admin/delete-vehicle-reviews','method'=>'POST','id'=>'form_delete']); ?>

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
<!-- Modal -->

<!-- Modal -->
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
<!-- Modal -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  $("#del_btn").on("click",function(){
    var id=$(this).data("submit");
    $("#form_"+id).submit();
  });

  $('#myModal').on('show.bs.modal', function(e) {
    var id = e.relatedTarget.dataset.id;
    $("#del_btn").attr("data-submit",id);
  });

  // $(function(){
    
  //   var table = $('#ajax_data_table').DataTable({
  //         "language": {
  //             "url": '<?php echo e(asset("assets/datatables/")."/".__("fleet.datatable_lang")); ?>',
  //         },
  //        processing: true,
  //        serverSide: true,
  //        ajax: {
  //         url: "<?php echo e(url('admin/vehicle-reviews-fetch')); ?>",
  //         type: 'POST',
  //         data:{}
  //        },
  //        columns: [
  //           {data: 'check',name:'check', searchable:false, orderable:false},
  //           {data: 'vehicle',name:'vehicle'},                    
  //           {data: 'user', name: 'user.name'},            
  //           {data: 'reg_no', name: 'reg_no'},            
  //           {data: 'action',name:'action',  searchable:false, orderable:false}
  //       ],
  //       order: [[1, 'desc']],
  //       "initComplete": function() {
  //             table.columns().every(function () {
  //               var that = this;
  //               $('input', this.footer()).on('keyup change', function () {
  //                 // console.log($(this).parent().index());
  //                   that.search(this.value).draw();
  //               });
  //             });
  //           }
  //   });
  // });
  $(document).on('click','input[type="checkbox"]',function(){
    if(this.checked){
      $('#bulk_delete').prop('disabled',false);

    }else { 
      if($("input[name='ids[]']:checked").length == 0){
        $('#bulk_delete').prop('disabled',true);
      } 
    } 
    
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
<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/vehicles/vehicle_review_index.blade.php ENDPATH**/ ?>