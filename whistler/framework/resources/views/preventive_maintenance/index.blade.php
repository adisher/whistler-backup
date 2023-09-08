@extends("layouts.app")
@php($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y')

@section("breadcrumb")
<li class="breadcrumb-item active">Preventive Maintenance</li>
@endsection
@section('extra_css')
<style type="text/css">
  .checkbox,
  #chk_all {
    width: 20px;
    height: 20px;
  }
</style>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          Preventive Maintenance
          &nbsp;
          @can('ServiceReminders add')<a href="{{ route('preventive-maintenance.create')}}" class="btn btn-success"
            style="margin-bottom: 5px" title="@lang('fleet.add_service_reminder')"><i class="fa fa-plus"></i></a>@endcan
          &nbsp;
          @can('ServiceItems add')<a href="{{ route('service-item.create')}}" class="btn btn-success"
            style="margin-bottom: 5px">@lang('fleet.add_service_item')</a></h3>@endcan
      </div>

      <div class="card-body table-responsive">
        <table class="table" id="data_table">
          <thead class="thead-inverse">
            <tr>
              <th>
                @if($preventive_maintenance->count() > 0)
                <input type="checkbox" id="chk_all">
                @endif
              </th>
              <th></th>
              <th>Fleet</th>
              <th>@lang('fleet.service_item')</th>
              <th>Parts Used</th>
              <th>Price</th>
              <th>Last Performed (Meter)</th>
              <th>Deviation (Meter)</th>
              <th>Next Planned (Meter)</th>
              <th>Update Date</th>
              <th>Creation Date</th>
              <th>Total Count</th>
              <th>@lang('fleet.action')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($preventive_maintenance as $reminder)
            <tr>
              <td>
                <input type="checkbox" name="ids[]" value="{{ $reminder->id }}" class="checkbox"
                  id="chk{{ $reminder->id }}" onclick='checkcheckbox();'>
              </td>
              <td>
                @if($reminder->vehicle['vehicle_image'] != null)
                <img src="{{asset('uploads/'.$reminder->vehicle['vehicle_image'])}}" height="70px" width="70px">
                @else
                <img src="{{ asset(" assets/images/vehicle.jpeg")}}" height="70px" width="70px">
                @endif
              </td>
              <td>
                {{$reminder->vehicle->vehicleData->make}} {{$reminder->vehicle->vehicleData->model}} - {{
                $reminder->vehicle->license_plate }}
              </td>
              <td>
                {{ $reminder->services->description }}
                <!-- More code for displaying service item details -->
              </td>
              <td nowrap>
                {{ $reminder->parts->title }}
                <br>
                Qty: {{ $reminder->quantity }}
              </td>
              <td>
                {{ $reminder->price }}
              </td>
              <td>
                {{ $reminder->last_performed }}
              </td>
              <td>
                {{ $reminder->deviation }}
              </td>
              <td>
                {{ $reminder->next_planned }}
              </td>
              <td nowrap>
                {{ $reminder->updated_at->toDateString() }}
              </td>
              <td>
                {{ $reminder->date }}
              </td>
              <td>
                {{ $reminder->status }}
              </td>
              <td>
                <div class="d-flex align-items-stretch">
                  <div>
                    <a class="btn btn-success close-maintenance" href="#" data-id="{{ $reminder->id }}" 
                      data-last-performed="{{$reminder->last_performed}}" data-next-planned="{{$reminder->next_planned}}"
                      data-service-item-id="{{$reminder->service_item_id}}" data-parts-id={{ $reminder->parts_id }}
                      data-toggle="tooltip"
                      title="Update Record">
                      <span class="fa fa-edit fa-lg"></span>
                    </a>
                  </div>
                  <div class="btn-group ml-2">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                      <span class="fa fa-gear"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu custom" role="menu">
                      @can('ServiceItems edit')<a class="dropdown-item" href="{{ url("admin/service-item/".$reminder->id."/edit")}}">
                        <span aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span>
                        @lang('fleet.edit')</a>@endcan
                      @can('ServiceItems delete')<a class="dropdown-item" data-id="{{$reminder->id}}"
                        data-toggle="modal" data-target="#myModal"> <span aria-hidden="true" class="fa fa-trash"
                          style="color: #dd4b39"></span>
                        @lang('fleet.delete')</a>@endcan
                    </div>
                  </div>
                  {!! Form::open(['url' =>
                  'admin/service-reminder/'.$reminder->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$reminder->id])
                  !!}
                  {!! Form::hidden("id",$reminder->id) !!}
                  {!! Form::close() !!}
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>
                @if($preventive_maintenance->count() > 0)
                @can('ServiceReminders delete')<button class="btn btn-danger" id="bulk_delete" data-toggle="modal"
                  data-target="#bulkModal" disabled title="@lang('fleet.delete')"><i
                    class="fa fa-trash"></i></button>@endcan
                @endif
              </th>
              <th></th>
              <th>Fleet</th>
              <th>@lang('fleet.service_item')</th>
              <th>Parts Used</th>
              <th>Price</th>
              <th>Last Performed (Meter - kms)</th>
              <th>Deviation (Meter)</th>
              <th>Next Planned (Meter - kms)</th>
              <th>Update Date</th>
              <th>Creation Date</th>
              <th>Total Count</th>
              <th>@lang('fleet.action')</th>
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
        <h4 class="modal-title">@lang('fleet.delete')</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['url'=>'admin/delete-reminders','method'=>'POST','id'=>'form_delete']) !!}
        <div id="bulk_hidden"></div>
        <p>@lang('fleet.confirm_bulk_delete')</p>
      </div>
      <div class="modal-footer">
        <button id="bulk_action" class="btn btn-danger" type="submit" data-submit="">@lang('fleet.delete')</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
      </div>
      {!! Form::close() !!}
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
        <h4 class="modal-title">@lang('fleet.delete')</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>@lang('fleet.confirm_delete')</p>
      </div>
      <div class="modal-footer">
        <button id="del_btn" class="btn btn-danger" type="button" data-submit="">@lang('fleet.delete')</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<!-- Close Maintenance Modal -->
