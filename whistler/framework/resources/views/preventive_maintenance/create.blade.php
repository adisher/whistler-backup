@extends('layouts.app')
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{ route('preventive-maintenance.index')}}">Preventive Maintenance</a></li>
<li class="breadcrumb-item active">Add Preventive Maintenance</li>
@endsection
@section('extra_css')
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.min.css')}}">
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Preventive Maintenance</h3>
      </div>
      {!! Form::open(['route' => 'preventive-maintenance.store','method'=>'post']) !!}
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
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('vehicle_id',__('Select Fleet'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
              <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                <option value=""></option>
                @foreach($vehicles as $v)
                <option value="{{$v->id}}">{{$v->vehicleData->make}} {{$v->vehicleData->model}} - {{$v->license_plate}} </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              {!! Form::label('start_meter', __('Last Meter Reading'), ['class' => 'form-label']) !!}
              <div class="input-group date">
                <div class="input-group-prepend"><span class="input-group-text">{{Hyvikk::get('dis_format')}}</span></div>
                {!! Form::number('start_meter',null,['class'=>'form-control','required', 'min'=>'0',
                'readonly'
                ]) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('date', __('Date'). ' <span class="text-danger">*</span>', ['class' => 'form-label'], false) !!}
              <div class="input-group date">
                <div class="input-group-prepend"><span class="input-group-text"><span
                      class="fa fa-calendar"></span></span></div>
                {!! Form::text('date',date('Y-m-d'),['class'=>'form-control','required','id'=>'start_date']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label(
              'recipient',
              __('Email Reminder Recipients') . ' <span class="text-danger">*</span>',
              ['class' => 'form-label'],
              false,
              ) !!}
              <select id="recipient" name="recipients[]" multiple="multiple" class="form-control">
                <option value="">-</option>
                @foreach ($recipients as $recipient)
                <option value="{{ $recipient->email }}">{{ $recipient->email }}</option>
                @endforeach
              </select>
            </div>
            
          </div>
          <div class="col-md-6">
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
              {!! Form::label(
              'quantity',
              __('Used Parts/Items Quantity') . ' <span class="text-danger">*</span>',
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
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead class="thead-inverse">
              <tr>
                <th>
                </th>
                <th>@lang('fleet.description')</th>
                <th>Planned Meter Interval (kms)</th>
              </tr>
            </thead>
            <tbody>
              @foreach($services as $service)
              <tr>
                <td>
                  <input type="checkbox" name="chk[]" value="{{$service->id}}" class="flat-red">
                </td>
                <td>
                  {{$service->description}}
                </td>
                <td>
                  {{$service->meter_interval}} 
                  @if($service->overdue_meter != null)
                  @lang('fleet.or') {{$service->overdue_meter}} {{Hyvikk::get('dis_format')}}
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-md-12">
          {!! Form::submit(__('fleet.save'), ['class' => 'btn btn-success']) !!}
        </div>
      </div>
      {!! Form::close() !!}
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
    $('#vehicle_id').select2({placeholder: "Select Fleet"});
    $('#parts_id').select2({placeholder: "Select Parts/Item"});
    $('#recipient').select2({
    placeholder: "Select Recipients"
    });

    $('#vehicle_id').change(function() {
    var vehicleId = $(this).val();
    
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
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    });

  $('#start_date').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  });
  });
</script>
@endsection