@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('fuel.index') }}">@lang('fleet.fuel')</a></li>
    <li class="breadcrumb-item active">Allocate To Fleet</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Allocate To Fleet</h3>
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

                    {!! Form::open(['route' => 'fuel.store', 'method' => 'post', 'files' => true]) !!}
                    {!! Form::hidden('user_id', Auth::user()->id) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('vehicle_id', __('Select Fleet'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                                <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                                    <option value="">-</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" data-type-id="{{ $vehicle->vehicleData->type_id }}" data-another-type="{{ $vehicle->make_model_id }}">
                                            {{ $vehicle->vehicleData->make }} -
                                            {{ $vehicle->vehicleData->model }} -
                                            {{ $vehicle->license_plate }}</option>
                                    @endforeach
                                    {!! Form::hidden('fleet_type_id', null, ['id' => 'fleet_type_id', 'class' => 'form-control']) !!}
                                </select>
                                <span id="fuel_capacity" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('date', __('fleet.date'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                                <div class='input-group'>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    {!! Form::text('date', date('Y-m-d'), ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('qty', __('Fuel in Stock') . ' ' . '(liters)', ['class' => 'form-label']) !!}
                                {!! Form::number('qty', $stock, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group meter-reading" style="display: none;">
                                {!! Form::label('meter_reading', __('Meter Reading'), ['class' => 'form-label']) !!}
                                {!! Form::number('meter_reading', null, ['class' => 'form-control']) !!}
                                <small>@lang('fleet.meter_reading')</small>
                            </div>
                            <div class="form-group hours" style="display: none;">
                                {!! Form::label('hours', __('Hours'), ['class' => 'form-label']) !!}
                                {!! Form::text('hours', null, ['class' => 'form-control']) !!}
                            </div>
                            <!-- Quantity -->
                            <div class="form-group">
                                {!! Form::label('quantity', __('Quantity'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                                {!! Form::number('quantity', null, ['class' => 'form-control', 'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('image', __('fleet.select_image'), ['class' => 'form-label']) !!}
                                {!! Form::file('image', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('note', __('fleet.note'), ['class' => 'form-label']) !!}
                                {!! Form::text('note', null, ['class' => 'form-control']) !!}
                            </div>
                            {{-- <div class="form-group row">
                                <div class="col-md-6">
                                    <h4>@lang('fleet.complete_fill_up')</h4>
                                </div>
                                <div class="col-md-6">
                                    <label class="switch">
                                        <input type="checkbox" name="complete" value="1">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div> --}}
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit(__('Allocate'), ['class' => 'btn btn-success']) !!}
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
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css" />
    <script type="text/javascript">
        $(document).ready(function() {
            $("#vehicle_id").select2({
                placeholder: "@lang('fleet.selectVehicle')"
            });
            $("#vendor_name").select2({
                placeholder: "@lang('fleet.select_fuel_vendor')"
            });

            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $('#hours').timepicker({
            'timeFormat': 'H:i',
            'step': 15
            });

            $("#date").on("dp.change", function(e) {
                var date = e.date.format("YYYY-MM-DD");
            });

            //Flat green color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            $('#vehicle_id').change(function() {
            var selectedOption = $(this).find(':selected');
            var fleetTypeId = selectedOption.data('typeId');
            $('#fleet_type_id').val(fleetTypeId);
            });

            $(".fuel_from").change(function() {
                if ($("#r1").attr("checked")) {
                    $('#vendor_name').show();
                } else {
                    $('#vendor_name').hide();
                }
            });

            $('#vehicle_id').change(function() {
                var vehicleId = $(this).val(); // Get the selected vehicle ID
                var makeModelId = $(this).find('option:selected').data('another-type');
                console.log(makeModelId);

                // Make an AJAX request to fetch the fuel capacity
                $.ajax({
                    url: '{{ route('fuel.get_fuel_capacity') }}', // Replace with your actual route URL
                    type: 'POST',
                    data: {
                        make_model_id: makeModelId,
                        vehicle_id: vehicleId
                    },
                    success: function(response) {
                        // Update the fuel capacity element with the fetched value
                        $('#fuel_capacity').text('Fuel Tank Capacity: ' + response
                            .fuel_capacity + ' liters');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
            $('#vehicle_id').change(function() {
                // Hide both divs
                $('.meter-reading').hide();
                $('.hours').hide();

                // Get the type of the selected vehicle
                var type = $('option:selected', this).data('typeId');
                console.log(type);

                // Show the appropriate div based on the type
                if (type === 1) {
                    $('.meter-reading').show();
                } else if (type === 2) {
                    $('.hours').show();
                }
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
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
@endsection
