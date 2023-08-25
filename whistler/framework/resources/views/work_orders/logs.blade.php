@extends("layouts.app")
@php($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y')

@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{ route('work_order.index')}}">Fleet Utilization </a></li>
<li class="breadcrumb-item active">Fleet Utilization History</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          Fleet Utilization History
        </h3>
      </div>
      <div class="card-body table-responsive">
        <table class="table" id="data_table">
          <thead class="thead-inverse">
            <tr>
              <th>
                @if($data->count() > 0)
                <input type="checkbox" id="chk_all">
                @endif
              </th>
              <th>Fleet Details</th>
              <th></th>
              <th>Site</th>
              <th>Shift</th>
              <th>@lang('fleet.date')</th>
              <th>Work Hours</th>
              <th>Cost</th>
              <th>@lang('fleet.description')</th>
              <th>@lang('fleet.action')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $row)
            <tr>
              <td>
                <input type="checkbox" name="ids[]" value="{{ $row->id }}" class="checkbox" id="chk{{ $row->id }}"
                  onclick='checkcheckbox();'>
              </td>
              <td>
                @if($row->vehicle['vehicle_image'] != null)
                <img src="{{asset('uploads/'.$row->vehicle['vehicle_image'])}}" height="70px" width="70px">
                @else
                <img src="{{ asset(" assets/images/vehicle.jpeg")}}" height="70px" width="70px">
                @endif
              </td>
              <td nowrap>
                {{$row->vehicle->vehicleData->make}} {{$row->vehicle->vehicleData->model}}
                <br>
                <b> @lang('fleet.plate'):</b> {{$row->vehicle['license_plate']}}
              </td>
              <td>
                {{ $row->sites->site_name }}
              </td>
              <td>
                @if($row->shift_id == "1")
                <span>Morning</span>
                @elseif($row->shift_id == "2")
                <span>Evening</span>
                @else
                N/A
                @endif
              </td>
              <td nowrap>
                {{$row->date }}
              </td>
              <td>
                {{$row->work_hours}}
              </td>
              <td>
                @if($row->price == null || $row->price == 0)
                N/A
                @else
                {{ $row->price }}
                @endif
              </td>
              <td>
                @if($row->description == null)
                N/A
                @else
                {{$row->description}}
                @endif
              </td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="fa fa-gear"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu custom" role="menu">
                    @can('WorkOrders edit')<a class="dropdown-item" href='{{ url("admin/work_order/".$row->id."/edit")}}'> <span
                        aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span> @lang('fleet.edit')</a>@endcan
                    @can('WorkOrders delete')<a class="dropdown-item" data-id="{{$row->id}}" data-toggle="modal"
                      data-target="#myModal"><span aria-hidden="true" class="fa fa-trash" style="color: #dd4b39"></span>
                      @lang('fleet.delete')</a>@endcan
                  </div>
                </div>
                {!! Form::open(['url' =>
                'admin/work_order/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]) !!}
                {!! Form::hidden("id",$row->id) !!}
                {!! Form::close() !!}
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>
                
              </th>
              <th></th>
              <th>Fleet Details</th>
              <th>Site</th>
              <th>Shift</th>
              <th>@lang('fleet.date')</th>
              <th>Work Hours</th>
              <th>Cost</th>
              <th>@lang('fleet.description')</th>
              <th>@lang('fleet.action')</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

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
</script>
@endsection