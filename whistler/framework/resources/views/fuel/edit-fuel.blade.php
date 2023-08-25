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
                {{-- <ul class="nav nav-pills custom">
                    <li class="nav-item"><a class="nav-link active" href="#fuel_details"
                            data-toggle="tab" id="fuelDetailsLink">
                            Edit Fuel Details <i class="fa"></i></a></li>
                </ul> --}}
            </div>
            <hr>
            <div class="tab-content">
                <div class="tab-pane active" id="fuel_details">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                @lang('fleet.edit_fuel')
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
                            {!! Form::open(['route' => ['fuel.update_fuel',$fuel->id],'method'=>'PATCH','files'=>'true']) !!}
                            {!! Form::hidden('user_id',Auth::user()->id)!!}
                            {!! Form::hidden('vehicle_id',$vehicle_id)!!}
                            {!! Form::hidden('id',$fuel->id)!!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-solid">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="hidden" name="fuel_from" class="flat-red" value="Vendor"
                                                    @if($fuel->fuel_from == "Vendor")
                                                checked @endif>
                                                {!! Form::label('fuel_from', __('Select Vendor'), ['class' =>
                                                'form-label']) !!}
                                                <select id="vendor_name" name="vendor_name" class="form-control">
                                                    <option value="">-</option>
                                                    @foreach($vendors as $vendor)
                                                    <option value="{{$vendor->id}}" @if($fuel->vendor_name ==
                                                        $vendor->id) selected @endif>
                                                        {{$vendor->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('date',__('fleet.date'), ['class' => 'form-label']) !!}
                                                <div class='input-group'>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><span
                                                                class="fa fa-calendar"></span>
                                                    </div>
                                                    {!!
                                                    Form::text('date',$fuel->date,['class'=>'form-control','required'])
                                                    !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('qty',__('fleet.qty').' (litres)', ['class' =>
                                                'form-label'])
                                                !!}
                                                {!! Form::text('qty',$fuel->qty,['class'=>'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('cost_per_unit',__('fleet.cost_per_unit'), ['class' =>
                                                'form-label']) !!}
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text">{{ $currency->symbol }}</span>
                                                    </div>
                                                    {!!
                                                    Form::text('cost_per_unit',$fuel->cost_per_unit,['class'=>'form-control'])
                                                    !!}
                                                </div>
                                            </div>
                                        </div>
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
        </div>
    </div>

    @endsection

    @section('script')
    <script src="{{ asset('assets/js/moment.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

  $("#vehicle_id").select2({placeholder: "@lang('fleet.selectVehicle')"});
  $("#vendor_name").select2({placeholder: "@lang('fleet.select_fuel_vendor')"});

  $('#date').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
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