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
@section('breadcrumb')
    <li class="breadcrumb-item">{{ link_to_route('vehicle-types.index', __('Fleet Details')) }}</li>
    <li class="breadcrumb-item active">Add Fleet Details</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Add Fleet Details</h3>
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

                    {!! Form::open(['route' => 'vehicle-types.store', 'method' => 'post', 'files' => true]) !!}
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('type_id', __('Select Fleet Type'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}
                            <select name="type_id" class="form-control" required id="type_id"
                                onchange="handleSelectChange(this)">
                                <option></option>
                                <optgroup label="Existing Types">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="">
                                    <option value="add_new">Add New Type</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group col-md-6" id="new_type_form"></div>

                        <div class="form-group col-md-6">
                            {!! Form::label('make', __('Make'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                            {!! Form::text('make', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('model', __('Model'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                            {!! Form::text('model', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <!-- Engine Type -->
                        <div class="form-group col-md-6">
                            {!! Form::label('engine_type', __('Select Engine Type'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                            {!! Form::select('engine_type', ['Petrol' => 'Petrol', 'Diesel' => 'Diesel'], null, [
                            'class' => 'form-control',
                            'required',
                            ]) !!}
                        </div>
                        <!-- Horse Power -->
                        <div class="form-group col-md-6">
                            {!! Form::label('horse_power', __('Horse Power'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                            {!! Form::number('horse_power', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <!-- Engine Capacity -->
                        <div class="form-group col-md-6">
                            {!! Form::label('engine_capacity', __('Engine Capacity'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                            {!! Form::number('engine_capacity', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <!-- Oil Tank Capacity -->
                        <div class="form-group col-md-6">
                            {!! Form::label('oil_capacity', __('Oil Tank Capacity'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                            {!! Form::number('oil_capacity', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <!-- Fuel Tank Capacity -->
                        <div class="form-group col-md-6">
                            {!! Form::label('fuel_capacity', __('Fuel Tank Capacity'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                            {!! Form::number('fuel_capacity', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group col-md-4" style="margin-top: 30px">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="switch">
                                        <input type="checkbox" name="isenable" value="1">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="col-md-9" style="margin-top: 5px">
                                    <h4>@lang('fleet.isenable')</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::submit(__('fleet.save'), ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
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
                radioClass: 'iradio_flat-green'
            });

            $('#type_id').select2({
                placeholder: "Fleet Type"
            });

        });

        function handleSelectChange(selectElement) {
            var selectedOption = selectElement.value;
            if (selectedOption === 'add_new') {
                var newForm = `
                  <label for="new_type_name">New Type Name</label>
                  <input type="text" name="new_type_name" id="new_type_name" placeholder="Enter new type name" class='form-control'>
                `;
                // Append new form to the div
                $('#new_type_form').html(newForm);
            } else {
                // Empty the div
                $('#new_type_form').empty();
            }
        }
    </script>
@endsection
