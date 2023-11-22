@extends('layouts.app')
@section('extra_css')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('work_order.index') }}">Fleet Utilization </a></li>
    <li class="breadcrumb-item active">Deploy Fleet</li>
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        Deploy Fleet
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

                    {!! Form::open(['route' => 'work_order.store', 'method' => 'post']) !!}
                    {!! Form::hidden('user_id', Auth::user()->id) !!}
                    {!! Form::hidden('type', 'Created') !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label(
                                    'vehicle_id',
                                    __('Select Vehicle/Equipment') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ) !!}
                                <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                                    <option value="">-</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}"
                                            {{ in_array($vehicle->id, $open_shift) ? 'disabled' : '' }}>
                                            {{ $vehicle->vehicleData->make }} -
                                            {{ $vehicle->vehicleData->model }} -
                                            {{ $vehicle->license_plate }}
                                            @if (in_array($vehicle->id, $open_shift))
                                                (Shift Open)
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!! Form::label(
                                    'driver_id',
                                    __('Select Driver') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ) !!}
                                <select id="driver_id" name="driver_id" class="form-control" required>
                                    <option value="">-</option>
                                    @foreach ($drivers as $d)
                                        <option value="{{ $d->id }}"
                                            {{ isset($assigned_driver[$d->id]) ? 'disabled' : '' }}>
                                            {{ $d->name }}
                                            @if (isset($assigned_driver[$d->id]))
                                                (Assigned to Vehicle:
                                                {{ $assigned_driver[$d->id]['vehicle_data']->vehicleData->make }} -
                                                {{ $assigned_driver[$d->id]['vehicle_data']->vehicleData->model }} -
                                                {{ $assigned_driver[$d->id]['vehicle_data']->license_plate }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                {!! Form::label(
                                    'site_id',
                                    __('Select Site') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ) !!}
                                <select id="site_id" name="site_id" class="form-control" required>
                                    <option value="">-</option>
                                    @foreach ($sites as $s)
                                        <option value="{{ $s->id }}"> {{ $s->site_name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!! Form::label('date', __('Date') . ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                                {!! Form::date('date', null, ['class' => 'form-control', 'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label(
                                    'shift_id',
                                    __('Select Shift') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ) !!}
                                <select id="shift_id" name="shift_id" class="form-control" required>
                                    <option value="" disabled>Select Shift</option>
                                    <option value="1">Morning</option>
                                    <option value="2">Evening</option>
                                </select>
                            </div>
                            <div class="form-group">
                                {!! Form::label(
                                    'start_meter',
                                    __('Start Meter') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ) !!}
                                {!! Form::text('start_meter', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            {{-- <div class="form-group">
                                {!! Form::label('end_meter', __('End Meter'), ['class' => 'form-label'], false) !!}
                                {!! Form::text('end_meter', null, ['class' => 'form-control']) !!}
                            </div> --}}
                            {{-- <div class="form-group" id="work_hours_div">
                                {!! Form::label('work_hours', __('Work Hours'), ['class' => 'form-label'], false) !!}
                                {!! Form::number('work_hours', null, ['class' => 'form-control']) !!}
                            </div> --}}
                        </div>
                        <input type="hidden" name="expense_amount" id="expense_amount" value="0">

                        <div class="col-md-6">
                            {{-- <div class="form-group">
                                {!! Form::label('price', __('Cost'), ['class' => 'form-label']) !!}
                                {!! Form::number('price', null, ['class' => 'form-control', 'readonly']) !!}
                            </div> --}}
                            <div class="form-group">
                                {!! Form::label('description', __('Description'), ['class' => 'form-label']) !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="parts col-md-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit(__('Deploy'), ['class' => 'btn btn-success']) !!}
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#vehicle_id').select2({
                placeholder: "Select Vehicle/Equipment"
            });
            $('#vendor_id').select2({
                placeholder: "@lang('fleet.select_vendor')"
            });
            $('#mechanic_id').select2({
                placeholder: "@lang('fleet.select_mechanic')"
            });
            $('#select_part').select2({
                placeholder: "@lang('fleet.selectPart')"
            });
            $('#site_id').select2({
                placeholder: "Select Site"
            });
            $('#driver_id').select2({
                placeholder: "Select Driver"
            });
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
                    if (vehicleData.expense_type === 'rental') {
                        var cost = workHours * vehicleData.expense_amount;
                        $('input[name="price"]').val(cost);
                    } else {
                        $('input[name="price"]').val(0);
                    }
                });

                // Fetch start_meter data for the selected vehicle
                var meterUrl = "{{ route('vehicles.getMeter', ['id' => ':id']) }}".replace(':id',
                    vehicleId);
                $.get(meterUrl, function(data) {
                    if (data.start_meter) {
                        $('input[name="start_meter"]').val(data.start_meter);
                    } else {
                        $('input[name="start_meter"]').val(0); // Or any default value
                    }
                });
            });

            $('input[name="work_hours"]').on('change keyup', function() {
                workHours = $(this).val();
                var vehicleId = $('#vehicle_id').val();
                if (vehicleId) {
                    var url = "{{ route('vehicles.expense', ['id' => ':id']) }}".replace(':id', vehicleId);
                    $.get(url, function(vehicleData) {
                        if (vehicleData.expense_type === 'rental') {
                            var cost = workHours * vehicleData.expense_amount;
                            $('input[name="price"]').val(cost);
                        } else {
                            $('input[name="price"]').val(0);
                        }
                    });
                }
            });

            $('#driver_id').change(function() {
                var driver_id = $(this).val();
                var url = "{{ route('assigned_driver', ['id' => ':id']) }}".replace(':id', driver_id);
                if (driver_id) {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(response) {
                            if (response.error) {
                                alert(response.error);
                                $('#driver_id').val(null).trigger(
                                    'change'); // Reset the selection
                            }
                        },
                        error: function(xhr) {
                            console.error('An error occurred:', xhr);
                        }
                    });
                }
            });

            //Flat green color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

        });
    </script>
@endsection
