@extends('layouts.app')
@php($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y')

@section("breadcrumb")
<li class="breadcrumb-item"><a href="#">@lang('menu.reports')</a></li>
<li class="breadcrumb-item active">Product Yield Report</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Product Yield Report
                </h3>
            </div>

            <div class="card-body">
                {!! Form::open(['route' => 'reports.yield_report','method'=>'post','class'=>'form-inline']) !!}
                @csrf
                <div class="row">
                    <div id="reportrange" class="form-control" style="margin-right: 10px">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                        <input type="hidden" name="daterange" id="daterange">
                    </div>

                    <div class="form-group" style="margin-right: 10px">
                        {{-- {!! Form::label('site_name', __('Sites'), ['class' => 'form-label']) !!} --}}
                        <select id="site_name" name="site_name" class="form-control vehicles" style="width: 250px;">
                            <option value="">Select Site</option>
                            @foreach($sites as $s)
                            <option value="{{ $s['site_name'] }}" @if($s['site_name']==$site) selected @endif>
                                {{$s->site_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info"
                        style="margin-right: 10px">@lang('fleet.generate_report')</button>
                    <button type="submit" formaction="{{url('admin/print-fuel-report')}}" class="btn btn-danger"><i
                            class="fa fa-print"></i> @lang('fleet.print')</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@if(isset($result))
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Fuel Report
                </h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table" id="myTable" style="padding-bottom: 25px">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>@lang('fleet.site_name')</th>
                            <th>@lang('fleet.site_details')</th>
                            <th>@lang('fleet.shift_details')</th>
                            <th>Shift Yield Details</th>
                            <th>Site Production Details</th>
                            <th>Stock Details</th>
                            <th>Product Transfer</th>
                            <th>@lang('fleet.shift_yield')</th>
                            <th>@lang('fleet.daily_yield')</th>
                            <th>Daily Quantity</th>
                            <th>Wastage</th>
                            <th>@lang('fleet.date')</th>
                            <th>@lang('fleet.time')</th>
                            <th>@lang('fleet.shift_incharge_id')</th>
                            <th>Shift Quantity</th>
                            <th>Yield Quality</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($yield as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->site_name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->site_details, 10, '...') }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->shift_details, 10, '...') }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->shift_yield_details, 10, '...') }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->site_production_details, 10, '...') }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->stock_details, 10, '...') }}</td>
                            <td>{{ $item->product_transfer ? 'Yes' : 'No' }}</td>
                            <td>{{ $item->shift_yield }}</td>
                            <td>{{ $item->daily_yield }}</td>
                            <td>{{ $item->daily_quantity }}</td>
                            <td>{{ $item->wastage }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->date)) }}</td>
                            <td>{{ date('h:i a', strtotime($item->time)) }}</td>
                            <td>{{ $item->incharge->name }}</td>
                            <td>{{ $item->shift_quantity }}</td>
                            <td>{{ $item->yield_quality }}</td>
                            @if (Auth::user()->user_type == 'O' && Auth::user()->group_id == 1)
                            <td>{{ $item->status ? 'Forwarded' : 'Not Forwarded' }}</td>
                            @else
                            <td>{{ $item->status ? 'Approved' : 'Not Approved' }}</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>@lang('fleet.site_name')</th>
                            <th>@lang('fleet.site_details')</th>
                            <th>@lang('fleet.shift_details')</th>
                            <th>Shift Yield Details</th>
                            <th>Site Production Details</th>
                            <th>Stock Details</th>
                            <th>Product Transfer</th>
                            <th>@lang('fleet.shift_yield')</th>
                            <th>@lang('fleet.daily_yield')</th>
                            <th>Daily Quantity</th>
                            <th>Wastage</th>
                            <th>@lang('fleet.date')</th>
                            <th>@lang('fleet.time')</th>
                            <th>@lang('fleet.shift_incharge_id')</th>
                            <th>Shift Quantity</th>
                            <th>Yield Quality</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section("script")
<script type="text/javascript" src="{{ asset('assets/js/cdn/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/cdn/buttons.html5.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();
        
        function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        // Update the hidden input field's value
        $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        }
        
        $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
        }, cb);
        
        cb(start, end);
		$("#vehicle_id").select2();
		$('#myTable tfoot th').each( function () {
	      var title = $(this).text();
	      $(this).html( '<input type="text" placeholder="'+title+'" />' );
	    });
	    var myTable = $('#myTable').DataTable( {
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