<div class="modal fade" id="closeMaintenanceModal" tabindex="-1" aria-labelledby="closeMaintenanceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="closeMaintenancetModalLabel">Update Maintenance</h5>
      </div>
      <div class="modal-body">
        <form id="closeMaintenanceForm">
          <input type="hidden" name="id" id="row_id" value="" />
          <input type="hidden" name="service_item_id" id="service_item_id" value="" />
          <input type="hidden" name="parts_id" id="parts_id" value="" />
          <div class="mb-3">
            <label for="last_performed" class="form-label">Last Performed</label>
            <input type="number" name="last_performed" class="form-control" id="last_performed" readonly />
          </div>
          <div class="mb-3">
            <label for="next_planned" class="form-label">Next Planned</label>
            <input type="number" name="next_planned" class="form-control" id="next_planned" readonly />
          </div>
          <div class="mb-3">
            <label for="qty" class="form-label">Item Quantity</label>
            <input type="number" name="qty" class="form-control" id="qty" />
          </div>
          <div class="mb-3">
            <label for="end_meter" class="form-label">End Meter</label>
            <input type="number" name="end_meter" class="form-control" id="end_meter" />
          </div>
          <div class="mb-3">
            <label for="deviation" class="form-label">Deviation</label>
            <input type="number" name="deviation" class="form-control" id="deviation" readonly />
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" id="submitMaintenance">Update Maintenance</button>
      </div>
    </div>
  </div>
</div>

@endsection


@section('script')
<script type="text/javascript">
// Function to update the deviation field
function updateDeviation() {
var next_planned = parseFloat($('#next_planned').val()) || 0; // Make sure to set this value when the modal opens
var end_meter = parseFloat($('#end_meter').val()) || 0;

if(end_meter === 0) {
$('#deviation').val(''); // Clear the deviation field if end_meter is not entered
} else {
var deviation = end_meter - next_planned;
$('#deviation').val(deviation.toFixed(2)); // Displaying the deviation up to 2 decimal places
}
}

// Function to open the modal and populate the data
function closeMaintenanceModal(row_id, last_performed, next_planned, service_item_id, parts_id) {
$('#row_id').val(row_id);
$('#last_performed').val(last_performed);
$('#next_planned').val(next_planned);
$('#service_item_id').val(service_item_id);
$('#parts_id').val(parts_id);
$('#closeMaintenanceModal').modal('show'); // Open the modal

updateDeviation(); // Call the function to initially set the deviation
}

// Existing code to open the modal
$('a.close-maintenance').click(function(e) {
e.preventDefault();
var row_id = $(this).data('id');
var next_planned = $(this).data('next-planned');
var last_performed = $(this).data('last-performed');
var service_item_id = $(this).data('service-item-id');
var parts_id = $(this).data('parts-id');

closeMaintenanceModal(row_id, last_performed, next_planned, service_item_id, parts_id);
});

// Update the deviation when the end_meter changes
$('#end_meter').change(updateDeviation);

$("#submitMaintenance").click(function(e){
e.preventDefault();
var row_id = $("#row_id").val();
var last_performed = $("#last_performed").val();
var next_planned = $("#next_planned").val();
var end_meter = $("#end_meter").val();
var deviation = $("#deviation").val();
var qty = $("#qty").val();
var parts_id = $("#parts_id").val();
var service_item_id = $("#service_item_id").val();

$.ajax({
url: "{{ route('close_preventive_maintenance') }}",
method: 'POST',
data: {
row_id: row_id,
last_performed: last_performed,
next_planned: next_planned,
end_meter: end_meter,
deviation: deviation,
qty: qty,
parts_id: parts_id,
service_item_id: service_item_id,
_token: '{{ csrf_token() }}' // CSRF token for Laravel
},
success: function(response){
$('#closeMaintenanceModal').modal('hide');
location.reload(); // Refresh the page
},
error: function(error){
alert('An error occurred. Please try again.');
}
});
});


  $("#del_btn").on("click",function(){
    var id=$(this).data("submit");
    $("#form_"+id).submit();
  });

  $('#myModal').on('show.bs.modal', function(e) {
    var id = e.relatedTarget.dataset.id;
    $("#del_btn").attr("data-submit",id);
  });

  $('input[type="checkbox"]').on('click',function(){
    $('#bulk_delete').removeAttr('disabled');
  });

  $('#bulk_delete').on('click',function(){
    // console.log($( "input[name='ids[]']:checked" ).length);
    if($( "input[name='ids[]']:checked" ).length == 0){
      $('#bulk_delete').prop('type','button');
        new PNotify({
            title: 'Failed!',
            text: "@lang('fleet.delete_error')",
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
@endsection