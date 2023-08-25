@extends('layouts.app')
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
@endsection
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{ route('maintenance.index')}}"> Corrective Maintenance </a></li>
<li class="breadcrumb-item active">Edit Maintenance</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Maintenance</h3>
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


        {!! Form::open(['route' => ['maintenance.update',$maintenance->id],'files'=>true,'method'=>'PATCH']) !!}
        {!! Form::hidden('id',$maintenance->id) !!}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('vehicle_id',__('Select Vehicle/Equipment'). ' <span class="text-danger">*</span>',
              ['class' =>
              'form-label'], false) !!}
              <select name="vehicle_id" class="form-control" id="vehicle_id">
                @foreach($vehicles as $vehicle)
                <option value="{{$vehicle->id}}" @if(old('vehicle_id', $maintenance->vehicle_id) == $vehicle->id)
                  selected
                  @endif>
                  {{$vehicle->vehicleData->make}} - {{$vehicle->vehicleData->model}} - {{$vehicle->license_plate}}
                </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              {!! Form::label('date', __('Date'), ['class' => 'form-label']) !!}
              {!! Form::date('date', $maintenance->date,['class' => 'form-control','required']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('subject', __('Subject'), ['class' => 'form-label']) !!}
              {!! Form::text('subject', $maintenance->subject,['class' => 'form-control','required']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('files', __('Select Image'), ['class' => 'form-label']) !!}
              {!! Form::file('files',['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('description', __('Description'), ['class' => 'form-label']) !!}
              {!! Form::textarea('description', $maintenance->description,['class' => 'form-control']) !!}
            </div>
          </div>
        </div>
        <div class="col-md-12">
          {!! Form::submit(__('fleet.update'), ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $('#group_id').select2({placeholder: "@lang('fleet.selectGroup')"});
    $('#role_id').select2({placeholder: "@lang('fleet.role')"});
    //Flat green color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });
  });
</script>
@endsection