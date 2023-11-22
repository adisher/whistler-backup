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
  .switch input {display:none;}

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

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
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
<li class="breadcrumb-item">{{ link_to_route('vehicle-types.index', __('Fleet Details'))}}</li>
<li class="breadcrumb-item active">Edit Fleet Details</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Fleet Details</h3>
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

      {!! Form::open(['route' => ['vehicle-types.update',$vehicle_data->id],'method'=>'PATCH','files'=>true]) !!}
      {!! Form::hidden('id',$vehicle_data->id) !!}
      {!! Form::hidden('old_type',strtolower(str_replace(' ','',$vehicle_data->vehicletype))) !!}
      <div class="row">
        <div class="form-group col-md-6">
          {!! Form::label('type_id', __('Select Fleet Type'), ['class' => 'col-xs-5 control-label']) !!}
          <select name="type_id" class="form-control" required id="type_id">
            <option></option>
            @foreach ($types as $type)
            <option value="{{ $type->id }}" {{ old('type_id', $vehicle_data->type_id) == $type->id ? 'selected' : '' }}>{{
              $type->type_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          {!! Form::label('make', __('Make'), ['class' => 'form-label']) !!}
          {!! Form::text('make', $vehicle_data->make,['class' => 'form-control','required']) !!}
        </div>
        <div class="form-group col-md-6">
          {!! Form::label('model', __('Model'), ['class' => 'form-label']) !!}
          {!! Form::text('model', $vehicle_data->model,['class' => 'form-control','required']) !!}
        </div>
        <!-- Engine Type -->
        <div class="form-group col-md-6">
          {!! Form::label('engine_type', __('Engine Type'), ['class' => 'form-label']) !!}
            {!! Form::select('engine_type', ['Petrol' => 'Petrol', 'Diesel' => 'Diesel'], $vehicle_data->engine_type, [
            'class' => 'form-control', 'required',
            ]) !!}
        </div>
        <!-- Horse Power -->
        <div class="form-group col-md-6">
          {!! Form::label('horse_power', __('Horse Power'), ['class' => 'form-label']) !!}
          {!! Form::text('horse_power', $vehicle_data->horse_power, ['class' => 'form-control', 'required']) !!}
        </div>
        <!-- Engine Capacity -->
        <div class="form-group col-md-6">
          {!! Form::label('engine_capacity', __('Engine Capacity'), ['class' => 'form-label']) !!}
          {!! Form::number('engine_capacity', $vehicle_data->engine_capacity, ['class' => 'form-control', 'required']) !!}
        </div>
        <!-- Fuel Tank Capacity -->
        <div class="form-group col-md-6">
          {!! Form::label('fuel_capacity', __('Fuel Tank Capacity'), ['class' => 'form-label']) !!}
          {!! Form::number('fuel_capacity', $vehicle_data->fuel_capacity, ['class' => 'form-control', 'required']) !!}
        </div>
        <!-- Oil Tank Capacity -->
        <div class="form-group col-md-6">
          {!! Form::label('oil_capacity', __('Oil Tank Capacity'), ['class' => 'form-label']) !!}
          {!! Form::number('oil_capacity', $vehicle_data->oil_capacity, ['class' => 'form-control', 'required']) !!}
        </div>
        <!-- Status -->
        <div class="form-group col-md-4" style="margin-top: 30px">
          <div class="row">
            <div class="col-md-3">
              <label class="switch">
              <input type="checkbox" name="isenable" value="1" @if($vehicle_data->isenable == 1) checked @endif>
              <span class="slider round"></span>
              </label>
            </div>
            <div class="col-md-9" style="margin-top: 5px">
              <h4>@lang('fleet.isenable')</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
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
  //Flat green color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });

    $('#type_id').select2({
    placeholder: "@lang('fleet.type')"
    });
  });
</script>
@endsection