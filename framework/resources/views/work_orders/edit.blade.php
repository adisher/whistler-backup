@extends('layouts.app')
@section('extra_css')
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.min.css')}}">
@endsection
@section("breadcrumb")
<li class="breadcrumb-item "><a href="{{ route('work_order.index')}}">Manage Fleet Utilization </a></li>
<li class="breadcrumb-item active">Edit Fleet Utilization</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Fleet Utilization</h3>
      </div>

      <div class="card-body">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        {!! Form::open(['route' => ['work_order.update',$data->id],'method'=>'PATCH']) !!}
        {!! Form::hidden('user_id',Auth::user()->id)!!}
        {!! Form::hidden('id',$data->id)!!}
        {!! Form::hidden('type','Updated')!!}

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('vehicle_id',__('Select Vehicle/Equipment'). ' <span class="text-danger">*</span>',
              ['class' =>
              'form-label'], false) !!}
              <select name="vehicle_id" class="form-control" id="vehicle_id">
                @foreach($vehicles as $vehicle)
                <option value="{{$vehicle->id}}" @if(old('vehicle_id', $data->vehicle_id) == $vehicle->id)
                  selected
                  @endif>
                  {{$vehicle->vehicleData->make}} - {{$vehicle->vehicleData->model}} - {{$vehicle->license_plate}}
                </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              {!! Form::label('site_id',__('Select Site'). ' <span class="text-danger">*</span>', ['class' =>
              'form-label'], false)
              !!}
              <select id="site_id" name="site_id" class="form-control" required>
                @foreach($sites as $s)
                <option value="{{$s->id}}" @if(old('site_id', $data->site_id) == $s->id)
                  selected
                  @endif> {{$s->site_name}} </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              {!! Form::label('date', __('Date'). ' <span class="text-danger">*</span>', ['class' => 'form-label'],
              false) !!}
              {!! Form::date('date',$data->date,['class'=>'form-control', 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('shift_id',__('Select Shift'). ' <span class="text-danger">*</span>', ['class' =>
              'form-label'],
              false) !!}
              <select id="shift_id" name="shift_id" class="form-control" required>
                <option value="" disabled>Select Shift</option>
                <option value="1" @if ($data->shift_id == '1') selected @endif>Morning</option>
                <option value="2" @if ($data->shift_id == '2') selected @endif>Evening</option>
              </select>
            </div>
            <div class="form-group" id="work_hours_div">
              {!! Form::label('work_hours', __('Work Hours'), ['class' =>
              'form-label']) !!}
              {!! Form::number('work_hours',$data->work_hours,['class'=>'form-control']) !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('price', __('Cost'), ['class' => 'form-label']) !!}
              {!! Form::number('price',$data->price,['class'=>'form-control', 'readonly']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('description',__('fleet.description'), ['class' => 'form-label']) !!}
              {!! Form::textarea('description',$data->description,['class'=>'form-control','size'=>'30x4']) !!}
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
            {!! Form::submit(__('fleet.update'), ['class' => 'btn btn-success']) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section("script")
<script src="{{ asset('assets/js/moment.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
  $('#vehicle_id').select2({placeholder: "Select Vehicle/Equipment"});
  $('#site_id').select2({placeholder: "Select Sitet"});
  $('#vendor_id').select2({placeholder: "@lang('fleet.select_vendor')"});
  $('#mechanic_id').select2({placeholder: "@lang('fleet.select_mechanic')"});
  $('#select_part').select2({placeholder: "@lang('fleet.selectPart')"});
  $('#required_by').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });
  $('#created_on').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

    var workHours = $('input[name="work_hours"]').val();
    
    $('#vehicle_id').change(function() {
    var vehicleId = $(this).val();
    var url = "{{ route('vehicles.expense', ['id' => ':id']) }}".replace(':id', vehicleId);
    $.get(url, function(vehicleData) {
    if(vehicleData.expense_type === 'rental'){
    var cost = workHours * vehicleData.expense_amount;
    $('input[name="price"]').val(cost);
    } else {
    $('input[name="price"]').val(0);
    }
    });
    });
    
    $('input[name="work_hours"]').on('change keyup', function() {
    workHours = $(this).val();
    var vehicleId = $('#vehicle_id').val();
    if(vehicleId){
    var url = "{{ route('vehicles.expense', ['id' => ':id']) }}".replace(':id', vehicleId);
    $.get(url, function(vehicleData) {
    if(vehicleData.expense_type === 'rental'){
    var cost = workHours * vehicleData.expense_amount;
    $('input[name="price"]').val(cost);
    } else {
    $('input[name="price"]').val(0);
    }
    });
    }
    });

  //Flat green color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  });

});
</script>
@endsection