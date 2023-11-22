@extends('layouts.app')

@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{ route('fuel.index')}}">@lang('fleet.fuel')</a></li>
<li class="breadcrumb-item active"> @lang('fleet.edit_fuel')</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card-body table-responsive">
      <div class="nav-tabs-custom">
        <ul class="nav nav-pills custom">
            <li class="nav-item"><a class="nav-link active" href="#fleet_allocation" data-toggle="tab" id="fleetAllocationLink"> 
              Edit Fleet Allocation Details
                    <i class="fa"></i></a></li>
        </ul>
    </div>
    <hr>
    <div class="tab-content">
      <div class="tab-pane active" id="fleet_allocation">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              
            </h3>
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
    
            {!! Form::open(['route' => ['fuel.update',$fuel_allocation->id],'method'=>'PATCH','files'=>'true']) !!}
            {!! Form::hidden('user_id',Auth::user()->id)!!}
            {!! Form::hidden('vehicle_id',$vehicle_id)!!}
            {!! Form::hidden('id',$fuel_allocation->id)!!}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('vehicle_id',__('Select Fleet'), ['class' => 'form-label']) !!}
                  <select id="vehicle_id" disabled name="vehicle_id" class="form-control xxhvk" required>
                    <option selected value="{{$vehicle_id}}">{{$fuel_allocation->vehicle_data->vehicleData->make}} -
                      {{$fuel_allocation->vehicle_data->vehicleData->model}} - {{$fuel_allocation->vehicle_data->fleet_no}}</option>
                  </select>
                </div>
                <div class="form-group">
                  {!! Form::label('date',__('fleet.date'), ['class' => 'form-label']) !!}
                  <div class='input-group'>
                    <div class="input-group-prepend">
                      <span class="input-group-text"><span class="fa fa-calendar"></span>
                    </div>
                    {!! Form::text('date',$fuel_allocation->date,['class'=>'form-control','required']) !!}
                  </div>
                </div>
              @if ($type_id == '1')
                <div class="form-group meter-reading">
                  {!! Form::label('meter_reading', __('Meter Reading'), ['class' => 'form-label']) !!}
                  {!! Form::number('meter_reading', $fuel_allocation->meter, ['class' => 'form-control']) !!}
                  <small>@lang('fleet.meter_reading')</small>
                </div>
                <!-- Quantity -->
                <div class="form-group">
                  {!! Form::label('quantity', __('Quantity'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false)
                  !!}
                  {!! Form::number('quantity', $fuel_allocation->qty, ['class' => 'form-control', 'required']) !!}
                </div>
              @elseif($type_id == '2') 
                <div class="form-group hours">
                  {!! Form::label('hours', __('Hours'), ['class' => 'form-label']) !!}
                  {!! Form::text('hours', $fuel_allocation->time, ['class' => 'form-control']) !!}
                </div>
                  <div class="form-group">
                  {!! Form::label('Quantity',__('Quantity'), ['class' => 'form-label']) !!}
                  {!! Form::number('quantity',$fuel_allocation->qty,['class'=>'form-control']) !!}
                </div>
              @endif 
    
                <div class="form-group">
                  {!! Form::label('image',__('fleet.select_image'), ['class' => 'form-label']) !!}
                  @if (!is_null($fuel_allocation->image) && file_exists('uploads/'.$fuel_allocation->image))
                    <a href="{{ url('uploads/'.$fuel_allocation->image) }}" target="_blank">View</a>
                  @endif
                  {!! Form::file('image',['class'=>'form-control']) !!}
                </div>
    
                <div class="form-group">
                  {!! Form::label('note',__('fleet.note'), ['class' => 'form-label']) !!}
                  {!! Form::text('note',$fuel_allocation->note,['class'=>'form-control']) !!}
                </div>
                {{-- <div class="form-group row">
                  <div class="col-md-6">
                    <h4>@lang('fleet.complete_fill_up')</h4>
                  </div>
                  <div class="col-md-6">
                    <label class="switch">
                      <input type="checkbox" name="complete" value="1" @if($fuel_allocation->complete == '1')checked @endif>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div> --}}
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
  </div>
</div>

@endsection

@section('script')
<script src="{{ asset('assets/js/moment.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
<link rel="stylesheet" type="text/css"
  href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css" />
<script type="text/javascript">
  $(document).ready(function() {

  $("#vehicle_id").select2({placeholder: "@lang('fleet.selectVehicle')"});
  $("#vendor_name").select2({placeholder: "@lang('fleet.select_fuel_vendor')"});

  $('#date').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  });
  $('#hours').timepicker({
  'timeFormat': 'H:i',
  'step': 15
  });

  $("#date").on("dp.change", function (e) {
    var date=e.date.format("YYYY-MM-DD");
  });

  //Flat green color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  });
});
</script>
@endsection
@section('extra_css')
<style type="text/css">
  /* The switch - the box around the slider */
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  /* Hide default HTML checkbox */
  .switch input {
    display: none;
  }

  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.min.css')}}">
@endsection