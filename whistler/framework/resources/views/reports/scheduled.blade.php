@extends('layouts.app')
@php($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y')

@section("breadcrumb")
<li class="breadcrumb-item"><a href="#">@lang('menu.reports')</a></li>
<li class="breadcrumb-item active">Scheduled Reports</li>
@endsection
@section('content')
{{-- <div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">@lang('fleet.income') @lang('fleet.report')
                </h3>
            </div>

            <div class="card-body">
                {!! Form::open(['url' => 'admin/reports/income','method'=>'post','class'=>'form-inline']) !!}
                <div class="row">
                    <div class="form-group" style="margin-right: 10px">
                        {!! Form::label('year', __('fleet.year1'), ['class' => 'form-label']) !!}
                        {!! Form::select('year', $years, $year_select,['class'=>'form-control']); !!}
                    </div>

                    <div class="form-group" style="margin-right: 10px">
                        {!! Form::label('month', __('fleet.month'), ['class' => 'form-label']) !!}
                        {!! Form::selectMonth('month',$month_select,['class'=>'form-control']); !!}
                    </div>

                    <div class="form-group" style="margin-right: 10px">
                        {!! Form::label('vehicle', __('fleet.vehicles'), ['class' => 'form-label']) !!}
                        <select id="vehicle_id" name="vehicle_id" class="form-control vehicles" style="width: 250px">
                            <option value="">@lang('fleet.selectVehicle')</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" @if($vehicle->id==$vehicle_id) selected
                                @endif>{{$vehicle->make_name}}-{{$vehicle->model_name}}-{{$vehicle->license_plate}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info"
                        style="margin-right: 10px">@lang('fleet.generate_report')</button>
                    <button type="submit" formaction="{{url('admin/print-income')}}" class="btn btn-danger"
                        style="margin-right: 10px"><i class="fa fa-print"></i> @lang('fleet.print')</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Scheduled Reports
                </h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th>Report Name</th>
                            <th>Frequency</th>
                            <th>Format</th>
                            <th>Report Type</th>
                            <th>Recipients</th>
                            <th>Assets</th>
                            <th>Subject</th>
                            <th>Content</th>
                            <th>Date & Time</th>
                            <th>End Date</th>
                            <th>Created By</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($scheduled as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->frequency}}</td>
                            <td>{{$row->format}}</td>
                            <td>{{$row->type}}</td>
                            <td>{{$row->recipients}}</td>
                            <td>{{$row->assets}}</td>
                            <td>{{$row->subject}}</td>
                            <td>{{$row->content}}</td>
                            <td>{{date($date_format_setting,strtotime($row->date))}}</td>
                            <td>{{date($date_format_setting,strtotime($row->end))}}</td>
                            <td>{{date($date_format_setting,strtotime($row->created_by))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Report Name</th>
                            <th>Frequency</th>
                            <th>Format</th>
                            <th>Report Type</th>
                            <th>Recipients</th>
                            <th>Assets</th>
                            <th>Subject</th>
                            <th>Content</th>
                            <th>Date & Time</th>
                            <th>End Date</th>
                            <th>Created By</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section("script")

<script type="text/javascript" src="{{ asset('assets/js/cdn/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/buttons.html5.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $("#vehicle_id").select2();
    $('#myTable tfoot th').each( function () {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="'+title+'" />' );
    });
  	var myTable =	$('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [{
             extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                ]}
        ],
        "language": {
                 "url": '{{ asset("assets/datatables/")."/".__("fleet.datatable_lang") }}',
              },
         // individual column search
         "initComplete": function() {
                  myTable.columns().every(function () {
                    var that = this;
                    $('input', this.footer()).on('keyup change', function () {
                        that.search(this.value).draw();
                    });
                  });
                }
    });
	});
</script>
@endsection