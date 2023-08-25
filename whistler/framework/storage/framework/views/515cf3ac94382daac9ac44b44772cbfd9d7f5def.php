<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.users'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extra_css'); ?>
<style type="text/css">
  .checkbox,
  #chk_all {
    width: 20px;
    height: 20px;
  }
  .show-password-button{
    outline: none;
    border: 1px solid #ced4da;
  }
  td>img {
    border-radius: 50%;
  }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Corrective Maintenance &nbsp;
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Users add')): ?><a href="<?php echo e(route('maintenance.create')); ?>" class="btn btn-success" title="Corrective Maintenance"><i
              class="fa fa-plus"></i></a></h3><?php endif; ?>
      </div>

      <div class="card-body table-responsive">
        <table class="table" id="ajax_data_table">
          <thead class="thead-inverse">
            <tr>
              <th>
                <input type="checkbox" id="chk_all">
              </th>
              
              <th>Fleet</th>
              <th>Subject</th>
              <th>Description</th>
              <th>Date</th>
              <th><?php echo app('translator')->get('fleet.action'); ?></th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <tr>
              <th>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Users delete')): ?><button class="btn btn-danger" id="bulk_delete" data-toggle="modal"
                  title="<?php echo app('translator')->get('fleet.delete'); ?>" data-target="#bulkModal" disabled>
                  <i class="fa fa-trash"></i></button><?php endif; ?>

              </th>
              
              <th>Fleet</th>
              <th>Subject</th>
              <th>Description</th>
              <th>Date</th>
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
        <?php echo Form::open(['url'=>'admin/delete-users','method'=>'POST','id'=>'form_delete']); ?>

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

  $('#changepass').on('show.bs.modal', function(e) {
    var id = e.relatedTarget.dataset.id;
    $("#driver_id").val(id);
  });

  $(function(){
    
    var table = $('#ajax_data_table').DataTable({
          "language": {
              "url": '<?php echo e(asset("assets/datatables/")."/".__("fleet.datatable_lang")); ?>',
          },
         processing: true,
         serverSide: true,
         ajax: {
          url: "<?php echo e(url('admin/maintenance-fetch')); ?>",
          type: 'POST',
          data:{}
         },
         columns: [
            {data: 'check',name:'check', searchable:false, orderable:false},
            // {data: 'id', name: 'id'},
            {data: 'vehicle_id',name:'corrective_maintenance.vehicle_id'},
            {data: 'subject', name: 'corrective_maintenance.subject'},
            {data: 'description', name: 'corrective_maintenance.description'},            
            {data: 'date', name: 'corrective_maintenance.date'},
            {data: 'action',name:'action',  searchable:false, orderable:false}
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

<script>
  $(document).ready(function() {
  $('#show-password-button').click(function() {
    $('#show-password-button').show();
    var passwordField = $('#passwd');
    var fieldType = passwordField.attr('type');
    if (fieldType === 'password') {
      passwordField.attr('type', 'text');
      $(this).attr('title', 'Hide password');
      $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      passwordField.attr('type', 'password');
      $(this).attr('title', 'Show password');
      $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
    }
  });
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/maintenance/index.blade.php ENDPATH**/ ?>