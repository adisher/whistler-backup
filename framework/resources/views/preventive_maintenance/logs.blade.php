@extends("layouts.app")
@php($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y')

@section("breadcrumb")
<li class="breadcrumb-item active">Preventive Maintenance Logs</li>
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
                    Preventive Maintenance Logs
                </h3>
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
                            <th>Creation Date</th>
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
                                <img src="{{asset('uploads/'.$reminder->vehicle['vehicle_image'])}}" height="70px"
                                    width="70px">
                                @else
                                <img src="{{ asset(" assets/images/vehicle.jpeg")}}" height="70px" width="70px">
                                @endif
                            </td>
                            <td>
                                {{$reminder->vehicle->vehicleData->make}} {{$reminder->vehicle->vehicleData->model}} -
                                {{
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
                                {{ $reminder->deviation ?? 'N/A'}} 
                            </td>
                            <td>
                                {{ $reminder->next_planned }}
                            </td>
                            <td>
                                {{ $reminder->date }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>
                                @if($preventive_maintenance->count() > 0)
                                @can('ServiceReminders delete')<button class="btn btn-danger" id="bulk_delete"
                                    data-toggle="modal" data-target="#bulkModal" disabled
                                    title="@lang('fleet.delete')"><i class="fa fa-trash"></i></button>@endcan
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
                            <th>Creation Date</th>
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
                <button id="bulk_action" class="btn btn-danger" type="submit"
                    data-submit="">@lang('fleet.delete')</button>
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


@endsection


@section('script')
<script type="text/javascript">

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