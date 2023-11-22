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
<li class="breadcrumb-item">{{ link_to_route('vehicle-make.index', __('Fleet Make'))}}</li>
<li class="breadcrumb-item active">Edit Fleet Make</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Edit Fleet Make</h3>
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

      {!! Form::open(['route' => ['vehicle-make.update',$vehicle_make->id],'method'=>'PATCH','files'=>true]) !!}
      {!! Form::hidden('id',$vehicle_make->id) !!}
      {!! Form::hidden('old_type',strtolower(str_replace(' ','',$vehicle_make->make))) !!}
      <div class="row">
        <div class="form-group col-md-6">
          {!! Form::label('vehiclemake', __('Fleet Make'), ['class' => 'form-label']) !!}
          {!! Form::text('vehiclemake', $vehicle_make->make,['class' => 'form-control','required']) !!}
        </div>

        <div class="form-group col-md-4" style="margin-top: 30px">
          <div class="row">
            <div class="col-md-3">
              <label class="switch">
              <input type="checkbox" name="isenable" value="1" @if($vehicle_make->isenable == 1) checked @endif>
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
        {!! Form::submit(__('fleet.update'), ['class' => 'btn btn-warning']) !!}
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
  });
</script>
@endsection