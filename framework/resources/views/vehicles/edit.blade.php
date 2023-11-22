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

        .custom .nav-link.active {

            background-color: #3f51b5 !important;
            color: inherit;
        }

        .select2-selection:not(.select2-selection--multiple) {
            height: 38px !important;
        }

        span.select2-selection.select2-selection--multiple {
            width: 100%;
        }

        input.select2-search__field {
            width: auto !important;
        }

        span.select2.select2-container {
            width: 100% !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('vehicles.index') }}">Fleet</a></li>
    <li class="breadcrumb-item active">Edit Fleet</li>
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


            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Edit Fleet</h3>
                </div>

                <div class="card-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-pills custom">
                            <li class="nav-item"><a class="nav-link active" href="#info-tab" data-toggle="tab">
                                    @lang('fleet.general_info') <i class="fa"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="#insurance" data-toggle="tab"> @lang('fleet.insurance')
                                    <i class="fa"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="#acq-tab" data-toggle="tab"> @lang('fleet.purchase_info')
                                    <i class="fa"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="#driver" data-toggle="tab"> @lang('fleet.assign_driver')
                                    <i class="fa"></i></a></li>
                            {{-- <li class="nav-item"><a class="nav-link" href="#site" data-toggle="tab"> Assign Site
                                    <i class="fa"></i></a></li> --}}
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="info-tab">
                            {!! Form::open([
                                'route' => ['vehicles.update', $vehicle->id],
                                'files' => true,
                                'method' => 'PATCH',
                                'class' => 'form-horizontal',
                                'id' => 'accountForm1',
                            ]) !!}
                            {!! Form::hidden('user_id', Auth::user()->id) !!}
                            {!! Form::hidden('id', $vehicle->id) !!}
                            <div class="row card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('type_id', __('Select Fleet Type'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}

                                        <div class="col-xs-6">
                                            <select name="type_id" class="form-control" required id="type_id">
                                                <option></option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}"
                                                        @if ($vehicle->type_id == $type->id) selected @endif data-type-name="{{ $type->type_name }}">
                                                        {{ $type->displayname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{-- @dd($makes) --}}
                                        {!! Form::label('make_model_id', __('Select Make - Model'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}

                                        <div class="col-xs-6">
                                            <select name="make_model_id" class="form-control" required id="make_model">
                                                <option></option>
                                                @foreach ($vehicleData as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($vehicle->make_model_id == $item->id) selected @endif>
                                                        {{ $item->make }} - {{ $item->model }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- @dd($vehicle,$models) --}}
                                    <!-- Fleet no -->
                                    <div class="form-group">
                                        {!! Form::label('fleet_no', __('Vehicle/Equipment No.'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}
                                        <div class="col-xs-6">
                                            {!! Form::text('fleet_no', $vehicle->fleet_no, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('year', __('Vehicle/Equipment Year'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}
                                        <div class="col-xs-6">
                                            {!! Form::number('year', $vehicle->year, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    <!-- Engine No. -->
                                    <div class="form-group">
                                        {!! Form::label('engine_no', __('Engine No.'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}
                                        <div class="col-xs-6">
                                            {!! Form::text('engine_no', $vehicle->engine_no, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    
                                    <!-- Chasis No -->
                                    <div class="form-group">
                                        {!! Form::label('chasis_no', __('Chasis No.'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}
                                        <div class="col-xs-6">
                                            {!! Form::text('chasis_no', $vehicle->chasis_no, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('license_plate', __('fleet.licensePlate'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}
                                        <div class="col-xs-6">
                                            {!! Form::text('license_plate', $vehicle->license_plate, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('lic_exp_date', __('fleet.lic_exp_date'). ' <span class="text-danger">*</span>', [
                                            'class' => 'col-xs-5 control-label
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          required',
                                    ], false) !!}
                                        <div class="col-xs-6">
                                            <div class="input-group date">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span></div>
                                                {!! Form::text('lic_exp_date', $vehicle->lic_exp_date, ['class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tracker No -->
                                    <div class="form-group">
                                        {!! Form::label('tracker_no', __('Tracker No.'), ['class' => 'col-xs-5 control-label']) !!}
                                        <div class="col-xs-6">
                                            {!! Form::text('tracker_no', $vehicle->tracker_no == 0 ? '' : $vehicle->tracker_no, [
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <!-- Tracker Exp Date -->
                                    <div class="form-group">
                                        {!! Form::label('tracker_exp_date', __('Tracker Expiry Date'), [
                                            'class' => 'col-xs-5 control-label
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          required',
                                        ]) !!}
                                        <div class="col-xs-6">
                                            <div class="input-group date">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span></div>
                                                {!! Form::text('tracker_exp_date', $vehicle->tracker_exp_date == 0 ? '' : $vehicle->tracker_exp_date, [
                                                    'class' => 'form-control'
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fitness Certificate No -->
                                    <div class="form-group">
                                        {!! Form::label('fitness_cert_no', __('Fitness Certificate No.'), ['class' => 'col-xs-5 control-label']) !!}
                                        <div class="col-xs-6">
                                            {!! Form::text('fitness_cert_no', $vehicle->fitness_cert_no == 0 ? '' : $vehicle->fitness_cert_no, [
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <!-- Fitness Cert Exp Date -->
                                    <div class="form-group">
                                        {!! Form::label('fitness_cert_exp_date', __('Fitness Cert Expiry Date'), [
                                            'class' => 'col-xs-5 control-label
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          required',
                                        ]) !!}
                                        <div class="col-xs-6">
                                            <div class="input-group date">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-calendar"></i></span></div>
                                                {!! Form::text(
                                                    'fitness_cert_exp_date',
                                                    $vehicle->fitness_cert_exp_date == 0 ? '' : $vehicle->fitness_cert_exp_date,
                                                    [
                                                        'class' => 'form-control',
                                                    ],
                                                ) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::label('in_service', __('fleet.service'), ['class' => 'col-xs-5 control-label']) !!}
                                            </div>
                                            <div class="col-ms-6" style="margin-left: -140px">
                                                <label class="switch">
                                                    <input type="checkbox" name="in_service" value="1"
                                                        @if ($vehicle->in_service == '1') checked @endif>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('color_name', __('Select Fleet Color'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}

                                        <div class="col-xs-6">
                                            <select name="color_name" class="form-control" required id="color_name">
                                                <option></option>
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->color }}"
                                                        @if ($vehicle->pluck('color_name')->contains($color->color)) selected @endif>
                                                        {{ $color->color }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- condition -->
                                    <div class="form-group">
                                        {!! Form::label('condition', __('Condition'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}
                                        <div class="col-xs-6">
                                            {!! Form::select('condition', ['Old' => 'Old', 'New' => 'New'], null, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{-- {!! Form::label('vin', __('fleet.vin'), ['class' => 'col-xs-5 control-label']) !!} --}}
                                        <div class="col-xs-6">
                                            {!! Form::hidden('vin', $vehicle->vin, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('average', '<span class="avg">'.__('fleet.average') . ' (' . __('fleet.kmpl') . ')</span>'. ' <span
                                            class="text-danger">*</span>', [
                                        'class' => 'col-xs-5 control-label', 'id' => 'average_label'
                                        ], false) !!}
                                        <div class="col-xs-6">
                                            {!! Form::number('average', $vehicle->average, ['class' => 'form-control', 'required', 'step' => 'any']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if (Hyvikk::get('dis_format') == 'km')
                                            {!! Form::label('int_mileage', __('fleet.intMileage') . '(' . __('fleet.km') . ')'. ' <span class="text-danger">*</span>', [
                                                'class' => 'col-xs-5
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      control-label',
                                    ], false) !!}
                                        @else
                                            {!! Form::label('int_mileage', __('fleet.intMileage') . '(' . __('fleet.miles') . ')', [
                                                'class' => 'col-xs-5
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      control-label',
                                            ]) !!}
                                        @endif
                                        <div class="col-xs-6">
                                            {!! Form::text('int_mileage', $vehicle->int_mileage, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    <!-- Expense Type -->
                                    <div class="form-group">
                                        {!! Form::label('expense_type', __('Select Expense Type'). ' <span class="text-danger">*</span>', ['class' => 'col-xs-5 control-label'], false) !!}
                                        <div class="col-xs-6">
                                            {!! Form::select('expense_type', ['own' => 'own', 'rental' => 'rental'], $vehicle->expense_type, [
                                                'class' => 'form-control',
                                                'id' => 'expense_type',
                                                'required',
                                            ]) !!}
                                        </div>
                                    </div>
                                        <!-- Purchase Amount -->
                                        <div class="form-group purchase-amount-div">
                                            {!! Form::label('purchase_amount', __('Purchase Amount'), ['class' => 'col-xs-5 control-label']) !!}
                                            <div class="col-xs-6">
                                                {!! Form::number('purchase_amount', $vehicle->expense_amount, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <!-- Rent Amount -->
                                        <div class="form-group rent-amount-div">
                                            {!! Form::label('rent_amount', __('Rent Amount'), ['class' => 'col-xs-5 control-label']) !!}
                                            <div class="col-xs-6">
                                                {!! Form::number('rent_amount', $vehicle->expense_amount, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                    <div class="form-group">
                                        {!! Form::label('vehicle_image', __('Fleet Image'), ['class' => 'col-xs-5 control-label']) !!}
                                        @if ($vehicle->vehicle_image != null)
                                            <a href="{{ asset('uploads/' . $vehicle->vehicle_image) }}" target="_blank"
                                                class="col-xs-3 control-label">View</a>
                                        @endif
                                        <br>
                                        {!! Form::file('vehicle_image', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <!-- certificates images upload -->
                                    <div class="form-group">
                                        {!! Form::label('certificates_images', __('Certificates Images'), ['class' => 'col-xs-5 control-label']) !!}
                                        @if ($vehicle->certificates_images != null)
                                            <a href="{{ asset('uploads/' . $vehicle->certificates_images) }}"
                                                target="_blank" class="col-xs-3 control-label">View</a>
                                        @endif
                                        <br>
                                        <div class="col-xs-6">
                                            {!! Form::file('certificates_images', null, ['class' => 'form-control']) !!}
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
                                    <div class="blank"></div>
                                    @if ($udfs != null)
                                        @foreach ($udfs as $key => $value)
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group"> <label
                                                            class="form-label text-uppercase">{{ $key }}</label>
                                                        <input type="text" name="udf[{{ $key }}]"
                                                            class="form-control" required value="{{ $value }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" style="margin-top: 30px"><button
                                                            class="btn btn-danger" type="button"
                                                            onclick="this.parentElement.parentElement.parentElement.remove();">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
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

                        <div class="tab-pane " id="insurance">
                            {!! Form::open([
                                'url' => 'admin/store_insurance',
                                'files' => true,
                                'method' => 'post',
                                'class' => 'form-horizontal',
                                'id' => 'accountForm',
                            ]) !!}
                            {!! Form::hidden('user_id', Auth::user()->id) !!}
                            {!! Form::hidden('vehicle_id', $vehicle->id) !!}
                            <div class="row card-body">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        {!! Form::label('insurance_number', __('fleet.insuranceNumber'), ['class' => 'control-label']) !!}
                                        {!! Form::text('insurance_number', $vehicle->getMeta('ins_number'), ['class' => 'form-control', 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="documents" class="control-label">@lang('fleet.inc_doc')
                                        </label>
                                        @if ($vehicle->getMeta('documents') != null)
                                            <a href="{{ asset('uploads/' . $vehicle->getMeta('documents')) }}"
                                                target="_blank">View</a>
                                        @endif
                                        {!! Form::file('documents', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('insurance_issue_date', __('Insurance Issue Date'), ['class' => 'control-label required']) !!}
                                        <div class="input-group date">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-calendar"></i></span></div>
                                            {!! Form::text('insurance_issue_date', $vehicle->getMeta('ins_issue_date'), [
                                                'class' => 'form-control',
                                                'required',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('exp_date', __('fleet.inc_expirationDate'), ['class' => 'control-label required']) !!}
                                        <div class="input-group date">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-calendar"></i></span></div>
                                            {!! Form::text('exp_date', $vehicle->getMeta('ins_exp_date'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style=" margin-bottom: 20px;">
                                <div class="form-group" style="margin-top: 15px;">
                                    {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-success']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div class="tab-pane " id="acq-tab">
                            <div class="row card-body">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('fleet.acquisition') @lang('fleet.add')</h3>
                                        </div>

                                        <div class="card-body">
                                            {!! Form::open([
                                                'route' => 'acquisition.store',
                                                'method' => 'post',
                                                'class' => 'form-inline',
                                                'id' => 'add_form',
                                            ]) !!}
                                            {!! Form::hidden('user_id', Auth::user()->id) !!}
                                            {!! Form::hidden('vehicle_id', $vehicle->id) !!}
                                            <div class="form-group" style="margin-right: 10px;">
                                                {!! Form::label('exp_name', __('fleet.expenseType'), ['class' => 'form-label']) !!}
                                                {!! Form::text('exp_name', null, ['class' => 'form-control', 'required']) !!}
                                            </div>
                                            <div class="form-group"></div>
                                            <div class="form-group" style="margin-right: 10px;">
                                                {!! Form::label('exp_amount', __('fleet.expenseAmount'), ['class' => 'form-label']) !!}
                                                <div class="input-group" style="margin-right: 10px;">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text">{{ Hyvikk::get('currency') }}</span>
                                                    </div>
                                                    {!! Form::number('exp_amount', null, ['class' => 'form-control', 'required']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group"></div>
                                            <button type="submit" class="btn btn-success">@lang('fleet.add')</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row card-body">
                                <div class="col-md-12">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('fleet.acquisition') :<strong>
                                                    @if ($vehicle->make_name)
                                                        {{ $vehicle->make_name }}
                                                        @endif @if ($vehicle->model_name)
                                                            {{ $vehicle->model_name }}
                                                        @endif
                                                        {{ $vehicle->license_plate }}
                                                </strong>
                                            </h3>
                                        </div>
                                        <div class="card-body" id="acq_table">
                                            <div class="row">
                                                <div class="col-md-12 table-responsive">
                                                    @php($value = unserialize($vehicle->getMeta('purchase_info')))
                                                    <table class="table">
                                                        <thead>
                                                            <th>@lang('fleet.expenseType')</th>
                                                            <th>@lang('fleet.expenseAmount')</th>
                                                            <th>@lang('fleet.action')</th>
                                                        </thead>
                                                        <tbody id="hvk">
                                                            @if ($value != null)
                                                                @php($i = 0)
                                                                @foreach ($value as $key => $row)
                                                                    <tr>
                                                                        @php($i += $row['exp_amount'])
                                                                        <td>{{ $row['exp_name'] }}</td>
                                                                        <td>{{ Hyvikk::get('currency') . ' ' . $row['exp_amount'] }}
                                                                        </td>
                                                                        <td>
                                                                            {!! Form::open([
                                                                                'route' => ['acquisition.destroy', $vehicle->id],
                                                                                'method' => 'DELETE',
                                                                                'class' => 'form-horizontal',
                                                                            ]) !!}
                                                                            {!! Form::hidden('vid', $vehicle->id) !!}
                                                                            {!! Form::hidden('key', $key) !!}
                                                                            <button type="button"
                                                                                class="btn btn-danger del_info"
                                                                                data-vehicle="{{ $vehicle->id }}"
                                                                                data-key="{{ $key }}">
                                                                                <span class="fa fa-times"></span>
                                                                            </button>
                                                                            {!! Form::close() !!}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                <tr>
                                                                    <td><strong>@lang('fleet.total')</strong></td>
                                                                    <td><strong>{{ Hyvikk::get('currency') . ' ' . $i }}</strong>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Allocate Driver -->
                        <div class="tab-pane" id="driver">
                            {!! Form::open([
                                'url' => 'admin/assignDriver',
                                'files' => true,
                                'method' => 'post',
                                'class' => 'form-horizontal',
                                'id' => 'accountForm',
                            ]) !!}
                            {!! Form::hidden('user_id', Auth::user()->id) !!}
                            {!! Form::hidden('vehicle_id', $vehicle->id) !!}
                            <div class="row card-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('driver_id', __('fleet.selectDriver'), ['class' => 'form-label']) !!}
                                        <select id="driver_id" name="driver_id" class="form-control" required>
                                            <option value="">-</option>
                                            @foreach ($drivers as $driver)
                                                <option value="{{ $driver->id }}"
                                                    @if ($vehicle->driver_id == $driver->id) selected @endif
                                                    @if ($driver->getMeta('is_active') != 1) disabled @endif>
                                                    {{ $driver->name }}
                                                    @if ($driver->getMeta('is_active') != 1)
                                                        (@lang('fleet.in_active'))
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style=" margin-bottom: 20px;">
                                <div class="form-group" style="margin-top: 15px;">
                                    {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-success']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- Allocate Site -->
                        {{-- <div class="tab-pane" id="site">
                            {!! Form::open([
                                'url' => 'admin/assignSite',
                                'files' => true,
                                'method' => 'post',
                                'class' => 'form-horizontal',
                                'id' => 'accountForm',
                            ]) !!}
                            {!! Form::hidden('user_id', Auth::user()->id) !!}
                            {!! Form::hidden('vehicle_id', $vehicle->id) !!}
                            <div class="row card-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('site_id', __('Select Site'), ['class' => 'form-label']) !!}
                                        <select id="site_id" name="site_id" class="form-control" required>
                                            <option value="" disabled>Select Site</option>
                                            @forelse ($sites as $s)
                                            <option value="{{ $s->id }}" @if ($vehicle->site_id == $s->id) selected @endif
                                                @if ($s->status != 1) disabled @endif>
                                                {{ $s->site_name }}
                                                @if ($s->status != 1)
                                                (Inactive)
                                                @endif
                                            </option>
                                            @empty
                                            <option>No sites available</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style=" margin-bottom: 20px;">
                                <div class="form-group" style="margin-top: 15px;">
                                    {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-warning']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div> --}}


                        {!! Form::close() !!}
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
    {{-- <script></script> --}}
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
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var getByTypeUrl = '{{ route('vehicle-data-by-type', '') }}';

            $('#type_id').change(function() {
                var typeId = $(this).val();
                var typeName = $(this).find('option:selected').data('type-name');

                $.get(getByTypeUrl + '/' + typeId, function(data) {
                    var makeModelDropdown = $('#make_model');
                    makeModelDropdown.empty();
                    makeModelDropdown.append(
                    '<option selected></option>'); // to keep the initial empty option

                    $.each(data, function(index, item) {
                        makeModelDropdown.append('<option value="' + item.id + '">' + item
                            .make + ' - ' + item.model + '</option>');
                    });

                    makeModelDropdown.prop('selectedIndex', 0).change(); // Reset the selection to the first option and trigger change event
                });

                if(typeName == 'Vehicle') { // Replace 'vehicle' with the actual id of vehicle type
                $('#average_label .avg').text('Average (Km Per Liter)');
                }
                else if(typeName == 'Equipment') { // Replace 'equipment' with the actual id of equipment type
                $('#average_label .avg').text('Average (Per hour)');
                }
            });
            expense_type = "{{ $vehicle->expense_type }}";
            console.log(expense_type);
            if (expense_type === 'own') {
                $('.rent-amount-div').hide();
                $('.purchase-amount-div').show();
            } else if (expense_type === 'rental') {
                $('.purchase-amount-div').hide();
                $('.rent-amount-div').show();
            }
            $('#expense_type').change(function() {
                // Show the appropriate div based on the selected option
                if ($(this).val() === 'own') {
                    $('.purchase-amount-div').show();
                    $('.rent-amount-div').hide();
                } else if ($(this).val() === 'rental') {
                    $('.rent-amount-div').show();
                    $('.purchase-amount-div').hide();
                }
            });
            $('#driver_id').select2({
                placeholder: "@lang('fleet.selectDriver')"
            });
            $('#group_id').select2({
                placeholder: "@lang('fleet.selectGroup')"
            });
            $('#type_id').select2({
                placeholder: "@lang('fleet.type')"
            });
            $('#make_model').select2({
                placeholder: "Fleet Make - Model"
            });
            $('#model_name').select2({
                placeholder: "@lang('fleet.SelectVehicleModel')"
            });
            $('#color_name').select2({
                placeholder: "@lang('fleet.SelectVehicleColor')"
            });
            // $('#make_name').on('change',function(){
            //       // alert($(this).val());
            //       $.ajax({
            //         type: "GET",
            //         url: "{{ url('admin/get-models') }}/"+$(this).val(),
            //         success: function(data){
            //           var models =  $.parseJSON(data);
            //             $('#model_name').empty();
            //             $.each( models, function( key, value ) {
            //               $('#model_name').append($('<option>', {
            //                 value: value.id,
            //                 text: value.text
            //               }));
            //               $('#model_name').select2({placeholder:"@lang('fleet.SelectVehicleModel')"});
            //             });
            //         },
            //         dataType: "html"
            //       });
            //     });
            @if (isset($_GET['tab']) && $_GET['tab'] != '')
                $('.nav-pills a[href="#{{ $_GET['tab'] }}"]').tab('show')
            @endif
            $('#start_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#end_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#exp_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#lic_exp_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#reg_exp_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('#issue_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $(document).on("click", ".del_info", function(e) {
                var hvk = confirm("Are you sure?");
                if (hvk == true) {
                    var vid = $(this).data("vehicle");
                    var key = $(this).data('key');
                    var action = "{{ route('acquisition.index') }}/" + vid;

                    $.ajax({
                        type: "POST",
                        url: action,
                        data: "_method=DELETE&_token=" + window.Laravel.csrfToken + "&key=" + key +
                            "&vehicle_id=" + vid,
                        success: function(data) {
                            $("#acq_table").empty();
                            $("#acq_table").html(data);
                            new PNotify({
                                title: 'Deleted!',
                                text: '@lang('fleet.deleted')',
                                type: 'wanring'
                            })
                        },
                        dataType: "HTML",
                    });
                }
            });

            $("#add_form").on("submit", function(e) {
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    success: function(data) {
                        $("#acq_table").empty();
                        $("#acq_table").html(data);
                        new PNotify({
                            title: 'Success!',
                            text: '@lang('fleet.exp_add')',
                            type: 'success'
                        });
                        $('#exp_name').val("");
                        $('#exp_amount').val("");
                    },
                    dataType: "HTML"
                });
                e.preventDefault();
            });

            // $("#accountForm").on("submit",function(e){
            //   $.ajax({
            //     type: "POST",
            //     url: $("#accountForm").attr("action"),
            //     data: new FormData(this),
            //     mimeType: 'multipart/form-data',
            //     contentType: false,
            //               cache: false,
            //               processData:false,
            //     success: new PNotify({
            //           title: 'Success!',
            //           text: '@lang('fleet.ins_add')',
            //           type: 'success'
            //       }),
            //   dataType: "json",
            //   });
            //   e.preventDefault();
            // });

            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

        });
    </script>
    <script>
        // Initialize Select2 on your select boxes
        // Listen for the select2:select event on the first select box
        $('#make_name').on('select2:select', function(e) {
            // Clear the contents of the second select box
            $('#model_name').val(null).trigger('change');
            $('#color_name').val(null).trigger('change');

        });
    </script>
@endsection
