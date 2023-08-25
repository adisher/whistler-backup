@extends('layouts.app')
@section('extra_css')
    <style type="text/css">
        .nav-tabs-custom>.nav-tabs>li.active {
            border-top-color: #00a65a !important;
        }

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

        .custom .nav-link.active {

            background-color: #3f51b5 !important;

        }

        .error-border {
            border: 1px solid red !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('shift-details.index') }}">Yield Details</a></li>
    <li class="breadcrumb-item active">Add Yield Details</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Add Yield Details</h3>
                </div>

                <div class="card-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-pills custom">
                            <li class="nav-item"><a class="nav-link active" href="#shifts-tab" data-toggle="tab">
                                    @lang('fleet.general_info') <i class="fa"></i></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="shifts-tab">
                            {!! Form::open([
                                'route' => 'shift-details.store',
                                'files' => true,
                                'method' => 'POST',
                                'class' => 'form-horizontal',
                                'id' => 'accountForm',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            {!! Form::hidden('user_id', Auth::user()->id) !!}
                            {!! Form::hidden('id', 1) !!}
                            <div class="row card-body">
                                <div class="col-md-6">
                                    <!-- Site Id -->
                                    <div class="form-group">
                                        {!! Form::label(
                                            'site',
                                            __('Site') . ' <span class="text-danger">*</span>',
                                            ['class' => 'col-xs-5 control-label'],
                                            false,
                                        ) !!}

                                        <div class="col-xs-6">
                                            <select name="site_id" class="form-control" id="site_name">
                                                <option></option>
                                                @foreach ($sites as $s)
                                                    <option value="{{ $s->id }}">
                                                        {{ $s->sites->site_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Shift Name -->
                                    <div class="form-group">
                                        {!! Form::label(
                                            'shift',
                                            __('Shift') . ' <span class="text-danger">*</span>',
                                            ['class' => 'col-xs-5 control-label'],
                                            false,
                                        ) !!}
                                        <div class="col-xs-6">
                                            <select name="shift_id" class="form-control" id="shift_name">
                                                <!-- Options will be populated by JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Vehicle Id -->
                                    <input type="hidden" name="vehicle_id" id="vehicle_id_display">
                                    <!-- Date -->
                                    <div class="form-group">
                                        {!! Form::label(
                                            'date',
                                            __('fleet.date') . ' <span class="text-danger">*</span>',
                                            [
                                                'class' => 'col-xs-5 control-label',
                                            ],
                                            false,
                                        ) !!}
                                        <div class="col-xs-6">
                                            <div class="input-group date">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span></div>
                                                {!! Form::date('date', null, ['class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Shift Yield Quantity -->
                                    <div class="form-group">
                                        {!! Form::label(
                                            'shift_quantity_grams',
                                            __('fleet.shift_quantity') . '(' . __('fleet.gms') . ')' . ' <span class="text-danger">*</span>',
                                            [
                                                'class' => 'col-xs-5 control-label',
                                            ],
                                            false,
                                        ) !!}
                                        <div class="col-xs-6">
                                            {!! Form::number('shift_quantity_grams', null, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    <!-- Shift Yield Quantity(pounds) -->
                                    <div class="form-group">
                                        {!! Form::label('shift_quantity_pounds', __('fleet.shift_quantity') . '(' . __('pounds') . ')', [
                                            'class' => 'col-xs-5 control-label',
                                        ]) !!}
                                        <div class="col-xs-6">
                                            {!! Form::number('shift_quantity_pounds', null, ['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <!-- Yield Image -->
                                    <div class="form-group">
                                        {!! Form::label('yield_image', __('fleet.yield_image'), [
                                            'class' => 'col-xs-5 control-label',
                                        ]) !!}
                                        <div class="col-xs-6">
                                            {!! Form::file('yield_images[]', ['class' => 'form-control', 'multiple' => true]) !!}
                                            <span class="text-danger"><b>(max file size) 10MB for videos | 2MB for image
                                                    files</b></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Shift Yield Quality -->
                                    <div class="form-group">
                                        {!! Form::label(
                                            'yield_quality',
                                            __('fleet.yield_quality') . '(' . __('fleet.cr') . ')' . ' <span class="text-danger">*</span>',
                                            [
                                                'class' => 'col-xs-5 control-label',
                                            ],
                                            false,
                                        ) !!}
                                        <div class="col-xs-6">
                                            {!! Form::number('yield_quality', null, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    <!-- Wastage/Impurities -->
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                {!! Form::label('wastage', __('fleet.wastage') . '(' . __('fleet.gms') . ')', [
                                                    'class' => 'col-xs-5 control-label',
                                                ]) !!}
                                                <div class="col-xs-6">
                                                    {!! Form::text('wastage', null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Net Weight -->
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                {!! Form::label('net_weight_grams', __('Net Weight') . '(' . __('fleet.gms') . ')', [
                                                    'class' => 'col-xs-5 control-label',
                                                ]) !!}
                                                <div class="col-xs-6">
                                                    {!! Form::text('net_weight_grams', null, ['class' => 'form-control', 'readonly']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Net Weight (Pounds) -->
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                {!! Form::label('net_weight_pounds', __('Net Weight') . '(' . __('pounds') . ')', [
                                                    'class' => 'col-xs-5 control-label',
                                                ]) !!}
                                                <div class="col-xs-6">
                                                    {!! Form::text('net_weight_pounds', null, ['class' => 'form-control', 'readonly']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Remarks -->
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                {!! Form::label('shift_yield_details', __('Remarks'), [
                                                    'class' => 'col-xs-5 control-label',
                                                ]) !!}
                                                <div class="col-xs-6">
                                                    {!! Form::textarea('shift_yield_details', null, [
                                                        'class' => 'form-control', 'rows' => '5',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blank"></div>
                            </div>

                            <div style=" margin-bottom: 20px;">
                                <div class="form-group" style="margin-top: 15px;">
                                    <div class="col-xs-6 col-xs-offset-3">
                                        {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-success']) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
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
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css" />

    <script type="text/javascript">
        $(".add_udf").click(function() {
            // alert($('#udf').val());
            var field = $('#udf1').val();
            if (field == "" || field == null) {
                alert('Enter field name');
            } else {
                $(".blank").append(
                    '<div class="row"><div class="col-md-8">  <div class="form-group"> <label class="form-label">' +
                    field.toUpperCase() + '</label> <input type="text" name="udf[' + field +
                    ']" class="form-control" placeholder="Enter ' + field +
                    '" required></div></div><div class="col-md-4"> <div class="form-group" style="margin-top: 30px"><button class="btn btn-danger" type="button" onclick="this.parentElement.parentElement.parentElement.remove();">Remove</button> </div></div></div>'
                );
                $('#udf1').val("");
            }
        });

        $(document).ready(function() {
            $('#group_id').select2({
                placeholder: "@lang('fleet.selectGroup')"
            });
            $('#vehicle_id').select2({
                placeholder: "Select Deployed Fleet",
            });
            $('#type_id').select2({
                placeholder: "@lang('fleet.type')"
            });
            $('#make_name').select2({
                placeholder: "@lang('fleet.SelectVehicleMake')",
                tags: true
            });
            $('#model_name').select2({
                placeholder: "@lang('fleet.SelectVehicleModel')",
                tags: true
            });
            $('#incharge_name').select2({
                placeholder: "@lang('fleet.SelectIncharge')",
                tags: true
            });
            $('#site_name').select2({
                placeholder: "Select Site",
                tags: true
            });
            $('#shift_name').select2({
                placeholder: "Select Shift",
                tags: true
            });
            $('#model_name').on('select2:select', () => {
                selectionMade = true;

            });
            $('#work_hours').timepicker({
                'timeFormat': 'H:i',
                'step': 15
            });

            $('input[name="shift_quantity_grams"], input[name="wastage"]').on('keyup', function() {
                var shift_quantity_grams = parseFloat($('input[name="shift_quantity_grams"]').val()) || 0;
                var shift_quantity_pounds = shift_quantity_grams * 0.00220462;
                var wastage = parseFloat($('input[name="wastage"]').val()) || 0;
                var wastage_pounds = wastage * 0.00220462;

                if (wastage > shift_quantity_grams) {
                    alert("Wastage cannot exceed Total Quantity");
                    $('input[name="wastage"]').val('');
                } else {
                    var net_weight = shift_quantity_grams - wastage;
                    var net_weight_pounds = shift_quantity_pounds - wastage_pounds;
                    $('input[name="shift_quantity_pounds"]').val(shift_quantity_pounds.toFixed(2));
                    $('input[name="net_weight_grams"]').val(net_weight.toFixed(2));
                    $('input[name="net_weight_pounds"]').val(net_weight_pounds.toFixed(2));
                }
            });

            // $("form").submit(function(e) {
            //     var vehicleId = $("#vehicle_id").val();
            //     if (vehicleId == null || vehicleId.trim() === "") {
            //         $("#vehicle_id_error").show();
            //         $("#vehicle_id_display").addClass(
            //             'error-border'); // Adding class to change border color
            //         e.preventDefault();
            //         return false;
            //     } else {
            //         $("#vehicle_id_error").hide();
            //         $("#vehicle_id_display").removeClass(
            //             'error-border'); // Removing class to reset border color
            //     }
            // });

            $('#site_name, #shift_name').change(function() {
                $("#vehicle_id_error").hide();
                $("#vehicle_id").removeClass('error-border');
                // Clearing the select menu
                $("#vehicle_id").empty().append('<option></option>');

                var siteId = $('#site_name').val();
                var shiftId = $('#shift_name').val();

                if (siteId && shiftId) {
                    $.ajax({
                        url: '{{ route('reports.deployed_fleet') }}',
                        type: 'GET',
                        data: {
                            site_id: siteId,
                            shift_id: shiftId
                        },
                        success: function(response) {
                            console.log('deployed: ', response);
                            $.each(response.fleet_details, function(i, vehicleDetail) {
                                $('#vehicle_id_display').val(i);
                            });
                        }
                    });
                }
            });

            $('#site_name').change(function() {
                var siteId = $(this).val();
                if (siteId) {
                    $.get("{{ route('get_open_shift', '') }}/" + siteId, function(response) {
                        console.log('shifts: ', response);
                        // Clear existing options
                        $('#shift_name').empty();
                        $('#shift_name').append('<option></option>'); // Default empty option

                        // Iterate through the response and add options
                        response.forEach(function(shiftId) {
                            var shiftText = shiftId == 1 ? 'Morning' : 'Evening';
                            $('#shift_name').append('<option value="' + shiftId + '">' +
                                shiftText + '</option>');
                        });
                    });
                }
            });

            $('#vehicle_id').change(function() {
                if (!$(this).val()) {
                    $("#vehicle_id_error").show();
                    $("#vehicle_id").addClass('error-border');
                } else {
                    $("#vehicle_id_error").hide();
                    $("#vehicle_id").removeClass('error-border');
                }
            });

            //Flat green color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endsection
