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
    <li class="breadcrumb-item"><a href="{{ route('sites.index') }}">Sites</a></li>
    <li class="breadcrumb-item active">Edit Site</li>
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
                    <h3 class="card-title">Edit Site</h3>
                </div>

                <div class="card-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-pills custom">
                            <li class="nav-item"><a class="nav-link active" href="#info-tab" data-toggle="tab">
                                    @lang('fleet.general_info') <i class="fa"></i></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="info-tab">
                            {!! Form::open([
                                'route' => ['sites.update', $products->id],
                                'files' => true,
                                'method' => 'PATCH',
                                'class' => 'form-horizontal',
                                'id' => 'accountForm',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            {!! Form::hidden('user_id', Auth::user()->id) !!}
                            {!! Form::hidden('id', $products->id) !!}
                            <div class="row card-body">

                                <div class="col-md-6">
                                    <!-- Site Name -->
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                {!! Form::label('site_name', __('fleet.site_name'). ' <span class="text-danger">*</span>', [
                                                    'class' => 'col-xs-5 control-label',
                                            ], false) !!}
                                                <div class="col-xs-6">
                                                    {!! Form::text('site_name', $products->site_name, ['class' => 'form-control', 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Site Details -->
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                {!! Form::label('site_details', __('fleet.site_details'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}
                                                <div class="col-xs-6">
                                                    {!! Form::textarea('site_details', $products->site_details, ['class' => 'form-control', 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product Transfer -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::label('product_transfer', __('fleet.product_transfer'), ['class' => 'col-xs-5 control-label']) !!}
                                            </div>
                                            <div class="col-ms-6">
                                                <label class="switch">
                                                    <input type="checkbox" name="product_transfer" value="1"
                                                        @if ($products->product_transfer == '1') checked @endif>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        {!! Form::label('udf1', __('fleet.add_udf'), ['class' => 'col-xs-5 control-label']) !!}
                                        <div class="row">
                                            <div class="col-md-8">
                                                {!! Form::text('udf1', null, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-info add_udf">
                                                    @lang('fleet.add')</button>
                                            </div>
                                        </div>
                                    </div>

                                </div> <!-- col-md-6 -->

                                {{-- <div class="col-md-6">
                                    <!-- Site Production Details -->
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                {!! Form::label('site_production_details', __('Site Production Details'), [
                                                    'class' => 'col-xs-5 control-label',
                                                ]) !!}
                                                <div class="col-xs-6">
                                                    {!! Form::textarea('site_production_details', $products->site_production_details, [
                                                        'class' => 'form-control',
                                                        'required',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Stock Details -->
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                {!! Form::label('stock_details', __('fleet.stock_details'), ['class' => 'col-xs-5 control-label']) !!}
                                                <div class="col-xs-6">
                                                    {!! Form::textarea('stock_details', $products->stock_details, ['class' => 'form-control', 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
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

                // Clear the container
                $('#input-container').empty();

                // Generate the inputs
                for (var i = 0; i < val; i++) {
                    $('#input-container').append(` 
                    <label for="slot${i}" class="control-label text-primary">Time Slot ${i + 1}</label>
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

            //Flat green color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

        });
    </script>
@endsection
