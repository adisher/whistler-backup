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
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('shifts.index') }}">Manage Shifts</a></li>
    <li class="breadcrumb-item active">Edit Shift</li>
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
                    <h3 class="card-title">Edit Shifts</h3>
                </div>

                <div class="card-body">
                   
                    <div class="tab-content">
                        <div class="tab-pane active" id="shifts-tab">
                            {!! Form::open([
                                'route' => ['shifts.update', $shifts->id],
                                'files' => true,
                                'method' => 'PATCH',
                                'class' => 'form-horizontal',
                                'id' => 'accountForm',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            {!! Form::hidden('user_id', Auth::user()->id) !!}
                            <div class="row card-body">

                                <div class="col-md-6">
                                    <!-- Site Id -->
                                    <div class="form-group">
                                        {!! Form::label('site', __('Site'), ['class' => 'col-xs-5 control-label']) !!}

                                        <div class="col-xs-6">
                                            <select name="site_id" class="form-control" id="site_name" disabled>
                                                @foreach ($sites as $site)
                                                    <option value="{{ $site->id }}"
                                                        {{ (old('site_id') ?? $shifts->site_id) == $site->id ? 'selected' : '' }}>
                                                        {{ $site->site_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Shift Name -->
                                    <div class="form-group">
                                        {!! Form::label('shift_name', __('Shift Name'), ['class' => 'col-xs-5 control-label']) !!}
                                    
                                        <div class="col-xs-6">
                                            <select name="shift_name" class="form-control" id="shift_name" disabled>
                                                <option></option>
                                                <option value="morning" {{ (old('shift_name') ?? $shifts->shift_name) == 'morning' ? 'selected' : '' }}>Morning</option>
                                                <option value="evening" {{ (old('shift_name') ?? $shifts->shift_name) == 'evening' ? 'selected' : '' }}>Evening</option>
                                                    
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Shift Incharge -->
                                    <div class="form-group">
                                        {!! Form::label('shift_incharge_id', __('fleet.shift_incharge_id'), ['class' => 'col-xs-5 control-label']) !!}

                                        <div class="col-xs-6">
                                            <select name="shift_incharge_id" class="form-control" required
                                                id="incharge_name">
                                                <option></option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ (old('shift_incharge_id') ?? $shifts->shift_incharge_id) == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div> <!-- col-md-6 -->

                                <div class="col-md-6">
                                    <!-- Shift Details -->
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                {!! Form::label('shift_details', __('fleet.shift_details'), ['class' => 'col-xs-5 control-label']) !!}
                                                <div class="col-xs-6">
                                                    {!! Form::textarea('shift_details', $shifts->shift_details, ['class' => 'form-control', 'required']) !!}
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

            $('#total_shifts').on('keypress', function(e) {
                // ASCII codes for numbers 1-9 are 49-57
                // Allow only these to pass, reject anything else
                if (e.which < 49 || e.which > 57) {
                    return false;
                }
                // If input field already has a character, prevent additional input
                if ($(this).val().length > 0) {
                    return false;
                }
            }).on('input', function() {
                // Get the entered number
                var val = $(this).val();
                var existingCount = $('#input-container input[type="time"]').length /
                    2; // count existing slots

                // Clear the additional container
                $('#additional-container').empty();

                // Generate the additional inputs
                for (var i = existingCount; i < existingCount + parseInt(val); i++) {
                    $('#additional-container').append(` <label for="slot${i}"
                    class="control-label text-primary">Time Slot ${i + 1}</label>
                    <br><br>
                    <div class="form-group row justify-content-between">
                        <div class="col-md-6">
                            <label for="starttime${i}" class="control-label">Start Time</label>
                            <div class="input-group date">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-clock"></i></span></div>
                                <input type="time" name="starttimes[]" id="starttime${i}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="endtime${i}" class="control-label">End Time</label>
                            <div class="input-group date">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-clock"></i></span></div>
                                <input type="time" name="endtimes[]" id="endtime${i}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <hr>
                    `);
                }
            });

            $('#input-container, #additional-container').on('change',
                'input[type="time"][name="starttimes[]"]',
                function() {
                    var endTime = $(this).parent().parent().next().find(
                        'input[type="time"][name="endtimes[]"]').val();
                    if (endTime && this.value > endTime) {
                        alert("Start time cannot be greater than end time");
                        this.value = '';
                    }
                });

            $('#input-container, #additional-container').on('change',
                'input[type="time"][name="endtimes[]"]',
                function() {
                    var startTime = $(this).parent().parent().prev().find(
                        'input[type="time"][name="starttimes[]"]').val();
                    if (startTime && this.value < startTime) {
                        alert("End time cannot be less than start time");
                        this.value = '';
                    }
                });

            // Trigger a change event to populate the time slots
            $('#total_shifts').trigger('input');

            //Flat green color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

        });
    </script>
@endsection
