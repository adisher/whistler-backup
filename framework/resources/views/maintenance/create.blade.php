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
    <li class="breadcrumb-item"><a href="{{ route('maintenance.index') }}"> Corrective Maintenance </a></li>
    <li class="breadcrumb-item active">Add Maintenance</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Add Maintenance</h3>
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

                    {!! Form::open(['route' => 'maintenance.store', 'files' => true, 'method' => 'post']) !!}
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
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->vehicleData->make }} -
                                            {{ $vehicle->vehicleData->model }} -
                                            {{ $vehicle->license_plate }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                {!! Form::label(
                                    'parts_id',
                                    __('Select Part/Item') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ) !!}
                                <select id="parts_id" name="parts_id" class="form-control" required>
                                    <option value="">-</option>
                                    @foreach ($parts as $part)
                                        <option value="{{ $part->id }}">{{ $part->title }} - {{ $part->vendor->name }}
                                            -
                                            {{ $part->stock }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                {!! Form::label('date', __('Date') . ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                                {!! Form::date('date', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label(
                                    'meter',
                                    __('Meter Reading') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ) !!}
                                {!! Form::text('meter', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label(
                                    'quantity',
                                    __('Used Parts Quantity') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ) !!}
                                {!! Form::number('quantity', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('price', __('Price') . ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
                                {!! Form::text('price', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label(
                                    'subject',
                                    __('Subject') . ' <span class="text-danger">*</span>',
                                    ['class' => 'form-label'],
                                    false,
                                ) !!}
                                {!! Form::text('subject', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('files', __('Select Image'), ['class' => 'form-label']) !!}
                                {!! Form::file('files', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', __('Description'), ['class' => 'form-label']) !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        {!! Form::submit(__('Add'), ['class' => 'btn btn-success']) !!}
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
            $('#group_id').select2({
                placeholder: "@lang('fleet.selectGroup')"
            });
            $('#role_id').select2({
                placeholder: "@lang('fleet.role')"
            });
            $('#vehicle_id').select2({
                placeholder: "Select Fleet"
            });
            $('#parts_id').select2({
                placeholder: "Select Parts/Items"
            });

            // Declare a variable to store unit cost
            let unitCost = 0;

            // Listen for change event on #parts_id select field
            $('#parts_id').change(function() {
                var partId = $(this).val();
                console.log(partId);
                if (partId) {
                    console.log(partId);
                    // Initialize a URL template with a placeholder for the partId
                    var urlTemplate = '{{ route('parts_unit_cost', ['id' => ':id']) }}';

                    // Replace the placeholder with the actual partId
                    var url = urlTemplate.replace(':id', partId);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            // Update the unitCost variable
                            unitCost = parseFloat(response);

                            // Trigger a change event on #quantity to update the price
                            $('#quantity').trigger('change');
                        },
                        error: function(error) {
                            console.error('Error fetching unit cost:', error);
                        }
                    });
                }
            });

            // Listen for change or input event on #quantity field
            $('#quantity').on('change input', function() {
                const quantity = parseFloat($(this).val());
                if (quantity && unitCost) {
                    // Calculate the total price
                    const totalPrice = unitCost * quantity;
                    // Populate the #price field
                    $('#price').val(totalPrice.toFixed(2));
                } else {
                    // Clear the #price field if either quantity or unitCost is not available
                    $('#price').val('');
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
